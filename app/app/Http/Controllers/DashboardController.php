<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function create(){
        $user = session('user');
        return view('auth.dashboard.dashboard' , compact('user'));
    }
}
