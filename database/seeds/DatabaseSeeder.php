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
            ApartmentTableSeeder::class,
            ImagesTableSeeder::class,
            MessagesTableSeeder::class,
            ServiceTableSeeder::class,
            SponsorshipTableSeeder::class,
            UserTableSeeder::class,
            ViewsTableSeeder::class,

        ]);
    }
}