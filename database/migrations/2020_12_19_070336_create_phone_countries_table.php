<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('iso', 2);
            $table->string('name', 80);
            $table->string('nicename', 80);
            $table->char('iso3', 3  )->nullable();
            $table->smallinteger('numcode')->nullable();
            $table->integer('phonecode');
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
        Schema::dropIfExists('phone_countries');
    }
}
