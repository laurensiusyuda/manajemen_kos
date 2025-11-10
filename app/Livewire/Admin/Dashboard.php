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


        $dataPenyewa = DB::table('users')
            ->join('propertis', 'users.id', '=', 'propertis.user_id')
            ->join('tenants', 'propertis.id', '=', 'tenants.property_id')
            ->where('users.id', $userId)
            ->get();

        $dataKamarTersewa = DB::table('users')
            ->join('propertis', 'users.id', '=', 'propertis.user_id')
            ->join('units', 'propertis.id', '=', 'units.property_id')
            ->where('users.id', $userId)
            ->where('units.status', 'occupied')
            ->get();

        $dataKamarTersewabyUnit = DB::table('units')
            ->join('propertis', 'units.property_id', '=', 'propertis.id')
            ->join('users', 'propertis.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->where('units.status', 'occupied')
            ->select(
                'propertis.name as properti_name',
                'propertis.address as properti_address',
                'units.name as unit_name',
                'units.price as unit_price',
                'units.status as unit_status'
            )
            ->get();

        $dataKamarTersediabyUnit = DB::table('units')
            ->join('propertis', 'units.property_id', '=', 'propertis.id')
            ->join('users', 'propertis.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->where('units.status', 'available')
            ->select(
                'propertis.name as properti_name',
                'propertis.address as properti_address',
                'units.name as unit_name',
                'units.price as unit_price',
                'units.status as unit_status'
            )
            ->get();

        return view('livewire.admin.dashboard', [
            'jumlahKamarTotal' => $dataKamarTotal,
            'jumlahKamarTersedia' => $dataKamarTersedia,
            'jumlahKamarTersewa' => $dataKamarTersewa,
            'jumlahProperti' => $dataProperti,
            'jumlahPenyewa' => $dataPenyewa,
            'kamarTersewabyUnit' => $dataKamarTersewabyUnit,
            'kamarTersediabyUnit' => $dataKamarTersediabyUnit,
        ]);
    }
}
