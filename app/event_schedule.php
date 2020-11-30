<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class event_schedule extends Model
{   protected $table='event_schedules';
    public $primaryKey='id';
    public $timestamps=false; 
   protected $fillable=[
       'event_id', 'date', 'start_time', 'end_time', 'venue_id',
   ];

   public static function event($stake_holder_id,$event_id){
       return DB::table('events')->where([['id','=',$event_id],['stake_holder_id','=',$stake_holder_id]])->get();
   }

//    public static function select($event_id){
//        return DB::table('event_schedules')->where([['event_id','=',$event_id]]);
//    }
}
