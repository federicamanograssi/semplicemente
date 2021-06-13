<?php

use Illuminate\Database\Seeder;
use App\ApartmentImage;

class ApartmentImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartmentImages= [];

        foreach ($apartmentImages as $apartmentImage ) {
            $newApartmentImage = new ApartmentImage();

            $newApartmentImage->id_apartment = $apartmentImage['id_apartment'];
            $newApartmentImage->img_path = $apartmentImage['img_path'];
            $newApartmentImage->img_description = $apartmentImage['img_description'];
            $newApartmentImage->is_cover = $apartmentImage['is_cover'];
            $newApartmentImage->save();
        }
    }
}
