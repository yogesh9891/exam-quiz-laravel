<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

     public $timestamps = false;

     protected $fillable = ['class_id'];


        public function class()
    {
        return $this->belongsTo(SchoolClass::class,'class_id','id');
    }

        public function school()
    {
        return $this->belongsTo(User::class,'school_id','id');
    }


        public function sections()
    {
        return $this->hasMany(Section::class,'class_id')->with('section')->withCount('section_student');
    }
}
