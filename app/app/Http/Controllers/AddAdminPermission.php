<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddAdminPermission extends Controller
{
    public function showLoginAdminForm(){
        return view('auth.admin.admin-login');
    }
}
