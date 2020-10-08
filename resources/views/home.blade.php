@extends('inc.navbar')

@section('content')

    {{-- {{$u_events}} --}}


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                       <button> <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                       </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!!!!!!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fullcard_with_comments" class="modal">
    <div class="modal-content">
        <div class="row ml-28 m-0">
            <div class="col m8 s12">
                <h6 class="bold">Saturday</h6>
                <h6 class="bold">September 04</h6>
                <h6 class="bold"> 11:00 - 12:00</h6>
                <h6 class="bold mt-0">Seminar Details</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam consequuntur sapiente ab vero, expedita facere aspernatur repellat doloremque amet, dolorem quia, similique vel quam maxime alias nam. Ea, cumque officia.</p>
                <div class="row m-0 p-0">
                    <div class="col m6 pr-20 s12">
                        <span class="bold">Venue :</span> IT Building
                    </div>
                    <div>
                        <span class="bold">Speaker :</span> XYZ
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 pr-20 s12">
                        <span class="bold">Organiser :</span> XYZ Department
                    </div>
                    <div>
                        <span class="bold">Stakeholder :</span> Teachers
                    </div>
                </div>
            </div>
            <div class="col m4 s12">
                <h5 class="bold top-0">Comments</h5>
                <div class="view_comments">
                    <div class="comment_1">
                        <span class="faculty">HOD: </span> Please change the date
                    </div>
                    <div class="comment_2">
                        <span class="faculty">DOA: </span> Please change the time and also change the venue
                    </div>
                    <div class="comment_3">
                        <span class="faculty">PRINCIPAL: </span> Please change the name.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="MyEvents">
    <div class="container" style="padding: 50px 0;">
        <!-- Events -->
      @foreach ($u_events as $uv)
      @foreach ($arr as $evs)
            @if ($evs->event_id==$uv->id)
                        <div class="card-head">
                            
                            <div class="row"><a class="modal-trigger" href="#fullcard_with_comments">
                                    <div class="col s12 m-0 p-0 offset-m2">
                                        <div class="card-panel black-text event m-0">
                                            <div class="valign-wrapper">
                                                @foreach ($u_per as $u_p)
                                                    @if ($u_p->event_id==$uv->id)
                                                   <div> 
                                            Principal: @if($u_p->permit_p==0)
                                                            <p>Pending</p><br>
                                                        @elseif($u_p->permit_p==1)   
                                                            <p>Accepted</p><br>
                                                        @elseif($u_p->permit_p==2)    
                                                            <p>Modify</p>
                                                        @else   
                                                            <p>Rejected</p><br>
                                                        @endif 
                                            </div>    
                                       <div>
                                           Vice-Principal: @if($u_p->permit_vp==0)
                                                            <p>Pending</p><br>
                                                        @elseif($u_p->permit_vp==1)   
                                                            <p>Accepted</p>
                                                        @elseif($u_p->permit_vp==2)    
                                                            <p>Modify</p>
                                                        @else   
                                                            <p>Rejected</p>
                                                        @endif 
                                                    </div>                 
                                        
                                                    <div>
                                                    Dean Of Academics: @if($u_p->permit_doa==0)
                                                    <p>Pending</p>
                                                @elseif($u_p->permit_doa==1)   
                                                    <p>Accepted</p>
                                                @elseif($u_p->permit_doa==2)    
                                                    <p>Modify</p>
                                                @else   
                                                    <p>Rejected</p>
                                                @endif 
                                                    </div>
                                            @endif
                                                @endforeach
                                                <div class="row m-0">
                                                    <div class="col m3 s12 p-0 card-date">
                                                        <h6 class="bold">{{date('l', strtotime($evs->date))}} {{date('F \ j  ', strtotime($evs->date))}}</h6>
                                                    </div>
                                                    <div>
                                                        <h6 class="col m2 p-0 m-0"> {{date("g:i a", strtotime($evs->start_time))}} - {{date("g:i a", strtotime($evs->end_time))}}</h6>
                                                    </div>
                                                    <div>
                                                        <div class="col m7 p-0 m-0">
                                                            <h6 class="bold mt-0">{{$uv->title}}</h6>
                                                            <p>{{$uv->description}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                @endif   
         @endforeach 
      @endforeach    
    </div>
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
    $(document).ready(function() {
        $('.modal').modal();
    });

    </script>

@endsection
