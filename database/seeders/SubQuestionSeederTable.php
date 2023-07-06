<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\SubQuestion;
use Illuminate\Database\Seeder;

class SubQuestionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();
        $answer = ['option_1','option_2','option_3','option_4'];
          $faker = \Faker\Factory::create();

        foreach ($questions as $question ) {
                                SubQuestion::insert(
                                    [
                                        'template_id'=>$question->template_id,
                                        'question_id '=>$question->id,
                                        'type '=>'MCQ',
                                        'question' => $faker->sentence(),
                                        'option_1' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_2' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_3' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_4' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'answer'=>$answer[array_rand($answer)],
                                        'explaination'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                                  ],
                                     [
                                        'template_id'=>$question->template_id,
                                        'question_id '=>$question->id,
                                        'type '=>'MCQ',
                                        'question' => $faker->sentence(),
                                        'option_1' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_2' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_3' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_4' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'answer'=>$answer[array_rand($answer)],
                                        'explaination'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                                  ],
                                     [
                                        'template_id'=>$question->template_id,
                                        'question_id '=>$question->id,
                                        'type '=>'MCQ',
                                        'question' => $faker->sentence(),
                                        'option_1' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_2' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_3' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_4' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'answer'=>$answer[array_rand($answer)],
                                        'explaination'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                                  ],
                                     [
                                        'template_id'=>$question->template_id,
                                        'question_id'=>$question->id,
                                        'type '=>'MCQ',
                                        'question' => $faker->sentence(),
                                        'option_1' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_2' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_3' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_4' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'answer'=>$answer[array_rand($answer)],
                                        'explaination'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                                  ],
                                     [
                                        'template_id'=>$question->template_id,
                                        'question_id '=>$question->id,
                                        'type '=>'MCQ',
                                        'question' => $faker->sentence(),
                                        'option_1' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_2' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_3' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'option_4' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                        'answer'=>$answer[array_rand($answer)],
                                        'explaination'=>$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                                  ],



                              );
                        }
}

}
