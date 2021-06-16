<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyViewsApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('views', function (Blueprint $table)

            {
            $table->foreign('apartment_id')->references('id')->on('apartments');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('views', function (Blueprint $table){
            $table->dropForeign('views_apartment_id_foreign');

            // dà errore nel reset perchè questa migration viene dopo la cancellazione della tabella, quindi non la trova
            // $table->dropColumn('apartment_id');
        }); 
    }
}