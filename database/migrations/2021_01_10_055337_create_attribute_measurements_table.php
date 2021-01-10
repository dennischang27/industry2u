<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_measurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->integer('min')->default(0);
            $table->integer('max')->default(0);
            $table->integer('position')->default(0);
            $table->integer('is_active')->default(1);
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attributes');
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
        Schema::dropIfExists('attribute_measurements');
    }
}
