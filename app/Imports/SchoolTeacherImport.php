<?php

namespace App\Imports;

use App\Models\SchoolStudent;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\Section;
use App\Models\ClassSection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SchoolTeacherImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     public function __construct($school_id)
    {
       $this->school_id = $school_id;
    }


    public function model(array $row)
    {
        
         $user = User::firstOrCreate([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[3],
            'password' => $row[2],
        ]);
        // $user = User::find(114);
        $user->assignRole('teacher');
        $user->teacher()->create(['school_id'=>$this->school_id]);
        if(!empty($row[5])){

        $class_name = $row[5];
        $section_array =explode(',', $row[6]);
          $sclass = SchoolClass::where('name',$class_name)->first();
            if($sclass)
            {
                 $class = Classes::where('school_id',$this->school_id)->where('class_id',$sclass->id)->first();
                 foreach ($section_array as $key => $value) {
                        $csection = ClassSection::where('name',$value)->first();
                            if($csection)
                            {
                                $section = Section::where('section_id',$csection->id)->where('class_id',$class->id)->update(['teacher_id'=>$user->id]);;
                              
                                
                            }
                 }
            }
        }
    }  

       public function uniqueBy()
    {
        return 'email';
    }

 public function startRow(): int
    {
        return 2;
    } 
}
