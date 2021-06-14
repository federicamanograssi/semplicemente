<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ApartmentImagesTableSeeder::class,
            ApartmentTableSeeder::class,
            ApartmentViewsTableSeeder::class,
            MessagesTableSeeder::class,
            ServiceTableSeeder::class,
            SponsorshipTableSeeder::class,
            UserTableSeeder::class,

        ]);
    }
}