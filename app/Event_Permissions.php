<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Permissions extends Model
{
    protected $table='event__permissions';
    public $primaryKey='id';
    public $timestamps=false;
    protected $fillable=[
    'permit_doa', 'permit_vp', 'permit_p', 'event_id',
    ];
}
