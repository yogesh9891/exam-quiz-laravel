<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignedPaper extends Model
{
    use HasFactory,SoftDeletes;

    public function question_paper()
    {
        return $this->belongsTo(QuestionPaper::class)->with('paper','question_paper');
    }


      public function template()
    {
        return $this->belongsTo(Template::class);
    }
    public function school_group()
    {
      return $this->belongsTo(SchoolGroup::class);
    }

      public function school()
    {
      return $this->belongsTo(School::class,'school_id','school_id');
    }


     public function class()
    {
      return $this->belongsTo(Classes::class,'class_id','id');
    }

    public function section_assigned()
    {
      return $this->hasMany(StudentAssigned::class,'question_paper_id','id');
    }

      public function student_paper()
    {
      return $this->hasOne(StudentPaper::class,'student_assigned_id','id');
    }

}
