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
     
gg

@endsection
