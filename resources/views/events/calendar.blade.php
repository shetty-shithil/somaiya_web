@extends('inc.navbar')
{{-- @include('inc.messages') --}}

@section('content')
{{-- {{$prev_m}}
{{$next_m}}
{{$lw}} --}}
{{-- @if(count($events)>0)  --}}
    {{-- @foreach($events->all() as $e) --}}
        {{-- <p>{{$events[0]}}</p> --}}
    {{-- @endforeach --}}
{{-- @endif     --}}
{{-- {{$evs}} --}}
    <div class="calendar">
        <div class="calendar-container">
                
         <div class="row col m4 s12 m-0 p-0" id="monthYear">
                    @if($m==12)
                    <a href={{"?month=$h&year=$n"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                {{-- <p id="month" class="col m8 "></p> --}}
                <h5 id="abc">{{date("F Y",$j)}}</h5> 
                <a href={{"?month=$k&year=$u"}}><i class="fas fa-chevron-right col" id="next"></i></a>                    
            @elseif($m==1)
                    <a href={{"?month=$h&year=$s"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                {{-- <p id="month" class="col m8 "></p> --}}
                <h5 id="abc">{{date("F Y",$j)}}</h5> 
                {{-- <input type="hidden" id="abc" name="abc" value="Monday"> --}}
                <a href={{"?month=$k&year=$n"}}><i class="fas fa-chevron-right col" id="next"></i></a>
            @else
                        <a href={{"?month=$h&year=$n"}}><i class="fas fa-chevron-left" id="prev"></i></a>
                    {{-- <p id="month" class="col m8 "></p> --}}
                    <h5 id="abc">{{date("F Y",$j)}}</h5>
                    <a href={{"?month=$k&year=$n"}}><i class="fas fa-chevron-right col" id="next"></i></a>
             
            @endif  
                    {{-- <i class="fas fa-chevron-left col s3" id="prev"></i>
                    <p id="month" class="col s6"></p>
                    <i class="fas fa-chevron-right col s3" id="next"></i> --}}
        </div>
            {{-- {{$prev_m}}
            {{$next_m}} --}}
            <div class="calendar-days">
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thur</div>
                <div>Fri</div>
                <div>Sat</div>
                <div>Sun</div>
            </div>
            {{-- {{count($arr1)}} --}}
            {{-- {{Carbon::now()}} --}}
            {{-- {{$prev_m}}
            {{$lw}} --}}
            <ul id="calendar-date" class="date-list">
                @for ($b = ($prev_m-$lw)+1; $b <=$prev_m ; $b++)
                 <li class="extra-date">{{$b}}</li>
                @endfor
               
                @for ($i = 0; $i < $d; $i++)
                    <li class="date popup" id="{{$i+1}}{{date("m", strtotime(date("F",$j)))}}{{date("Y",$j)}}" date-day="{{$i+1}}" date-month="{{date("m", strtotime(date("F",$j)))}}" date-year="{{date("Y",$j)}}">
                        <div class="popuptext" id="text_of_{{$i+1}}{{date("m", strtotime(date("F",$j)))}}{{date("Y",$j)}}">
                        <!-- {{$key = 0}} -->
                            @foreach ($events as $eve)
                                @foreach ($arr1 as $a)
                                    @if ($i+1==date("j",strtotime($a->date))) 
                                    @if($eve->id == $a->event_id)
                                    <div>{{++$key}} . {{$eve->title}}</div>
                                    @endif
                                    @endif
                                @endforeach
                            @endforeach
                            </div>
                        <span id="event_count">
                            @if ($key != 0)
                                {{$key}}    
                            @endif
                        </span>
                        <span class="da/teEl">{{$i+1}}</span>
                    </li>
                @endfor

                @for ($p=1 ; $p <=42-($lw+$d) ; $p++)
                    <li class="extra-date">{{$p}}</li>
                @endfor 
              {{-- {{date("m",strtotime(date("F",strtotime($a->date))))}}
            </ul>
            {{-- {{date("F",strtotime($a->date))}} --}}
        </div>
    </div>
  

    <!-- <div class="event-container">
    <div class="events visible">
        <span class="no-events event-message">There are no events today</span>
    </div>
</div> -->
    
     <!-- JQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>
    <script src="../js/app.js"></script>
    <script>
        $('body').on('focus', ".datepicker", function () {
    console.log($(this));
    $(this).datepicker();
});
$('body').on('focus', ".timepicker", function () {
    $(this).timepicker();
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
</script>

 <script>
    $('.popup').click(function(){
        var id_of_li = this.id;
        var popup = document.getElementById('text_of_' + id_of_li);
        console.log(popup);
        popup.classList.toggle("show");
    });
</script>   
@endsection
