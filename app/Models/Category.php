<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected  $level = 1;

     protected $fillable = ['name','parent_id','level'];


      public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


      public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }
    public function parentCategories()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parentCategory');
    }
      public function categories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }


      public function recursiveChilds(){
           return $this->categories()->with('recursiveChilds');
        }

         public function recursiveParents(){
       
           return $this->parent()->with('recursiveParents');
        }

      public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

//         public function getLevelAttribute($level)
//         {   
  

// return $this->level;
//             switch ($level) {
//                 case '1':
//                     return 'Branch';
//                     break;
//                 case '2':
//                     return 'Twig';
//                     break;
//                 case '3':
//                     return 'Leaf';
//                     break;
//                 case '4':
//                     return 'Vein';
//                     break;
//                 case '5':
//                     return 'Vein';
//                     break;
              
//                 default:
//                    return 'Trunk';
//                     break;
//             }
//         }

              public function getLevelNameAttribute()
        {   
  
return $this->id;;

            switch ($level) {
                case '1':
                    return 'Branch';
                    break;
                case '2':
                    return 'Twig';
                    break;
                case '3':
                    return 'Leaf';
                    break;
                case '4':
                    return 'Vein';
                    break;
                case '5':
                    return 'Vein';
                    break;
              
                default:
                   return 'Trunk';
                    break;
            }
        }
    

}
