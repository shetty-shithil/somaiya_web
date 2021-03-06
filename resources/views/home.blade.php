@extends('inc.navbar')

@section('content')
@include('inc.messages')
    {{-- {{$u_events}} --}}


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <div class="card">
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
                <div class="form-group row mb-0">

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Reset Password') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<div id="fullcard_with_comments" class="modal">
    <div class="modal-content">
        <div class="row ml-28 m-0">
            <div class="col m8 s12">
                <h6 class="bold" id="day_on_modal"></h6>
                <h6 class="bold" id="date_on_modal"></h6>
                <h6 class="bold" id="time_on_modal"></h6>
                <h6 class="bold mt-0" id="title_on_modal"></h6>
                <p id="description_on_modal"></p>
                <div class="row m-0 p-0">
                    <div class="col m6 pr-20 s12">
                        <span class="bold">Venue : </span><span id="venue_on_modal"></span>
                    </div>
                    <div>
                        <span class="bold">Speaker : </span><span id="speaker_on_modal"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 pr-20 s12">
                        <span class="bold">Organiser : </span><span id="organiser_on_modal"></span>
                    </div>
                    <div>
                        <span class="bold">Stakeholder : </span><span id="stakeholder_on_modal"></span>
                    </div>
                </div>
                <div class="row">
                    {{-- <form action="/events/edit" method="POST"> --}}
                        {{-- @csrf --}}
                        {{-- <input type="hidden" id="send_on_modal" name="event_id">      --}}
                        <a  class="btn col m4 s5  mar-15 btn-modify modal-close" id="event-id">Modify</a>
                    {{-- </form> --}}
                </div>
                <div class="row">
                    <form action="/events/download" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="download_on_modal" name="event_id">     
                        <button class="btn col m4 s5  mar-15 btn-download modal-close">Download Report</button>
                    </form>
                </div>

                <div class="row">
                    <form action="/events/fileupload" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="file_on_modal" name="event_id"> 
                        <input type="hidden" id="title" name="title"> 
                            <label class="bold" for="uploadedfile">Upload Report : </label>
                            <input type="file" class="form-control-file" id="uploadedfile" name="uploadedfile">  
                        <div class="form-control-group"><button class="btn btn-success btn-submit">Submit</button></div>
                    </form>
                </div>
            </div>
            <div class="col m4 s12">
                <h5 class="bold top-0">Comments</h5>
                <div id="comments_on_modal">
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
                    <div class="row card_to_update_modal" id="{{$evs->id}}">
                        <a class="modal-trigger" href="#fullcard_with_comments">
                        <div class="col s12 m-0 p-0 offset-m2">
                            <div class="card-panel black-text event m-0">
                                <div class="valign-wrapper">
                                    <div class="row m-0">
                                        <div class="col m2 s12 p-0 card-date" style="transform: translateY(62%);">
                                            <input type="hidden" id="id_on_card{{$evs->id}}" name="event_id" value="{{$uv->id}}">
                                            <h6 class="bold" id="day_on_card{{$evs->id}}">{{date('l', strtotime($evs->date))}}</h6>
                                            <h6 class="bold" id="date_on_card{{$evs->id}}">{{date('F \ j  ', strtotime($evs->date))}}</h6>
                                        </div>
                                        <div>
                                            <h6 class="col m2 p-0 m-0" style="line-height:160px;" id="time_on_card{{$evs->id}}">{{date("g:i a", strtotime($evs->start_time))}} - {{date("g:i a", strtotime($evs->end_time))}}</h6>
                                        </div>
                                        <div>
                                            <div class="col m8 p-0 m-0">
                                                <h6 class="bold mt-0" id="title_on_card{{$evs->id}}">{{$uv->title}}</h6>
                                                <p id="description_on_card{{$evs->id}}">{{$uv->description}}</p>
                                                <div class="row m-0" style="display: none;">
                                                    <div class="col m6 s12 pr-20">
                                                        @foreach ($venues as $venue)
                                                        @if ($venue->id==$evs->venue_id)
                                                <span class="bold-sm">Venue :</span><span id="venue_on_card{{$evs->id}}">{{$venue->name}}  </span>  
                                                        @endif
                                                   @endforeach                                                     
                                                   </div>
                                                    <div class="col m6 pad-20">
                                                        <span class="bold-sm">Speaker : </span> <span id="speaker_on_card{{$evs->id}}">{{$uv->speakers}}</span>
                                                    </div>
                                                    <div class="col m6 s12 pr-20">
                                                        <span class="bold-sm">Organiser : </span> <span id="organiser_on_card{{$evs->id}}">{{$uv->department}}</span>
                                                    </div>
                                                    <div class="col m6 s12 pad-20">
                                                        @foreach ($stake_holders as $stkh)
                                                            @if ($stkh->id==$uv->stake_holder_id)
                                                                <span class="bold-sm">Stakeholder : </span><span id="stakeholder_on_card{{$evs->id}}">{{$stkh->name}}</span>
                                                            @endif
                                                        @endforeach                                                     
                                                    </div>
                                                    
                                                    <!-- {{$key = 0}} -->
                                                    <div id="comments_on_card{{$evs->id}}"> 
                                                    @foreach($comm as $c)
                                                        @if($c->event_id==$evs->event_id)
                                                            <div class="comment">
                                                                <span id="comment_user_{{$key}}">{{$c->user}} : </span>
                                                                <span id="comment_detail_{{$key++}}">{{$c->comments}}</span>        
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($u_per as $u_p)
                        @if($u_p->event_id==$uv->id)
                               
                                <div class="flags">
                                    @if($u_p->permit_p==1)
                                        <div class="user">
                                            <span class="status_indicator approved"></span><span id="p_flag" class="userName">Principal</span>
                                        </div>
                                    @endif    
                                    @if($u_p->permit_p==0)    
                                        <div class="user">
                                            <span class="status_indicator pending"></span><span id="vcp_flag" class="userName">Principal</span>
                                        </div>
                                    @endif
                                     @if($u_p->permit_p==2)    
                                        <div class="user">
                                            <span class="status_indicator rejected"></span><span id="doa_flag" class="userName">Principal</span>
                                        </div>
                                    @endif  
                                    @if($u_p->permit_p==3)    
                                        <div class="user">
                                            <span class="status_indicator modify"></span><span id="doa_flag" class="userName">Principal</span>
                                        </div>
                                    @endif    
                                

                               
                                    @if($u_p->permit_vp==1)
                                    <div class="user">
                                        <span class="status_indicator approved"></span><span id="p_flag" class="userName">Vice Principal</span>
                                    </div>
                                @endif    
                                @if($u_p->permit_vp==0)    
                                    <div class="user">
                                        <span class="status_indicator pending"></span><span id="vcp_flag" class="userName">Vice Principal</span>
                                    </div>
                                @endif
                                 @if($u_p->permit_vp==2)    
                                    <div class="user">
                                        <span class="status_indicator rejected"></span><span id="doa_flag" class="userName">Vice Principal</span>
                                    </div>
                                @endif
                                @if($u_p->permit_vp==3)    
                                <div class="user">
                                    <span class="status_indicator modify"></span><span id="doa_flag" class="userName">Vice Principal</span>
                                </div>
                            @endif    
                       
                                    @if($u_p->permit_doa==1)
                                    <div class="user">
                                        <span class="status_indicator approved"></span><span id="p_flag" class="userName">Dean of Academics</span>
                                    </div>
                                @endif    
                                @if($u_p->permit_doa==0)    
                                    <div class="user">
                                        <span class="status_indicator pending"></span><span id="vcp_flag" class="userName">Dean of Academics</span>
                                    </div>
                                @endif
                                 @if($u_p->permit_doa==2)    
                                    <div class="user">
                                        <span class="status_indicator rejected"></span><span id="doa_flag" class="userName">Dean of Academics</span>
                                    </div>
                                @endif  
                                @if($u_p->permit_doa==3)    
                                <div class="user">
                                    <span class="status_indicator modify"></span><span id="doa_flag" class="userName">Dean of Academics</span>
                                </div>
                            @endif      
                            </div>
                          @endif      
                        @endforeach        
                        </a>
                    </div>
                </div>
        @endif   
        @endforeach 
     @endforeach    
    </div>
