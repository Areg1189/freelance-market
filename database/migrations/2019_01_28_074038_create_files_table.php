<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('files')) {
            Schema::create('files', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('message_id')->unsigned()->nullable()->index('files_message_id_foreign');
                $table->integer('conversation_id')->unsigned()->nullable();
                $table->string('origin_name', 191);
                $table->string('name', 191);
                $table->string('mime_type', 191);
                $table->integer('size');
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
		Schema::drop('files');
	}

}
