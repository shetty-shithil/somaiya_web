@extends('inc.navbar')

@section('content')
@include('inc.messages')
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
        

      
            <div id="fullcard_with_comments" class="modal">
                <div class="modal-content">
                    <div class="row ml-28 m-0">
                        <div class="col m8 s12">
                            <h6 class="bold" id="day_on_modal"></h6>
                            <h6 class="bold" id="date_on_modal"></h6>
                            <h6 class="bold" id="time_on_modal"> </h6>
                            <h6 class="bold mt-0" id="title_on_modal"></h6>
                            <p id="description_on_modal"></p>
                            <div class="row m-0 p-0">
                                <div class="col m6 pr-20 s12">
                                    <span class="bold">Venue :</span><span id="venue_on_modal"></span> 
                                </div>
                                <div>
                                    <span class="bold">Speaker :</span><span id="speaker_on_modal"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m6 pr-20 s12">
                                    <span class="bold">Organiser :</span><span id="organiser_on_modal"></span>
                                </div>
                                <div>
                                         <span class="bold">Stakeholder :</span><span id="stakeholder_on_modal"></span>
                                </div>
                            </div>
                             <form action="/comments" method="POST">
                                <div class="input-field col m4" style="width: 95%; margin-bottom: 0px;">
                                    <textarea id="textarea1" name="comments" class="materialize-textarea"></textarea>
                                    <label for="textarea1" class="comments">Comments</label>                   
                                        @csrf
                                            <input type="hidden" id="send_on_modal" name="event_id">     
                                            <input type="hidden" id="approval" name="approval" value="2">    
                                        <button class="btn col m4 s5  mar-15 btn-modify modal-close">Send</button>                                                   
                                </div>
                        </form> 
                        </div>
                        <div class="col m4 s12">
                            <h5 class="bold top-0">Comments</h5>
                            <div id="comments_on_modal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
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
                                        {{-- {{$evs->id}} --}}

                                        <h6 class="bold" id="day_on_card{{$evs->id}}">{{date('l', strtotime($evs->date))}}</h6>
                                        <h6 class="bold" id="date_on_card{{$evs->id}}">{{date('F \ j  ', strtotime($evs->date))}}</h6>
                                        {{-- <h6 class="bold">{{date('F Y', strtotime($evs->date))}}</h6> --}}
                                        {{-- <h6 class="bold">{{date('l jS \of F Y', strtotime($evs->date))}}</h6> --}}

                                    </div>
                                    <div>
                                        <h6 class="col m2 p-0 m-0" id="time_on_card{{$evs->id}}" style="line-height:160px;">{{date("g:i a", strtotime($evs->start_time))}} - {{date("g:i a", strtotime($evs->end_time))}}</h6>
                                    </div>
                                    <div>
                                        <div class="col m8 p-0 m-0">
                                            <h6 class="bold mt-0" id="title_on_card{{$evs->id}}">{{$eve->title}}</h6>
                                            <p id="description_on_card{{$evs->id}}">{{$eve->description}}
                                            </p>
                                            <div class="row m-0">
                                                <div class="col m6 s12 pr-20">
                                                   @foreach ($venues as $venue)
                                                        @if ($venue->id==$evs->venue_id)
                                                <span class="bold-sm">Venue :</span><span id="venue_on_card{{$evs->id}}">{{$venue->name}}  </span>  
                                                        @endif
                                                   @endforeach 
                                                </div>
                                                <div class="col m6 pad-20">
                                                    <span class="bold-sm">Speaker :</span><span id="speaker_on_card{{$evs->id}}"> {{$eve->speakers}}  </span>  
                                                </div>
                                                <div class="col m6 s12 pr-20">
                                                    <span class="bold-sm">Organiser :</span><span id="organiser_on_card{{$evs->id}}">  {{$eve->department}}  </span>  
                                                </div>
                                                <div class="col m6 s12 pad-20">
                                                    @foreach ($stake_holders as $stkh)
                                                        @if ($stkh->id==$eve->stake_holder_id)
                                                                <span class="bold-sm">Stakeholder :</span><span id="stakeholder_on_card{{$evs->id}}">  {{$stkh->name}}</span> 
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
                                                <!-- {{$key = 0}} -->
                                                <div id="comments_on_card{{$evs->id}}" style="display: none;"> 
                                                    @foreach($comm as $c)
                                                    @if($c->event_id==$evs->event_id)
                                                        <div class="comment">
                                                            <span id="comment_user_{{$key}}">{{$c->user}} : </span>
                                                            <span id="comment_detail_{{$key++}}">{{$c->comments}}</span>        
                                                        </div>
                                                    @endif
                                                    @endforeach
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
                                                        <button data-target="fullcard_with_comments" class="btn modal-trigger waves-effect waves-light col m2 s6 offset-s3 grey mar-0 btn_modify"  id={{$evs->id}}>Modify</button>
                                                        <form action="/approval" method="POST">
                                                            @csrf
                                                                <input type="hidden" id="id_on_card{{$evs->id}}" name="event_id" value="{{$eve->id}}">
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
    $(document).ready(function() {
            $('.modal').modal();
         
        }); 
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

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {
            draggable: true,
        });
        $('.btn_modify').click(function() {
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
            var comments_on_card = document.getElementById("comments_on_card" + id_no).innerHTML;
            var comments_on_modal = document.getElementById("comments_on_modal");
            comments_on_modal.innerHTML = comments_on_card;

            // document.getElementById("cvp_on_modal").innerHTML = $("#cvp_on_card"+id_no).val();
            // document.getElementById("cdoa_on_modal").innerHTML = $("#cdoa_on_card"+id_no).val();
            document.getElementById("send_on_modal").value = $("#id_on_card" + id_no).val();

        });
    });

</script>
@endsection






