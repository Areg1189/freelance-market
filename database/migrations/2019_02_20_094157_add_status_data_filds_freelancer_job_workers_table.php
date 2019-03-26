<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDataFildsFreelancerJobWorkersTable extends Migration
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
                $table->text('data')->nullable()->after('budget');
                $table->enum('status', ['on_development','on_waiting', 'completed'])->after('budget');
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
            $table->dropColumn('data');
            $table->dropColumn('cancel_from');
        });
    }
}
