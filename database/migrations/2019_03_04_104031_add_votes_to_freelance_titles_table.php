<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToFreelanceTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('freelance_titles')) {
            Schema::table('freelance_titles', function (Blueprint $table) {
                $table->integer('active')->default(0);
                $table->string('image');
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
        Schema::table('freelance_titles', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('image');
        });
    }
}
