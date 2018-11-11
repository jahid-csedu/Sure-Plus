<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('id',12)->primary();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('personal_phone',11)->nullable();
            $table->string('father_phone',11)->nullable();
            $table->string('mother_phone',11)->nullable();
            $table->integer('class')->unsigned();
            $table->string('section')->nullable();
            $table->string('group')->nullable();
            $table->string('institute')->nullable();
            $table->date('dob')->nullable();
            $table->string('blood_group',3)->nullable();
            $table->binary('photo')->nullable();
            $table->timestamps();

            $table->foreign('class')->references('class')->on('classes');
            $table->foreign('section')->references('name')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
