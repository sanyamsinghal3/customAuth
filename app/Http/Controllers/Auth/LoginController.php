<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.login');
    }

    public function submitLogin(request $request)
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->with([
                'error' => 'The email or password is incorrect, please try again'
            ]);
        }
        return redirect()->route('dashboard');

        //return redirect()->back()->with('success', 'User created successfully!');
    }

    public function logOut() {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
    public function dashboard(request $request)
    {
        return view('dashboard');
    }
}
