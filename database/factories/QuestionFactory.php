<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $templates = collect(Template::all()->modelKeys());
        return [
          'template_id'=>$templates->random(),
          'instruction'=> $this->faker->sentence(),
        ];
    }
}
