<?php

namespace App\Http\Livewire\Paper;

use Livewire\Component;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Category;
use App\Models\Board;
use App\Models\Paper;
use Auth;

class Papers extends Component
{
    public $status = 'index';
    public $trees,$trunks,$branches,$twiges,$leaves,$veins,$classes,$boards,$states,$paper_id,$paper;

    public $title    ,$number  ,$subject_id  ,$category_id ,$branch_id   ,$twig_id ,$leaf_id ,$vein_id ,$class_id    ,$board_id    ,$state_board_id  ,$q_type  ,$b_title ,$b_sub_title ,$publisher   ,$isbn    ,$publication_year    ,$chapter_source  ,$chapter_title,$papers,$confirming =null;


  

public function mount()
{
    // code...
}


    public function render()
    {
        $this->papers = Paper::all();
        return view('livewire.paper.papers');
    }

      public function create()
    {
        $this->status = 'create';
        $this->trees = Subject::whereStatus(1)->get();
        $this->trunks = Category::where('parent_id',null)->get();
        $this->branches =Category::where('parent_id',$this->trunks[0]->id)->get();
        $this->twiges = Category::where('parent_id',$this->branches[0]->id)->get();
        $this->leaves = Category::where('parent_id',$this->twiges[0]->id)->get();
        $this->veins = Category::where('parent_id',$this->leaves[0]->id)->get();
        $this->classes = SchoolClass::whereStatus(1)->get();
        $this->boards =Board::where('is_state',0)->get();
        $this->states =Board::where('is_state',1)->get();



    }



      public function back()
    {
        $this->status = 'index';
    }

     private function resetInputFields(){
        $this->title ='';
        $this->paper_id ='';
        $this->number='';
        $this->subject_id='';
        $this->category_id='';
        $this->class_id='';
        $this->board_id='';
        $this->branch_id='';
        $this->twig_id='';
        $this->leaf_id='';
        $this->vein_id='';
        $this->state_board_id='';
        $this->q_type=''; 
        $this->b_title='';
        $this->b_sub_title='';
        $this->publisher='';
        $this->isbn='';
        $this->publication_year='';
        $this->chapter_source='';
        $this->chapter_title='';
    }

