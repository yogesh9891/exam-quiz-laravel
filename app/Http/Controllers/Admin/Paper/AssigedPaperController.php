<?php

namespace App\Http\Controllers\Admin\Paper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionPaper;
use App\Models\AssignedPaper;
use App\Models\Template;
use App\Models\Paper;

class AssigedPaperController extends Controller
{

   public function index()
   {
        $question_papers = QuestionPaper::with('template','paper')->get();
        return view('admin.template.assigned.index',compact('question_papers'));
   }

       public function show($id)
    {
         $questions_paper = QuestionPaper::with('question')->where('number',$id)->get();
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($questions_paper[0]->template_id);
         $paper = Paper::findOrFail($questions_paper[0]->paper_id);

        return view('admin.template.assigned.show',compact('questions_paper','template','paper'));
    }


   public function sent()
   {
        $question_papers = AssignedPaper::with('school_group','question_paper','class','school')->get();
        return view('admin.template.assigned.sent',compact('question_papers'));
   }
}
