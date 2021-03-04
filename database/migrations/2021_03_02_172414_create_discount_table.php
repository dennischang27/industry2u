<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('master_tier1')->nullable();
            $table->integer('master_tier2')->nullable();
            $table->integer('master_tier3')->nullable();
            $table->integer('manager_tier1')->nullable();
            $table->integer('manager_tier2')->nullable();
            $table->integer('manager_tier3')->nullable();
            $table->integer('sales_tier1')->nullable();
            $table->integer('sales_tier2')->nullable();
            $table->integer('sales_tier3')->nullable();
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('discount');
    }
}
