<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolTeacher extends Model
{
    use HasFactory;

    protected $fillable = ['school_id','teacher_id'];
    public $timestamps = false;


    public function school()
    {
        return $this->belongsTo(User::class,'school_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'teacher_id','id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class,'teacher_id','teacher_id');
    }

    public function getSectionAssignedAttribute()
    {

        $class = '';
        $section_array = [];
        foreach ($this->sections as $section) {
          
         if($class != $section->class->class->name){

             $class.= $section->class->class->name;
         }
        
                array_push($section_array,$section->section->name);
        }
        $section_string = implode(',',$section_array);

        return $class.'-'.$section_string;
    }
}

