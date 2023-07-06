<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolTeacher;

class UserTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolTeacher::factory()->count(50)->make();
    }
}
