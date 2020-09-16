<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
