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
            $table->bigIncrements('id')->index();
            $table->bigInteger('machine_category_id')->index()->nullable()->unsigned()->default(0);
            $table->string('parts')->index()->nullable()->default(0);
            $table->integer('qty')->unsigned()->nullable();
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
