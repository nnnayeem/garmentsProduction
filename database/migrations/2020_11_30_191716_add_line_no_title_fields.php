<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLineNoTitleFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_controllers', function (Blueprint $table) {
            $table->integer('line_no')->default(0)->nullable();
            $table->string('line_title', 10)->default('N/A')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_controllers', function (Blueprint $table) {
            //
        });
    }
}
