<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use App\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments=Apartment::all();

        return response()->json([
            'success'=> true,
            'results'=> $apartments
        ]);
    }
    public function search()
    {
        $apartments=Apartment::all();

        return response()->json([
            'success'=> true,
            'results'=> 'ciao'
        ]);
    }
    public function location(Request $request)
    {

        // $apartments=config('apartments');
        $apartments=Apartment::all();
        // Oppure: $apartments = DB::table('apartments')->where('title', '=', $location )->get();

        
        $location = $request->input('location');    // Query Location
        $radius   = $request->input('radius');      // Query Radius

        // Chiamata a TomTom per ottenere coordinate di $location
        $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $location . '.json?limit=1&key=qISPPmwNd3vUBqM2P2ONkZuJGTaaQEmb')->json();
        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];
        
        // Coordinate (conversione da decimali a radianti)
        $radLat1 =   (M_PI / 180) * $lat;
        $radLon1 =   (M_PI / 180) * $lon;        
        
        $earthRadius = 6371; // Raggio Terrestre (KM)

        // Formula distanza fra due punti
        // dist = arccos(sin(lat1) · sin(lat2) + cos(lat1) · cos(lat2) · cos(lon1 - lon2)) · R
        // ..In PHP 
        // acos( sin($radLat1) * sin($lat2) + cos($radLat1) * cos($lat2) * cos($radLon1 - $lon2) )
        

        // Prima Prova: Calcolo la distanza fra il punto indicato dall'utente e tutti gli appartamenti che abbiamo in config
        
        $chalets = array();
        foreach($apartments as $index => $apartment) {
            
            $newChalet = array(
                'name'=> $apartment['title'] ,
                'lat' => (M_PI / 180) * $apartment['latitude'] ,
                'lon' => (M_PI / 180) * $apartment['longitude'] ,
            );

            // Calcolo distanza con il punto indicato dall'utente

            $dist = acos( sin($radLat1) * sin($newChalet['lat']) + cos($radLat1) * cos($newChalet['lat']) * cos($radLon1 - $newChalet['lon']) ) * $earthRadius;            
            $newChalet['distanza'] = $dist;

            if($dist <= $radius){
                array_push($chalets , $newChalet);
            }
        }

        
        return response()->json([
            'success'=> true,
            // 'results'=> 'Hai cercato ' . $location . ' Il raggio è pari a  ' . $radius . ' chilometri'
            'results'=> $chalets
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
