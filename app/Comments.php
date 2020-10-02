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
    'comments_p','comments_vp','comments_doa',
    ];

}
