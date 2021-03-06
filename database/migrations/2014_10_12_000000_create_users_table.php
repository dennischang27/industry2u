<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile', 150)->nullable();
            $table->string('referral_code', 100)->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_company_admin')->default(0);
            $table->boolean('manage_company_admin')->default(0);
            $table->boolean('is_super_user')->default(0);
            $table->boolean('manage_supers')->default(0);
            $table->boolean('is_buyer')->default(0);
            $table->boolean('is_seller')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
