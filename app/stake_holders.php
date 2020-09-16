<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stake_holders extends Model
{   
    protected $table='stake_holders';
    //Primary Key
    public $primaryKey='id';
    //Timestamps
    public $timestamps=false; 
    
    protected $fillable=[
        'name',
    ];
}
