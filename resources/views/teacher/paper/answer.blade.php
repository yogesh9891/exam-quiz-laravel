@extends('layouts.app')
@section('before_body')
<style type="text/css">
  .bg-question {
     background-color: #79ef63;
  }
</style>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
  
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
                           


        {{--

      
          <div class="bg-white mt-2 sm:p-6 sm:pb-4">
            <div class="row">
               
             
             
              {{dd($student_assigned)}} --}}
                    
                      {{--   <div class="col-md-12 mt-2 text-center">
                              <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                              <h3 class=" h6 mt-2"> Paper Title: &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->title}}</h3>
                                <h3 class=" h6"> Paper Number:  &nbsp;&nbsp; {{$student_assigned->assigned_paper->question_paper->number}}</h3>
                        </div>


                         <div class="col-md-12 text-center mt-3">
                              <h3 class=" h5 text-danger text-bold"> Paper Layout</h3>
                              <h3 class=" h6 mt-2"><b> Paper Layout:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->subject->name}} / {{$student_assigned->assigned_paper->template->category->name}} / {{$student_assigned->assigned_paper->template->branch->name??''}} / {{$student_assigned->assigned_paper->template->twig->name??''}} / {{$student_assigned->assigned_paper->template->leaf->name??''}} / {{$student_assigned->assigned_paper->template->vein->name??'-'}} / C{{$student_assigned->assigned_paper->template->class->name??''}} - {{$student_assigned->assigned_paper->template->board->name??''}} / {{$student_assigned->assigned_paper->template->q_type}}</h3>
                                  <h3 class=" h6 mt-3"> <b>Tree : </b>&nbsp;&nbsp;{{$student_assigned->assigned_paper->template->subject->name}}</h3>
                                  <h3 class=" h6 "> <b>Trunk :</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->category->name}}</h3>
                                  <h3 class=" h6 "> <b>Branch :</b> &nbsp;&nbsp;{{$student_assigned->assigned_paper->template->branch->name??'None'}}</h3>
                                  <h3 class=" h6 "> <b>Twig :</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->twig->name??'None'}}</h3>
                                  <h3 class=" h6 "><b> Leaf :</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->leaf->name??'None'}}</h3>
                                  <h3 class=" h6 "><b>Vein :</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->vein->name??'None'}}</h3>
                  
                        </div>

                          <div class="col-md-12 text-center m-2">
                              <h3 class=" h5 text-danger text-bold"> Source Details</h3>
                              <h3 class=" h6 mt-2"><b> Book Title:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->b_title}}</h3>
                              <h3 class=" h6 "><b> Book Sub title:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->b_sub_title}}</h3>
                              <h3 class=" h6 "><b> ISBN:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->isbn}}</h3>
                              <h3 class=" h6 "><b> Year of Publication:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->publication_year}}</h3>
                              <h3 class=" h6 "><b> Publisher:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->publisher}}</h3>
                              <h3 class=" h6 "><b> Chapter title:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->chapter_title}}</h3>
                        
                             

                        </div>

                          <div class="col-md-12 text-center mt-2">
                              <h3 class=" h5 text-danger text-bold"> Creater Details</h3>
                  
                              <h3 class=" h6 "><b> Creater:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->creater}}</h3>
                              <h3 class=" h6 "><b> Created At:</b> &nbsp;&nbsp; {{$student_assigned->assigned_paper->template->created_at}}</h3>
                  
                        
                             
                        </div>
                  </div>
         </div>
    </div>

                --}}

     <div class="bg-white  shadow-xl sm:rounded-lg px-4 ">
                 <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                   
                       
                    
                        <div class="row">
                            <div class="col-md-12 mb-3">
          <h1 class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded  text-white text-uppercase"> {{$student_assigned->student->user->name??''}} ({{$student_assigned->class->class->name??''}} - {{$student_assigned->section->section->name??''}}) &nbsp;&nbsp;   @if($student_assigned->sent_tag) <span class="badge badge-warning">SBA</span>@endif
                                                  @if($student_assigned->error_tag) <span class="badge badge-danger">SWE</span>@endif
                                                  @if($student_assigned->late_tag) <span class="badge badge-info">Late</span>@endif
                                           </h1>
                    <p class="my-3"><b>The student's old answers are  shaded <span class="badge first-question" > grey</span> and the new ones are  in <span class="badge second-question" > purple</span>. All the correct anwsers are shaded <span class="badge bg-question" > green</span>.</b></p>
                 </div> 
                                   <h3 class=" h5 text-danger col-md-12 text-center"> {{$student_assigned->assigned_paper->question_paper->paper->name}}</h3>
                                    <div class="col-md-12 instruction-box ">
                                    <h3 class=" h6 my-2 p-3 "><b>{{$student_assigned->assigned_paper->question_paper->paper->defination_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->defination_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3  "><b>{{$student_assigned->assigned_paper->question_paper->paper->word_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->word_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3  "><b>{{$student_assigned->assigned_paper->question_paper->paper->example_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->example_decription}}</h3>
                                   
                                   
                                 
                               
                                </div>
                                   
                                    <div class="col-md-12 ">
                                    @if($student_assigned->status =='submit')
                                       <form action="{{route('teacher.paper.comment')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="paper_id" value="{{ $student_assigned->student_paper->id }}">
                                      <textarea class="form-control mt-3" rows="5" name="comment"> {{ $student_assigned->student_paper->comment }}</textarea>
                                      @if($student_assigned->student_paper->comment)
                                      <button type="submit" class="btn btn-warning my-3" onclick="return confirm('Are you sure you want to edit comment this paper ?');">Edit General Comment</button>
                                      @else
                                      <button type="submit" class="btn btn-success my-3" onclick="return confirm('Are you sure you want to comment this paper ?');">General Comment</button>
                                      @endif
                                    </form>
                                    @else
                                    <p>{{ $student_assigned->student_paper->comment }}</p>
                                      @endif
                                    </div>
                              

                                  <div class="col-md-12 p-0">
                                    @foreach($student_assigned->assigned_paper->question_paper->question_paper as $no =>$question)

                         <h1 class="question @if($loop->first) mt-3 @else mt-4  @endif"> Question :{{$no+1}}: <b> {{$question->question->instruction}} </b> 
                                          (Marks :{{$question->question->marks  }}</h1>

                                                @foreach($question->question->sub_questions as $key =>$que)
                                                @php $lettter = chr($key+65); 
                                                  $num = ($no+1).'-'.$lettter;
                                                  $stu_ans = $student_assigned->student_paper->student_answers->where('sub_question_id',$que->id)->first();
                                                         $stu_new_ans = $student_assigned->student_paper->student_new_answers->where('sub_question_id',$que->id)->first();

                                                @endphp

                                                 <div class="sub-question @if(!$loop->first) mt-4 @endif ">
                                                <input type="hidden" name="question[{{$que->id}}]" value="{{$stu_ans->id}}">
                                                <h3 class=" "><b>{{$lettter}}: {{$que->question}}</b></h3>
                                                
                                             
                                                       <p class="my-1  option  @if($que->answer =='option_1')   bg-question   @endif  @if(($stu_ans) && ($stu_ans->answer == 'option_1'))  first-question @endif
                                                              @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_1')) second-question  @endif ">
                                                                
                                                              <input type="radio" name="answer[{{$que->id}}]"    @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_1')) checked="" @endif        @if(old('answer.'.$que->id,$stu_ans->answer) == 'option_1') checked="" @endif " value="option_1"required="">
                                                              a.&nbsp;&nbsp;{{$que->option_1}}  </p>
                                                           
                                                            <p class="my-1 option  @if($que->answer =='option_2')  bg-question @endif @if(($stu_ans) && ($stu_ans->answer == 'option_2')) first-question  @endif
                                                              @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_2')) second-question  @endif" >  <input type="radio" name="answer[{{$que->id}}]"     @if($stu_ans->answer) =='option_2') checked="" @endif value="option_2" required="">
                                                              b.&nbsp;&nbsp; {{$que->option_2}}  </p>
                                                         
                                                             <p class="my-1  option  @if($que->answer =='option_3')   bg-question  @endif @if(($stu_ans) && ($stu_ans->answer == 'option_3'))  first-question  @endif
                                                              @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_3'))   second-question  @endif">    <input type="radio" name="answer[{{$que->id}}]"   @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_3')) checked="" @else @if(old('answer.'.$que->id,$stu_ans->answer) == 'option_3') checked="" @endif @endif  value="option_3" required="">
                                                             c.&nbsp;&nbsp;{{$que->option_3}} </p>
                                                           
                                                             <p class="my-1  option @if($que->answer =='option_4') bg-question @endif @if(($stu_ans) && ($stu_ans->answer == 'option_4'))  first-question  @endif
                                                              @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_4'))  second-question  @endif"> 
                                                                <input type="radio" name="answer[{{$que->id}}]"  @if(($stu_new_ans) && ($stu_new_ans->answer == 'option_4')) checked="" @else @if(old('answer.'.$que->id,$stu_ans->answer) == 'option_4') checked="" @endif @endif  @if(old('answer.'.$que->id,$stu_ans->answer) == 'option_4') checked="" @endif value="option_4" >
                                                                d.&nbsp;&nbsp;{{$que->option_4}} </p>
                                                         
                                                         </div>  
                                                        <div class="explaination my-2" >
                                                      @if($stu_ans->comment)
                                                          <h3 class="mt-2"><b >About the answer:</b><br><span id="comment{{$stu_ans->id}}">{{$stu_ans->comment->comment}}</span>
                                                    
                                                      @endif
                                                                 <h3 class=" mt-2"><b class="text-danger">Explaining  the correct answer:</b><br>{{$que->explaination}}</h3>
                                                      </h3>
                                                  </div>  
                                                
                                                      @if($student_assigned->status =='submit') 
                                                      @if(!$stu_ans->comment)
                                                      <button type="button" class="btn btn-success modalBtn" data-id="{{$stu_ans->id}}" data-number="{{$que->id}}" > Comment </button>
                                                      @else
                                                          <h3 class=" h6 my-3 p-3  border border-dark"><span id="comment{{$stu_ans->id}}">{{$stu_ans->comment->comment}}</span>
                                                            <br>
                                                            <button type="button" class="btn btn-warning editModalBtn" data-id="{{$stu_ans->id}}" data-number="{{$que->id}}" > Edit Comment </button></h3>
                                                      @endif
                                                      @endif
                                                     
                                                @endforeach
                                    @endforeach
                                </div>
                                @if($student_assigned->status =='submit')
                                      <div class="col-md-12 ">
                                     <a href="{{route('teacher.student.paper.action',['id'=>$student_assigned->id,'type'=>'checked'])}}" class="btn btn-warning "  onclick="return confirm('Are you sure you want to Accept this paper ?');"> Accept</a>
                                
                                    <a href="{{route('teacher.student.paper.action',['id'=>$student_assigned->id,'type'=>'sent_back'])}}"class="btn btn-danger "  onclick="return confirm('Are you sure you want to Send Back for Action  ?');"> Send Back For Action</a>
                     
                                </div> 
                                    @endif
                              
                       </div>

           
                </div>
        </div> 
    </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade mt-5 ml-3" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
         <form action="{{route('teacher.answer.comment')}}" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           
            @method('post')
        
            @csrf
            <input type="hidden" id="Q_number" name="question_id">
            <input type="hidden" id="A_id" name="id">
            <input type="hidden"  name="number" value="{{$student_assigned->id}}">
            <label class="text-primary">Please write below</label>
            <textarea class="form-control" name="comment"  rows="5" required=""></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary " onclick="return confirm('Are you sure you want to comment this question ?');">Comment</button>
     
      </div>
    </div>
        </form>
  </div>
</div>
<div class="modal fade mt-5 ml-3" id="editModalComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
         <form action="{{route('teacher.answer.comment')}}" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           
            @method('put')
        
            @csrf
            <input type="hidden" id="EQ_number" name="question_id">
            <input type="hidden" id="EA_id" name="id">
            <input type="hidden"  name="number" value="{{$student_assigned->id}}">
            <label class="text-primary">Please write below</label>
            <textarea class="form-control" name="comment" id="comment-textarea" rows="5" required=""></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary " onclick="return confirm('Are you sure you want to comment this question ?');">Comment</button>
     
      </div>
    </div>
        </form>
  </div>
</div>
@section('afterScript')
<script type="text/javascript">
  $('.modalBtn').click(function () {
    
    $('#Q_number').val($(this).attr('data-number'));
    $('#A_id').val($(this).attr('data-id'));
    $('#modalComment').modal('show')
  })

    $('.editModalBtn').click(function () {
    let comment_id =$(this).attr('data-id');
    $('#EQ_number').val($(this).attr('data-number'));
    $('#EA_id').val($(this).attr('data-id'));
    $('#comment-textarea').val($('#comment'+comment_id).text());
    $('#editModalComment').modal('show')
  })
</script>

@endsection