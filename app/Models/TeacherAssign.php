<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssign extends Model
{
    use HasFactory;

    public function school()
    {
    	return $this->belongsTo(User::class,'school_id');
    }
    public function teacher()
    {
    	return  $this->belongsTo(User::class,'teacher_id');
    }
    public function class()
    {
    	return  $this->belongsTo(Classes::class,'class_id');
    }
}
