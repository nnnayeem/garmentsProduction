<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('switch_id')->unsigned()->default(0);
            $table->string('name',100);
            $table->string('companyID',30)->nullable()->default('');
            $table->string('phone',11)->nullable()->default('');
            $table->decimal('skill_minute',4)->nullable()->default(0);
            $table->decimal('skill_hour',4)->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
