<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SchoolStudent extends Model
{
     use HasFactory,SoftDeletes;
    protected $fillable = ['school_id','admission_id','roll_no','class_id ','section_id ','parent_name','parent_email','dob','city'];

     public function user()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

          public function class()
    {
        return $this->belongsTo(Classes::class,'class_id','id');
    }

          public function section()
    {
        return $this->belongsTo(Section::class)->with('section_student');
    }

    public function setDobAttribute( $value ) {
      $this->attributes['dob'] = (new Carbon($value))->format('Y-m-d');
    }

    
}
