<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['school_id','name'];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class,'school_id','id');
    }
 
}
