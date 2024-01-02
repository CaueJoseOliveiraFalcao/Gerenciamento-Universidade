<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    public function store(Request $request) : RedirectResponse
    {
        try{
            $request->validate([
                'name' => ['required' , 'string' , 'unique:groups'],
            ]);
            $group = Group::create([
                'name' => $request->name,
            ]);
            return redirect(RouteServiceProvider::AdminPainel);
        } catch(ValidationException $e){
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    


    }
}
