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
        //
        Schema::table('company_customers', function (Blueprint $table) {
            $table->dropForeign(['purchaser_company_id']);
            $table->dropColumn(['purchaser_company_id']);
        });

        Schema::table('company_customers', function (Blueprint $table) {
            $table->unsignedBigInteger('purchaser_id')->nullable()->after('company_salesperson_id');
            $table->foreign('purchaser_id')->references('id')->on('users');
        });

        Schema::table('company_customers', function (Blueprint $table) {
            $table->unsignedBigInteger('purchaser_company_id')->nullable()->after('company_salesperson_id');
            $table->foreign('purchaser_company_id')->references('id')->on('companies');
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
        Schema::table('company_customers', function (Blueprint $table) {
            $table->dropForeign(['purchaser_company_id', 'purchaser_id']);
            $table->dropColumn(['purchaser_company_id', 'purchaser_id']);
        });

    }
}
