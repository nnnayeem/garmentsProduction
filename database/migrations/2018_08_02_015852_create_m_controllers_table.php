<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_controllers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->bigInteger('floor_id')->nullable()->unsigned()->index();
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
        Schema::drop('m_controllers');
    }
}
