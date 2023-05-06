@extends("layout.front.header")
    @section('pageTitle',"Register")
    @section('content')

   
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
    @endsection 