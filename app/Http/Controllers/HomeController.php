<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Event_Stake_Holders;
use App\Venue;
use App\stake_holders;
use App\Event_Permissions;
use App\User;
use App\event_schedule;
use App\Comments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth() ->user()->id;
        $user = User::find($user_id);

        $z=0;
        $arr=[];
        $events= Events::all();
        $event_schedules= event_schedule::all();
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
           
            $arr=array_merge($arr,array($z=>$evs));
            
            $z++;
            // echo $j;
            
        }

        $stake_holders= stake_holders::all();
        $venues= Venue::all();
        $u_events=$user->events;
        // return view('home')->with('events',$user->events);
        return view('home',compact('events','u_events','arr','stake_holders','venues'));

    }
}
