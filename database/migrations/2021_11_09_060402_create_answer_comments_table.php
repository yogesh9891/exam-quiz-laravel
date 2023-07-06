<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_assigned_id');
            $table->foreign('student_assigned_id')->references('id')->on('student_assigneds');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
             $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
             $table->unsignedBigInteger('student_answer_id');
            $table->foreign('student_answer_id')->references('id')->on('student_answers');   
            $table->unsignedBigInteger('sub_question_id');
            $table->foreign('sub_question_id')->references('id')->on('sub_questions');
            $table->longText('comment')->nullable();
            $table->boolean('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('answer_comments');
    }
}
