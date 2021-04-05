<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitedCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invited_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('customer_company_name');
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('customer_email');
            $table->unsignedBigInteger('company_salesperson_id');
            $table->foreign('company_salesperson_id')->references('id')->on('users');
            $table->string('invitation_code', 100)->nullable();
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
        Schema::dropIfExists('invited_customers');
    }
}
