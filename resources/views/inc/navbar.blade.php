<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{config('app.name', 'Somaiya')}}</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <!--  <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/_styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/_responsive.css')}}"> --}}
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Google Fonts:Raleway-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>
    <!-- Navbar -->
    <nav class="blue_backgroung">
        <div class="container">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo "><img src="/storage/Group 24.png" alt="K.J.S.I.E.I.T logo"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="/">HOME</a></li>
                    <li><a href="/events">EVENTS</a></li>
                    <li><a href="/events/create">CREATE</a></li>
                    <li><a href="#" data-target="slide-out" class="sidenav-trigger user"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>


    <ul class="sidenav" id="mobile-demo">
        <li><a href="/">HOME</a></li>
        <li><a href="/events">EVENTS</a></li>
        <li><a href="/events/create">CREATE</a></li>
        <li><a href="{{ route('login') }}">MY EVENTS</a></li>
        <li><a href="#">PROFILE</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">LOGOUT</a></li>
    </ul>
    <div id="slide-out" class="sidenav">
        <ul>
            <li>
                <div class="user-view">
                    {{-- <a href="#name"><span class="white-text name">   {{ auth()->user()->name }} </span></a> --}}
                    @if(Auth::user())
                    <a href="#designation"><span class="white-text designation"><i class="fas fa-map-marker-alt"></i>{{Auth::user()->name}}</span></a>
                    @endif
                </div>
            </li>
            <li><a href="{{ route('login') }}">MY EVENTS</a></li>
            <li><a href="#">PROFILE</a></li>
        </ul>
        @if(Auth::user())
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @endif
        @if(!Auth::user())
        <li><a href="{{ route('login') }}">LOGIN</a></li>
        @endif
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                   
                </div>
            </div>
        </nav> --}}

    </div>
    
<div>
        
        {{-- @include('inc.messages') --}}
        @yield('content')
</div>









     <!-- JQuery -->

   <!-- <script src="../js/jquery.min.js"></script>-->

   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <!-- Compiled and minified JavaScript -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <!-- <script src="../js/app.js"></script>-->
   <script src="{{asset('js/app.js')}}"></script>
   <script src="{{asset('js/_app.js')}}"></script>
   <script src="{{asset('js/form.js')}}"></script>
   <script src="{{asset('js/event.js')}}"></script>
   <script src="{{asset('js/abc.js')}}"></script>
   <script src="{{asset('js/extra.js')}}"></script>
   <script>
       $(document).ready(function () {
    $('#slide-out').sidenav({
        edge: 'right'
    });
});
$(document).ready(function () {
    $('#mobile-demo.sidenav').sidenav({
        edge: 'left'
    });
});
   </script>

</body>

</html>
