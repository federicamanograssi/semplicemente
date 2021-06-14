<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable= [
        'service_name','service_icon','service_info'
    ];

    public function apartments(){
        return $this -> belongsToMany('App\Apartment');
    }
}
