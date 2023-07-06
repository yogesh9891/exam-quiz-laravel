<?php

namespace App\Http\Livewire\Paper;

use Livewire\Component;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Category;
use App\Models\Board;
use App\Models\Paper;
use App\Models\User;
use App\Models\SchoolTeacher;
use App\Models\Section;
use App\Models\AssignedPaper;;
use App\Models\QuestionPaper;
use App\Models\SubQuestion;
use App\Models\Template;
use App\Models\QuestionComment;
use App\Models\SchoolStudent;
use App\Models\StudentAssigned;
use Auth;

class BrowsePaper extends Component
{   

     public $objects ; 

    public $readyToLoad = false;
    public $trees,$trunks,$branches,$twiges,$leaves,$veins,$classes,$teacher,$class_array;
      public  $subject_id  ,$category_id ,$branch_id   ,$twig_id ,$leaf_id ,$vein_id ,$class_id ,$tree;
    public $page = 1;

    public $items_per_page = 5;

    public $loading_message = "Loading Papers ...";
    public $found_message = "";

    public $listeners = [
        "load_papers" => "loadPaper"
    ];

      public $filter = [
        "tree" => '',
        "trunk" => "",
        "branch" => "",
        "twig" => "",
        "leaf" => "",
        "vein" => "",
        "class" => "",
        "sort" => "",
    ];
  
    public function mount($class,$teacher)
    {
        $this->teacher = $teacher;
        $this->class_array = $class;
        $this->trees = Subject::whereStatus(1)->get();
        $this->trunks = Category::where('parent_id',null)->get();
        $this->branches =Category::where('parent_id',$this->trunks[0]->id)->get();
        $this->twiges = [];
        $this->leaves = [];
        $this->veins = [];  
        $this->classes = Section::with('class','section')->whereIn('class_id',$class)->where('teacher_id',$teacher->teacher_id)->get();
        // dd($this->classes);
        // $this->loadPaper(); 
    

    }

public function updated($name,$value)
{
      
        $this->readyToLoad =true;
         if(!empty($this->filter["trunk"])){
          $this->branches =Category::where('parent_id',$this->filter["trunk"])->get();

      }
       if(!empty($this->filter["branch"])){
        $this->twiges = Category::where('parent_id',$this->filter["branch"])->get();
    }
     if(!empty($this->filter["twig"])){
        $this->leaves = Category::where('parent_id',$this->filter["twig"])->get();
    }
     if(!empty($this->filter["leaf"])){
        $this->veins = Category::where('parent_id',$this->filter["leaf"])->get();
    }
     $this->loadPaper();
    // dd($this->branches);
}


    public function loadPaper(){

        // $thi->filter['tree'] = null;
          // $this->page = 485;


         $query = [];
         $filter = $this->filter;
         // dd($this->subject_id,$this->category_id,$this->branch_id,$this->twig_id,$this->leaf_id,$this->vein_id);

           // $question_papers = AssignedPaper::with('template')->whereIn('class_id',$this->class_array)->get();
           $question_papers = AssignedPaper::with('question_paper','template','section_assigned')->whereHas(
                'template' , function($query) use ($filter){


                   // $template  = $query->get();
                     if(!empty($filter["tree"])){
                        $query->where('subject_id',$filter["tree"]);
                    }
                     if(!empty($filter["trunk"])){
                        $query->where('category_id',$filter["trunk"]);
                    
                    }
                     if(!empty($filter["branch"])){
                        $query->where('branch_id',$filter["branch"]);
                    }
                     if(!empty($filter["twig"])){
                        $query->where('twig_id',$filter["twig"]);
                    }
                     if(!empty($filter["leaf"])){
                        $query->where('leaf_id',$filter["leaf"]);
                    } 
                    if(!empty($filter["vein"])){
                        $query->where('vein_id',$filter["vein"]);
                    }
                    // dd($query->get());
                    //  return $query->get();
                }
            )->whereIn('class_id',$this->class_array)->get();
           
          $objects =$question_papers;

        if(!empty($this->filter["sort"])){
            $objects->orderBy('created_at',$this->filter["sort"]);
        }

        $this->objects = $objects;
        $this->found_message ='No Paper Found';
        $this->readyToLoad =false;
    }

    public function render()
    {
        return view('livewire.paper.browse-paper');
    }
}
