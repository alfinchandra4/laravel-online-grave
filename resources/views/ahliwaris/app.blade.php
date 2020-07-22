<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    @yield('css')

    <title>@yield('title')</title>

    {{-- For success --}}
    @if (session()->has('msg'))
        <script>
          alert("{{session()->get('msg')}}");
        </script>
    @endif
    
  </head>
  <body style="background: #f8f9fa">
    <nav class="navbar navbar-light bg-light p-3" style="background: linear-gradient(45deg, #1de099, #1dc8cd)">
        <div class="container">
            <a class="navbar-brand text-white">Selamat datang, {{auth()->guard('user')->user()->name}}</a>
            @yield('dashboard')
            <a href="{{route('logout')}}" class="text-white">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row mb-3">
            @yield('content')
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- {{-- <script src="{{asset('jquery-3.4.1.slim.min.js')}}" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
    <script src="{{asset('bootstrap/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    {{-- <script src="{{asset('bootstrap/popper.min.js')}}"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}
    @yield('js')
  </body>
</html>