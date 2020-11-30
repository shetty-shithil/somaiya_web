@extends('inc.navbar')
{{-- @include('inc.messages') --}}

@section('content')

    <!--   BEGIN:CREATE FORM-->
    <div class="row">
        <div id="my_container">
            {!! Form::open(['action'=>'EventsController@update','method'=>'POST','class'=>'event-details col s12 m12 l12 p-0','autocomplete' => 'off', 'id'=>'form'])!!}
           <div id="form1">
                <div class="row m-0">
                    <div class="department">
                        <div class="input-field col s12">
                            {{-- <input id="department" type="text" class="validate"> --}}
                            <label for="department">Enter Department</label>
                            {{Form::text('department', $events->department, ['class'=>"form-control",'id'=>'department','required' => 'required'])}}        
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('department')}}</div>
                            
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="title">
                        <div class="input-field col s12">
                            {{-- <input id="title" type="text" class="validate"> --}}
                            {{Form::text('title', $events->title, ['class'=>'validate','id'=>'title','required' => 'required'])}}        
                            <label for="title">Enter Event Title</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('title')}}</div>

                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="description">
                        <div class="input-field col s12">
                            {{-- <textarea id="description" class="materialize-textarea"></textarea> --}}
                            {{Form::textarea('description', $events->description, ['class'=>'materialize-textarea','id'=>'description','required' => 'required'])}}
                            <label for="description">Enter Event Description</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('description')}}</div>

                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="dropdown">
                        <div class="input-field col s12 m6 l3 p-0">
                            {{-- <select>
                                <option value="" disabled selected>Select</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select> --}}
                            {{Form::select('type',$type,$events->type,['class'=>'validate type_of_event','placeholder'=> 'Select','required' => 'required'])}}
                            <label>Type Of Event</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('type')}}</div>

                        </div>
                    </div>
                    <div class="col mycol"></div>
                    <div class="stakeholders">
                        <div class="input-field col s12 m6 l3 p-0">
                            {{-- <select>
                                <option value="" disabled selected>Select</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select> --}}
                            {{Form::select('stake_holder[]',$stake_holder,$events->stake_holder_id,array('multiple'=>true,'required' => 'required'),['class'=>'validate','id'=>'stake_holder','placeholder' => 'Select'])}}
                            <label>Stakeholders</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('stake_holder')}}</div>
                        </div>
                    </div>
                    <div class="col mycol"></div>
                    <div class="fees">
                        <div class="input-field col s12 m6 l3">
                            {{-- <input id="fees" type="text" class="validate"> --}}
                            {{Form::text('fees',$events->fees, ['class'=>'validate','id'=>'fees','required' => 'required'])}}        
                            <label for="fees">Enter Fees</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('fees')}}</div>

                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="company_name">
                       <div class="input-field col s12 m6 l3">
                            {{-- <input id="company_name" type="text" class="validate"> --}}
                            {{Form::text('company_name', $events->company_name,['class'=>'validate','id'=>'company_name','required' => 'required'])}}  
                             <label for="company_name">Company Name</label>
                             <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('company_name')}}</div>
 
                        </div>
                    </div>
                    <div class="col mycol"></div>
                    <div class="certificate">
                        <div class="input-field col s12 m6 l3">
                            {{-- <select>
                                <option value="" disabled selected>Select</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select> --}}
                            {{Form::select('certificate',$certificate,$events->certificate,['class'=>'validate','id'=>'certificate','placeholder' => 'Select','required' => 'required'])}}
                            <label>Certificate</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('certificate')}}</div>

                        </div>
                    </div>
                    <div class="col mycol"></div>
                    <div class="speaker">
                        <div class="input-field col s12 m6 l3">
                            {{-- <input id="Speaker" type="text" class="validate"> --}}
                            {{Form::text('speaker', $events->speakers,['class'=>'validate','id'=>'speaker','required' => 'required'])}}       
                            <label for="speaker" class="speaker">Speaker</label>
                            <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('speaker')}}</div>

                        </div>
                    </div>
                </div>
                <input type="hidden" id="evs" name="evs" value=1>
                <div class="row m-0">
                    <div class="col mycol2"></div>
                    <div class="multipe_venue">
                        {{-- <label class="col s7 m7 l5 p-0">
                            <p>Does this event require multiple venue?</p>
                        </label> --}}
                        <div class="col s4 m4 l3 p-0">
                            {{-- <div class="yes">
                                <label> --}}
                                    {{-- <input id="yes_venue" name="v" value="1" type="radio" /> --}}
                                    {{-- {{Form::radio('group1', '1')}} --}}
                                    
                                    {{-- {{Form::radio('group1','',false,['id'=>'yes_venue'])}} --}}
                                    {{-- <span>YES</span>  --}}
                                    {{-- {{Form::label('group1','YES')}} --}}
                                {{-- </label> 
                            </div>
                            <div class="no">
                                <label> --}}
                                    {{-- <input id="no_venue"  name="v" value="0" type="radio" /> --}}
                                    {{-- {{Form::radio('group1', '0')}} --}}
                                    {{-- {{Form::radio('group1','',false,['id'=>'no_venue'])}} --}}
                                    {{-- <span>NO</span>
                                </label>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="single_venue"></div>
                </div>
                <div class="row m-0">
                    <div class="col mycol2"></div>
                    {{-- <div class="event_days">
                        <label class="col s7 m7 l4 p-0">
                            <p>Enter the number of days for the event.</p>
                        </label>
                        <div class="col s1"></div>
                        <div class="input-field col s4 m4 l3">
                            {{Form::number('no_of_days',count($event_schedules),['min'=>1,'max'=>10,'id'=>'no_of_days'])}} 
                        </div>
                    </div> --}}
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" id="event_id" name="event_id" value="{{$events->id}}">
                </div>
                <div class="row m-0">
                    <div class="col mycol2"></div>
                    {{-- <div class="multipe_time">
                        <label class="col s7 m7 l5 p-0">
                            <p>Does this event require multiple time slots?</p>
                        </label>
                        <div class="col s4 m4 l3 p-0">
                            <div class="yes">
                                <label>
                                    <input id="yes_time" name="t" value="1"type="radio" />
                                    {{-- {{Form::radio('group2','',false,['id'=>'yes_time'])}} --}}
                                    {{-- <span>YES</span>
                                </label>
                            </div>
                            {{-- <div class="no">
                                <label>
                                    <input id="no_time" name="t" value="0" type="radio" /> 
                                    {{-- {{Form::radio('group2','',false,['id'=>'no_time'])}} --}}
                                    {{-- <span>NO</span>
                                </label>
                            </div> -
                        </div>
                   </div>  --}}
                </div>
                {{-- <div class="venue">
                    <div class="input-field col s12 m12 l12">
                        <select name="venue_list[]" id="select_venue">
                            <option value="" disabled>Select</option>
                        </select>
                        <label>Venue</label>
                    </div>
                </div> --}}
                 <!-- {{$key = 0}} -->
                @foreach($event_schedules as $evs)
                <div class="row m-0 datetime_parent_row_{{$key++}}">
                    <div class="date_time">
                        <div class="input-field col s12 l2">
                            <input name="start_dates[]" id="start_date" value='{{date('M j, Y',strtotime($evs->date))}}' type="text" class="datepicker">
                            <label class="active" for="start_date">Date</label>
                        </div>
                        <div class="col mycol"></div>
                        <div class="input-field col s5 l2">
                            <input name="start_times[]" id="start_time" value='{{date('h:i A',strtotime($evs->start_time))}}' type="text" class="timepicker">
                            <label class="active" for="start_time">Start Time</label>
                        </div>
                        <div class="col s2 m1 l1 center-align mt-20">
                            <span class="">to</span>
                        </div>
                        <div class="input-field col s5 l2">
                            <input name="end_times[]" id="end_time" value='{{date('h:i A',strtotime($evs->end_time))}}' type="text" class="timepicker">
                            <label class="active"  for="end_time">End Time</label>
                        </div>
                        <div class="col mycol"></div>
                        <div class="venue">
                            <div class="input-field col s12 m2 l2">
                                <select name="venue_list[]" id="select_venue">
                                    <option value="" disabled>Select</option>
                                    @foreach($venue as $v)
                                        @if($evs->venue_id==$v->id)
                                        <option value="{{$v->id}}" selected>{{$v->name}}</option>
                                            @continue
                                        @endif
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                                <label>Venue</label>
                            </div>
                        </div>
                    </div>
                    <div class="delete_row"><i class="fas fa-trash-alt"></i></div>
                </div>
                @endforeach
                <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('venue_list')}}</div>
                <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('start_dates')}}</div>
                <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('end_dates')}}</div>
                <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('start_times')}}</div>
                <div class="error" style="background-color: rgb(141, 7, 7); color: white">{{ $errors->first('end_times')}}</div>
                @if(session('errort'))
                <div class="alert alert-danger" style="background-color :rgb(141, 7, 7); color: white">
                    {{session('errort')}}
                </div>
                @endif
                <div class="add_button" id="modify_page">
                    <a class="btn-floating btn-large waves-effect waves-light darkpurple_bg"><i class="material-icons">add</i></a>
                </div>
           </div>
                <div class="buttons">
                    <div class="row center-align m-0">
                        <div class="submit_form">
                       <div class="row center-align m-0">
                           <button type="submit" id="submit" 
                           {{-- onclick="event.preventDefault(); --}}
                           {{-- document.getElementById('form').submit();" --}}
                           >
                           SUBMIT
                           </button>
                           <button type="reset" id="pqr" onclick="event.preventDefault();
                           document.getElementById('form').reset();">
                               BACK
                           </button>
                           
                       </div>
                       </div>
                    </div>
                </div>   
                {!!Form::close()!!}
           
<script>
var department = $('#department');
var title = $('#title');
var description = $('#description');
var fees = $('#fees');
var speaker = $('#speaker');
var total_rows_of_dates = 0;
var no_of_days = 0;
document.addEventListener('DOMContentLoaded', function () {
    $('select').formSelect();
});

$('select:not(.browser-default)').on('change', function (e) {
    console.log(e.target.value);
});

function warning() {
    if ($(this).val() == "") {
        var parent = $(this).parent().parent();
        var parent_classname = parent.attr('class');
        if (parent.hasClass('department') || parent.hasClass('title') || parent.hasClass('description') || parent.hasClass('event_days'))
            parent.append(`<label class="warning_message col s12 ${parent_classname} ">Please add ${parent_classname}.</label>`);
        else if (parent.hasClass('fees') || parent.hasClass('stakeholders') || parent.hasClass('venue') || parent.hasClass('speaker') || parent.hasClass('certificate')) {
            parent.parent().append(`<label class="warning_message col s12 ${parent_classname} ">Please add ${parent_classname}.</label>`);

        }

    }
}

function remove_warning() {
    if ($(this).val() != "") {
        var parent = $(this).parent();
        if ($(this).is('#fees') || $(this).is('#stakeholders') || $(this).is('#venue') || $(this).is('#speaker') || $(this).is('#certificate')) {
            var targetclass = parent.parent().attr('class');
            var targetelement = parent.parent().siblings(`label.${targetclass}`);
            console.log(targetelement);
            targetelement.remove();
        } else {
            var targetclass = parent.parent().attr('class');
            var targetelement = parent.siblings(`label.${targetclass}`);
            targetelement.remove();
        }

    }
}
$("input[type=text]").blur(warning);
$("input[type=text]").on("propertychange change keyup paste input" , remove_warning);

$("textarea").blur(warning);
$("textarea").on("propertychange change keyup paste input" , remove_warning);

$("input[type=number]").blur(warning);
$("input[type=number]").on("propertychange change keyup paste input" , remove_warning);
$("input[type=number]").mousedown(remove_warning);
var venue;
var time;

$('#yes_venue').click(function () {
    venue = true;
    $('.single_venue').children().remove();
    $('.date-time').parent().remove();
    if (time == true)
        yes_time();
    else if (time == false)
        no_time();

})

// var venue_options = ["Opt 1", "Opt 2", "Opt 3"];
$('#no_venue').click(function (e) {
    venue = false;
    // console.log('clicked');
    $('.date-time').parent().remove();
    if (time == true)
        yes_time();
    else if (time == false)
        no_time();
    if ($('.venue').length == 0)
        $('.single_venue').append(`<div class="venue">
                        <div class="input-field col s12 m12 l12">
                            <select name="venue_list[]" id="select_venue">
                                <option value="" disabled>Select</option>
                            </select>
                            <label>Venue</label>
                        </div>
                    </div>`);
    var select_venue = $('#select_venue');
    const http = new extra;
    http.get('http://somaiya_web.io/venues')
        .then(data => updateUI(data, select_venue))
        .catch(err => console.error(err));
})

$('#yes_time').click(yes_time);

function yes_time() {
    time = true;
    no_of_days = $("#no_of_days").val();
    total_rows_of_dates = no_of_days;
    $('.date_time').parent().remove();
    if (venue == true) {
        for (var i = 0; i < no_of_days; i++) {
            singledate_venue(i);
        }
        multiple_venue();
    } else if (venue == false)
        for (var i = 0; i < no_of_days; i++) {
            singledate(i);
        }
}


$('#no_time').click(no_time);

function no_time() {
    time = false;
    no_of_days = $("#no_of_days").val();
    total_rows_of_dates = Number(no_of_days);
    $('.date_time').parent().remove();
    var i = 0;
    if (venue == true) {
        for (i = 0; i < no_of_days; i++) {
            singledate_venue(i);
        }
        multiple_venue();
    } else if (venue == false) {
        multipledate();
    }
}


function singledate(i) {
    console.log("CLicked!");
    $('#form1').append(`<div class="row m-0">
                    <div class="date_time">
                        <div class="col mycol"></div>
                        <div class="input-field col s12 l2">
                            <input name="start_dates[]" id="start_date${i}" type="text" class="datepicker">
                            <label class="active" for="start_date">Date</label>
                        </div>
                        <div class="col mycol2"></div>
                        <div class="input-field col s5 l2">
                            <input name="start_times[]" id="start_time${i}" type="text" class="timepicker">
                            <label class="active" for="start_time">Start Time</label>
                        </div>
                        <div class="col s2 m1 l1 center-align mt-20">
                            <span class="">to</span>
                        </div>
                        <div class="input-field col s5 l2">
                            <input name="end_times[]" id="end_time${i}" type="text" class="timepicker">
                            <label class="active"  for="end_time">End Time</label>
                        </div>
                    </div>
                </div>`);
}

function singledate_venue(i) {
    $('#form1').append(`<div class="row m-0">
                    <div class="date_time">
                        <div class="input-field col s12 l2">
                            <input name="start_dates[]" id="start_date${i}" type="text" class="datepicker">
                            <label class="active" for="start_date">Date</label>
                        </div>
                        <div class="col mycol"></div>
                        <div class="input-field col s5 l2">
                            <input name="start_times[]" id="start_time${i}" type="text" class="timepicker">
                            <label class="active" for="start_time">Start Time</label>
                        </div>
                        <div class="col s2 m1 l1 center-align mt-20">
                            <span class="">to</span>
                        </div>
                        <div class="input-field col s5 l2">
                            <input name="end_times[]" id="end_time${i}" type="text" class="timepicker">
                            <label class="active"  for="end_time">End Time</label>
                        </div>
                        <div class="col mycol"></div>
                        <div class="venue">
                        <div class="input-field col s12 m2 l2">
                            <select name="venue_list[]" class="venue${i}" id="select_venue">
                                <option value="" disabled>Select</option>
                            </select>
                            <label>Venue</label>
                        </div>
                    </div>
                    </div>
                </div>`);
    $('.venue .input-field input[type=text]').css("width", "78%");

}
$('.btn-floating.btn-large').click(function () {
    total_rows_of_dates = Number(total_rows_of_dates) + 1;
    $('.date_time').parent().remove();
    if (venue == true) {
        for (var i = 0; i < total_rows_of_dates; i++) {
            singledate_venue(i);
        }
        multiple_venue();
    } else if (venue == false)
        singledate();
    console.log(total_rows_of_dates);
});

function multipledate() {
    $('#form1').append(`<div class="row m-0">
                    <div class="date_time">
                        <div class="input-field col s5 l2">
                            <input name="start_dates[]" id="start_date" type="text" class="datepicker">
                            <label class="active" for="start_date">Start Date</label>
                        </div>
                        <div class="col s2 m1 l1 center-align mt-20">
                            <span class="">to</span>
                        </div>
                        <div class="input-field col s5 l2">
                            <input name="end_dates[]" id="end_date" type="text" class="datepicker">
                            <label class="active" for="end_date">End Date</label>
                        </div>
                        <div class="col mycol2"></div>
                        <div class="input-field col s5 l2">
                            <input name="start_times[]" id="start_time" type="text" class="timepicker">
                            <label class="active" for="start_time">Start Time</label>
                        </div>
                        <div class="col s2 m1 l1 center-align mt-20">
                            <span class="">to</span>
                        </div>
                        <div class="input-field col s5 l2">
                            <input name="end_times[]" id="end_time" type="text" class="timepicker">
                            <label class="active" for="end_time">End Time</label>
                        </div>
                    </div>
                </div>`);
}
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


class extra {
    //Makes a GET Request
    get(url) {
        return new Promise((resolve, reject) => {
            fetch(url)
                .then(res => {
                    if (!res.ok)
                        throw new Error(res.status);
                    return res.json();
                })
                .then(data => resolve(data))
                .catch(err => reject(err));
        })
    }
}


function updateUI(data, class_name) {
    for (var i = 1; i <= Object.keys(data).length; i++) {
        var option = document.createElement("OPTION");
        option.setAttribute("value", i);
        var textnode = document.createTextNode(data[i]);
        option.appendChild(textnode);
        class_name.append(option);
    }

    $('select').formSelect();
}

function multiple_venue() {
    const http = new extra;
    http.get('http://somaiya_web.io/venues')
        .then(data => update_venueUI(data))
        .catch(err => console.error(err));
}

function update_venueUI(data) {
    for (var i = 0; i < no_of_days; i++) {
        var select_venue = $('.venue' + i);
        updateUI(data, select_venue);
    }
}

$('.delete_row i').click(function(){
    var parent = $(this).parent();
    parent.parent().remove();
});

</script>
            
        </div>
    </div>
    <!--   END:CREATE FORM-->

    <!-- JQuery -->
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>

    <script src="{{asset('js/form.js')}}"></script> --}}


@endsection

