<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\ClassSection;
use App\Models\Section;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              $classes =  Classes::all();
              $sections =  ClassSection::all();
        
    
    foreach ($classes as  $class) {
   			$class_id = $class->id;
    		  foreach ($sections as  $section) {
   				$c = new Section;
              	$c->class_id = $class_id;
              	$c->section_id = $section->id;
            	  $c->save();
		}
    }
    }
}
