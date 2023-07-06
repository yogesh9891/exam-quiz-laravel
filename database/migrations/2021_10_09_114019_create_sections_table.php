<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
    	
           	$table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('school_classes');
         	$table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('class_sections');
        	$table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('teacher_id')->on('school_teachers');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
