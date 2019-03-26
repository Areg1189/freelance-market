<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('freelancers')) {
            Schema::create('freelancers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('full_name')->nullable();
                $table->integer('country')->nullable();
                $table->integer('city')->nullable();
                $table->string('title')->nullable();
                $table->text('overview')->nullable();
                $table->string('hourly_rate')->nullable();
                $table->string('total_earned')->nullable();
                $table->integer('jobs')->nullable();
                $table->string('hours_worked')->nullable();
                $table->text('employments', 65535)->nullable();
                $table->text('educations', 65535)->nullable();
                $table->string('availability')->nullable();
                $table->text('languages', 65535)->nullable();
                $table->timestamps();
                $table->string('email')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('avatar')->nullable();
                $table->integer('freelancer_id')->nullable();
                $table->text('work_history')->nullable();
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
		Schema::drop('freelancers');
	}

}
