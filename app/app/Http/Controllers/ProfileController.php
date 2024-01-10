<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function mult_destroy(Request $request)
    {
        if ($request->has('selected_users')) {
            $selectedUsers = $request->input('selected_users');
            
            // Faça o que precisar com os valores selecionados
            foreach ($selectedUsers as $userId) {
                $userId = trim($userId , "`");
                $user = User::find(intval($userId));
                if($user){
                    $UserPermission = $user->permissions;
                    if ($UserPermission->isNotEmpty()){
                        $user->removePermissionTo($UserPermission);
                        $user->delete();

                    }
                    else{
                        $user->delete();

                    }


                }
            }
            redirect()->back()->withErrors('Usuario deletado');
        } else {
            echo "Nenhum usuário selecionado";
            redirect()->back()->withErrors('Usuario nao selecionado');
        }
    
        // Resto do código...
    }
}
