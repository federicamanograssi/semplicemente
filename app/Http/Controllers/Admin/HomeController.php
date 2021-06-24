<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\View;
use App\Message;
use App\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [

            //prendere lista appartamenti user
            'apartments' => Apartment::where('user_id', Auth::id())->get(),

            //prendere views di tutti gli apppartamenti dell'utente
            'views' => View::whereHas('apartment', function($query){
                $query->where('user_id', Auth::id());
            })->get(),

            //prendere messaggi degli apppartamenti dell'utente
            'messages' => Message::whereHas('apartment', function($query){
                $query->where('user_id', Auth::id());
            })->get()
        ];

        return view('admin.dashboard.index',$data);
    }


        //pagina statistiche
    public function statistics()
    {
        $data = [

            //prendere lista appartamenti user
            'apartments' => Apartment::where('user_id', Auth::id())->get(),

            //prendere views di tutti gli apppartamenti dell'utente
            'views' => View::whereHas('apartment', function($query){
                $query->where('user_id', Auth::id());
            })->get(),

            //prendere messaggi degli apppartamenti dell'utente
            'messages' => Message::whereHas('apartment', function($query){
                $query->where('user_id', Auth::id());
            })->get()
        ];

        return view('admin.statistics.index',$data);
    }


    //sezione sponsorizzate
    public function sponsorship(){

        $data = [

            //prendere lista appartamenti user
            'apartments' => Apartment::where('user_id', Auth::id())->get(),
            'sponsorships' => Sponsorship::all()
        ];

        return view('admin.sponsorships.index',$data);
    }
    
}
