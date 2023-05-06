<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    # display register form
    public function show(request $request)
    {
        return view('auth.registerform');
    }

    public function Register(request $request)
    {
        # validation code
        $validatedData = $request->validate([
            'name' 		=> 'required|max:255',
            'email' 	=> 'required|email|unique:users|max:255',
            'password' 	=> 'required|min:8|max:255',
            'mobile' 	=> 'required|min:10|max:11',
        ]);

        $user = User::create(request(['name', 'email', 'password']));
        //auth()->login($user);

        if(isset($user->id) && ($user->id !='') ) {
            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error','Somethinng went wrong try again.');
        }
    }
}
