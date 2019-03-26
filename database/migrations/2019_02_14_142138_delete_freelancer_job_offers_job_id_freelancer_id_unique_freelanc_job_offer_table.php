<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFreelancerJobOffersJobIdFreelancerIdUniqueFreelancJobOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('freelancer_job_offers')) {
            Schema::table('freelancer_job_offers', function (Blueprint $table) {
                $table->dropUnique('freelancer_job_offers_job_id_freelancer_id_unique');
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
