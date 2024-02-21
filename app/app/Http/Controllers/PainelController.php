<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

use function Laravel\Prompts\search;

class PainelController extends Controller
{
    public function create(Request $request){
        $user = session('user');
        $userPermission = $user->permissions->first->first()->permission;
        $isFinded = 'notseached';
        $DisponibleGroups = '';
        $DisponiblePermissions = '';
        $users = $this->seachAndGetUsers($request , $user , $userPermission , $isFinded , $DisponibleGroups , $DisponiblePermissions);
        return view('auth.dashboard.painel.painel' , compact('users' , 'isFinded' , 'DisponibleGroups' , 'DisponiblePermissions'));
    }
    public function seachAndGetUsers(Request $input , $user , $permission , &$isFinded , &$DisponibleGroups , &$DisponiblePermissions){
        if($input->input('search') && $permission === 'admin'){
            $FindUser = User::where('email' , $input->input('search'))->get();
            if (($FindUser->count() > 0)){
                $isFinded = 'found';
                $DisponiblePermissions = Permission::all();
                $DisponibleGroups = Group::all();
                return $FindUser;
            }
            else{
                $isFinded = 'notfound';
                $DisponiblePermissions = Permission::all();
                $DisponibleGroups = Group::all();
                return User::all();
            }
        }
        elseif($input->input('name') && $permission === 'admin'){
            $FindUser = User::where('name' , 'LIKE' , '%' . $input->input('name') . '%')->get();
            if (($FindUser->count() > 0)){
                $isFinded = 'found';
                $DisponiblePermissions = Permission::all();
                $DisponibleGroups = Group::all();
                return $FindUser;
            }
            else{
                $isFinded = 'notfound';
                $DisponiblePermissions = Permission::all();
                $DisponibleGroups = Group::all();
                return User::all();
            }
        }
        elseif ($permission === 'admin'){
            $DisponibleGroups = Group::all();
            $DisponiblePermissions = Permission::all();
            return $users = User::all();
        }
        elseif ($input->input('search') && $permission === 'coordinator'){
            $user_group_id = $user->group_id;
            $GroupsAcessArray = [$user_group_id , 7];
            $PermissionsAcessArray = [$permission , 'usp'];
            $FindUser = User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                ->where('users.group_id', $user_group_id)
                ->where('users.email' , $input->input('search'))
                ->select('users.*')
                ->distinct()
                ->get();
                if (count($FindUser) > 0){
                    $DisponiblePermissions = Permission::whereIn('permission' , $PermissionsAcessArray)->get();
                    $DisponibleGroups = Group::whereIn('id', $GroupsAcessArray)->get();
                    $isFinded = 'found';
                    return $FindUser;
                }
                else{
                    $isFinded = 'notfound';
                    $DisponibleGroups = Group::whereIn('id', $GroupsAcessArray)->get();
                    $DisponiblePermissions = Permission::whereIn('permission' , $PermissionsAcessArray)->get();
                    $user_group_id = $user->group_id;
                    return  User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                    ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                    ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                    ->where('users.group_id', $user_group_id)
                    ->select('users.*')
                    ->distinct()
                    ->get();
                }
        }
        elseif ($input->input('name') && $permission === 'coordinator'){
            $user_group_id = $user->group_id;
            $GroupsAcessArray = [$user_group_id , 7];
            $PermissionsAcessArray = [$permission , 'usp'];
            $FindUser = User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                ->where('users.group_id', $user_group_id)
                ->where('users.name' , 'LIKE', '%' .$input->input('name') . '%')
                ->select('users.*')
                ->distinct()
                ->get();
                if (count($FindUser) > 0){
                    $DisponiblePermissions = Permission::whereIn('permission' , $PermissionsAcessArray)->get();
                    $DisponibleGroups = Group::whereIn('id', $GroupsAcessArray)->get();
                    $isFinded = 'found';
                    return $FindUser;
                }
                else{
                    $isFinded = 'notfound';
                    $DisponibleGroups = Group::whereIn('id', $GroupsAcessArray)->get();
                    $DisponiblePermissions = Permission::whereIn('permission' , $PermissionsAcessArray)->get();
                    $user_group_id = $user->group_id;
                    return  User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                    ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                    ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                    ->where('users.group_id', $user_group_id)
                    ->select('users.*')
                    ->distinct()
                    ->get();
                }
        }
        elseif($permission === 'coordinator'){
            $user_group_id = $user->group_id;
            $GroupsAcessArray = [$user_group_id , 7];
            $PermissionsAcessArray = [$permission , 'usp'];
            $DisponibleGroups = Group::whereIn('id', $GroupsAcessArray)->get();
            $DisponiblePermissions = Permission::whereIn('permission' , $PermissionsAcessArray)->get();
            return  User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
            ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
            ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
            ->where('users.group_id', $user_group_id)
            ->select('users.*')
            ->distinct()
            ->get();
        }
    }
}
