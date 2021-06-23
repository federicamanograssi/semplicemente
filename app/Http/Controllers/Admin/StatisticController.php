<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;


class StatisticController extends Controller
{
    public function index(){

        $data = [
            'apartments' => Apartment::where('user_id', Auth::id())->get(),
        ];

        return view('admin.statistics.index',$data);
    }
}
