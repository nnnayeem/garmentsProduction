<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneralStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->nullable()->index();
            $table->integer('accessoriese_id')->unsigned()->nullable()->index();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->integer('qty')->unsigned()->nullable();
            $table->timestamp('delivered')->nullable();
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
        Schema::drop('general_stores');
    }
}
