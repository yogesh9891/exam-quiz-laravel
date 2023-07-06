<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionIdToAssignedPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assigned_papers', function (Blueprint $table) {
              $table->unsignedBigInteger('question_paper_id');
            $table->foreign('question_paper_id')->references('id')->on('question_papers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assigned_papers', function (Blueprint $table) {
            //
        });
    }
}
