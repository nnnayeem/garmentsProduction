<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalSwitchMControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_controllers', function (Blueprint $table) {
            $table->tinyInteger('total_switch')->unsigned()->default(0);
            $table->tinyInteger('production_switch_start_at')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_controllers', function (Blueprint $table) {
            //
        });
    }
}
