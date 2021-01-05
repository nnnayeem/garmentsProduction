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
            $table->bigInteger('floor_id')->nullable()->unsigned()->index();
            $table->string('machine_token')->nullable()->index();
            $table->tinyInteger('status')->nullable()->index();
            $table->bigInteger('machine_category_id')->nullable()->unsigned()->index();
            $table->bigInteger('store_id')->nullable()->unsigned()->index();
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
