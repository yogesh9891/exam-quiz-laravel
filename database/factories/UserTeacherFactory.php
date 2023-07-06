<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\SchoolTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTeacherFactory extends Factory
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
         $school = User::whereNotNull('school_id')->get()->modelKeys();
                  factory(App\User::class, 50)->create()->each(function($u) {
            $u->teacher()->save(['school_id',$school->random()]);
        });
    }
}
