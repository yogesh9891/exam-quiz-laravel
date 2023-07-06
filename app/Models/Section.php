<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = ['section_id','teacher_id'];

        public function class()
    {
        return $this->belongsTo(Classes::class,'class_id','id')->with('class');
    }


        public function section()
    {
        return $this->belongsTo(ClassSection::class,'section_id','id');
    }

        public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id','id');
    }

         public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }


          public function section_student()
    {
        return $this->hasMany(SchoolStudent::class);
    }

    public function assigned_papers()
    {
       return $this->hasMany(StudentAssigned::class,'section_id','id');
    }

    public function submit_papers()
    {
       return $this->hasMany(StudentAssigned::class,'section_id','id')->where('status','submit');
       
    }



}
