<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Events;
use App\Event_Stake_Holders;
use App\Venue;
use App\stake_holders;
use App\Event_Permissions;
use App\User;
use App\event_schedule;
use App\Comments;
use App\Fileupload;
use Carbon\Carbon;
use DB;
use App\Mail\SendMail;


class EventsController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    public $q=0;
    public function index(Request $request)
    {   
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
        // $events= Events::orderBy('id','desc')->paginate();
        // $events=Events::all()
        $eventsobj= new Events;
        // $eventsobj = DB::table('events')
        // ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
        // ->orderBy('date', 'asc') //order in descending order
        // ->get();

        // echo $eventsobj;
        // if($request->input('term')){
        //     $search=$request->input('term');
        //     $events= DB::table('events')->where('title', 'like', '%'.$search.'%')->get();
        //     echo ($events);

        // }
        $eobj=$eventsobj->approval();
        $events=[];

        // foreach($eventsobj as $eob){
        //     $e=Event_Permissions::find($ob->id);
        //     if($e->permit_p='1' and $e->permit_p='1' and $e->permit_p='1'){
        //         $events=array_merge($events,array($e));
        //     }
           

        // }
        foreach($eobj as $ej){
            $e=Events::find($ej->event_id);
            $events=array_merge($events,array($e));
        }
        // $events=[];
        // $pqr=[1,2];
        // foreach($events1 as $eve){
        //     foreach($pqr as $p){
        //         if($eve->stake_holder_id==$p){
        //             $events=array_merge($events,array($eve));
        //         }
        //     }
            
        // }

        $event_schedules= event_schedule::orderBy('date','asc')->get();
        // echo $event_schedules;
        
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
        // echo $nmonth;
        // print_r($arr);
        $stake_holders= stake_holders::all();
        $venues= Venue::all();
        $comm= Comments::all();

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
        // echo $j;
        // echo "Value of j.";
        return view('events.index',compact('m','n','u','s','j','h','k','events','arr','stake_holders','venues','comm'));
    }

    public function search(Request $request){
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
        // $events= Events::orderBy('id','desc')->paginate();
        $search=$request->input('term');
        $events= DB::table('events')->where('title', 'like', '%'.$search.'%')->get();
    
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
        // echo $nmonth;
        // print_r($arr);
        $stake_holders= stake_holders::all();
        $venues= Venue::all();
        $comm= Comments::all();

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
        // echo $j;
        // echo "Value of j.";
        return view('events.index',compact('m','n','u','s','j','h','k','events','arr','stake_holders','venues','comm'));

    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venue = \DB::table('venues')->pluck('name','id');
        $stake_holder = \DB::table('stake_holders')->pluck('name','id');
        $certificate =['0'=>'Yes', '1' => 'No', '2' => 'Not Decided'];
        $type = ['0' => 'Workshops', '1' => 'Competitions', '2' => 'Conferences','3'=>'Fun Events','4'=>'STTP','5'=>'FDP','6'=>'Orientation Program'];
        // $user_id=auth()->user()->id;
        $pqr='abcd';
        return view('events.create',compact('venue','stake_holder','certificate','type','pqr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function stores(Request $request){
    //     $data = $request->all();
    //     if(Request::ajax()) {
    //         $data = Input::all();
    //     }
    //     dd(json_decode($data));  
    // }
    public function store(Request $request)
    {   
        $data = $request->all();
        if($request->v==0 and $request->t==0){
                $validator=Validator::make($data, [
                    'department'=>['required','string','max:180'],
                    'title' => ['required', 'string', 'max:180'],
                    'description' => ['required', 'string','max:500'],
                    'speaker' => ['required', 'string'],
                    'type' =>['required'],
                    'company_name'=>['required'],
                    'certificate' => ['required'],
                    'fees' => ['required','int'],
                    'stake_holder' => ['required'],
                    'start_dates'=>['required'],
                    'end_dates'=>['required'],
                    'start_times'=>['required'],
                    'end_times'=>['required'],
                    'venue_list'=>['required'],
                ]);
            }   
        else{
            $validator=Validator::make($data, [
                'department'=>['required','string','max:180'],
                'title' => ['required', 'string', 'max:180'],
                'description' => ['required', 'string','max:500'],
                'speaker' => ['required', 'string'],
                'type' =>['required'],
                'company_name'=>['required'],
                'certificate' => ['required'],
                'fees' => ['required','int'],
                'stake_holder' => ['required'],
                'start_dates'=>['required'],
                'start_times'=>['required'],
                'end_times'=>['required'],
                'venue_list'=>['required'],
            ]);
            }             
            if ($validator->fails()) {
                return redirect('/events/create')
                            ->withErrors($validator)
                            ->withInput();                
}
            
//         // $abc= $request->params;
//         //dd($request);
//         // echo $request;
//         //  $abc= $request->getContent()->title;
//         // echo $abc;
//         // echo gettype($abc);
        
//         // print_r(count($request->venue_list));
//         echo "start";
//         echo $request->title;
//         echo $request->getContent();
//         // $abc =$request->all();
//         // print_r($abc);
//         // echo $request->input('title');
//         $xyz =$request->title;
//         echo $xyz;
foreach($request->stake_holder as $stake_holder){
    if($request->v==0 and $request->t==0) {

        $start = $request->start_dates[0];
        $end = $request->end_dates[0];

        if($start>$end){
            return redirect('/events/create')->with('errort','The start date and end date entries are invalid')->withInput();
        }
        $num_days = floor((strtotime($end)-strtotime($start))/(60*60*24));
        $num_days++;
        $days = array();
        for ($i=0; $i<$num_days; $i++) 
                $days[$i] = date('Y-m-d', strtotime($start . "+ $i days"));
        if($request->no_of_days!=$num_days){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        // $evsc=event_schedule::all();

        $d=$request->start_times[0];
        $start_time= date('H:i:s', strtotime($d));
            
        $c= $request->end_times[0];
        $end_time= date('H:i:s', strtotime($c));

        if($start_time>$end_time){
            return redirect('/events/create')->with('errort','The start time and end time entries are invalid')->withInput();
        }
        $venue_id=$request->venue_list[0];
        for ($b=0; $b<count($days); $b++) {
            $eve= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','<=',$start_time],['end_time','>=',$end_time],['venue_id','=',$venue_id]])->get();
            $eve1= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','>=',$start_time],['end_time','>=',$end_time],['venue_id','=',$venue_id]])->get();
            $eve2= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','<=',$start_time],['end_time','<=',$end_time],['venue_id','=',$venue_id]])->get();
            $eve3= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','>=',$start_time],['end_time','<=',$end_time],['venue_id','=',$venue_id]])->get();
            if(count($eve)>0 or count($eve1)>0 or count($eve2)>0 or count($eve3)>0){
                $venue=Venue::find($venue_id);
                $vname=$venue->name;
                return redirect('/events/create')->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
            }
            

            $eve= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','<=',$start_time],['end_time','>=',$end_time]])->get();
            $eve1= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','>=',$start_time],['end_time','>=',$end_time]])->get();
            $eve2= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','<=',$start_time],['end_time','<=',$end_time]])->get();
            $eve3= DB::table('event_schedules')->where([['date','=',$days[$b]],['start_time','>=',$start_time],['end_time','<=',$end_time]])->get();

            // $array = array($eve);
            // $array1 = array($eve1);
            // $array2 = array($eve2);
            // $array3 = array($eve3);
            
            if(count($eve)>0){
                foreach($eve as $e) {
                    $tag = new event_schedule();
                    $p=$tag->event($stake_holder,$e->event_id);
                    if($p){
                        $stkh=stake_holders::find($stake_holder);
                        $sname=$stkh->name;
                        return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                    }
                   }    
            }

               if(count($eve1)>0){
                foreach($eve1 as $e) {
                    $tag = new event_schedule();
                    $p=$tag->event($stake_holder,$e->event_id);
                    if($p){
                        $stkh=stake_holders::find($stake_holder);
                        $sname=$stkh->name;
                        return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                    }
                   }
            }
               if(count($eve2)>0){
                foreach($eve2 as $e) {
                    $tag = new event_schedule();
                    $p=$tag->event($stake_holder,$e->event_id);
                    if($p){
                        $stkh=stake_holders::find($stake_holder);
                        $sname=$stkh->name;
                        return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                    }  
                 }
            }
    
             if(count($eve3)>0){
                foreach($eve3 as $e) {
                    $tag = new event_schedule();
                    $p=$tag->event($stake_holder,$e->event_id);
                    if($p){
                        $stkh=stake_holders::find($stake_holder);
                        $sname=$stkh->name;
                        return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
    
                    }
                   }
            }
            // echo $eve1;
            // echo $eve2;
            // echo $eve3;
            // $even=DB::table('event_schedules')->where([['venue_id','=',$venue_id]])->get();
        }    
        // print_r($days);
        // echo $num_days;
        // echo $eve;
        // echo gettype($eve);
        // $eve=array($eve);
        // echo gettype($eve);
        // echo $eve[0];

    } 
    elseif($request->v==0 and $request->t==1){
        if($request->no_of_days!=count($request->start_dates)){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        // $evsc=event_schedule::all();
        for ($j=0; $j<count($request->start_dates); $j++){
            $d=date('Y-m-d',strtotime ($request->start_dates[$j]));
            $a=date('H:i:s', strtotime($request->start_times[$j]));
            $b=date('H:i:s', strtotime($request->end_times[$j]));
            if($a>$b){
                $s=$j+1;
                return redirect('/events/create')->with('errort',"The start time and end time of the slot $s are invalid")->withInput();
            }

               $venue_id= $request->venue_list[0];
        
        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
        if(count($eve)>0 or count($eve1)>0 or count($eve2)>0 or count($eve3)>0){
            $venue=Venue::find( $venue_id);
            $vname=$venue->name;
            return redirect('/events/create')->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
        }
                     
        
        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b]])->get();

        // $array = array($eve);
        // $array1 = array($eve1);
        // $array2 = array($eve2);
        // $array3 = array($eve3);
        if(count($eve)>0){
            foreach($eve as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }    
        } 
           if(count($eve1)>0){
            foreach($eve1 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }
        }
           if(count($eve2)>0){
            foreach($eve2 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }  
             }
        }

         if(count($eve3)>0){
            foreach($eve3 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();

                }
               }
        }

       }

    }
    elseif($request->v==1 and $request->t==1){
        if($request->no_of_days!=count($request->start_dates)){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        // $evsc=event_schedule::all();
        for ($j=0; $j<count($request->start_dates); $j++){
            // for($k=0; $k<count($request->venue_list[$j]); $k++){
             $d=date('Y-m-d',strtotime ($request->start_dates[$j]));
             $a=date('H:i:s', strtotime($request->start_times[$j]));
             $b=date('H:i:s', strtotime($request->end_times[$j]));
             if($a>$b){
                $s=$j+1;
                return redirect('/events/create')->with('errort',"The start time and end time of the slot $s are invalid")->withInput();
            }

            $venue_id=$request->venue_list[$j];
            $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
            $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
            $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
            $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
            if(count($eve)>0 or count($eve1)>0 or count($eve2)>0 or count($eve3)>0){
                $venue=Venue::find($venue_id);
                $vname=$venue->name;
                return redirect('/events/create')->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
            }

        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b]])->get();

        // $array = array($eve);
        // $array1 = array($eve1);
        // $array2 = array($eve2);
        // $array3 = array($eve3);
        if(count($eve)>0){
            foreach($eve as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }    
        } 
           if(count($eve1)>0){
            foreach($eve1 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }
        }
                
           if(count($eve2)>0){
            foreach($eve2 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }  
             }
        }

         if(count($eve3)>0){
            foreach($eve3 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();

                }
               }
        }
        }
    }
    elseif($request->v==1 and $request->t==0){
        if($request->no_of_days!=count($request->start_dates)){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        $evsc=event_schedule::all();
        for ($j=0; $j<count($request->start_dates); $j++){
            // for($k=0; $k<count($request->venue_list[$j]); $k++){
             $d=date('Y-m-d',strtotime ($request->start_dates[$j]));
             $a=date('H:i:s', strtotime($request->start_times[$j]));
             $b=date('H:i:s', strtotime($request->end_times[$j]));
             if($a>$b){
                $s=$j+1;
                return redirect('/events/create')->with('errort',"The start time and end time of the slot $s are invalid")->withInput();
            }
        
        $venue_id=$request->venue_list[$j];
        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b],['venue_id','=',$venue_id]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b],['venue_id','=',$venue_id]])->get();
        if(count($eve)>0 or count($eve1)>0 or count($eve2)>0 or count($eve3)>0){
            $venue=Venue::find($venue_id);
            $vname=$venue->name;
            return redirect('/events/create')->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
        }
          
        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b]])->get();

        // $array = array($eve);
        // $array1 = array($eve1);
        // $array2 = array($eve2);
        // $array3 = array($eve3);
        if(count($eve)>0){
            foreach($eve as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }    
        } 
           if(count($eve1)>0){
            foreach($eve1 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }
        }
           if(count($eve2)>0){
            foreach($eve2 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }  
             }
        }

         if(count($eve3)>0){
            foreach($eve3 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();

                }
               }
        }
        
           
        }
    }
    
}

        foreach($request->stake_holder as $stake_holder){
            $event=new Events;
            $event->title=$request->title;
            $event->description=$request->description;
            $event->department=$request->department;
            $event->speakers=$request->speaker;
            $event->type=$request->type;
            $event->certificate=$request->certificate;
            $event->fees=$request->fees;
            $event->user_id=$request->user_id;
            $event->slots=count($request->start_dates);
            $event->company_name=$request->company_name;
            $event->stake_holder_id=$stake_holder;//Associative Array
            $event->save();
        
          
  
 if($request->v==0 and $request->t==0) {   
        $start = $request->start_dates[0];
        $end = $request->end_dates[0];

        $num_days = floor((strtotime($end)-strtotime($start))/(60*60*24));
        echo $num_days;
        $days = array();
        for ($i=0; $i<=$num_days; $i++) 
                $days[$i] = date('Y-m-d', strtotime($start . "+ $i days"));

//         print_r($days);
        // for($t=0; $t<count($days); $t++){
        //     if($days){
                
        //     }
        // }
        for ($b=0; $b<count($days); $b++) {
                $evs =new event_schedule;
                $evs->event_id=$event->id;
                
                $evs->date=$days[$b];
                    
                $d=$request->start_times[0];
                $evs->start_time= date('H:i:s', strtotime($d));
                    
                $c= $request->end_times[0];
                $evs->end_time= date('H:i:s', strtotime($c));
                
                
                $evs->venue_id=$request->venue_list[0];
                $evs->save();
                
            }
        
     }   
     
    elseif($request->v==0 and $request->t==1){
           
           for ($j=0; $j<count($request->start_dates); $j++){
                $d=$request->start_dates[$j];
                $a=$request->start_times[$j];
                $b=$request->end_times[$j];
                    $evs=new event_schedule;
                    $evs->event_id=$event->id;
                    $evs->date=date('Y-m-d',strtotime ($d) );
                    $evs->start_time=date('H:i:s', strtotime($a));
                    $evs->end_time=date('H:i:s', strtotime($b));
                    $evs->venue_id=$request->venue_list[0];
                    $evs->save();
               
           }
        }     
     elseif($request->v==1 and $request->t==1){
           
           for ($j=0; $j<count($request->start_dates); $j++){
            //    for($k=0; $k<count($request->venue_list[$j]); $k++){
                $d=$request->start_dates[$j];
                $a=$request->start_times[$j];
                $b=$request->end_times[$j];
                print_r($request->venue_list[$j]);
                    $evs=new event_schedule;
                    $evs->event_id=$event->id;
                    $evs->date=date('Y-m-d',strtotime ($d) );
                    $evs->start_time=date('H:i:s', strtotime($a));
                    $evs->end_time=date('H:i:s', strtotime($b));
                    $evs->venue_id=$request->venue_list[$j];
                    $evs->save();
            //    }
           } 
     }         
    elseif($request->v==1 and $request->t==0){
    
    for ($j=0; $j<count($request->start_dates); $j++){
        // for($k=0; $k<count($request->venue_list[$j]); $k++){
            $d=$request->start_dates[$j];
            $a=$request->start_times[$j];
            $b=$request->end_times[$j];
                $evs=new event_schedule;
                $evs->event_id=$event->id;
                $evs->date=date('Y-m-d',strtotime ($d) );
                $evs->start_time=date('H:i:s', strtotime($a));
                $evs->end_time=date('H:i:s', strtotime($b));
                $evs->venue_id=$request->venue_list[$j];
                $evs->save();
        // }
    }
    }
        $evp=new Event_Permissions;
        $evp->event_id=$event->id;
        $evp->permit_doa='0';
        $evp->permit_vp='0';
        $evp->permit_p='0';
        $evp->save();

        // $com=new Comments;
        // $com->event_id=$event->id;
        // $com->save();
    // print_r($request->v);
    // print_r($request->t);
    $user=User::find($request->user_id);
    $details=[
        'title'=>'Title: Mail of Event Request.',
        'body'=>'Body: This is to inform you that the event request for stakeholders'.$stake_holder.' has been sent',
        'message'=>'E-mail has been sent successfully.',
        'subject'=>'Your event request has been sent.',
    ];
    $details1=[
        'title'=>'Title: Mail for confirmation.',
        'body'=>'Body: An event request has been sent by '.$user->name.' for approval.',
        'message'=>'E-mail has been sent successfully.',
        'subject'=>'Event request has been sent.',
    ];

   
    \Mail::to($user->email)->send(new SendMail($details));
    \Mail::to('shithil.s@somaiya.edu')->send(new SendMail($details1));
  }
  

 
    //   print_r($request->venue_list);
   
    return redirect('/events')->with('success','Event Request Submitted!');

    // return redirect()->to('/events')->send();
    // return redirect()->route('events.index');
    // return redirect()->action('EventsController@index');
    // return Redirect::to('/events')->with(['type' => 'success','message' => 'Page redirected!']);
 
}  

