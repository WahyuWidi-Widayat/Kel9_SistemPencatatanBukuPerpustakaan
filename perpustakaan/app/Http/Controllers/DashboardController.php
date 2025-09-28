<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function rootDashboard(): View
    {
        $users = User::all();
        return view('dashboard.root', compact('users'));
    }

    public function adminDashboard(): View
    {
        return view('dashboard.admin');
    }

    public function userDashboard(): View
    {
        return view('dashboard.user');
    }
}
