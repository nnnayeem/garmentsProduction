<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_platforms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('machine_category_id')->nullable()->unsigned()->index();
            $table->bigInteger('machine_id')->nullable()->unsigned()->index();
            $table->bigInteger('parts_id')->nullable()->unsigned()->index();
            $table->string('partsName')->nullable()->index();
            $table->boolean('approved')->nullable()->index()->default(0);
            $table->boolean('deliver')->nullable()->index()->default(0);
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
        Schema::drop('request_platforms');
    }
}
