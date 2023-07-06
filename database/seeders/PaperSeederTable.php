<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paper;

class PaperSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Paper::factory()->count(50)->create();
    }
}
