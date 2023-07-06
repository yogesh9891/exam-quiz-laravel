<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentNewAnswer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['student_id','sub_question_id','answer','teacher_id'];

    public function student_paper()
    {
         return $this->belongsTo(StudentPaper::class);
    }

     public function sub_question()
    {
      return $this->belongsTo(SubQuestion::class,'sub_question_id')->with('instruction');
    }

    
    public function getAnswerOptionAttribute()
    {
        $answer ='';
        if($this->answer=='option_1'){
            $answer ='a';
        }elseif ($this->answer =='option_2') {
            $answer ='b';

        }elseif ($this->answer =='option_3') {
            $answer ='b';
            // code...
        }else{
            $answer ='d';

        }
              return $answer;
    }

      
}
