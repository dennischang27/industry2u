<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_company_name', 150);
            $table->bigInteger('supplier_company_id')->unsigned();
            $table->foreign('supplier_company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('supplier_user_id')->nullable();
            $table->foreign('supplier_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('requester_id');
            $table->foreign('requester_id')->references('id')->on('users');
            $table->text('qr_no');
            $table->date('qr_valid_until');
            $table->text('quotation_no')->nullable();
            $table->double('quotation_amount', 8, 2)->nullable();
            $table->date('quotation_valid_until')->nullable();
            $table->unsignedBigInteger('purchaser_id')->nullable();
            $table->foreign('purchaser_id')->references('id')->on('users');
            $table->bigInteger('purchaser_company_id')->unsigned();
            $table->foreign('purchaser_company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('quotation_requests');
    }
}
