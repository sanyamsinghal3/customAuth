<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle')</title>
    <link href="{{ asset('frontent/css/bootstrap.min.css') }}" rel="stylesheet">
       
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li> 
                 @if( auth()->check() )
                      <li class="nav-item">
                          <a class="nav-link font-weight-bold" href="#">Hi {{ auth()->user()->name }}</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('logOut')}} ">Log Out</a>
                      </li>
                  @else
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('login')}}">Log In</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('register.form')}}">Register</a>
                      </li>
                  @endif
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
  </head>
  <body> 
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('frontent/js/jquery.min.js') }}"></script> 
<script src="{{ asset('frontent/js/bootstrap.min.js') }}"></script>

 
 @yield('script')
</html>
