@extends('layouts.app')
	@section('before_body')
  <style type="text/css">
       .first-question {
      background-color: #c5c1c1; 
    }

 .second-question {
      background-color: #cf8fe3;
    }

    #my-template {
      background-color: #eee;
    font-size: 21px;
    width: 50%;
    height: 51%;
    }
  </style>
  @endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
  
     {{--    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
                           



       
       <a href="{{route('student.paper.sent',$student_paper->id)}}"  class="btn btn-danger"  onclick="return confirm('Are you sure you want to save this paper ?');"><i class="fa fa-paper-plane" aria-hidden="true"> </i> Sent to teacher</a>
       
      
          <div class="bg-white mt-2 sm:p-6 sm:pb-4">
            <div class="row">
          <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> PREVIEW FULL QUESTION PAPER   </h1>
             
                    
                    
                        <div class="col-md-12 text-center">
                              <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                              <h3 class=" h6 mt-2"> Paper Title: &nbsp;&nbsp; {{$template->title}}</h3>
                                <h3 class=" h6"> Paper Number:  &nbsp;&nbsp; {{$student_assigned->assigned_paper->question_paper->number}}</h3>
                        </div>


                         <div class="col-md-12 text-center mt-3">
                              <h3 class=" h5 text-danger text-bold"> Paper Layout</h3>
                              <h3 class=" h6 mt-2"><b> Paper Layout:</b> &nbsp;&nbsp; {{$template->subject->name}} / {{$template->category->name}} / {{$template->branch->name??''}} / {{$template->twig->name??''}} / {{$template->leaf->name??''}} / {{$template->vein->name??'-'}} / C{{$template->class->name??''}} - {{$template->board->name??''}} / {{$template->q_type}}</h3>
                                  <h3 class=" h6 mt-3"> <b>Tree : </b>&nbsp;&nbsp;{{$template->subject->name}}</h3>
                                  <h3 class=" h6 "> <b>Trunk :</b> &nbsp;&nbsp; {{$template->category->name}}</h3>
                                  <h3 class=" h6 "> <b>Branch :</b> &nbsp;&nbsp;{{$template->branch->name??'None'}}</h3>
                                  <h3 class=" h6 "> <b>Twig :</b> &nbsp;&nbsp; {{$template->twig->name??'None'}}</h3>
                                  <h3 class=" h6 "><b> Leaf :</b> &nbsp;&nbsp; {{$template->leaf->name??'None'}}</h3>
                                  <h3 class=" h6 "><b>Vein :</b> &nbsp;&nbsp; {{$template->vein->name??'None'}}</h3>
                  
                        </div>

                          <div class="col-md-12 text-center m-2">
                              <h3 class=" h5 text-danger text-bold"> Source Details</h3>
                              <h3 class=" h6 mt-2"><b> Book Title:</b> &nbsp;&nbsp; {{$template->b_title}}</h3>
                              <h3 class=" h6 "><b> Book Sub title:</b> &nbsp;&nbsp; {{$template->b_sub_title}}</h3>
                              <h3 class=" h6 "><b> ISBN:</b> &nbsp;&nbsp; {{$template->isbn}}</h3>
                              <h3 class=" h6 "><b> Year of Publication:</b> &nbsp;&nbsp; {{$template->publication_year}}</h3>
                              <h3 class=" h6 "><b> Publisher:</b> &nbsp;&nbsp; {{$template->publisher}}</h3>
                              <h3 class=" h6 "><b> Chapter title:</b> &nbsp;&nbsp; {{$template->chapter_title}}</h3>
                        
                             

                        </div>

                          <div class="col-md-12 text-center mt-2">
                              <h3 class=" h5 text-danger text-bold"> Creater Details</h3>
                  
                              <h3 class=" h6 "><b> Creater:</b> &nbsp;&nbsp; {{$template->creater}}</h3>
                              <h3 class=" h6 "><b> Created At:</b> &nbsp;&nbsp; {{$template->created_at}}</h3>
                  
                        
                             
                        </div>
               
                  </div>
         </div>
    </div> --}}


      
         <div class="bg-white  shadow-xl sm:rounded-lg px-4  mt-5">
                 <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
                           


                    <form action="{{route('student.paper.update',$student_paper->id)}}" method="post" id="paper-form">
                      @method('put')
                                <button type="button" class="btn btn-danger float-right confirmBtn"   > Save as Draft</button> <br>
                                     <a href="{{route('student.paper.sent',$student_paper->id)}}"  class="btn btn-info"  onclick="return confirm('Are you sure you want to sent  this paper ?');"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Sent to teacher</a>
          <h1 class="bg-info hover:bg-blue-700 my-5  px-4 py-2 rounded  text-white text-uppercase"> {{$template->subject->name}} / {{$template->category->name}} / {{$template->branch->name??''}} / {{$template->twig->name??''}} / {{$template->leaf->name??''}} / {{$template->vein->name??'-'}}   </h1>
                        @csrf
                        <div class="row">
                                   <h3 class=" h5 text-danger col-md-12 text-center"> {{$paper->name}}</h3>
                                 <div class="col-md-12">
                                    <h3 class=" h6 my-2 p-3  border border-dark"><b>{{$paper->defination_heading}}:</b><br>{{$paper->defination_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3 border border-dark"><b>{{$paper->word_heading}}:</b><br>{{$paper->word_decription}}</h3>
                                    <h3 class=" h6 my-2 p-3 border border-dark"><b>{{$paper->example_heading}}:</b><br>{{$paper->example_decription}}</h3>
                     
                                </div>

                           <div class="col-md-12 mt-5">
                                    @foreach($student_assigned->assigned_paper->question_paper->question_paper as $no =>$question)

                                    <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> Question :{{$no+1}}. </h1>
                                                <h3 class=" h5 mt-3"><b> {{$question->question->instruction}}</b></h3>

                                                @foreach($question->question->sub_questions as $key =>$que)
                                                @php $lettter = chr($key+65); 
                                                  $num = ($no+1).'-'.$lettter;
                                                  $stu_ans = $student_paper->student_answers->where('sub_question_id',$que->id)->first();
                                                  
                                                @endphp
                                                <input type="hidden" name="question[{{$que->id}}]" value="{{$stu_ans->id??''}}">
                                                <h3 class=" h6 mt-5 p-1 ml-3  border border-dark"><b>{{$lettter}}: {{$que->question}}</b></h3>
                                                   @error($num) <span class="text-red-500">{{ $message }}</span>@enderror
                                                  <div class="ml-5">
                                                   {{-- 
                                                                @if($stu_ans)
                                                             <p class="my-1 @if(($stu_ans) && ($stu_ans->answer == 'option_1')) border border-dark first-question py-2 @endif ">
                                                              <input type="radio" name="answer[{{$que->id}}]" @if(($stu_ans) && ($stu_ans->answer == 'option_1')) checked=""  @endif   value="option_1" readonly="true">
                                                              a.&nbsp;&nbsp;{{$que->option_1}} 
                                                            </p>
                                                            <p class="my-1  @if(($stu_ans) && ($stu_ans->answer == 'option_2')) border border-dark  first-question py-2 @endif">  <input type="radio"  name="answer[{{$que->id}}]" @if(($stu_ans) && ($stu_ans->answer == 'option_2'))  checked="" @endif class="mr-2 "  value="option_2" readonly="true">
                                                              b.&nbsp;&nbsp;{{$que->option_2}}
                                                          </p>
                                                             <p class="my-1  @if(($stu_ans) && ($stu_ans->answer == 'option_3')) border border-dark first-question  py-2 @endif">    <input type="radio" name="answer[{{$que->id}}]"  @if(($stu_ans) && ($stu_ans->answer == 'option_3'))  checked="" @endif class="mr-2 "  value="option_3" readonly="true" >
                                                             c.&nbsp;&nbsp;{{$que->option_3}} 
                                                            </p>
                                                             <p class="my-1  @if(($stu_ans) && ($stu_ans->answer == 'option_4')) border border-dark  first-question py-2 @endif"> 
                                                                <input type="radio"  class="mr-2"  name="answer[{{$que->id}}]" @if(($stu_ans) && ($stu_ans->answer == 'option_4'))  checked="" @endif value="option_4" readonly="true">
                                                                d.&nbsp;&nbsp;{{$que->option_4}} 
                                                                  
                                                            </p>
                                                                  @else  --}}
                                                               
                                                             <p class="my-1 @if(($stu_ans) && ($stu_ans->answer == 'option_1')) border border-dark  first-question py-2 @endif">
                                                              <input type="radio" name="ans{{$que->id}}" class="mr-2 answerBtn optionAnswer{{$que->id}}  @if(($loop->parent->last) && ($loop->last)) lastQuestion @endif " data-id="{{$que->id}}" 
                                                                 @if(($stu_ans))  disabled="disabled"  @if($stu_ans->answer == 'option_1') checked="" @endif @endif
                                                               value="option_1"  >
                                                              a.&nbsp;&nbsp;{{$que->option_1}} 
                                                            </p>
                                                            <p class="my-1 @if(($stu_ans) && ($stu_ans->answer == 'option_2')) border border-dark  first-question py-2 @endif">  <input type="radio" name="ans{{$que->id}}"  class="mr-2 answerBtn optionAnswer{{$que->id}}  @if(($loop->parent->last) && ($loop->last)) lastQuestion @endif " data-id="{{$que->id}}"  value="option_2"   @if(($stu_ans))  disabled="disabled"  @if($stu_ans->answer == 'option_2') checked="" @endif @endif>
                                                              b.&nbsp;&nbsp;{{$que->option_2}}
                                                          </p>
                                                             <p class="my-1 @if(($stu_ans) && ($stu_ans->answer == 'option_3')) border border-dark  first-question py-2 @endif">    <input type="radio" name="ans{{$que->id}}"  class="mr-2  answerBtn optionAnswer{{$que->id}}  @if(($loop->parent->last) && ($loop->last)) lastQuestion @endif " data-id="{{$que->id}}"  value="option_3"    @if(($stu_ans))  disabled="disabled"  @if($stu_ans->answer == 'option_3') checked="" @endif @endif>
                                                             c.&nbsp;&nbsp;{{$que->option_3}} 
                                                            </p>
                                                             <p class="my-1 @if(($stu_ans) && ($stu_ans->answer == 'option_4')) border border-dark  first-question py-2 @endif"> 
                                                                <input type="radio" name="answ{{$que->id}}" class="mr-2 answerBtn optionAnswer{{$que->id}} @if(($loop->parent->last) && ($loop->last)) lastQuestion @endif "  data-id="{{$que->id}}"    value="option_4"   @if(($stu_ans))  disabled="disabled"  @if($stu_ans->answer == 'option_4') checked="" @endif @endif>
                                                                d.&nbsp;&nbsp;{{$que->option_4}} 
                                                                
                                                            </p>
                                                           
                                                  </div>  
                                                     
                                                @endforeach
                                    @endforeach
                                </div> 
                                 @if($student_assigned->status == 'saved')
                              <div class="col-md-12 mt-2" id="buttonDiv">
                                    
                                    <button type="submit" class="btn btn-danger confirmBtn"  > Save as Draft</button>
                                   <a href="{{route('student.paper.sent',$student_paper->id)}}"  class="btn btn-info"  onclick="return confirm('Are you sure you want to sent  this paper ?');"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Sent to teacher</a>
                                </div>      
                            @endif
                       </div>

                    </form>
                </div>
        </div>
    </div>
</div>
<template id="my-template" >
  <swal-title>
    Thank You
  </swal-title>
  <swal-html>
    We have sent your completed paper to the teacher.<br>If the teacher sends the paper back to you, please make the corrections.<br> When your corrections are finished, the paper will go back to the teacher.
  </swal-html>

  <swal-button type="confirm">
    Ok
  </swal-button>
 
  <swal-param
    name="class"
    value='{ "popup": "my-popup" }' />
</template>
@endsection


@section('afterScript')

<script type="text/javascript">

  // console.log($('input[name=answer[]]:checked').length)
  console.log($('input[name=answer').length)
    $('.answerBtn').on('click',function () {
     let radio_id =    $(this).attr('data-id');
     Swal.fire({
  title: 'Shall we confirm this answer?',
   text: 'Once confirmed, this answer cannot change',
  icon: 'warning',

    showDenyButton: true,
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  denyButtonColor: '#d33',
  confirmButtonText: 'Yes, Confirm',
    denyButtonText: `No, Cancel`,
}).then((result) => {
    if (result.isConfirmed) {
                     $('.optionAnswer'+radio_id).attr("disabled",'disabled');
                    $(this).parent().addClass('border border-dark first-question py-2')
                  Swal.fire('Answer Confirmed', 'Now you will not be able to change this answer', 'success')
                  $('<input>').attr({
    type: 'hidden',
    name: 'answer['+radio_id+']',
    value:$(this).val()
}).appendTo('#paper-form');
                    if($(this).hasClass('lastQuestion')){
                        $('#buttonDiv').hide();
                        Swal.fire({
  template: '#my-template'
})
  //                            Swal.fire({
  // title: 'Thank You',
  //  html:  'We have sent your completed paper to the teacher.<br>If the teacher sends the paper back to you, please make the corrections.<br> When your corrections are finished, the paper will go back to the teacher.',
  // icon: 'success',})
                  $('<input>').attr({
    type: 'hidden',
    name: 'status',
    value:'sent',
}).appendTo('#paper-form');
                     $('#paper-form').submit();

                       
           
                    }
                
              }
})
      
        console.log(radio_id);
    })



       $('.confirmBtn').click(function (e) {
       e.preventDefault()


       Swal.fire({
              title: 'Save as Draft',
              html: "You can save this paper as a Draft and return to it later. <br> To open the saved draft, go to the Drafts menu item. ",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Save Draft',
              cancelButtonText: 'No, Return To Paper',
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Paper saved as Draft',
                  'To open the saved draft, go to the Drafts menu item.',
                  'success'
                )
                $('#paper-form').submit();
              }
            })
    })
</script>

@endsection
