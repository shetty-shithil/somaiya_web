<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events;
use App\Event_Stake_Holders;
use App\Venue;
use App\stake_holders;
use App\Event_Permissions;
use App\User;
use App\event_schedule;
use App\Comments;
use Carbon\Carbon;
use DB;


// $a=$_POST['start_dates'];
//         $b=$_POST['end_dates'];
//         $c=$_POST['start_times'];
//     $d=$_POST['end_times'];
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
        // echo $j;
        // echo "Value of j.";
        return view('events.index',compact('m','n','u','s','j','h','k','events','arr','stake_holders','venues'));
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
        return view('events.create',compact('venue','stake_holder','certificate','type'));
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
        for ($i=0; $i<=$num_days; $i++) 
                $days[$i] = date('Y-m-d', strtotime($start . "+ $i days"));
        if($request->no_of_days!=$num_days){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        $evsc=event_schedule::all();
        $d=$request->start_times[0];
        $start_time= date('H:i:s', strtotime($d));
            
        $c= $request->end_times[0];
        $end_time= date('H:i:s', strtotime($c));
        if($start_time>$end_time){
            return redirect('/events/create')->with('errort','The start time and end time entries are invalid')->withInput();
        }
        $venue_id=$request->venue_list[0];
        for ($b=0; $b<count($days); $b++) {
            foreach($evsc as $evs){
                $eve=Events::find($evs->event_id);
                if($evs->date==$days[$b] and $evs->start_time==$start_time and $evs->venue_id==$request->venue_list[0]){
                    $venue=Venue::find( $evs->venue_id);
                    $vname=$venue->name;
                    return redirect('/events/create')->with('errort',"Time slots for the venue $vname mentioned date aren't available.")->withInput();
                }
                elseif($eve->stake_holder_id==$stake_holder and $evs->start_time==$start_time and $evs->date==$days[$b]){
                    $stkh=stake_holders::find($eve->stake_holder_id);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
            }
        }    

    } 
    elseif($request->v==0 and $request->t==1){
        if($request->no_of_days!=count($request->start_dates)){
            return redirect('/events/create')->with('errort','The number of entries do not match with the number of days mentioned.' )->withInput();
        }
        $evsc=event_schedule::all();
        for ($j=0; $j<count($request->start_dates); $j++){
            $d=date('Y-m-d',strtotime ($request->start_dates[$j]));
            $a=date('H:i:s', strtotime($request->start_times[$j]));
            $b=date('H:i:s', strtotime($request->end_times[$j]));
            if($a>$b){
                $s=$j+1;
                return redirect('/events/create')->with('errort',"The start time and end time of the slot $s are invalid")->withInput();
            }
            foreach($evsc as $evs){    
                $eve=Events::find($evs->event_id);
                $request->venue_list[0];
                if($evs->date==$d and $evs->start_time==$a and $evs->venue_id==$request->venue_list[0]){
                    $venue=Venue::find( $evs->venue_id);
                    $vname=$venue->name;
                    return redirect('/events/create')->with('errort',"Mentioned Time slots for the venue $vname aren't available.")->withInput();
                }       
                elseif($eve->stake_holder_id==$stake_holder and $evs->start_time==$a and $evs->date==$d){
                    $stkh=stake_holders::find($eve->stake_holder_id);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
        }
       }

    }
    elseif($request->v==1 and $request->t==1){
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
             foreach($evsc as $evs){    
                $eve=Events::find($evs->event_id);
                $request->venue_list[$j];
                if($evs->date==$d and $evs->start_time==$a and $evs->venue_id==$request->venue_list[$j]){
                    $venue=Venue::find( $evs->venue_id);
                    $vname=$venue->name;
                    return redirect('/events/create')->with('errort',"Mentioned Time slots for the venue $vname aren't available.")->withInput();
                }       
                elseif($eve->stake_holder_id==$stake_holder and $evs->start_time==$a and $evs->date==$d){
                    $stkh=stake_holders::find($eve->stake_holder_id);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
        }
                 
            // }
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
             foreach($evsc as $evs){    
                $eve=Events::find($evs->event_id);
                $request->venue_list[$j];
                if($evs->date==$d and $evs->start_time==$a and $evs->venue_id==$request->venue_list[$j]){
                    $venue=Venue::find( $evs->venue_id);
                    $vname=$venue->name;
                    return redirect('/events/create')->with('errort',"Mentioned Time slots for the venue $vname aren't available.")->withInput();
                }       
                elseif($eve->stake_holder_id==$stake_holder and $evs->start_time==$a and $evs->date==$d){
                    $stkh=stake_holders::find($eve->stake_holder_id);
                    $sname=$stkh->name;
                    return redirect('/events/create')->with('errort',"The $sname department has another event to attend.")->withInput();
                }
        }
                 
            // }
        }
    }
    
}
// $event=Events::find($event->id;
// $event->delete(); 
        // echo "1";
        // print_r($request->start_dates);
        // echo gettype($request->start_dates);
        // echo "khatam!";
        // echo gettype($request->venue_list);
        // print_r($request->venue_list);
        // $users = json_decode($request->json()->all());
        // echo json($users);
        // $abc= $request->input('params');
        // echo $abc;
        // return redirect('/events/create')->with('success',$abc);
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
        
            // $evp=new Event_Permissions;
            // $evp->event_id=$event->id;
            // $evp->permit_doa='0';
            // $evp->permit_vp='0';
            // $evp->permit_p='0';
            // $evp->save();
  
// //         print_r($request->venue_list[0][0]);
// //         // foreach($request->start_dates as $d){
// //         //     // $d =$request->start_dates;
// //         //     $a= date('Y-m-d',strtotime ($d) );
// //         //     echo $a;
// //         // } 
// //         // foreach($request->start_times as $d){
// //         //     // $d =$request->start_dates;
// //         //     $a= date('H:i:s', strtotime($d));
// //         //     echo $a;
// //         // } 
      
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

        $com=new Comments;
        $com->event_id=$event->id;
        $com->save();
    // print_r($request->v);
    // print_r($request->t);
  }
 
      print_r($request->venue_list);
   
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
    if(auth()->user()->email=='shithil.s@somaiya.edu'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_p' => $request->approval]);

    }
    else if(auth()->user()->email=='xyz@g.com'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_vp' => $request->approval]);

    }
    else{
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_doa' => $request->approval]);

    }

    return redirect('/permission');
    
}


public function comments(Request $request){
    $comm=$request->comments;
    if(auth()->user()->email=='shithil.s@somaiya.edu'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_p' => $request->approval]);
        Comments::where(['event_id'=> $request->event_id])->update(['comments_p' => $request->comments]);
    }
    else if(auth()->user()->email=='xyz@g.com'){
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_vp' => $request->approval]);
        Comments::where(['event_id'=> $request->event_id])->update(['comments_vp' => $request->comments]);
    }
    else{
        Event_Permissions::where(['event_id'=> $request->event_id])->update(['permit_doa' => $request->approval]);
        Comments::where(['event_id'=> $request->event_id])->update(['comments_vp' => $request->comments]);
    }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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