<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
	           $table->string('invitation_code', 100)->nullable()->after('remember_token');
               $table->string('status', 100)->nullable()->after('invitation_code');
               $table->bigInteger('department_id')->nullable()->unsigned()->after('status');
               $table->bigInteger('user_admin_id')->nullable()->unsigned()->after('department_id');
               $table->bigInteger('user_reporting_id')->nullable()->unsigned()->after('user_admin_id');
               $table->foreign('department_id')->nullable()->references('id')->on('departments');
               $table->foreign('user_admin_id')->nullable()->references('id')->on('users');
               $table->foreign('user_reporting_id')->nullable()->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['department_id', 'user_admin_id', 'user_reporting_id']);
                $table->dropColumn(['invitation_code', 'status', 'department_id', 'user_admin_id', 'user_reporting_id']);
        });
    }
}
