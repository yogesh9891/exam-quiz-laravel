<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionPaper extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['template_id','question_id','paper_id','number','position','creater'];

        public function paper()
    {
        return $this->belongsTo(Paper::class);
    }
     public function template()
    {
      return $this->belongsTo(Template::class,'template_id','id');
    }

      public function question()
    {
      return $this->belongsTo(Question::class)->with('sub_questions');
    }

      public function question_paper()
    {
      return $this->hasMany(QuestionPaper::class,'number','number');
    }

       public function teacher_comment()
    {
      return $this->belongsTo(QuestionComment::class,'question_paper_id','id');
    }

    
}
