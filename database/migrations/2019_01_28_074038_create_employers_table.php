<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('employers')) {
            Schema::create('employers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->date('birthday')->nullable();
                $table->integer('country_id')->nullable();
                $table->integer('city_id')->nullable();
                $table->string('email')->nullable();
                $table->string('avatar')->nullable();
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
		Schema::drop('employers');
	}

}
