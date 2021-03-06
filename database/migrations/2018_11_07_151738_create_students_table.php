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
            $table->string('student_phone',11)->nullable();
            $table->string('father_phone',11)->nullable();
            $table->string('mother_phone',11)->nullable();
            $table->integer('academic_year')->unsigned();
            $table->string('class');
            $table->string('section')->nullable();
            $table->string('group')->nullable();
            $table->string('institute')->nullable();
            $table->date('dob')->nullable();
            $table->string('blood_group',3)->nullable();
            $table->integer('monthly_fee')->unsigned()->default(0);
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
        Schema::dropIfExists('students');
    }
}
