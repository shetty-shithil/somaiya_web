<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_schedule extends Model
{   protected $table='event_schedules';
    public $primaryKey='id';
    public $timestamps=false; 
   protected $fillable=[
       'event_id', 'date', 'start_time', 'end_time', 'venue_id',
   ];
}
