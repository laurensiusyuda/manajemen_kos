<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Invoice extends Component
{
    use WithPagination;
    public $search = '';
    public $filterStatus ='';

    public $tenantList = [];
    public $selectedTenant = null;
    public $invoice_period;
    public $amount;
    public $status = 'unpaid';

    public $showModal = false;
    public $showDeleteModal = false;
    public function render()
    {
        return view('livewire.admin.invoice');
    }

    protected function rules(){
        return [
            'selectedTenant' => 'required|exists:tenants,id',
            'invoice_period' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
        ];
    }
}