public function approval(Request $request){
    // $events=Events::find($request->id);
    // $events->name;
    // $evp=Event_Permissions::find($request->event_id);
    // $evp->permit_p='1';
    // $evp->save();
    if(auth()->user()->email=='principal@somaiya.edu'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_p' => $request->approval]);

    }
    else if(auth()->user()->email=='shithil.s@somaiya.edu'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_vp' => $request->approval]);
        $events=Events::find($request->event_id);
        $user=User::find($events->user_id);
        // echo $user->email;

        $details=[
            'title'=>'Title: Mail From Shithil Shetty',
            'body'=>'Body: This is to inform you that the event request has been approved',
            'message'=>'E-mail has been sent successfully.',
            'subject'=>'Your event request has been accepted.',
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return view('emails.thanks');

    }
    else if(auth()->user()->email=='doa@somaiya.edu'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_doa' => $request->approval]);

    }

    // return redirect('/permission');
    
}


public function comments(Request $request){
    $comm=$request->comments;
    // echo $request->event_id;
    $comments=new Comments;
    $comments->event_id=$request->event_id;
    if(auth()->user()->email=='principal@somaiya.edu'){
        $comments->user='Principal';
        }
    else if(auth()->user()->email=='shithil.s@somaiya.edu'){
        $comments->user= 'Vice-Pricipal';
        }
    else{
        $comments->user='Dean of Academics'; 
        }
    $comments->comments=$comm;    
    $comments->save();
   

    return redirect('/permission');
}

public function messages()
    {
        return [
            'title.required' => 'You must select at least one category.',
            
        ];
    }

    public function permission(Request $request)
    {
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
        // echo $nmonth;
        // print_r($arr);
        $stake_holders= stake_holders::all();
        $venues= Venue::all();
        
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
        $comm=Comments::all();
        // echo $j;
        // echo "Value of j.";
        return view('events.permission',compact('m','n','u','s','j','h','k','events','arr','stake_holders','venues','comm'));

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)//Replaced the id argument with request
    {
        // $venue = \DB::table('venues')->pluck('name','id');
        // echo "Hello!!!";
        $venue=Venue::all();
        $stake_holder = \DB::table('stake_holders')->pluck('name','id');
        $certificate =['0'=>'Yes', '1' => 'No', '2' => 'Not Decided'];
        $type = ['0' => 'Workshops', '1' => 'Competitions', '2' => 'Conferences','3'=>'Fun Events','4'=>'STTP','5'=>'FDP','6'=>'Orientation Program'];
        $events=Events::find($request->event_id);
        $event_schedules=DB::table('event_schedules')->where('event_id',$request->event_id)->get();

        return view('events.edit',compact('events','venue','stake_holder','certificate','type','event_schedules'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)//Removed the id argument present along with request
    {
        // print_r($request->start_dates[1]);
    //    echo "Hey";
        // print_r($request->event_id);
        $data=$request->all();

        $validator=Validator::make($data, [
            'department'=>['required','string','max:180'],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string','max:500'],
            'speaker' => ['required', 'string'],
            'type' =>['required'],
            'company_name'=>['required'],
            'certificate' => ['required'],
            'fees' => ['required','int'],
            'stake_holder' => ['required'],
            'start_dates'=>['required'],
            'start_times'=>['required'],
            'end_times'=>['required'],
            'venue_list'=>['required'],
        ]);
             $event_id=$request->event_id;     
        if ($validator->fails()) {
            return redirect('/events/edit?event_id='.$event_id)
                        ->withErrors($validator)
                        ->withInput(); 
            
        }
    foreach($request->stake_holder as $stake_holder){
        // if($request->no_of_days!=count($request->start_dates)){
        //     return redirect('/events/edit?event_id='.$event_id)->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        // }
        // $evsc=event_schedule::all();
        for ($j=0; $j<count($request->start_dates); $j++){
            // for($k=0; $k<count($request->venue_list[$j]); $k++){
             $d=date('Y-m-d',strtotime ($request->start_dates[$j]));
             $a=date('H:i:s', strtotime($request->start_times[$j]));
             $b=date('H:i:s', strtotime($request->end_times[$j]));
             if($a>$b){
                $s=$j+1;
                return redirect('/events/edit?event_id='.$event_id)->with('errort',"The start time and end time of the slot $s are invalid")->withInput();
            }
        
            $venue_id=$request->venue_list[$j];
            $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
            $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
            $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
            $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
            if(count($eve)>0 or count($eve1)>0 or count($eve2)>0 or count($eve3)>0){
                $venue=Venue::find($venue_id);
                $vname=$venue->name;
                return redirect('/events/edit?event_id='.$event_id)->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
            }

        $eve= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','>=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
        $eve1= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','>=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
        $eve2= DB::table('event_schedules')->where([['date','=',$d],['start_time','<=',$a],['end_time','<=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();
        $eve3= DB::table('event_schedules')->where([['date','=',$d],['start_time','>=',$a],['end_time','<=',$b],['venue_id','=',$venue_id],['event_id','!=',$event_id]])->get();

        // $array = array($eve);
        // $array1 = array($eve1);
        // $array2 = array($eve2);
        // $array3 = array($eve3);
        if(count($eve)>0){
            foreach($eve as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/edit?event_id='.$event_id)->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }    
        } 
           if(count($eve1)>0){
            foreach($eve1 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/edit?event_id='.$event_id)->with('errort',"The $sname department has another event to attend.")->withInput();
                }
               }
        }
                
           if(count($eve2)>0){
            foreach($eve2 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/edit?event_id='.$event_id)->with('errort',"The $sname department has another event to attend.")->withInput();
                }  
             }
        }

         if(count($eve3)>0){
            foreach($eve3 as $e) {
                $tag = new event_schedule();
                $p=$tag->event($stake_holder,$e->event_id);
                if($p){
                    $stkh=stake_holders::find($stake_holder);
                    $sname=$stkh->name;
                    return redirect('/events/edit?event_id='.$event_id)->with('errort',"The $sname department has another event to attend.")->withInput();

                }
               }
        }
        }
    }
        
    Events::where(['id'=> $request->event_id])->update(['title' => $request->title,'description'=> $request->description,'user_id' =>$request->user_id, 'department' => $request->department,'title' => $request->title,'speakers' => $request->speaker,'type' => $request->type,'certificate' => $request->certificate, 'fees' => $request->fees,'user_id' => $request->user_id,'slots' => count($request->start_dates),'company_name' => $request->company_name,'stake_holder_id' => $request->stake_holder[0] ]);
    DB::table('event_schedules')->where('event_id',$request->event_id)->delete();
                
    for ($j=0; $j<count($request->start_dates); $j++){
            $d=$request->start_dates[$j];
            $a=$request->start_times[$j];
            $b=$request->end_times[$j];
                $evs=new event_schedule;
                $evs->event_id=$request->event_id;
                $evs->date=date('Y-m-d',strtotime ($d) );
                $evs->start_time=date('H:i:s', strtotime($a));
                $evs->end_time=date('H:i:s', strtotime($b));
                $evs->venue_id=$request->venue_list[$j];
                $evs->save();
        
    }
    Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_p' => '0','permit_vp'=> '0','permit_doa' =>'0' ]);

    

         return redirect('/home')->with('success','Event Modified');
    }

    public function fileupload(Request $request)
    {   

        
        $filev= $request->all();
        $validator=Validator::make($filev, [
            'uploadedfile' => 'required|mimes:pdf|max:2000',
            ]);
            if ($validator->fails()) {
                return redirect('/home')
                            ->withErrors($validator);
            }
            $file= $request->file('uploadedfile');
            // $data= $request->all();
            // $validator=Validator::make($data, [
            //     'uploadedfile' => 'required|mimes:pdf|max:20000',
            //     ]);
            //     if ($validator->fails()) {
            //         return redirect('/home')
            //                     ->withErrors($validator);
            //     }
        $filename= $file->getClientOriginalName();
        $fileext = $file->getClientOriginalExtension();
        $filename= time(). '_' .$request->title.'_.'.$fileext;

        $path = $file->storeAs('reports', $filename);
        // $path = 'C:/'.$path;
        // echo $path;
        
        // echo request->event_id;
                // echo $path;
                // echo $request->title;
        Fileupload::create([
            'filename' => $filename,
            'filepath' => $path,
            'event_id' => $request->event_id,
        ]);
            $savedfile = Fileupload::latest()->firstOrFail();
        return redirect('/home')->with('success', 'Report submitted!');
               
      //Display File Size
    //   echo 'File Size: '.$file->getSize(). ' bytes';
    //   echo '<br>';
   
      //Display File Mime Type
    //   echo 'File Mime Type: '.$file->getMimeType();

    }


    public function filedownload(Request $request)
    {
        // echo $request->event_id;
        // $file=DB::table('fileuploads')->where('event_id',$request->event_id)->get('filename');
        $file=Fileupload::where('event_id', $request->event_id)->first();
        // $file=Fileupload::find($request->event_id);
        // $file=array($file);
        // print_r($file);
        if(!$file){
            return redirect('/events')->with('error', 'Report not uploaded yet.');
        }
        $filen= $file['filename'];
        $filep=$file['filepath'];
        $file= storage_path($filep);
        
    //    echo $file;
    //    echo "Hey";
    //    echo $filen;
    //    echo "Hey";
    //    echo $filep;
        if(file_exists(storage_path().'\app\reports\\'.$filen)){
            $file= storage_path().'\app\reports\\'.$filen;
            return response()->download($file);
        }
        else{
            return redirect('/events')->with('error', 'Report not found on server.');        
        }    
        // echo $file;
        // return  Storage::disk('ftp')->download($file);
    //     // $response->headers->set('Content-Type' , 'application/pdf');
    // $headers = [
    //           'Content-Type' => 'application/pdf',
    // ];
    
    //         // return Storage::download($file);
            // return response()->download(storage_path("app/reports/{$filen}"));
            


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function venues(){
        $venues=\DB::table('venues')->pluck('name','id');
        return json_decode($venues,true);
    }

    public function eventst(){
        // $events=collect(DB::table('events')->get());
        //Alternative Method
        $events=Events::all();
        return json_decode($events,true);
    }

    public function stakeholders(){
        $stake_holders=collect(DB::table('stake_holders')->get());
        return json_decode($stake_holders,true);
    }

    public function eventstakeholders(){
        $event_stake_holders=collect(DB::table('event_stake_holders')->get());
        return json_decode($event_stake_holders,true);
    }

    public function eventpermissions(){
        $event__permissions=collect(DB::table('event__permissions')->get());
        return json_decode($event__permissions,true);
    }

    public function eventschedules(){
        $event_schedules=collect(DB::table('event_schedules')->get());
        return json_decode($event_schedules,true);
    }
}
 //     echo 'Hi';
    //     $a=$_POST['start_dates'];
    //     $b=$_POST['end_dates'];
    //     $c=$_POST['start_times'];
    //     $d=$_POST['end_times'];
    //     $data = $request->all();
        
    //    $validator=Validator::make($data, [
    //     'title' => ['required', 'string', 'max:255'],
    //     'description' => ['required', 'string','max:255'],
    //     'speaker' => ['required', 'string'],
    //     'type' =>['required'],
    //     'certificate' => ['required'],
    //     'fees' => ['required'],
    //     'stake_holder' => ['required'],
    // ]);
    // if ($validator->fails()) {
    //     return redirect('/events/create')
    //                 ->withErrors($validator)
    //                 ->withInput();
    // }
    // return view('events.calendar');