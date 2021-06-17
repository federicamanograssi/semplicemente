<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'apartments' => Apartment::where('user_id', Auth::id())->get(),
            'services' => Service::with('apartments')
        ];

        return view('admin.apartments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        

        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:100',
            'address' => 'required',
            'rooms_n' => 'required|min:1',
            'beds_n' => 'required|min:1',
            'bathroom_n' => 'required',
            'dimensions' => 'required',
            'visible' => 'required',
            'price_per_night' => 'required|min:1'
        ]);

        
        // INDIRIZZO IN COORDINATE LAT LONG
        $address = $request->address;
        $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $address. '.json?limit=1&key=qISPPmwNd3vUBqM2P2ONkZuJGTaaQEmb')->json();
            $lat = $response['results'][0]['position']['lat'];
            $lon = $response['results'][0]['position']['lon'];
 
        $data = $request->all();
        // dd($data['img_path']);
        
        $new_apartment = new Apartment();
        $new_apartment->user_id = Auth::id();
        $new_apartment->latitude = $lat;
        $new_apartment->longitude = $lon;
        $new_apartment->fill($data);

        // if(array_key_exists('images',$data)){
        // // salvo l'immagine e recupero il path
        // $img_path= Storage::put('apartment_images',$data['images'],'public');

        // dd($img_path);
        // // questo se devo salvarlo nella colonna 'img_path' della tabella apartments MA NON CE L'ABBIAMO
        // $data['images'] = $img_path;
        // // e poi fare il new_apartment['image']
        // $new_image= new Image();
        // $new_image->img_path = $data['images'];
        // $new_image->save();
        // };

        $new_apartment->save();



        if(array_key_exists('services', $data)) {
            $new_apartment->services()->sync($data['services']);
        }

        return redirect()->route('apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('guest.singleApartment',compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $data = [
            'apartment'=> $apartment,
            'services'=> Service::all()
        ];
        return view('admin.apartments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        $apartment->update($data);

        if(array_key_exists('services', $data)){
            $apartment->services()->sync($data['services']);
        }else {
            $apartment->services()->sync([]);

        }

        return redirect()->route('apartments.index', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->sync([]);
        $apartment->delete();
        return redirect()->route('apartments.index');
    }
}
