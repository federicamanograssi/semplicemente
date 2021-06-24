<?php

use Illuminate\Database\Seeder;
use App\Sponsorship; 

class ApartmentSponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartment_sponsorships = config('apartment_sponsorship');

        foreach ($apartment_sponsorships as $apartment_sponsorship) {
            $apartment_sponsorship = new Sponsorship();
            $apartment_sponsorship->name = $sponsorship['name'];
            $apartment_sponsorship->hours = $sponsorship['hours'];
            $apartment_sponsorship->amount = $sponsorship['amount'];
            $apartment_sponsorship->save();
            };
    }
}
