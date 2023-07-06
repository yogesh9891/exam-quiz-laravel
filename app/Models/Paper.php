<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    protected $fillable = ['template_id','name','defination_heading','defination_decription','word_heading','word_decription','example_heading', 'example_decription'];

       public function template()
    {
      return $this->belongsTo(Template::class);
    }
}
