<?php

namespace Database\Factories;

use App\Models\SchoolTeacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolTeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolTeacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
          $u =  User::whereNotNull('school_id')->get();
          $school = $u->pluck('id')->toArray();
          $user = User::factory()->create();
          $random_keys=array_rand($school);
              $company = new SchoolTeacher(['school_id'=>$school[$random_keys],'teacher_id'=>$user->id]);
              $company->save();
              
          
    }
}
