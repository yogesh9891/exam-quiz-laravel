<?php

namespace Database\Factories;

use App\Models\Template;
use App\Models\Category;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Template::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

         $twigs = collect(Category::where('parent_id',14)->get()->modelKeys());
         $classes = collect(SchoolClass::all()->modelKeys());

        return [
            'title' => $this->faker->sentence(),
            'subject_id' => 1,
            'category_id' => 1,
            'branch_id ' => 14,
            'twig_id  ' => $twigs->random(),
            'leaf_id   ' => null,
            'vein_id   ' => null,
            'class_id' => $classes->random(),
            'board_id' => 1,
            'q_type' => 'MCQ',
            'b_title' =>  $this->faker->sentence(),
            'b_sub_title' =>  $this->faker->sentence(),
            'publisher' =>  $this->faker->name(),
            'isbn' =>  $this->faker->numberBetween($min = 1000000000000, $max = 99999999999999),
            'publication_year' => $this->faker->year($max = 'now'),
            'chapter_source' => $this->faker->randomDigit(),
            'chapter_title' => $this->faker->sentence(),
            'creater' =>'Admin'
        ];
    }
}
