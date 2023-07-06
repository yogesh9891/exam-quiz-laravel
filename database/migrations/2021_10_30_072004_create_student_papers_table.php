<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_papers', function (Blueprint $table) {
            $table->id();
               $table->unsignedBigInteger('student_assigned_id');
            $table->foreign('student_assigned_id')->references('id')->on('student_assigneds');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->unsignedBigInteger('question_paper_id');
            $table->foreign('question_paper_id')->references('id')->on('question_papers');
            $table->boolean('is_sent')->default(0);
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
        Schema::dropIfExists('student_papers');
    }
}
