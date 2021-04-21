<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSupplierInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('supplier_invitations', function (Blueprint $table) {
            $table->dropForeign('supplier_invitations_supplier_id_foreign');
            $table->dropColumn('supplier_id');
            $table->dropForeign('supplier_invitations_purchaser_id_foreign');
            $table->dropColumn('purchaser_id');
        });

        Schema::table('supplier_invitations', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->after('id');
            $table->foreign('supplier_id')->references('id')->on('users');
            $table->unsignedBigInteger('purchaser_id')->after('company_id');
            $table->foreign('purchaser_id')->references('id')->on('users');
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
        Schema::table('supplier_invitations', function (Blueprint $table) {
            $table->integer('supplier_id')->nullable();
            $table->integer('purchaser_id')->nullable();
        });
    }
}
