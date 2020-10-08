<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table='comments';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'event_id','user','comments',
    ];

}
