<p align="center"><a href="" target="_blank">Laravel Auth Login and Registration</a></p>

 

## Step 1

--Update Route.php file

Route::get('/dashboard', function () {
    return view('welcome');
});

Route::get('register-form', [Auth\RegistrationController::class, 'show'])->name('register.form')->middleware('guest');
Route::post('store', [Auth\RegistrationController::class, 'Register'])->name('register.store');
Route::get('login-form', [Auth\LoginController::class, 'show'])->name('login')->middleware('guest');;
Route::post('submit-login', [Auth\LoginController::class, 'submitLogin'])->name('login.submit');

Route::get('/home',[Auth\LoginController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('logOut', [Auth\LoginController::class, 'logOut'])->name('logOut');

## register Contoller under auth folder


	-- php artisan make:controller Auth/RegistrationController
	
	
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

## Login Controller

 php artisan make:controller Auth/LoginController


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


### create blade view file under auth folder

	auth/login.blade.php and auth/registerform.blade.php
	
	--enter this code in login.blade
	
	    <div class="cotainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header">Login</div>
                 <div class="card-body">
                    <form method="POST" action="{{route('login.submit')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <button style="cursor:pointer" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 


-- enter this code in registerform.blade.php

<div class="cotainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header">Register</div>
            <div class="card-body">
                <form name="my-form" action="{{route('register.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                        <div class="col-md-6">
                            <input type="text" id="full_name" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <span class="text-danger" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="text" id="email_address" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                        <span class="text-danger" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input type="text" id="password" class="form-control" name="password" >
                        </div>
                        @error('password')
                        <span class="text-danger" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                        <div class="col-md-6">
                            <input type="text" id="phone_number" name="mobile" value="{{ old('mobile') }}" class="form-control">
                        </div>
                        @error('mobile')
                        <span class="text-danger" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div> 
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">  Register  </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div> 


-- modify dashboard.blade.php registerform.blade.php
@extends("layout.front.header")
    @section('pageTitle',"Register")
    @section('content')
    {{ auth()->user()->name }}

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
      

@endsection


 ###  Run the migrations below
	php artisan migrate

### added function in user Models.


   public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }