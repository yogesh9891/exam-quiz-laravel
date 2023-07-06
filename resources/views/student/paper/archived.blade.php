@extends('layouts.app')



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
                           


     <div class="bg-white  shadow-xl sm:rounded-lg px-4">
                 <div class="bg-white px-4 sm:p-6 sm:pb-4">
                   
                       
                    
                        <div class="row">
                            <div class="col-md-12 mb-3 p-0">
                                <h1 class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded  text-white text-uppercase"> {{$student_assigned->student->user->name??''}} ({{$student_assigned->class->class->name??''}} - {{$student_assigned->section->section->name??''}}) &nbsp;&nbsp;
                                      @if($student_assigned->sent_tag) <span class="badge badge-warning">SBA</span>@endif
                                                  @if($student_assigned->error_tag) <span class="badge badge-danger">SWE</span>@endif
                                                  @if($student_assigned->late_tag) <span class="badge badge-info">Late</span>@endif
                                                  @if(!$student_assigned->sent_tag&&!$student_assigned->error_tag&&!$student_assigned->late_tag) <span class="badge badge-success">Correct</span> @endif</h1>


                                 <p class="my-3"><b>The student's old answers are  shaded <span class="badge first-question" > grey</span> and the new ones are  in <span class="badge second-question" > purple</span>. All the correct anwsers are shaded <span class="badge bg-question" > green</span>.</b></p>


                             </div>

                                 <h3 class=" h5 text-danger col-md-12 text-center col-md-12 ">{{$student_assigned->assigned_paper->question_paper->paper->name}}</h3>
                                 <div class="col-md-12 instruction-box ">
                                    <h3 class=" h6 my-2 p-3 "><b>{{$student_assigned->assigned_paper->question_paper->paper->defination_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->defination_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3  "><b>{{$student_assigned->assigned_paper->question_paper->paper->word_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->word_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3  "><b>{{$student_assigned->assigned_paper->question_paper->paper->example_heading}}:</b><br>{{$student_assigned->assigned_paper->question_paper->paper->example_decription}}</h3>
                                   
                                   
                                 
                               
                                </div>

                                      @if($student_assigned->student_paper->comment)  <h3 class=" h6 my-2 p-3  col-md-12  "style="background-color:#f1b8b8; border-radius: 14px"><b>General Comment</b> <br>{{ $student_assigned->student_paper->comment }}</h3>
                                      @endif
                           
                               
                                  <div class="col-md-12 p-0 ">
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
                                                     
                                                @endforeach
                                    @endforeach
                                </div>
                                @if($student_assigned->status =='resubmit')
                                  <div class="col-md-12  mt-5">
                             <form action="{{route('teacher.student.paper.action',$student_assigned->id)}}" method="post" id="paper-form">
                              @csrf
                                 
                                            @csrf
                                            <input type="hidden" name="paper_id" value="{{ $student_assigned->student_paper->id }}">
                                            <input type="hidden" name="type" value="checked">
                                      <textarea class="form-control border border-danger mb-3" rows="5" name="comment" placeholder="Comment Before Archiving"></textarea>
                                
                       

                                     <button type="submit"  class="btn btn-warning btn-lg  py-3 confirmBtn "  > Accept & Archive</button>
                                      <button type="submit" class="btn btn-danger py-3  btn-lg confirmErrorBtn "  > Accept & Archive With Errors</button>
                                    </form>
                                </div> 
                                    @endif
                              
                       </div>

           
                </div>
        </div> 
    </div>
</div>
@endsection


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



       $('.confirmBtn').click(function (e) {
       e.preventDefault()


       Swal.fire({
              title: 'Accept?',
              html: "Once accepted, this paper will move to the Archives folder",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Accept',
              cancelButtonText: 'Cancel',
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  '',
                  'Paper accepted and archived successfully',
                  'success'
                )
                      
                  $('#paper-form').submit();
              }
            })
    })

       $('.confirmErrorBtn').click(function (e) {
       e.preventDefault()

    Swal.fire({
              title: 'Accept?',
              html: "Once accepted, this paper will move to the Archives folder",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Accept',
              cancelButtonText: 'Cancel',
            }).then((result) => {
              if (result.isConfirmed) {

                Swal.fire(
                  '',
                  'Paper accepted and archived successfully',
                  'success'
                )
                            $('<input>').attr({
                  type: 'hidden',
                  id: 'foo',
                  name: 'error',
                  value:'sent'
              }).appendTo('#paper-form');
                                $('#paper-form').submit();
              }
            })
    })
</script>

@endsection