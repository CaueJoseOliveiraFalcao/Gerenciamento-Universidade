<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                $allUsers = User::all();
                $allUsersWithPermission = [];
                foreach ($allUsers as $user){
                    $userId = $user->id;
                    $userName = $user->name;
                    $userEmail = $user->email;
                    $UserPermission = $user->permissions;
                    if ($UserPermission->isNotEmpty()){
                        $permissionName = $UserPermission->first->first()->permission;
                    } else{
                        $permissionName = 'UsP';
                    }
                    $userArray = [
                        'id' => $userId,
                        'name' => $userName,
                        'email' => $userEmail,
                        'permission' => $permissionName
                    ];

                    $allUsersWithPermission[] = $userArray; 
                }
                return view('auth.admin-painel' , compact('allUsersWithPermission'));
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
