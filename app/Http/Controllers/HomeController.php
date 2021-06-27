<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Image;
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

    /*
    *   Dato l'id di un appartamento, questo metodo
    *   restituisce l'oggetto che lo rappresenta
    */
    public function show($id)
    {
        // Trova appartamento il cui ID corrisponde a quello richiesto

        $apartment = Apartment::where('id', $id)->first();

        // Trova immagini associate all'appartamento
        $apt_images = Image::where('apartment_id' , $id)->get();
        
        $images = array();

        // Pusho le info necessarie relative ad ogni img trovata all'interno di un array
        foreach ($apt_images as $img) {
            $images[] = array(
                                'img_path'      => $img->img_path ,
                                'is_cover'      => $img->is_cover == 1 ? true : false ,
                                'description'   => $img->description
                            );                          
        }

        // Inserisco l'array di immagini fra le informazioni dell'appartamento
        
        $apartment['images'] = $images;

        $data = [
            'apartment' => $apartment
        ];

        //crea nuova visualizzazione dell'appartamento

        $new_view = new View;
        $new_view->apartment_id = $id;
        $new_view->save();

        return view('guest.singleApartment',$data);
    }
}
