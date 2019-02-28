<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('floor',20)->nullable();
            $table->string('title',191)->nullable();
            $table->integer('rows')->nullable()->default(4);
            $table->integer('machinePerRow')->nullable()->default(4);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('floors');
    }
}
