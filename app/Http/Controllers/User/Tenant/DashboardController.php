<?php

namespace App\Http\Controllers\User\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('guest.homepage');
    }
}
