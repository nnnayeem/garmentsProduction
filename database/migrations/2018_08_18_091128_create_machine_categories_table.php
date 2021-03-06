<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMachineCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('category')->nullable()->index();
            $table->integer('subMachineCategory')->nullable()->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('machine_categories');
    }
}
