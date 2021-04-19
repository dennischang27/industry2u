<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('product_discounts', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_company_id')->nullable()->after('subcategory_id');
            $table->foreign('customer_company_id')->references('id')->on('companies');
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
        Schema::table('product_discounts', function (Blueprint $table) {
            $table->dropForeign(['customer_company_id']);
            $table->dropColumn(['customer_company_id']);
        });
    }
}
