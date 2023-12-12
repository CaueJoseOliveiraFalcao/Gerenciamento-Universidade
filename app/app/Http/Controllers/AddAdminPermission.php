<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddAdminPermission extends Controller
{
    public function showLoginAdminForm(){
        return view('auth.admin.admin-login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['email', 'required', 'string', 'lowercase'],
            'password' => ['required'],
        ]);        
        $credentiais = $request->only('email' , 'password');

        if (Auth::attempt($credentiais)){
            $user = User::where('email', $request->email)->first();
            if($user->hasPermissionTo('admin')){
                return view('auth.admin-painel');
            }
            else{
                return redirect()->back()->withErrors('Usuario sem Permissão');
            }
        }
        else{
            return redirect()->back()->withErrors('Credenciais Invalidas');
        }
    }
}
