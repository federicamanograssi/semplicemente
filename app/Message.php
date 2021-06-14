<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email_sender','message_text'
    ];

    public function apartment(){
        return $this -> hasMany('App\Apartment');
    }

}
