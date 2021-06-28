<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Image;
use Illuminate\Support\Facades\DB;
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
        
        $new_apartment->save();

        $j = $data['n_img'];
        $k = 1;

        for($i=1; $i<= $j; $i++) {
                if (!empty($data['image'.$i])) {
                    // salviamo l'img inserita nel form nella cartella storage/app/public/images
                    $path = 'apt' .$new_apartment->id .'_photo' .$k .'.';
                    $extension = $data['image'.$i]->extension();
                    $name = $path .$extension;
                    $data['image'.$i] = $data['image'.$i]->storeAs('apartment_images', $name, 'public');
                    
                    // creiamo una nuova istanza della classe images
                    $new_image = New Image;
                    
                    // Compiliamo i dati della colonne immagine e apartment_id
                    $new_image->img_path = $data['image'.$i];
                    $new_image->img_description = $data['img_description'.$i];
                    $new_image->apartment_id = $new_apartment->id;

                    if ($data['is_cover'] == 'image'.$i) {
                        $new_image->is_cover = 1;
                    }

                    // Salviamo l'immagine nel database
                    $new_image->save();
                    $k++;
            }
        }
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
            'services'=> Service::all(),
            'images' => Image::where('apartment_id', $apartment->id)->get()
        ];

        $info = [
            'n_img' => count($data['images'])
        ];

        return view('admin.apartments.edit', $data, $info);
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

        if(!empty($data['n_img_del'])) {

            $img_del = explode(",", $data['n_img_del']);
            for($i=0; $i<count($img_del); $i++){
                $image = Image::find($img_del[$i]);
                $image->delete();
            }
        }

        $j = $data['n_img_now'];
        $k = $data['n_img'];
        // dd($j, $k);
        $k++;
        for($i=$k; $i<= $j; $i++) {
                if (!empty($data['image'.$i])) {
                    // salviamo l'img inserita nel form nella cartella storage/app/public/images
                    $path = 'apt' .$apartment->id .'_photo' .$k .'.';
                    $extension = $data['image'.$i]->extension();
                    $name = $path .$extension;
                    $data['image'.$i] = $data['image'.$i]->storeAs('apartment_images', $name, 'public');
                    // creiamo una nuova istanza della classe images
                    $new_image = New Image;
                    // Compiliamo i dati della colonne immagine e apartment_id
                    $new_image->img_path = $data['image'.$i];
                    $new_image->img_description = $data['img_description'.$i];
                    $new_image->apartment_id = $apartment->id;
                    if ($data['is_cover'] == 'image'.$i) {
                        $new_image->is_cover = 1;
                    }
                    // Salviamo l'immagine nel database
                    $new_image->save();
                    $k++;
            }
        }

        return redirect()->route('apartments.index', $apartment);
    }

    // public function removeImages ($id) {
    //     $image = Image::find($id);
    //     $ap = Apartment::where('id', $image->apartment_id)->first();
    //     $image->delete();
    //     return redirect()->route('apartments.edit', ['apartment' => $ap->id]);
    // }
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
