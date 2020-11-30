<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Events extends Model
{
    protected $table='events';
    //Primary Key
    public $primaryKey='id';
    //Timestamps
    public $timestamps=false; 
   
    protected $fillable=[
    'title', 'department', 'company_name', 'description', 'type', 'fees', 'speakers', 'certificate', 'slots', 'status', 'stake_holder_id', 'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

    // public static function evs(){
    //     return self::hasMany('App\event_schedule');
    // }
    public static function approval(){
        return DB::table('event__permissions')->where([['permit_p','=','1'],['permit_vp','=','1'],['permit_doa','=','1']])->get();
    }

    public static function select($user_id){
        return DB::table('events')->where(['user_id','=',$user_id]);
    }
}
