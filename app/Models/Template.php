<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Template extends Model
{
    use HasFactory,SoftDeletes;

        protected $fillable = ['title' ,   'number'  ,'subject_id' , 'category_id' ,'branch_id' ,  'twig_id','leaf_id','vein_id','class_id' ,   'board_id' , 'state_board_id' ,'q_type' ,'b_title', 'b_sub_title', 'publisher'  , 'isbn' ,   'publication_year'   , 'chapter_source' , 'chapter_title','creater'];  



     public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

      public function branch()
    {
        return $this->belongsTo(Category::class,'branch_id');
    }

      public function twig()
    {
        return $this->belongsTo(Category::class,'twig_id');
    }

      public function leaf()
    {
        return $this->belongsTo(Category::class,'leaf_id');
    }

       public function vein()
    {
        return $this->belongsTo(Category::class,'vein_id');
    }

       public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

       public function board()
    {
        return $this->belongsTo(Board::class);
    }


    public function getCreatedAtAttribute($value)
    {
       return Carbon::parse($value)->format('j F, Y');
    }
   
}
