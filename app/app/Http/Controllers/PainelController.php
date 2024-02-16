<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

use function Laravel\Prompts\search;

class PainelController extends Controller
{

    public function create(Request $request){
        $user = session('user');
        $userPermission = $user->permissions->first->first()->permission;
        $isFinded = true;
        $users = $this->getUsersByPermision($request , $user , $userPermission , $isFinded);

        return view('auth.dashboard.painel.painel');
    }
    public function getUsersByPermision(Request $input , $user , $permission , &$isFinded){
        if($input->input('search') && $permission === 'admin'){
            $FindUser = User::where('email' , $input->input('search'))->first();
            if (($FindUser)){
                return $FindUser;
            }
            else{
                $isFinded = false;
                return $users = User::all();
            }
        }
        elseif ($permission === 'admin'){
            return $users = User::all();
        }
        elseif ($input->input('search') && $permission === 'coordinator'){
            $user_group_id = $user->group_id;
            $FindUser = User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                ->where('users.group_id', $user_group_id)
                ->where('users.email' , $input->input('search'))
                ->select('users.*')
                ->distinct()
                ->get();
            if ($FindUser){
                return $FindUser;
            }
            else{
                $isFinded = false;
            }
        }
        elseif($permission === 'coordinator'){
            $user_group_id = $user->group_id;
             return $users = User::join('permission_user', 'users.id', '=', 'permission_user.user_id')
                ->join('permissions', 'permission_user.permission_id', '=', 'permissions.id')
                ->whereIn('permissions.permission', ['coordinator', 'teacher' , 'student'])
                ->where('users.group_id', $user_group_id)
                ->select('users.*')
                ->distinct()
                ->get();
        }
    }
    public function SearchUsersByEmail($users , $email){
        foreach($users as $user){
            if ($user->email === $email){
                return $user;
            }
        }

    }
}
