@extends('inc.navbar')
{{-- @include('inc.messages') --}}

@section('content')
@if(count($events)>0) 
    {{-- @foreach($events->all() as $e) --}}
        <p>{{$events[0]}}</p>
    {{-- @endforeach --}}
@endif    
{{-- {{$evs}} --}}
    <div class="calendar">
        <div class="calendar-container">
            <div id="calendar-month">
                <div class="list month-list">
                    <i class="fas fa-chevron-left col s3" id="prev"></i>
                    <p id="month" class="col s6"></p>
                    <i class="fas fa-chevron-right col s3" id="next"></i>
                </div>
            </div>
            <div class="calendar-days">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thur</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <ul id="calendar-date" class="date-list">

            </ul>
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
@endsection
