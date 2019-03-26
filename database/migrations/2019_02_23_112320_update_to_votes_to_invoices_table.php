<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToVotesToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable('invoices')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->dropColumn('merchant_mail');
                $table->dropColumn('payer_email');
                $table->string('webhook_id')->nullable();
                $table->string('status')->nullable();
                $table->string('cancelled_date')->nullable();
                $table->string('summary')->nullable();
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('cancelled_date');
            $table->dropColumn('webhook_id');
            $table->dropColumn('summary');
        });
    }
}
