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
<<<<<<< Updated upstream
        $this->call(ServicesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SponsorshipsSeeder::class);
=======
        
        $this->call([
            // UserSeeder::class,
            SponsorshipSeeder::class,
            ServiceSeeder::class,
            // ApartmentSeeder::class,
        ]);
>>>>>>> Stashed changes
    }
}
