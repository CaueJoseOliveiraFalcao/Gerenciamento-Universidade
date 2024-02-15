<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Post;

class AddAdminPermission extends Controller
{
    use WithPagination;
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
                    else{
                        $NoGroup = Group::find(7);
                        $user->group()->associate($NoGroup);
                        $user->save();
                        $groupName = $NoGroup->name;
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
                
                if ($request->search){
                    $allUsersWithPermission = User::where($request->search , 'email')->paginate(10);
                }
                else{
                    $allUsersWithPermission = User::query()->paginate(10);
                }
                return view('auth.admin-painel', [
                    'allUsersWithPermission' => $allUsersWithPermission,
                    'allDisponiblePermissions' => $allDisponiblePermissions,
                    'allDisponibleGroups' => $allDisponibleGroups,
                ]);

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
