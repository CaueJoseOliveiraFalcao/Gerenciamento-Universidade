<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Permission;
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
                if($user->id === 3){
                    $allUsers = User::all();
                }else{
                    $allUsers = User::whereHas('permissions' , function ($query) {
                        $query->where('permission' , 'coodinator');
                    })->get();

                }
                $allUsersWithPermission = [];
                $allDisponiblePermissions = Permission::pluck('permission');
                $allDisponibleGroups = Group::pluck('name');
                $groupName = '';
                foreach ($allUsers as $user){
                    $userId = $user->id;
                    $userName = $user->name;
                    $userEmail = $user->email;
                    if($user->group_id){
                        $userGroupId = $user->group_id;
                        $groupName = Group::find($userGroupId);
                        $groupName = $groupName->name;
                    }
   

                    $UserPermission = $user->permissions;
                    if ($UserPermission->isNotEmpty()){
                        $permissionName = $UserPermission->first->first()->permission;
                    }
                    $userArray = [
                        'id' => $userId,
                        'name' => $userName,
                        'email' => $userEmail,
                        'permission' => $permissionName,
                        'group' => $groupName,
                    ];

                    $allUsersWithPermission[] = $userArray; 
                }
                return view('auth.admin-painel' , compact('allUsersWithPermission' , 'allDisponiblePermissions' , 'allDisponibleGroups'));
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
