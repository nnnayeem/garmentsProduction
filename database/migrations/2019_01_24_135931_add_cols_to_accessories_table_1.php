<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToAccessoriesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessorieses', function (Blueprint $table) {
            $table->integer('stored')->default(0)->nullable()->unsigned();
            $table->integer('delivered')->default(0)->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessorieses', function (Blueprint $table) {
            //
        });
    }
}
