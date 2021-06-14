<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title','rooms_n','beds_n','bathrooms_n','dimensions','latitude','longitude','description','visible','price_per_night','rating'
    ];

    public function user(){
        return $this -> belongsTo('App\User');
    }

    public function services(){
        return $this -> belongsToMany('App\Service');
    }

    public function sponsorships(){
        return $this -> belongsToMany('App\Sponsorship');
    }

    
}