    public function store()
    {
         $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'b_title' => ['required', 'string', 'max:255'],
            'b_sub_title' => ['required', 'string', 'max:255'],
            'subject_id'=>['required'],
            'category_id'=>['required'],
            'class_id'=>['required'],
            'board_id'=>['required'],
            'q_type'=>['required'],
            'number' => ['required', 'string', 'max:255'],
            // 'chapter_title' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255'],
            'chapter_source' => ['required', 'numeric'],
            'publication_year' => ['required', 'string', 'max:255','date_format:Y'],
        ]);


        $data = Paper::updateOrCreate(['id' => !strlen($this->paper_id)? null : $this->paper_id], [
            'title' => $this->title,
            'number' => $this->number,
            'subject_id' => $this->subject_id,
            'category_id' => $this->category_id,
            'class_id' => $this->class_id,
            'branch_id' => $this->branch_id,
            'board_id' => $this->board_id,
            'twig_id' => $this->twig_id,
            'leaf_id' => $this->leaf_id,
            'vein_id' => $this->vein_id,
            'state_board_id' => $this->state_board_id,
            'q_type' => $this->q_type,
            'b_title' => $this->b_title,
            'b_sub_title' => $this->b_sub_title,
            'publisher' => $this->publisher,
            'isbn' => $this->isbn,
            'chapter_source' => $this->chapter_source,
            'chapter_title' => $this->chapter_title,
            'publication_year' => $this->publication_year,
            'creater' => 'Admin',
        ]);


  
        session()->flash('message', 
            $this->paper_id ? 'Paper Updated Successfully.' : 'Paper Created Successfully.');
  
        
        $this->resetInputFields();
         $this->status = 'index';
    }

     public function changeEvent($id,$level)
    {

       switch ($level) {
           case '4':
                 $this->twiges = null;
                 $this->leaves = null;
                 $this->veins = null;
                 $this->branches = null;
                $branches =Category::where('parent_id',$id)->get();
                if($branches->count() > 0){
                    $this->branches = $branches;
                $this->twiges =Category::where('parent_id',$this->branches[0]->id)->get();
                $this->leaves = $this->twiges->count()>0? Category::where('parent_id',$this->twiges[0]->id)->get():null;
                $this->veins = $this->leaves->count()>0? Category::where('parent_id',$this->leaves[0]->id)->get():null;
           
            

            } 
               break;
            case '3':
                   $this->twiges = null;
                 $this->leaves = null;
                 $this->veins = null;
                  $twiges =Category::where('parent_id',$id)->get();
                if($twiges->count() > 0){
                    $this->twiges = $twiges;
                $this->leaves =Category::where('parent_id',$this->twiges[0]->id)->get();
                $this->veins = $this->leaves->count()>0? Category::where('parent_id',$this->leaves[0]->id)->get():null;
           
            

            } 
               break;
             case '2':
                  $this->leaves = null;
                 $this->veins = null;
                  $leaves =Category::where('parent_id',$id)->get();
                if($leaves->count() > 0){
                    $this->leaves = $leaves;
                $this->veins =Category::where('parent_id',$this->leaves[0]->id)->get();
       
            }
              
               break;
             case '1':
             
                $this->veins = null;
                  $veins =Category::where('parent_id',$id)->get();
                if($veins->count() > 0){
                    $this->veins = $veins;
        
    
            }
               break;
         
          
       }
    }
       public function edit($id)
    {
        $this->status = 'edit';

          $paper = Paper::findOrFail($id);
        $this->paper_id = $id;
        $this->title =$paper->title;
        $this->number=$paper->number;
        $this->subject_id=$paper->subject_id;
        $this->category_id=$paper->category_id;
        $this->class_id=$paper->class_id;
        $this->board_id=$paper->board_id;
        $this->branch_id=$paper->branch_id;
        $this->twig_id=$paper->twig_id;
        $this->leaf_id=$paper->leaf_id;
        $this->vein_id=$paper->vein_id;
        $this->state_board_id=$paper->state_board_idt;
        $this->q_type=$paper->q_type; 
        $this->b_title=$paper->b_title;
        $this->b_sub_title=$paper->b_sub_title;
        $this->publisher=$paper->publisher;
        $this->isbn=$paper->isbn;
        $this->publication_year=$paper->publication_year;
        $this->chapter_source=$paper->chapter_source;
        $this->chapter_title=$paper->chapter_title;
        $this->trees = Subject::whereStatus(1)->get();
        $this->trunks = Category::where('parent_id',null)->get();
        $this->branches =Category::where('parent_id',$this->trunks[0]->id)->get();
        $this->twiges = Category::where('parent_id',$this->branches[0]->id)->get();
        $this->leaves = Category::where('parent_id',$this->twiges[0]->id)->get();
        $this->veins = Category::where('parent_id',$this->leaves[0]->id)->get();
        $this->classes = SchoolClass::whereStatus(1)->get();
        $this->boards =Board::where('is_state',0)->get();
        $this->states =Board::where('is_state',1)->get();
    }


       public function confirmDelete($id)
    {
        $this->confirming = $id;
    }  


    public function cancelDlt()
    {
        $this->confirming = null;
    }


    public function delete($id)
    {
        Paper::find($id)->delete();
        session()->flash('message', 'Board Deleted Successfully.');
         $this->status = 'index';
    }
        public function show($id)
    {
        $this->status = 'show';

         $paper = Paper::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($id);
          $this->paper = $paper;
        $this->paper_id = $id;
        $this->title =$paper->title;
        $this->number=$paper->number;
        $this->subject_id=$paper->subject_id;
        $this->category_id=$paper->category_id;
        $this->class_id=$paper->class_id;
        $this->board_id=$paper->board_id;
        $this->branch_id=$paper->branch_id;
        $this->twig_id=$paper->twig_id;
        $this->leaf_id=$paper->leaf_id;
        $this->vein_id=$paper->vein_id;
        $this->state_board_id=$paper->state_board_idt;
        $this->q_type=$paper->q_type; 
        $this->b_title=$paper->b_title;
        $this->b_sub_title=$paper->b_sub_title;
        $this->publisher=$paper->publisher;
        $this->isbn=$paper->isbn;
        $this->publication_year=$paper->publication_year;
        $this->chapter_source=$paper->chapter_source;
        $this->chapter_title=$paper->chapter_title;

    }
}
