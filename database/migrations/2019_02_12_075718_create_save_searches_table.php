<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_searches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keywords')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('freelancer_id');
            $table->integer('location_id')->nullable();
            $table->integer('project_type')->nullable();
            $table->string('skill_id')->nullable();
            $table->string('budget')->nullable();
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
        Schema::dropIfExists('save_searches');
    }
}
