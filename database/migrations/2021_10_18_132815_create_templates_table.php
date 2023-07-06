<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('number')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
             $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
             $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('categories');
             $table->unsignedBigInteger('twig_id');
            $table->foreign('twig_id')->references('id')->on('categories');
             $table->unsignedBigInteger('leaf_id');
            $table->foreign('leaf_id')->references('id')->on('categories');
             $table->unsignedBigInteger('vein_id');
            $table->foreign('vein_id')->references('id')->on('categories');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('school_classes');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions'); 
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')->references('id')->on('boards');
             $table->unsignedBigInteger('state_board_id')->nullable();
            $table->foreign('state_board_id')->references('id')->on('boards');
            $table->string('q_type');
            $table->string('b_title');
            $table->string('b_sub_title');
            $table->string('publisher');
            $table->string('isbn');
            $table->string('publication_year');
            $table->string('chapter_source');
            $table->string('chapter_title');
            $table->boolean('status')->default(0);
            $table->string('creater');
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
        Schema::dropIfExists('templates');
    }
}
