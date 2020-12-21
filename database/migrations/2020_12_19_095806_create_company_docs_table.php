<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_path', 150);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('doc_type_id')->nullable();
            $table->foreign('doc_type_id')->references('id')->on('doc_types');
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
        Schema::dropIfExists('company_docs');
    }
}
