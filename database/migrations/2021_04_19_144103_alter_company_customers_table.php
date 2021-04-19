<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_customers', function (Blueprint $table) {
            $table->string('payment_term_code', 150)->nullable()->after('purchaser_id');
            $table->integer('payment_term_days')->nullable()->after('payment_term_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_customers', function (Blueprint $table) {
            $table->dropColumn('payment_term_code');
            $table->dropColumn('payment_term_days');
        });
    }
}
