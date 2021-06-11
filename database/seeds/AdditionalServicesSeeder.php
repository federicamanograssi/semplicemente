<?php

use Illuminate\Database\Seeder;
use App\Additional_service;

class AdditionalServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('additional_services');

        foreach ($services as $service) {
            $newAdditional_service = new Additional_service();
            $newAdditional_service->service_name = $service['service_name'];
            $newAdditional_service->service_info = $service['service_info'];
            $newAdditional_service->service_icon = $service['service_icon'];
            $newAdditional_service->save();
            };
    }
}
