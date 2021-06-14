<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id_apartment','img_path','img_description','is_cover'
    ];

    public function apartment(){
        return $this -> hasMany('App\Apartment');
    }
}
