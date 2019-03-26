<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobSkillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('job_skill')) {
            Schema::create('job_skill', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('job_id')->nullable();
                $table->integer('skill_id')->nullable();
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
		Schema::drop('job_skill');
	}

}
