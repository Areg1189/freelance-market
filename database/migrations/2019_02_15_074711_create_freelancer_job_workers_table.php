<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancerJobWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('freelancer_job_workers')) {
            Schema::create('freelancer_job_workers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('job_id');
                $table->integer('freelancer_id');
                $table->integer('budget')->nullable();
                $table->unique(['job_id', 'freelancer_id']);
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
        Schema::dropIfExists('freelancer_job_workers');
    }
}
