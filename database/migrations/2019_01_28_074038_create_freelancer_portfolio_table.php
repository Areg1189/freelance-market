<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancerPortfolioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('freelancer_portfolio')) {
            Schema::create('freelancer_portfolio', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('freelancer_id')->nullable();
                $table->integer('portfolio_id')->nullable();
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
		Schema::drop('freelancer_portfolio');
	}

}
