<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Question::factory()->count(300)->create();
    }
}
