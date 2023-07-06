<?php

namespace App\Imports;
use App\Models\SchoolStudent;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\Section;
use App\Models\ClassSection;
use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SchoolStudentImport implements ToModel,WithStartRow,WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $school_id;

    public function __construct($school_id)
    {
       $this->school_id = $school_id;
    }


    public function model(array $row)
    {

     if (!isset($row[0])) {
                return null;
            }
      $user = User::where('email',$row[6])->first();
      if(!$user){
              
         $user = User::firstOrCreate([
            'name' => $row[0],
            'email' => $row[6],
            'phone' => $row[10],
            'password' => $row[13],
        ]);

        // $user = User::find(72);
               $sclass = SchoolClass::where('name',$row[1])->first();
                if($sclass)
                {
            
                 $class = Classes::where('school_id',$this->school_id)->where('class_id',$sclass->id)->first();
                 // dd($class);
                  $csection = ClassSection::where('name',$row[2])->first();
                if($csection)
                {
                
                       $section = Section::where('section_id',$csection->id)->where('class_id',$class->id)->first();
                       if($section){

                       $data =    [
                                            'school_id'=>$this->school_id,
                                            'student_id'=>$user->id,
                                            'admission_id'=>$row[4],
                                            'roll_no'=>$row[5],
                                            'dob'=>date("Y-m-d", strtotime($row[3])),
                                            'city'=>$row[7],
                                            'class_id'=>(string)$class->id,
                                            'section_id'=>(string)$section->id,
                                            'parent_name'=>$row[8],
                                            'parent_email'=>$row[11].','.$row[12],
                                            'parent_relation'=>'Father',
                                            ];
                        // dd($csection);
                       // dd($data);
                            $user->assignRole('student');
                            SchoolStudent::insert($data);
                       }
                 }
            }
      }
    }

    public function uniqueBy()
    {
        return $row[6];
    }

 public function startRow(): int
    {
        return 2;
    }

public function rules(): array
{
      $rules = [
            '0'=>'required|string|max:255',
            '10'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            '8'=>'required|string|max:255',
            '13'=>'required',
            // 'parent_relation'=>'required|string|max:255',
            '11'=>'required|string|max:255',
            '12'=>'required|string|max:255',
            
            // 'class_id'=>'required|numeric',
            // 'section_id'=>'required|numeric',
            '4'=>'required|alpha_num',
            '5'=>'required|alpha_num',

        ];

        return $rules;
}

/**
 * @return array
 */
public function messages()
{
    return [
        '0.in' => 'Name must be string and not mull ',
        '10.in' => 'Phone invalid.',
        '8.in' => 'city must be string and not mull',
        '13.in' => 'Password. required',
        '11.in' => 'Email must be string and not mull.',
        '12.in' => 'Email must be string and not mull',
        '4.in' => ':admission_id. must be alpha_num and not mull.',
        '5.in' => 'Roll No must be alpha_num and not mull.',
    ];
}

}
