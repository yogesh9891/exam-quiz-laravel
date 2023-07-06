<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->unsignedBigInteger('question_paper_id');
            $table->foreign('question_paper_id')->references('id')->on('question_papers');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions'); 
            $table->unsignedBigInteger('sub_question_id');
            $table->foreign('sub_question_id')->references('id')->on('sub_questions'); 
            $table->unsignedBigInteger('question_paper_back_id')->nullable();
            $table->foreign('question_paper_back_id')->references('id')->on('question_paper_backs');
            $table->longText('comment');
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
        Schema::dropIfExists('question_comments');
    }
}
