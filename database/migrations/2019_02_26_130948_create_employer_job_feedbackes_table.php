<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployerJobFeedbackesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employer_job_feedbackes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employer_id')->nullable();
			$table->integer('job_id')->nullable();
			$table->integer('freelancer_id')->nullable();
			$table->text('feedback', 65535)->nullable();
			$table->smallInteger('publish')->nullable()->default(1);
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
		Schema::drop('employer_job_feedbackes');
	}

}
