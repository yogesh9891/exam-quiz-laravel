<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SchoolStudentw extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['school_id','admission_id','roll_no','class_id ','section_id ','parent_name','parent_email'];

     public function user()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

          public function class()
    {
        return $this->belongsTo(Classes::class);
    }

          public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
