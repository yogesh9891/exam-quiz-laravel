<?php

namespace App\Http\Controllers\Admin\Paper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\SaveQuestionRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\SubQuestion;
use App\Models\Template;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $questions = Question::withCount('sub_questions')->get();

        return view('admin.template.question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

             $templates = Template::all();

        return view('admin.template.question.create',compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveQuestionRequest $request)
    {

        // dd($request->all());
        $data = $request->validated();
    
        $question  = new Question;
        $question->template_id = $data['template_id'];
        $question->instruction = $data['instruction'];
        $question->marks = $data['marks'];
        $question->save();
        // dd($question);
        foreach ($data['question'] as $key => $sub_question) {
            if(array_key_exists($key,$data['answer_option'])){
            $question->sub_questions()->create(
                [
                'template_id'=>$data['template_id'],
                'type'=>'mcq',
                'question'=>$sub_question,
                'option_1'=>$data['option_1'][$key],
                'option_2'=>$data['option_2'][$key],
                'option_3'=>$data['option_3'][$key],
                'option_4'=>$data['option_4'][$key],
                'answer'=>$data['answer_option'][$key],
                'explaination'=>$data['explaintion'][$key],
            ]);

        } else{
         return redirect()->back()->withErrors(['message'=>'please check choice of sub-question '.$key.''])->withInput($data);
        }
        }
        return redirect()->route('question.index')->with('message','Questions created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
           $question->load('sub_questions');
            $templates = Template::all();
         return view('admin.template.question.edit',compact('question','templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveQuestionRequest $request, Question $question)
    {
        $data =$request->validated();
         
          $question->template_id = $data['template_id'];
        $question->instruction = $data['instruction'];
           $question->marks = $data['marks'];
        $question->update();
         
             foreach ($data['question'] as $key => $sub_question) {
            if(array_key_exists($key,$data['answer_option'])){
                // dd($request->question_id[$key]);
            $question->sub_questions()->updateOrCreate(['id'=>$request->question_id[$key]],
                [
                'template_id'=>$data['template_id'],
                'type'=>'mcq',
                'question'=>$sub_question,
                'option_1'=>$data['option_1'][$key],
                'option_2'=>$data['option_2'][$key],
                'option_3'=>$data['option_3'][$key],
                'option_4'=>$data['option_4'][$key],
                'answer'=>$data['answer_option'][$key],
                'explaination'=>$data['explaintion'][$key],
            ]);

        } else{
         return redirect()->back()->withErrors(['message'=>'please check choice of sub-question '.$key.''])->withInput($data);
        }
    }

        return redirect()->route('question.index')->with('message','Questions updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       $question->delete();

        return redirect()->route('question.index')->with('message','Questions deleted successfully');
    }
}
