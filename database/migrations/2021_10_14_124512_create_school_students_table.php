<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_students', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('school_id');
             $table->foreign('school_id')->references('id')->on('users');
             $table->unsignedBigInteger('student_id');
             $table->foreign('student_id')->references('id')->on('users');
             $table->string('admission_id');
             $table->string('roll_no');
             $table->unsignedBigInteger('class_id');
             $table->foreign('class_id')->references('id')->on('classes');
             $table->unsignedBigInteger('section_id');
             $table->foreign('section_id')->references('id')->on('sections');
             $table->string('parent_name');
             $table->string('parent_realtion');
             $table->string('parent_email');
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
        Schema::dropIfExists('school_students');
    }
}
