<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_request_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name', 150);
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->double('price', 8, 2);
            $table->integer('quantity');
            $table->string('uom', 150)->nullable();
            $table->integer('discount_tier1')->nullable();
            $table->integer('discount_tier2')->nullable();
            $table->integer('discount_tier3')->nullable();
            $table->double('total_discount', 8, 2)->nullable();
            $table->double('total_amount', 8, 2)->nullable();
            $table->bigInteger('qr_id')->unsigned();
            $table->foreign('qr_id')->references('id')->on('quotation_requests');
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
        Schema::dropIfExists('quotation_request_details');
    }
}
