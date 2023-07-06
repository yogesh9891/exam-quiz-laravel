<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

use App\Exports\Reports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Category;
use App\Models\Board;
use App\Models\Paper;
use App\Models\User;
use App\Models\SchoolTeacher;
use App\Models\Section;
use App\Models\Classes as SClass;
use App\Models\AssignedPaper;;
use App\Models\QuestionPaper;
use App\Models\SubQuestion;
use App\Models\Template;
use App\Models\QuestionComment;
use App\Models\SchoolStudent;
use App\Models\StudentAssigned;
use Auth;

class Student extends Component
{
	  public $trees,$trunks,$branches,$twiges,$classes,$sections,$students;
      public  $subject_id  ,$category_id ,$branch_id   ,$twig_id ,$class_id ,$section_id ,$start_date ,$end_date,$found_message='';
        public $filter = [
        "tree" => '',
        "trunk" => "",
        "branch" => "",
        "twig" => "",
        "class" => "",
        "student" => "",
        "section" => "",
        "start_date" => "",
        "end_date" => "",
    ];

     public $listeners = [
        "load_data" => "loadData"
    ];

     public function mount($class)
    {
     
        $this->class_array = $class;
        $this->trees = Subject::whereStatus(1)->get();
        $this->trunks = Category::where('parent_id',null)->get();
        $this->branches =Category::where('parent_id',$this->trunks[0]->id)->get();
        $this->twiges = [];
        $this->classes = SClass::whereIn('id',$class)->get();

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

	     if(!empty($this->filter["class"])){
	     	if(auth::user()->hasRole('teacher')){

	     		 $this->sections = Section::where('class_id',$this->filter["class"])->where('teacher_id',Auth::id())->get();
	     	} else {
	     		 $this->sections = Section::where('class_id',$this->filter["class"])->get();
	     	}

	     }
	      if(!empty($this->filter["section"])){
	     		 $this->students = SchoolStudent::where('section_id',$this->filter["section"])->get();
	     	

	     }
  
     $this->loadData();
    // dd($this->branches);
}
   

        public function loadData(){

        // $thi->filter['tree'] = null;
          // $this->page = 485;


         $query = [];
         $filter = $this->filter;
        

         $students = SchoolStudent::with('user.assigned','user.assigned.assigned_paper.template','user.assigned.assigned_paper.question_paper')->orderBy('created_at','desc');

         // dd($this->subject_id,$this->category_id,$this->branch_id,$this->twig_id,$this->leaf_id,$this->vein_id);

           // $question_papers = AssignedPaper::with('template')->whereIn('class_id',$this->class_array)->get();
           // $question_papers = AssignedPaper::with()->whereHas(
           //      'template' , function($query) use ($filter){


                   // $template  = $query->get();
                     if(!empty($filter["class"])){
                        $students->where('class_id',$filter["class"]);
                     
                    }
                       if(!empty($filter["section"])){
                        $students->where('section_id',$filter["section"]);
                    }
                      if(!empty($filter["student"])){
                        $students->where('id',$filter["student"]);
                    }
                     if(!empty($filter["tree"])){

                        $students->whereHas(
            				  'user.assigned.assigned_paper.template' , function($query) use ($filter){
            				  	 $query->where('subject_id',$filter['tree']);
            				  });

                    
                    }
                     if(!empty($whereHas["trunk"])){
                         $students->with(
                          'user.assigned.assigned_paper.template' , function($query) use ($filter){
                             $query->where('category_id',$filter['trunk']);
                          });

                    }
                       if(!empty($filter["branch"])){
                         $students->whereHas(
                          'user.assigned.assigned_paper.template' , function($query) use ($filter){
                             $query->where('branch_id',$filter['branch']);
                          });

                    }
           //         
                     if(!empty($filter["twig"])){
                       $students->whereHas(
                          'user.assigned.assigned_paper.template' , function($query) use ($filter){
                             $query->where('branch_id',$filter['twig']);
                          });

                    }
                   
           //          // dd($query->get());
                     if(!empty($filter["start_date"])){

                           $students->whereHas(
                          'user.assigned' , function($query) use ($filter){
                            $query->where('updated_at','>=', $filter["start_date"]);
                      
                          });
                    
                        
                    } 
                      if(!empty($filter["end_date"])){
                    
                               $students->whereHas(
                          'user.assigned' , function($query) use ($filter){
                            $query->where('updated_at','<=', $filter["end_date"]);
                      
                          });
                         
                    } 
           //          //  return $query->get();
           //      }
           //  )->whereIn('class_id',$this->class_array)->get();
           

        $this->objects = $students->get();
  
        $this->readyToLoad =false;
     }

    public function render()
    {
        return view('livewire.reports.student');
    }

     public function export($student)
     {
     
           return Excel::download(new StudentExport($student), 'StudentReports.xlsx');
     	
     	 
     }
}
