<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCancelFromAddStatusAuthorTextFreelancerJobWorkerHistoriesTable extends Migration
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
                $table->dropColumn('cancel_from');
                $table->string('status');
                $table->string('author');
                $table->text('text');
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
        Schema::table('freelancer_job_worker_histories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('author');
            $table->dropColumn('text');
        });
    }
}
