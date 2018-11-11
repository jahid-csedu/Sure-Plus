<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->string('student_id',12);
            $table->integer('type')->unsigned();
            $table->integer('amount')->unsigned();
            $table->timestamps();

            $table->primary(['student_id','type']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('type')->references('id')->on('fees_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
