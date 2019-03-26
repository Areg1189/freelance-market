<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDataTextFreelancerJobWorkerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('freelancer_job_worker_histories')) {
            Schema::table('freelancer_job_worker_histories', function (Blueprint $table) {
                $table->text('text')->nullable()->change();
                $table->text('data')->nullable()->change();
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
