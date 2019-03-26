<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('files')) {
            Schema::table('files', function (Blueprint $table) {
                $table->foreign('message_id')->references('id')->on('messages')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('files_message_id_foreign');
        });
    }

}
