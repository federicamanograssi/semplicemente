<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    protected $fillable= [
        'apartament_id','service_id'
    ];

    public function apartments(){
        return $this -> belongsToMany('App\Apartment');
    }
}
