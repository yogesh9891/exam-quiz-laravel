<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentAssigned extends Model
{
    use HasFactory;

    protected $fillable = ['status','late_tag','sent_tag','submit_at'];
    public function assigned_paper()
    {
        return $this->belongsTo(AssignedPaper::class,'question_paper_id');
    }
   
  
    public function student()
    {
      return $this->belongsTo(SchoolStudent::class,'student_id','student_id');
    }

      public function teacher()
    {
      return $this->belongsTo(SchoolTeacher::class,'teacher_id','teacher_id');
    }


     public function class()
    {
      return $this->belongsTo(Classes::class,'class_id','id');
    }

     public function section()
    {
      return $this->belongsTo(Section::class,'section_id','id');
    }

      public function section_assigned()
    {
      return $this->hasMany(Section::class,'section_id','id');
    }

    public function student_paper()
    {
      return $this->hasOne(StudentPaper::class,'student_assigned_id');
    }

    public function question_rechecks()
    {
     return $this->hasMany(QuestionRecheck::class,'student_assigned_id');
    }

   
}
