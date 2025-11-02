<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', ['user' => auth()->user()]);
    }

    public function hunter()
    {
        return view('dashboard.hunter', ['user' => auth()->user()]);
    }
}
