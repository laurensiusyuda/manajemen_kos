<?php

namespace App\Livewire\Admin;

use App\Models\Properti as ModelsProperti;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Properti extends Component
{
    public $namaProperti;
    public $alamat;
    public $propertyId;

    public $showModal = false;
    public $showDeleteModal = false;

    protected $rules = [
        'namaProperti' => 'required|string|max:255',
        'alamat' => 'required|string',
    ];

    private function resetForm()
    {
        $this->reset(['namaProperti', 'alamat', 'propertyId']);
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

    public function store()
    {
        $validatedData = $this->validate();
        $dataToSave = [
            'name' => $validatedData['namaProperti'],
            'address' => $validatedData['alamat']
        ];

        auth()->user()->properties()->create($dataToSave);

        session()->flash('success', 'Properti berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit(ModelsProperti $property)
    {
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }
        $this->propertyId = $property->id;
        $this->namaProperti = $property->name;
        $this->alamat = $property->address;

        $this->showModal = true;
    }

    public function update()
    {
        $validatedData = $this->validate();
        $property = ModelsProperti::find($this->propertyId);

        if (!$property || $property->user_id !== auth()->id()) {
            abort(403);
        }
        $dataToUpdate = [
            'name' => $validatedData['namaProperti'],
            'address' => $validatedData['alamat']
        ];

        $property->update($dataToUpdate);

        session()->flash('success', 'Properti berhasil diperbarui.');
        $this->closeModal();
    }

    public function confirmDelete(ModelsProperti $property)
    {
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }
        if ($property->units()->count() > 0) {
            session()->flash('error', 'Properti tidak bisa dihapus karena masih memiliki unit kamar.');
            return;
        }

        $this->propertyId = $property->id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $property = ModelsProperti::find($this->propertyId);

        if (!$property || $property->user_id !== auth()->id()) {
            abort(403);
        }
        if ($property->units()->count() > 0) {
            session()->flash('error', 'Properti tidak bisa dihapus karena masih memiliki unit kamar.');
            $this->closeModal();
            return;
        }
        $property->delete();
        session()->flash('success', 'Properti berhasil dihapus.');
        $this->closeModal();
    }

    public function render()
    {
        $properties = auth()->user()
            ->properties()
            ->withCount('units')
            ->latest()
            ->get();
        return view('livewire.admin.properti', ['properties' => $properties]);
    }
}
