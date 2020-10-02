
        @foreach ($events as $eve)
        {{-- @foreach ($stake_holders as $stkh) --}}
        {{-- {{$m}} --}}
        @foreach ($arr as $evs)
            @if ($evs->event_id==$eve->id)
            <div id="fullcard_with_comments" class="modal">
                <div class="modal-content">
                    <div class="row ml-28 m-0">
                        <div class="col m8 s12">
                            <h6 class="bold">{{date('l', strtotime($evs->date))}}</h6>
                            <h6 class="bold">{{date('F \ j  ', strtotime($evs->date))}}</h6>
                            <h6 class="bold"> {{date("g:i a", strtotime($evs->start_time))}} - {{date("g:i a", strtotime($evs->end_time))}}</h6>
                            <h6 class="bold mt-0">{{$eve->title}}</h6>
                            <p> {{$eve->description}} </p>
                            <div class="row m-0 p-0">
                                <div class="col m6 pr-20 s12">
                                    <span class="bold">Venue :</span> @foreach ($venues as $venue)
                                    @if ($venue->id==$evs->venue_id)
                                            <span class="bold-sm">Venue :</span> {{$venue->name}}   
                                    @endif
                               @endforeach 
                                </div>
                                <div>
                                    <span class="bold">Speaker :</span> {{$eve->speakers}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m6 pr-20 s12">
                                    <span class="bold">Organiser :</span> {{$eve->department}}
                                </div>
                                <div>
                                    @foreach ($stake_holders as $stkh)
                                    @if ($stkh->id==$eve->stake_holder_id)
                                         <span class="bold">Stakeholder :</span> {{$stkh->name}}
                                    @endif
                                    @endforeach 
                                </div>
                            </div>
                            <form action="/comments" method="POST">
                                <div class="input-field col m4" style="width: 95%; margin-bottom: 0px;">
                                    <textarea id="textarea1" name="comments" class="materialize-textarea"></textarea>
                                    <label for="textarea1" class="comments">Comments</label>                   
                                        @csrf
                                        <input type="hidden" id="id" name="event_id" value="{{$eve->id}}">    
                                        <input type="hidden" id="approval" name="approval" value="2">    
                                        <button class="btn col m4 s5  mar-15 btn-modify modal-close">Send</button>                                                   
                                </div>
                        </form>
                        </div>
                        <div class="col m4 s12">
                            <h5 class="bold top-0">Comments</h5>
                            <div class="view_comments">
                                <div class="comment_1">
                                    <span class="faculty">Dean Of Academics: </span> 
                                    @foreach ($comm as $c)
                                        @if($c->event_id==$eve->id)
                                            {{$c->comments_doa}}
                                        @endif    
                                    @endforeach
                                </div>
                                <div class="comment_2">
                                    <span class="faculty">Vice-Principal: </span> 
                                    @foreach ($comm as $c)
                                        @if($c->event_id==$eve->id)
                                            {{$c->comments_vp}}
                                        @endif         
                                    @endforeach
                                </div>
                                <div class="comment_3">
                                    <span class="faculty">PRINCIPAL: </span>
                                    @foreach ($comm as $c)
                                    @if($c->event_id==$eve->id)
                                        {{$c->comments_p}}
                                    @endif        
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        @endforeach



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
    <link rel="stylesheet" href="{{asset('css/_styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/_responsive.css')}}">
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
        <li><a href="#">MY EVENTS</a></li>
        <li><a href="#">PROFILE</a></li>
        <li><a href="#">LOGOUT</a></li>
    </ul>
    <div id="slide-out" class="sidenav">
        <ul>
            <li>
                <div class="user-view">
                    <a href="#name"><span class="white-text name">John Doe</span></a>
                    <a href="#designation"><span class="white-text designation"><i class="fas fa-map-marker-alt"></i>Designation</span></a>
                </div>
            </li>
            <li><a href="#">MY EVENTS</a></li>
            <li><a href="#">PROFILE</a></li>
        </ul>
        <button class="btn waves-effect waves-light" type="submit" name="action">LOGOUT</button>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
        </nav>

    </div>
    