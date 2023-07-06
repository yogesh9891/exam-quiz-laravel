<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


  protected  $fillable = ['template_id','instruction'];
       public function sub_questions()
    {
        return $this->hasMany(SubQuestion::class);
    }
     public function template()
    {
      return $this->belongsTo(Template::class);
    }

}
