<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('street', 150);
            $table->string('postal_code', 150);
            $table->string('city', 150);
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('country_states');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('company_budget_range_id')->references('id')->on('company_budget_ranges');
            $table->unsignedBigInteger('company_budget_range_id')->nullable();
            $table->string('reg_no', 150)->nullable();
            $table->string('web_site', 150)->nullable();
            $table->string('phone', 150);
            $table->boolean('is_sst')->default(0);
            $table->string('sst_no', 150)->nullable();
            $table->string('logo', 150);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('bank_account', 150);
            $table->boolean('is_seller')->default(1);
            $table->boolean('is_buyer')->default(1);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
