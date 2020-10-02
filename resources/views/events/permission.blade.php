@extends('inc.navbar')

@section('content')
<div id="events">
    <div class="container">
        <!-- Month -->
        <div class="row header mt-20">
            <div class="row col m4 s12 m-0 p-0" id="monthYear">
                @if($m==12)
                            <a href={{"?month=$h&year=$n"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                        {{-- <p id="month" class="col m8 "></p> --}}
                        <h5>{{date("F Y",$j)}}</h5> 
                        <a href={{"?month=$k&year=$u"}}><i class="fas fa-chevron-right col" id="next"></i></a>                    
                    @elseif($m==1)
                            <a href={{"?month=$h&year=$s"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                        {{-- <p id="month" class="col m8 "></p> --}}
                        <h5>{{date("F Y",$j)}}</h5> 
                        <a href={{"?month=$k&year=$n"}}><i class="fas fa-chevron-right col" id="next"></i></a>
                    @else
                                <a href={{"?month=$h&year=$n"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                            {{-- <p id="month" class="col m8 "></p> --}}
                            <h5>{{date("F Y",$j)}}</h5>
                            <a href={{"?month=$k&year=$n"}}><i class="fas fa-chevron-right col" id="next"></i></a>
                     
                    @endif  
            </div>
            <div class="nav-wrapper col m5 s5 offset-s6 offset-m2 p-0 mar-15">
                <form>
                    <div class="input-field m-0">
                        <input id="search" class="m-0" type="search" required>
                        <label class="label-icon" for="search"><i class="material-icons" style="font-size: 30px; padding-top: 5px;">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
            <i class="fas fa-filter col s1 filter p-0 mar-15" id="filter-icon"></i>
        </div>
        

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
                                    <span class="faculty" id="pass_id">Dean Of Academics: </span> 
                                    @foreach ($comm as $c)
                                        @if($c->event_id==$eve->id)
                                            {{$c->comments_doa}}
                                        @endif    
                                    @endforeach
                                    {{-- <input class="form-control" name="name" type="text"
                                                               id="pass_id"> --}}
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
        <!-- Events -->
    @foreach ($events as $eve)
        {{-- @foreach ($stake_holders as $stkh) --}}
        {{-- {{$m}} --}}
        @foreach ($arr as $evs)
            @if ($evs->event_id==$eve->id)
            
            <div class="card-head">
                <div class="row">
                    <div class="col s12 m-0 p-0 offset-m2">
                        <div class="card-panel black-text event m-0">
             <!-- Modal-->  
                            <div class="valign-wrapper">
                                <div class="row m-0">
                                    <div class="col m2 s12 p-0 card-date" style="transform: translateY(62%);">
                                        <h6 class="bold">{{date('l', strtotime($evs->date))}}</h6>
                                        <h6 class="bold">{{date('F \ j  ', strtotime($evs->date))}}</h6>
                                        {{-- <h6 class="bold">{{date('F Y', strtotime($evs->date))}}</h6> --}}
                                        {{-- <h6 class="bold">{{date('l jS \of F Y', strtotime($evs->date))}}</h6> --}}

                                    </div>
                                    <div>
                                        <h6 class="col m2 p-0 m-0" style="line-height:160px;">{{date("g:i a", strtotime($evs->start_time))}} - {{date("g:i a", strtotime($evs->end_time))}}</h6>
                                    </div>
                                    <div>
                                        <div class="col m8 p-0 m-0">
                                            <h6 class="bold mt-0">{{$eve->title}}</h6>
                                            <p>{{$eve->description}}
                                            </p>
                                            <div class="row m-0">
                                                <div class="col m6 s12 pr-20">
                                                   @foreach ($venues as $venue)
                                                        @if ($venue->id==$evs->venue_id)
                                                                <span class="bold-sm">Venue :</span> {{$venue->name}}   
                                                        @endif
                                                   @endforeach 
                                                </div>
                                                <div class="col m6 pad-20">
                                                    <span class="bold-sm">Speaker :</span> {{$eve->speakers}}
                                                </div>
                                                <div class="col m6 s12 pr-20">
                                                    <span class="bold-sm">Organiser :</span> {{$eve->department}}
                                                </div>
                                                <div class="col m6 s12 pad-20">
                                                    @foreach ($stake_holders as $stkh)
                                                        @if ($stkh->id==$eve->stake_holder_id)
                                                                <span class="bold-sm">Stakeholder :</span>{{$stkh->name}}
                                                        @endif
                                                     @endforeach 
                                                    
                                                        {{-- @if (count($venues) === 1)
                                                        I have one record!
                                                    @elseif (count($venues) > 1)
                                                        I have multiple records!
                                                    @else
                                                        I don't have any records!
                                                    @endif --}}
                                                    
                                                </div>
                                                
                                                <div class="submit_form row m-0">
                                                    <button id="myBtn" class="hide-on-med-and-up col s6 offset-s3">Read more</button>
                                                    <div id="more">
                                                        <form action="/approval" method="POST">
                                                            @csrf
                                                                <input type="hidden" id="id" name="event_id" value="{{$eve->id}}">
                                                                <input type="hidden" id="approval" name="approval" value="1">
                                                            <button class="btn waves-effect waves-light col m2 s6 offset-s3 mar-15" name="aproval" type="submit" value="1">Approve</button>
                                                        </form>
                                                        @foreach ($comm as $c)
                                                        @if ($c->event_id==$eve->id)
                                                            {{$c->comments_vp}}    
                                                        @endif
                                                        @endforeach
                                                    <button data-target="fullcard_with_comments" data-toggle="modal"   class="btn modal-trigger waves-effect waves-light col m2 s6 offset-s3 grey mar-0">Modify</button>
                                                        <form action="/approval" method="POST">
                                                            @csrf
                                                                <input type="hidden" id="id" name="event_id" value="{{$eve->id}}">
                                                                <input type="hidden" id="approval" name="approval" value="3">
                                                            <button class="btn waves-effect waves-light col m2 s6 offset-s3 mar-0">Reject</button>
                                                        </form> 
                                                    {{-- </div></div> --}}
                                                </div>
                                           
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>   
            @endif
            
        @endforeach          
        {{-- @endforeach     --}}
    @endforeach   


<!-- Jquery -->
<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../js/event.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {
            draggable: true,
        });
    });

    $(document).ready(function() {
            $('.modal').modal();
            // $("#fullcard_with_comments").on("click", function (e) {
            //         var id = $(e.relatedTarget).data('target-id');
            //         $('#pass_id').val(id);
            //     });
        });



</script>
@endsection