</div>
{{-- <div id="MyEvents">
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
</div> --}}

<!-- JQuery -->

   <!-- <script src="../js/jquery.min.js"></script>-->
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
    $('.card_to_update_modal').click(function() {
            var id_no = this.id;
            document.getElementById("day_on_modal").innerHTML = document.getElementById("day_on_card" + id_no).innerHTML;
            document.getElementById("date_on_modal").innerHTML = document.getElementById("date_on_card" + id_no).innerHTML;
            document.getElementById("time_on_modal").innerHTML = document.getElementById("time_on_card" + id_no).innerHTML;
            document.getElementById("title_on_modal").innerHTML = document.getElementById("title_on_card" + id_no).innerHTML;
            document.getElementById("description_on_modal").innerHTML = document.getElementById("description_on_card" + id_no).innerHTML;
            document.getElementById("venue_on_modal").innerHTML = document.getElementById("venue_on_card" + id_no).innerHTML;
            document.getElementById("speaker_on_modal").innerHTML = document.getElementById("speaker_on_card" + id_no).innerHTML;
            document.getElementById("organiser_on_modal").innerHTML = document.getElementById("organiser_on_card" + id_no).innerHTML;
            document.getElementById("stakeholder_on_modal").innerHTML = document.getElementById("stakeholder_on_card" + id_no).innerHTML;
            // document.getElementById("send_on_modal").value = $("#id_on_card" + id_no).val();
            document.getElementById("file_on_modal").value = $("#id_on_card" + id_no).val();
            document.getElementById("download_on_modal").value = $("#id_on_card" + id_no).val();
            document.getElementById("title").value = document.getElementById("title_on_card" + id_no).innerHTML;
            var a= document.getElementById("event-id");
            // a.href="/events/edit?event_id="+id_no; //Event-Schedules Id
            //Event Id
            a.href="/events/edit?event_id="+$("#id_on_card" + id_no).val();

            var comments_on_card = document.getElementById("comments_on_card" + id_no).innerHTML;
            var comments_on_modal = document.getElementById("comments_on_modal");
            comments_on_modal.innerHTML = comments_on_card;
        });

        $(document).ready(function() {
        $('.modal').modal();
    });
    </script>

@endsection
