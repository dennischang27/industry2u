<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn(['manager_tier1', 'manager_tier2', 'manager_tier3', 'sales_tier1', 'sales_tier2', 'sales_tier3'] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('discounts', function (Blueprint $table) {

            $table->integer('manager_tier1')->nullable();
            $table->integer('manager_tier2')->nullable();
            $table->integer('manager_tier3')->nullable();
            $table->integer('sales_tier1')->nullable();
            $table->integer('sales_tier2')->nullable();
            $table->integer('sales_tier3')->nullable();
        });
    }
}
