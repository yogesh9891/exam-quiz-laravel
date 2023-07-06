<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentPaper extends Model
{
    use HasFactory,SoftDeletes;

        protected $fillable = ['assigned_paper_id','student_assigned_id','student_id','question_paper_id'];

    public function student_answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function student_new_answers()
    {
        return $this->hasMany(StudentNewAnswer::class);
    }

    public function student_assigned_paper()
    {
      return $this->belongsTo(StudentAssigned::class,'student_assigned_id','id');
    }

     public function student()
    {
      return $this->belongsTo(SchoolStudent::class,'student_id','student_id');
    }

      public function teacher()
    {
      return $this->belongsTo(SchoolTeacher::class,'teacher_id','teacher_id');
    }


     public function question_paper()
    {
      return $this->belongsTo(QuestionPaper::class,'question_paper_id','id');
    }
}
