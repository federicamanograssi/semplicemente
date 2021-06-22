<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use App\Apartment;
use App\Image;
use App\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Mostra lista appartamenti
    public function index()
    {
        $apartments=Apartment::all();

        return response()->json([
            'success'=> true,
            'results'=> $apartments
        ]);
    }
    
    //  Ritorna lista servizi
    public function services()
    {
        $services=Service::select('id','service_name')->get();

        return response()->json([
            'success'=> true,
            'results'=> $services
        ]);
    }
    // public function search()
    // {
    //     $apartments=Apartment::all();

    //     return response()->json([
    //         'success'=> true,
    //         'results'=> 'ciao'
    //     ]);
    // }

    /**
     * RICERCA APT VISIBILI NEL DB 
     * ALL'INTERNO DI UN DETERMINATO RAGGIO 
     * A PARTIRE DAL PUNTO DI RICERCA INSERITO */
    public function location(Request $request)
    {
        /*
            Formula distanza fra due punti
            dist = arccos(sin(lat1) · sin(lat2) + cos(lat1) · cos(lat2) · cos(lon1 - lon2)) · R
            PHP: acos( sin($radLat1) * sin($lat2) + cos($radLat1) * cos($lat2) * cos($radLon1 - $lon2) );
        */

        $apartments=Apartment::where('visible','1')->get();
        
        $location = $request->input('location');    // Query Location
        $radius   = $request->input('radius');      // Query Radius

        // Chiamata a TomTom per ottenere coordinate di $location
        $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $location . '.json?limit=1&key=qISPPmwNd3vUBqM2P2ONkZuJGTaaQEmb')->json();
        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];
        
        // Coordinate (conversione da decimali a radianti)
        
        $radLat1 =   (M_PI / 180) * $lat;
        $radLon1 =   (M_PI / 180) * $lon;

        $sinRadLat1 = sin($radLat1);    // Seno Latitudine input utente
        $cosRadLat1 = cos($radLat1);    // Coseno Latitudine input utente
        
        $earthRadius = 6371; // Raggio Terrestre (KM)
                
        $chalets = array();

        foreach($apartments as $apartment) {

            // calcola distanza radiale dal punto di ricerca inserito
            $dist = acos( $sinRadLat1 * sin((M_PI / 180) * $apartment['latitude']) + $cosRadLat1 * cos((M_PI / 180) * $apartment['latitude']) * cos($radLon1 - (M_PI / 180) * $apartment['longitude']) ) * $earthRadius;

            if ($dist <= $radius) {

                // - prendere img di copertina
                $cover_img = DB::table('images')->where(
                    [
                        ['apartment_id', '=' , $apartment['id']] ,
                        ['is_cover' ,    '=' , '1']
                    ]
                    )->first()->img_path;

                // - prendere servizi correlati

                $services = DB::table('apartment_service')
                    ->select('service_id')
                    ->where('apartment_id',$apartment['id'])
                    ->get();

                //- crea array con i dati necessari per stampa e filtri    
                $newChalet = array(
                    'name' => $apartment['title'] ,
                    'lat'  => (M_PI / 180) * $apartment['latitude'] ,
                    'lon'  => (M_PI / 180) * $apartment['longitude'] ,
                    'dist' => $dist ,                        
                    'cover_img' => $cover_img,
                    'rooms' => $apartment['rooms_n'],
                    'beds' => $apartment['beds_n'],
                    'price' => $apartment['price_per_night'],
                    'rating' => $apartment['rating'],
                    'services' => $services
                );

                //- salvare l'array dell'apt nell'array di risultati da restituire
                array_push($chalets , $newChalet);

            }
        }

        
        return response()->json([
            'success'=> true,
            'results'=> $chalets ,
            'base_lat' => $lat ,
            'base_lon' => $lon
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
