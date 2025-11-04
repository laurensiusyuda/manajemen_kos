<?php

namespace App\Livewire\Admin;

use Illuminate\Validation\Rules\Enum as ValidationRule;
use Illuminate\Validation\Rule;
use App\Models\Properti;
use App\UnitStatus;
use Livewire\Attributes\Layout;
use App\Models\Unit as UnitModel;
use Livewire\Component;

#[Layout('layouts.app')]
class Unit extends Component
{

    public Properti $properti;
    public $unitName;
    public $unitPrice;
    public $unitStatus;

    public $unit_id;
    public $showModal = false;
    public $showDeleteModal = false;

    public function mount(Properti $properti)
    {
        if ($properti->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }
        $this->properti = $properti;
    }

    protected function rules()
    {
        return [
            'unitName' => 'required|string|max:255',
            'unitPrice' => 'required|numeric|min:0',
            'unitStatus' => ['required', new ValidationRule(UnitStatus::class)],
        ];
    }

    private function resetForm()
    {
        $this->reset(['unitName', 'unitPrice', 'unitStatus', 'unit_id']);
        $this->unitStatus = UnitStatus::AVAILABLE;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function store()
    {
        $validatedData = $this->validate();
        $dataToSave = [
            'name' => $validatedData['unitName'],
            'price' => $validatedData['unitPrice'],
            'status' => $validatedData['unitStatus']->value
        ];
        $this->properti->units()->create($dataToSave);
        session()->flash('success', 'Unit berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit(UnitModel $unit)
    {
        if ($unit->property_id !== $this->properti->id) {
            abort(403);
        }
        $this->unit_id = $unit->id;
        $this->unitName = $unit->name;
        $this->unitPrice = $unit->price;
        $this->unitStatus = $unit->status;
        $this->showModal = true;
    }

    public function update()
    {
        $validatedData = $this->validate();
        $unit = UnitModel::find($this->unit_id);

        if (!$unit || $unit->property_id !== $this->properti->id) {
            abort(403);
        }
        $dataToUpdate = [
            'name' => $validatedData['unitName'],
            'price' => $validatedData['unitPrice'],
            'status' => $validatedData['unitStatus']->value
        ];
        // if ($unit->status == UnitStatus::OCCUPIED) {
        //     unset($dataToUpdate['status']);
        // }
        $unit->update($dataToUpdate);
        session()->flash('success', 'Unit berhasil diperbarui.');
        $this->closeModal();
    }

    public function confirmDelete(UnitModel $unit)
    {
        if ($unit->property_id !== $this->properti->id) {
            abort(403);
        }
        if ($unit->status == UnitStatus::OCCUPIED) {
            session()->flash('error', 'Unit tidak bisa dihapus karena sedang ditempati.');
            return;
        }
        $this->unit_id = $unit->id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $unit = UnitModel::find($this->unit_id);
        if (!$unit || $unit->property_id !== $this->properti->id || $unit->status == UnitStatus::OCCUPIED) {
            abort(403);
        }
        $unit->delete();
        session()->flash('success', 'Unit berhasil dihapus.');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }

    public function render()
    {
        $units = $this->properti->units()->latest()->get();
        $properti = $this->properti;
        return view('livewire.admin.unit', [
            'units' => $units,
            'properti' => $properti
        ]);
    }
}
