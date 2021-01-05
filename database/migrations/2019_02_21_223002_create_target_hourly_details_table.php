<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetHourlyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_hourly_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('target_id')->unsigned()->nullable()->index();
            $table->integer('red')->unsigned()->nullable();
            $table->integer('yellow')->unsigned()->nullable();
            $table->integer('green')->unsigned()->nullable();
            $table->string('start_time',50)->nullable()->index();
            $table->string('end_time',50)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_hourly_details');
    }
}
