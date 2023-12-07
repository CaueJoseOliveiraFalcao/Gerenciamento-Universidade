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
            'password' => ['required'], // Substituí 'password' por 'required' e 'password'
        ]);        
        $credentiais = $request->only('email' , 'password');

        if (Auth::attempt($credentiais)){
            $user = User::where('email', $request->email)->first();
            if($user->hasPermissionTo('admin')){
                return view('auth.admin-painel');
            }
            else{
                $errorMessage = 'Seu usuario nao tem Permissão admin';
                return view('auth.admin.admin-login', compact('errorMessage'));
            }
        }
        else{
            $errorMessage = 'Credenciais Invalidas';
            return view('auth.admin.admin-login', compact('errorMessage'));
        }
    }
}
