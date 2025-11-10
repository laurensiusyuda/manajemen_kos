<?php

namespace App\Livewire\Admin;

use App\Models\Tenant as ModelsTenant;
use App\Models\Unit;
use App\Models\User;
use App\UnitStatus;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]

class Tenant extends Component
{
    use WithPagination;

    public $search;
    public $fullName;
    public $phoneNumber;
    public $moveInDate;
    public $email;
    public $password;
    public $user_id;
    public $originalUnitId;
    public $selectedProperty = null;
    public $selectedUnit = null;
    public $propertiList = [];
    public $unitList = [];

    public $tenant_id;

    public $showModal = false;
    public $showDeleteModal = false;

    protected function rules()
    {
        return [
            'fullName' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id) // <-- Gunakan properti $user_id
            ],
            'phoneNumber' => 'nullable|string|max:20',
            'moveInDate' => 'required|date',
            'password' => $this->tenant_id ? 'nullable|min:8' : 'required|min:8',
            'selectedProperty' => 'required|exists:propertis,id',
            'selectedUnit' => [
                'required',
                Rule::exists('units', 'id')->where(function ($query) {
                    $query->where('property_id', $this->selectedProperty)
                        ->where(function ($subQuery) {
                            $subQuery->where('status', UnitStatus::AVAILABLE->value)
                                ->orWhere('id', $this->originalUnitId);
                        });
                })
            ],
        ];
    }


    private function resetForm()
    {
        $this->reset(['fullName', 'email', 'phoneNumber', 'moveInDate', 'password', 'selectedProperty', 'selectedUnit', 'tenant_id', 'user_id', 'originalUnitId']); // <-- TAMBAHKAN user_id & originalUnitId
        $this->unitList = [];
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->propertiList = auth()->user()->properties()->pluck('name', 'id');
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }


    public function updatedSelectedProperty($property_id)
    {
        if ($property_id) {
            $query = Unit::where('property_id', $property_id)
                ->where('status', UnitStatus::AVAILABLE->value);
            if ($this->originalUnitId) {
                $query->orWhere('id', $this->originalUnitId);
            }
            $this->unitList = $query->pluck('name', 'id');
            $this->selectedUnit = null;
        } else {
            $this->unitList = [];
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        DB::beginTransaction();
        try {
            $newUser = User::create([
                'name' => $validatedData['fullName'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $newUser->assignRole('tenant');

            $newTenant = ModelsTenant::create([
                'user_id' => $newUser->id,
                'property_id' => $this->selectedProperty,
                'unit_id' => $this->selectedUnit,
                'full_name' => $validatedData['fullName'],
                'phone_number' => $validatedData['phoneNumber'],
                'move_in_date' => $validatedData['moveInDate'],
                'status' => 'active',
            ]);

            $unit = Unit::find($this->selectedUnit);
            $unit->update(['status' => UnitStatus::OCCUPIED]);
            DB::commit();
            session()->flash('success', 'Penyewa baru berhasil ditambahkan.');
            $this->closeModal();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            session()->flash('error', 'Penyewa baru gagal ditambahkan.');
            $this->closeModal();
        }
    }

    public function edit(ModelsTenant $tenant)
    {
        if (!$tenant || $tenant->property->user_id !== auth()->id()) {
            abort(403);
        }

        $this->tenant_id = $tenant->id;
        $this->user_id = $tenant->user_id;
        $this->originalUnitId = $tenant->unit_id;

        $this->fullName = $tenant->full_name;
        $this->phoneNumber = $tenant->phone_number;
        $this->moveInDate = $tenant->move_in_date;
        $this->selectedProperty = $tenant->property_id;
        $this->selectedUnit = $tenant->unit_id;
        $this->email = $tenant->user->email;

        $this->unitList = Unit::where('property_id', $this->selectedProperty)
            ->where('status', UnitStatus::AVAILABLE->value)
            ->orWhere('id', $this->selectedUnit)
            ->pluck('name', 'id');

        $this->showModal = true;
    }

    public function update()
    {
        $validatedData = $this->validate();
        DB::beginTransaction();
        try {
            $tenant = ModelsTenant::find($this->tenant_id);

            if (!$tenant || $tenant->property->user_id !== auth()->id()) {
                abort(403);
            }

            $old_unit_id = $tenant->unit_id;
            $new_unit_id = $validatedData['selectedUnit'];

            if ($old_unit_id != $new_unit_id) {
                if ($old_unit_id) {
                    $oldUnit = Unit::find($old_unit_id);
                    if ($oldUnit) $oldUnit->update(['status' => UnitStatus::AVAILABLE]);
                }
                $newUnit = Unit::find($new_unit_id);
                if ($newUnit) $newUnit->update(['status' => UnitStatus::OCCUPIED]);
            }

            $tenant->update([
                'full_name' => $validatedData['fullName'],
                'phone_number' => $validatedData['phoneNumber'],
                'move_in_date' => $validatedData['moveInDate'],
                'property_id' => $validatedData['selectedProperty'],
                'unit_id' => $validatedData['selectedUnit'],
            ]);

            $user = $tenant->user;

            $user->update([
                'name' => $validatedData['fullName'],
                'email' => $validatedData['email'],
            ]);

            if (!empty($validatedData['password'])) {
                $user->update(['password' => Hash::make($validatedData['password'])]);
            }
            DB::commit();
            session()->flash('success', 'Penyewa berhasil diperbarui.');
            $this->closeModal();
        } catch (\Throwable $th) {

            DB::rollBack();
            session()->flash('error', 'Penyewa gagal diperbarui.');
            $this->closeModal();
        }
    }

    public function confirmDelete(ModelsTenant $tenant)
    {
        if (!$tenant || $tenant->property->user_id !== auth()->id()) {
            abort(403);
        }
        $this->tenant_id = $tenant->id;
        $this->showDeleteModal = true;
    }


    public function delete()
    {
        DB::beginTransaction();
        try {
            $tenant = ModelsTenant::find($this->tenant_id);
            if (!$tenant || $tenant->property->user_id !== auth()->id()) {
                abort(403);
            }
            $tenant->delete();
            DB::commit();
            session()->flash('success', 'Penyewa berhasil dihapus.');
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Penyewa gagal dihapus.');
            $this->closeModal();
        }
    }

    public function render()
    {
        $seacrhTerm = '%' . $this->search . '%';
        $tenants = ModelsTenant::whereHas('property', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->when($this->search, function ($query) use ($seacrhTerm) {
                $query->where(function ($query) use ($seacrhTerm) {
                    $query->WhereHas('user', function ($query) use ($seacrhTerm) {
                        $query->where('name', 'like', $seacrhTerm)
                            ->orWhere('email', 'like', $seacrhTerm);
                    })->orWhereHas('property', function ($query) use ($seacrhTerm) {
                        $query->where('name', 'like', $seacrhTerm);
                    });
                });
            })
            ->with(['user', 'property'])
            ->paginate(10);

        return view(
            'livewire.admin.tenant',
            [
                'tenants' => $tenants
            ]
        );
    }
}
