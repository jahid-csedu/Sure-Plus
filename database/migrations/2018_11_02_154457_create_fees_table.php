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
        if(!hasTable('fees')) {
            Schema::create('fees', function (Blueprint $table) {
                $table->string('student_id',12);
                $table->string('type',50);
                $table->integer('amount')->unsigned();
                $table->timestamps();

                $table->primary(['student_id','type']);
                $table->foreign('student_id')->references('id')->on('students');
                $table->foreign('type')->references('name')->on('fees_type');
            });
        }else {
            Schema::table('fees', function (Blueprint $table) {
                $table->string('student_id',12);
                $table->string('type',50);
                $table->integer('amount')->unsigned();
                $table->timestamps();

                $table->primary(['student_id','type']);
                $table->foreign('student_id')->references('id')->on('students');
                $table->foreign('type')->references('name')->on('fees_types');
            });
        }
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
