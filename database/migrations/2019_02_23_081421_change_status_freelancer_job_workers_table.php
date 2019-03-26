<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusFreelancerJobWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('freelancer_job_workers')) {
            Schema::table('freelancer_job_workers', function (Blueprint $table) {
                $table->enum('status', ['on_development','on_waiting', 'completed', 'canceled'])->change();
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
        Schema::table('freelancer_job_workers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
