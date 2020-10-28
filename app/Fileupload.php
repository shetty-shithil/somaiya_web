<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileupload extends Model
{
    protected $table='fileuploads';
    //Primary Key
    public $primaryKey='id';
    //Timestamps
    public $timestamps=true; 

    protected $fillable=[
        'event_id', 'filename', 'filepath',
    ];

    // protected $guarded = [];
}
