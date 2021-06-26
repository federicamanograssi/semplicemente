<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }
    public function show($id)
    {
        $data = [
            'apartments' => Apartment::where('id', $id)->get()
        ];

        //crea nuova visualizzazione dell'appartamento
        $new_view = new View;
        $new_view->apartment_id = $id;
        $new_view->save();

        return view('guest.singleApartment',$data);
    }
}
