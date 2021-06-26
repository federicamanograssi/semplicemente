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
        // Trova appartamento il cui ID corrisponde a quello richiesto

        $apartment = Apartment::where('id', $id)->first();

        $data = [
            // 'apartment' => Apartment::where('id', $id)->first()
            'apartment' => $apartment
        ];

        //crea nuova visualizzazione dell'appartamento

        $new_view = new View;
        $new_view->apartment_id = $id;
        $new_view->save();

        return view('guest.singleApartment',$data);
    }
}
