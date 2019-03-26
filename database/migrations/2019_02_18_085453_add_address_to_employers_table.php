<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('postal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('state_id');
            $table->dropColumn('postal_code');
        });
    }
}
