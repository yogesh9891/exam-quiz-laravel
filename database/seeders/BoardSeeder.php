<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Board;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [

            [ 'name'=>'IB'  ],
            [ 'name'=>'AP'  ],
            [ 'name'=>'iGCSE'  ],
            [ 'name'=>'ICSC'  ],
            [ 'name'=>'State' ,'is_board'=>0 ],
            [ 'name'=>'CBSE'  ],
            [ 'name'=>'AP' ,'is_state'=>1 ],
            [ 'name'=>'UP' ,'is_state'=>1 ],
            [ 'name'=>'Bihar' ,'is_state'=>1 ],


       ];

       Board::insert($data);
    }
}
