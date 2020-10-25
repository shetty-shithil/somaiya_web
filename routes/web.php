<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events;
use App\Venue;
use App\stake_holders;
use App\Event_Permissions;
use App\Users;
use App\event_schedule;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function (Request $request) {
    $m=$request->month;
    $n=$request->year;
    if($m and $n){

        // $q=$n+1;
        // echo $q;
        $o=($n."-0".$m."-01"); 
        if(strlen($m)==2){
            $o=($n."-".$m."-01");
        } 
        
        $j=strtotime($o);
        
    }
    // print_r($m);
    $u=$n+1;
    $s=$n-1;
    // echo "From Backend";
    $events= Events::all();
    $event_schedules= event_schedule::all();
    $z=0;
    $arr=[];
    if(!$m){
        $m=Carbon::now()->toDateTimeString();
        
        // echo $m;
        // echo "in if";
        $j=strtotime($m);
        // echo $j;
        $month=date("F",$j);
        // echo $month;
        $n=date("Y",$j);
        // echo $year;
        $nmonth = date("m", strtotime($month));
        // echo $nmonth;
        $m= $nmonth;
    }
    foreach($event_schedules as $evs)
    {   
        
        // $d = date_parse_from_format("m", $evs->date);
        $time=strtotime($evs->date);
        // print_r($evs);
        // echo $time;
        $year=date("Y",$time);
        // echo $year;
        // echo "Hi";
        $month=date("F",$time);
        // echo $month;
        $nmonth = date("m", strtotime($month));
        // echo $nmonth;
         if($nmonth==$m and $n==$year){
            $arr=array_merge($arr,array($z=>$evs));
        }
        $z++;
        // echo $j;

        if(!$j){
            // echo "j loop";
           $j=$time; 
        //    $p=Carbon::create()->day(1)->month(10);
        //    $j=strtotime($p);
        //    $s  = DateTime::createFromFormat('!m', $m);
        //     $b=$s->format('F');
        //     echo $b;
        // $j=strtotime($m);
        // $month=date("F",$j);
        // $nmonth = date("m", strtotime($month));
        // $m= $nmonth;
        }
    }
    
    
    if($m==12){
        $h=$m-1;
        $k='1';
        
    }
    else if($m==1){
        $h='12';
        $k=$m+1;
        
    }
    else{
        $k=$m+'1';
        $h=$m-'1';
    }
    // echo $year;
    // echo $j;
    // echo "Value of j.";
    $events=Events::all('id','title','department','stake_holder_id');
    $evs=event_schedule::all();
    $arr1=[];
    foreach($evs as $e){
        $f=strtotime($e->date);
        // echo(date("m", strtotime(date("F",$f))));
        if($m==date("m", strtotime(date("F",$f))) and ($n==date("Y", strtotime(date("F",$f))))){
            $arr1=array_merge($arr1,array($e));
        }
        // echo($e->date);
        // print_r($evs);
    }
    

    $t=Carbon::now()->year($n)->month($m)->toDateTimeString();
    // echo $t;
    // echo $m;
    $d=Carbon::parse($t)->daysInMonth;
    
    // echo $d;
    
    // echo date('l',strtotime($t));
    
    if($m==12){
    $prev=Carbon::now()->year($n)->month($m-1)->toDateTimeString();
    $prev_m=Carbon::parse($prev)->daysInMonth;

    $next=Carbon::now()->year($n+1)->month(1)->toDateTimeString();
    $next_m=Carbon::parse($next)->daysInMonth;
    $o=Carbon::now()->year($n)->month($m-1)->day($prev_m)->toDateTimeString();
    $p=Carbon::parse($o);
    $lw=$p->dayOfWeek;
    }
    else if($m==1){
        $prev=Carbon::now()->year($n-1)->month(12)->toDateTimeString();
        $prev_m=Carbon::parse($prev)->daysInMonth;
    
        $next=Carbon::now()->year($n)->month($m+1)->toDateTimeString();
        $next_m=Carbon::parse($next)->daysInMonth;
        $o=Carbon::now()->year($n)->month($m-1)->day($prev_m)->toDateTimeString();
        $p=Carbon::parse($o);
        $lw=$p->dayOfWeek;
    }
    else{
        $prev=Carbon::now()->year($n)->month($m-1)->toDateTimeString();
        $prev_m=Carbon::parse($prev)->daysInMonth;
    
        $next=Carbon::now()->year($n)->month($m+1)->toDateTimeString();
        $next_m=Carbon::parse($next)->daysInMonth;
        $o=Carbon::now()->year($n)->month($m-1)->day($prev_m)->toDateTimeString();
        $p=Carbon::parse($o);
        $lw=$p->dayOfWeek;
        // $var1=$p->englishDayOfWeek;
        // echo $var1;
        // echo $lw;
        // echo $o;
        // echo $p;
        // echo "Else";
    }
//    echo $lw;

    return view('events.calendar',compact('events','arr1','prev_m','next_m','lw','e','m','n','h','k','d','j','u','s'));
});
Route::resource('events','EventsController');
// Route::get('/events/create', 'EventsController@create');
// Route::post('/events/create', 'EventsController@store');
// Route::post('/events','EventsController@store');
Route::post('/approval','EventsController@approval');
Route::post('/comments','EventsController@comments');
Route::post('/events/edit','EventsController@edit');
Route::post('/events/update','EventsController@update');
Route::post('/events/fileupload','EventsController@fileupload');


Auth::routes(['verify'=>true]);
Route::get('register', 'UsersController@showRegistrationForm')->name('register');
Route::post('register', 'UsersController@register');
// Route::post('events/{params}','EventsController@store');
Route::group(['middleware' => ['auth', 'admin']], function() {
    // your routes
    Route::get('/permission', 'EventsController@permission');

});

Route::get('/venues','EventsController@venues');
Route::get('/eventst','EventsController@eventst');
Route::get('stkh','EventsController@stakeholders');
Route::get('estkh','EventsController@eventstakeholders');
Route::get('permissions','EventsController@eventpermissions');
Route::get('schedules','EventsController@eventschedules');

// Route::post('/eventst','EventsController@stores');
// Route::post('stkh','EventsController@stakeholders');
// Route::post('estkh','EventsController@eventstakeholders');
// Route::post('permissions','EventsController@eventpermissions');
// Route::post('schedules','EventsController@eventschedules');

Route::get('/home', 'HomeController@index')->name('home');

    