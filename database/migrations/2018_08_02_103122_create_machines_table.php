<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('switch')->nullable()->index();
            $table->integer('floor_id')->nullable()->index();
            $table->string('machine_token')->nullable()->index();
            $table->tinyInteger('status')->nullable()->index();
            $table->integer('machine_category_id')->nullable()->index();
            $table->integer('store_id')->nullable()->index();
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
        Schema::drop('machines');
    }
}
