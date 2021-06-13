<?php

use Illuminate\Database\Seeder;
use App\ApartmentView;

class ApartmentViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartmentViews=config('apartment_views');

        foreach ($apartmentViews as $apartmentView) {
            $newApartmentView = new ApartmentView();
            $newApartmentView->id_apartment = $apartmentView['id_apartment'];
            $newApartmentView->save();
        }
    }
}
