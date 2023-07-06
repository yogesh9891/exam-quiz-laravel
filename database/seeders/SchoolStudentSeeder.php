<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolStudent;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\Section;
use App\Models\ClassSection;


class SchoolStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $faker = \Faker\Factory::create();
              $sections = Section::where('class_id',132)->get();
              foreach ($sections as $key => $section) {
                    
                    for ($i=0; $i <40 ; $i++) { 
                        // code...
                        $user = User::firstOrCreate([
                            'name' => $faker->name(),
                            'email' => $faker->unique()->safeEmail(),
                            'phone' => $faker->phoneNumber(),
                            'password' => 'asdfasdf',
                        ]);
                            $user->assignRole('student');

              $data =    [
                                            'school_id'=>91,
                                            'student_id'=>$user->id,
                                            'admission_id'=>'DPSA-19-03-09'.'-'.$i,
                                            'roll_no'=>'7002'.$i,
                                            'dob'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
                                            'city'=>$faker->city(),
                                            'class_id'=>132,
                                            'section_id'=>(string)$section->id,
                                            'parent_name'=>$faker->name(),
                                            'parent_email'=>$faker->email(),
                                            'parent_relation'=>'Father',
                                            // 'phone' => $faker->phoneNumber(),
                                            ];
                       // dd($data);
                            SchoolStudent::insert($data);
                    }
    }
              }
}
