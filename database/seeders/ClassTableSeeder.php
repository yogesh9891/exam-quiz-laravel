<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\SchoolClass;
use App\Models\User;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools =  User::whereNotNull('school_id')->get();
        $classes =  SchoolClass::all();
    
    foreach ($schools as  $value) {
   			$school_id = $value->id;
    		  foreach ($classes as  $class) {
   				$c = new Classes;
              	$c->school_id = $school_id;
              	$c->class_id = $class->id;
            	  $c->save();
		}
    }
}
	
}
