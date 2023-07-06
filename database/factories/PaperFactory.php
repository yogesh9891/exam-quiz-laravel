<?php

namespace Database\Factories;

use App\Models\Paper;
use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paper::class;

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
          'name'=> $this->faker->sentence($nbWords = 1, $variableNbWords = true),
          'defination_heading'=> $this->faker->sentence(),
          'defination_decription'=> $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'word_heading'=> $this->faker->sentence(),
          'word_decription'=> $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'example_heading'=> $this->faker->sentence(),
          'example_decription'=> $this->faker->sentence($nbWords = 3, $variableNbWords = true),
        ];
    }
}
