<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwithcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switches', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('floor_id');
            $table->integer('switch')->index();
            $table->boolean('status')->index()->nullable()->default(1);
            $table->boolean('checked')->index()->nullable()->default(1);
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
        Schema::drop('switches');
    }
}
