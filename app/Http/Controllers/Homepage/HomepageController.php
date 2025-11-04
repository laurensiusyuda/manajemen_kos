<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\UserRole;
use Auth;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole(UserRole::ADMIN)) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            }
            return redirect(route('tenant.dashboard'));
        }
        return view('guest.homepage');
    }
}
