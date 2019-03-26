<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('freelance_title_id')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('budget')->nullable();
                $table->string('exp_date')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('plan_id')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->string('slug')->nullable();
                $table->integer('country')->nullable();
                $table->integer('city')->nullable();
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
		Schema::drop('jobs');
	}

}
