<?php

use Illuminate\Database\Seeder;
use App\View;


class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Views=config('apartment_views');

        foreach ($Views as $View) {
            $newView = new View();
            $newView->id_apartment = $View['id_apartment'];
            $newView->save();
        }
    }
}
