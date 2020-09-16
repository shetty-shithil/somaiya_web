<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Stake_Holders extends Model
{
    protected $table='event_stake_holders';
    public $primaryKey='id';
    public $timestamps=false; 

    protected $fillable=[
    'event_id', 'stake_holder_id',
    ];
}
