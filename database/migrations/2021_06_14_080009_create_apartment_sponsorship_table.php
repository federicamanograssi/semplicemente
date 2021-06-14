<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsorship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_apartment');
            $table->foreign('id_apartment')->references('id')->on('apartments');
            $table->unsignedBigInteger('id_sponsorship');
            $table->foreign('id_sponsorship')->references('id')->on('sponsorships');
            $table->float('amount',5,2);
            $table->boolean('status');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_sponsorship');
    }
}
