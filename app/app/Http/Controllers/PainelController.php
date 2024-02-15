<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function create(){
        $user = session('user');
        $userPermission = $user->permissions->first->first()->permission;
        return view('auth.dashboard.painel.painel');
    }
}
