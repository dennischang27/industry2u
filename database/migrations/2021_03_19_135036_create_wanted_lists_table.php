<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantedListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wanted_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('product_name', 150);
            $table->bigInteger('supplier_company_id')->unsigned();
            $table->foreign('supplier_company_id')->references('id')->on('companies');
            $table->string('supplier_company_name', 150);
            $table->string('product_slug', 150);
            $table->string('product_filepath', 150)->nullable();
            $table->integer('quantity');
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('purchaser_company_id')->unsigned();
            $table->foreign('purchaser_company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status', 150)->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('wanted_lists');
    }
}
