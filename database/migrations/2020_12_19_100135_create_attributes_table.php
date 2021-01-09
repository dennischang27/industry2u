<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->string('type', 150)->nullable();
            $table->integer('position')->default(0);
            $table->boolean('is_range')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_configurable')->default(0);
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('attribute_group_id')->nullable();
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups');
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
        Schema::dropIfExists('attributes');
    }
}
