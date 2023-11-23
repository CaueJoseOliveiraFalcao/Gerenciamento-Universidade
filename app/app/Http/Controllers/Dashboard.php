<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{


    public function index()
    {
        $this->authorize('edit-articles');
        return view('dashboard');
    }
}
