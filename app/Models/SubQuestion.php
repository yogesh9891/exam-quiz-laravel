<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubQuestion extends Model
{
    use HasFactory,SoftDeletes;
  protected  $fillable = ['template_id','paper_id','question_id','type','question','option_1','option_2','option_3','option_4','answer','explaination'];

  
    public function instruction()
    {
      return $this->belongsTo(Question::class,'question_id');
    }
     public function question()
    {
      return $this->belongsTo(Question::class,'question_id');
    }


       public function student_answer()
    {
      return $this->hasOne(StudentAnswer::class,'sub_question_id');
    }
}
