<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFreelancerJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('freelancer_job')) {
            Schema::table('freelancer_job', function (Blueprint $table) {
                $table->dropColumn(['employer_budget', 'offer_budget', 'last_budget', 'expired_date', 'expired']);
                $table->integer('budget')->nullable();
                $table->longText('data')->nullable();
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
        //
    }
}
