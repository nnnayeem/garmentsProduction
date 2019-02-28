<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('target_id')->unsigned()->nullable()->index();
            $table->integer('floor_id')->unsigned()->nullable()->index();
            $table->integer('line')->nullable()->index();
            $table->string('type',20)->nullable()->index();
            $table->integer('qty')->nullable()->default(1);
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
        Schema::dropIfExists('target_details');
    }
}
