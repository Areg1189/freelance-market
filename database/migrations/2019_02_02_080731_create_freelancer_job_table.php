<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancerJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('freelancer_job')) {
            Schema::create('freelancer_job', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('job_id');
                $table->integer('freelancer_id');
                $table->integer('count_day')->nullable();
                $table->integer('employer_budget')->nullable();
                $table->integer('offer_budget')->nullable();
                $table->integer('last_budget')->nullable();
                $table->text('message')->nullable();
                $table->date('expired_date')->nullable();
                $table->integer('expired')->default(0);
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
        Schema::dropIfExists('freelancer_job');
    }
}
