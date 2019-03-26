<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancerWorkHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('freelancer_work_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->nullable();
			$table->string('work_history')->nullable();
			$table->string('work_date')->nullable();
			$table->text('feedback', 65535)->nullable();
			$table->string('star')->nullable();
			$table->string('earned')->nullable();
			$table->string('hour_rate')->nullable();
			$table->string('work_hours')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('freelancer_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('freelancer_work_histories');
	}

}
