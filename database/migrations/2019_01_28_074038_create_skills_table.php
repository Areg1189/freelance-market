<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('skills')) {
            Schema::create('skills', function (Blueprint $table) {
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
		Schema::drop('skills');
	}

}
