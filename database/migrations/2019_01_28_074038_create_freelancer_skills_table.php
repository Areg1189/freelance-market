<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancerSkillsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('freelancer_skills')) {
            Schema::create('freelancer_skills', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('skill_id')->nullable();
                $table->integer('freelancer_id')->nullable();
                $table->integer('percent')->nullable();
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('freelancer_skills');
    }

}
