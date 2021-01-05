<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('switch_id')->unsigned()->default(0)->index();
            $table->bigInteger('employee_id')->unsigned()->default(0)->index();
            $table->boolean('checked')->default(0)->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_platforms');
    }
}
