<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;
use App\Models\Category;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $twigs = collect(Category::where('parent_id',2)->get()->modelKeys());
         $classes = collect(SchoolClass::all()->modelKeys());


         $faker = \Faker\Factory::create();
         for ($i = 0; $i < 50; $i++) {

       Template::create([
            'title' => $faker->sentence(),
            'subject_id' => 2,
            'category_id' => 1,
            'branch_id' => 2,
            'twig_id' => $twigs->random(),
            'leaf_id' => null,
            'vein_id' => null,
            'class_id' => $classes->random(),
            'board_id' => 2,
            'q_type' => 'MCQ',
            'b_title' =>  $faker->sentence(),
            'b_sub_title' =>  $faker->sentence(),
            'publisher' =>  $faker->name(),
            'isbn' =>  $faker->numberBetween($min = 1000000000000, $max = 99999999999999),
            'publication_year' => $faker->year($max = 'now'),
            'chapter_source' => $faker->randomDigit(),
            'chapter_title' => $faker->sentence(),
            'creater' =>'Admin',
        ]);
    }
        // Template::factory()->count(50)->create();
    }
}
