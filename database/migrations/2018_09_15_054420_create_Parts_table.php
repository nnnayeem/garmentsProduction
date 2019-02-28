<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Parts', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('machine_category_id')->index()->nullable()->default(0);
            $table->string('parts')->index()->nullable()->default(0);
            $table->integer('qty')->nullable();
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
        Schema::drop('Parts');
    }
}
