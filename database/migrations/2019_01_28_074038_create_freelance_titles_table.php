<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelanceTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('freelance_titles')) {
            Schema::create('freelance_titles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->timestamps();
                $table->string('slug')->nullable()->unique();
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
		Schema::drop('freelance_titles');
	}

}
