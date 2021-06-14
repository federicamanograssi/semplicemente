<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpApartmentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_apartment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('id_apartment');
            $table->foreign('id_apartment')->references('id')->on('apartments');
            $table->unsignedBigInteger('id_service');
            $table->foreign('id_Service')->references('id')->on('services');
            $table->primary(['id_apartment','id_service']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_apartment_service');
    }
}
