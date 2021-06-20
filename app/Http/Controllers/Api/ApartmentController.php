<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use App\Apartment;
use App\Image;

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
        /*
            Formula distanza fra due punti
            dist = arccos(sin(lat1) · sin(lat2) + cos(lat1) · cos(lat2) · cos(lon1 - lon2)) · R
            PHP: acos( sin($radLat1) * sin($lat2) + cos($radLat1) * cos($lat2) * cos($radLon1 - $lon2) );
        */

        $apartments=Apartment::all();
        
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
            
            $dist = acos( $sinRadLat1 * sin((M_PI / 180) * $apartment['latitude']) + $cosRadLat1 * cos((M_PI / 180) * $apartment['latitude']) * cos($radLon1 - (M_PI / 180) * $apartment['longitude']) ) * $earthRadius;

            if ($dist <= $radius) {

                $cover_img = DB::table('images')->where(
                    [
                        ['apartment_id', '=' , $apartment['id']] ,
                        ['is_cover' ,    '=' , '1']
                    ]
                    )->first()->img_path;

                $newChalet = array(
                    'name' => $apartment['title'] ,
                    'lat'  => (M_PI / 180) * $apartment['latitude'] ,
                    'lon'  => (M_PI / 180) * $apartment['longitude'] ,
                    'dist' => $dist ,                        
                    'cover_img' => $cover_img
                );

                array_push($chalets , $newChalet);

            }
        }

        
        return response()->json([
            'success'=> true,
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
