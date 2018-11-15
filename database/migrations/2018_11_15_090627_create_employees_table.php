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
            $table->string('id',12)->primary();
            $table->string('name');
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('phone',11);
            $table->string('designation');
            $table->date('dob')->nullable();
            $table->string('blood_group',3)->nullable();
            $table->binary('photo')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
