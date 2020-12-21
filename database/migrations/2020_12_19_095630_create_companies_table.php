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
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('reg_no', 150);
            $table->string('web_site', 150);
            $table->string('phone', 150);
            $table->string('sst_no', 150)->nullable();
            $table->string('logo', 150);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('bank_account', 150);
            $table->string('status', 150);
            $table->boolean('is_active')->default(1);
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
