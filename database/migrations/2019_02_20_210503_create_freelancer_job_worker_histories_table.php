<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancerJobWorkerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('freelancer_job_worker_histories')) {
            Schema::create('freelancer_job_worker_histories', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('freelancer_job_worker_id');
                $table->text('data');
                $table->enum('cancel_from', [0,'employer', 'freelancer']);
                $table->foreign('freelancer_job_worker_id')->references('id')->on('freelancer_job_workers');
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
        Schema::dropIfExists('freelancer_job_worker_histories');
    }
}
