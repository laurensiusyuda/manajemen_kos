<?php

namespace App\Livewire\Admin;

use App\Models\Properti;
use DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;
        $dataProperti = Properti::where('user_id', $userId)->get();

        $dataKamarTotal = DB::table('users')
            ->join('propertis', 'users.id', '=', 'propertis.user_id')
            ->join('units', 'propertis.id', '=', 'units.property_id')
            ->where('users.id', $userId)
            ->get();

        $dataKamarTersedia = DB::table('users')
            ->join('propertis', 'users.id', '=', 'propertis.user_id')
            ->join('units', 'propertis.id', '=', 'units.property_id')
            ->where('users.id', $userId)
            ->where('units.status', 'available')
            ->get();

        $dataKamarTersewa = DB::table('users')
            ->join('propertis', 'users.id', '=', 'propertis.user_id')
            ->join('units', 'propertis.id', '=', 'units.property_id')
            ->where('users.id', $userId)
            ->where('units.status', 'occupied')
            ->get();


        return view('livewire.admin.dashboard', [
            'jumlahKamarTotal' => count($dataKamarTotal),
            'jumlahKamarTersedia' => count($dataKamarTersedia),
            'jumlahKamarTersewa' => count($dataKamarTersewa),
            'jumlahProperti' => count($dataProperti),
        ]);
    }
}
