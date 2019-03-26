<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisingNoticesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertising_notices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->string('status')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('advertising_notices');
	}

}
