@extends('layouts.app')
@section('before_body')
<style type="text/css">
  #search-result ul {
    max-height: 300px;
   overflow-y: scroll;

  }
  #search-result ul li {
    display: block;
    padding: 10px;
    font-size: 18px;
    cursor: pointer;
  }
  #search-result ul li:hover {
    background-color: #eee;
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
                           


                    <div class="row">
                         <h1 class="bg-green-600 hover:bg-blue-700 my-2 col-md-12   px-4 py-2 rounded  text-white "> Send Paper   </h1>
                    {{--     <div class="col-md-4 mt-2"><h3 class=" h5 text-danger text-bold">Sent to all students</h3></div>
                        <div class="col-md-8 mt-2 ">
                            <a href="{{route('teacher.sent_to_all',$assigned_paper->id)}}" class="btn btn-info" onclick="return confirm('Are you sure you want to assign paper to this class ?');">Send To All</a>
                        </div>
                   <div class="col-md-4 mt-2"><h3 class=" h5 text-danger text-bold"> Sent to section</h3></div>
                        <div class="col-md-8 mt-2">

                             @foreach($sections as $section)
                                 <a href="{{route('teacher.sent_to_section',['number'=>$assigned_paper->id,'section_id'=>$section->id])}}"  class="btn btn-info m-1"  onclick="return confirm('Are you sure you want to assign paper to this section ?');">{{$section->class->class->name}}-{{$section->section->name}}</a>
                           @endforeach
                        </div> --}}
                
                        <div class="col-md-6 mt-2">
                                      <label>Submit By Date</label>
                               <div class="d-flex ">
                                       
                                       <input type="date" name="" id="submit_date" placeholder="Submit By Date " class="form-control">
                                  {{-- <button type="submit" class="btn btn-info ml-2 assign_paper">Submit By Date</button> --}}

                               </div>
                    </div>
                        <div class="col-md-11 mt-2">
                  
                                      <select class="form-control" id="category">
                                         <option value="">--Send To ---</option>
                                         <option value="all"> All Students</option>
                                         {{-- <option value="selected"> Selected Students</option> --}}
                                           @foreach($sections->groupBy('class_id') as $class=> $section)
                                           <option value="class-{{$class}}"> Full Class {{$section[0]->class->class->name}}</option>
                                           @endforeach
                                         {{-- <option value=""> Full Class 7</option> --}}
                                         @foreach($sections as $section)
                                      <option value="{{$section->id}}">{{$section->class->class->name}}-{{$section->section->name}}</option>
                                      @endforeach
                                      </select>
                                       
                                        <select class="form-control ml-2 get_student" style="display:none;">
                                           <option value="">--Select Students ---</option>
                                              @foreach($sections as $section)
                                                  @foreach($section->section_student as $student)
                                                  <option value="{{$student->user->id}}">{{$student->user->name}}-{{$student->admission_id}}</option>
                                                  @endforeach
                                           @endforeach

                                      </select>

                               </div>
                                  <!-- <button type="submit" class="btn btn-info col-md-1 mt-2 assign_paper">Send</button> -->
           
                        <div class="col-md-11 mt-2">
                              <input type="text" name="" placeholder="Enter Student Name " id="search" class="form-control">
                                  <div id="search-result"></div>
                               </div>
                        <div class="col-md-1 mt-2">
                              <button type="button" class="btn btn-info btn-lg assign_paper" id="assign_studenpt_btn">Send</button>
                            </div>
                    </div>
                  </div>
    
     <nav class="nav mt-4" role="navigation" >
        
              <ul class="nav__list col-md-12">

             
                <li class=" border border-primary p-2 mb-2">
                    <div class=" border-bottom border-danger p-2">
                        @php $assigned_section = array_keys($assigned_paper->section_assigned->where('class_id',$assigned_paper->class_id)->groupBy('section_id')->toArray());   sort($assigned_section); @endphp
                    <button class="badge badge-info btn-sm mb-2 "> Assigned To:</button><b>

                        @foreach($assigned_section as $id)
                       @php  $section = \App\Models\Section::with('section','class')->find($id); @endphp

                       @if($section)
                       {{$section->class->class->name}}-
                       {{$section->section->name}}
                       @endif

                        @endforeach
                        

                    </b>
        
                    </div>
                    <div class="p-2">
                        <h3 class="text-primary">{{$assigned_paper->question_paper->number}} ({{$template->title}})
                            <button class=" float-right "  data-toggle="modal" data-target="#quetion-meta1"><i class=" pb-3 fa fa-info-circle"></i></button>
                         </h3>   
                         
                         <h3 class=" h5 text-danger mt-1 col-md-12"> {{$paper->name}}</h3>
                          <h3 class=" h6  col-md-12 "><b>{{$paper->defination_heading}}:</b><br>{{$paper->defination_decription}}</h3>

                    
                    </div>
                        <input id="group-1" type="checkbox" hidden />
                        <label for="group-1" class="pb-1">
                          <span class="fa fa-plus text-primary"></span>
                         </label>
                          <ul class="group-list">
                            <li> 
                                 <div class="row">
                                         <div class="col-md-12">
                                            <h3 class=" h6 col-md-12"><b>{{$paper->word_heading}}:</b><br>{{$paper->word_decription}}</h3>
                                            <h3 class=" h6 col-md-12"><b>{{$paper->example_heading}}:</b><br>{{$paper->example_decription}}</h3>
                             
                                        </div>

                                        <div class="col-md-12 mt-5">
                                          @foreach($assigned_paper->question_paper->question_paper as $no =>$question)
                                          <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> Question :{{$no+1}}. </h1>
                                                      <h3 class=" h5 mt-3"><b> {{$question->question->instruction}}</b></h3>

                                                      @foreach($question->question->sub_questions as $key =>$que)
                                                      @php $lettter = chr($key+65); @endphp
                                                      <h3 class=" h6 mt-5 p-1 ml-3  border border-dark"><b>{{$lettter}}: {{$que->question}}</h3>
                                                        <div class="ml-5">
                                                                
                                                                   <p> a.&nbsp;&nbsp;{{$que->option_1}}  @if($que->answer =='option_1') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                                   <p> b.&nbsp;&nbsp;{{$que->option_2}}  @if($que->answer =='option_2') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                                   <p> c.&nbsp;&nbsp;{{$que->option_3}} @if($que->answer =='option_3') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                                   <p> d.&nbsp;&nbsp;{{$que->option_4}} @if($que->answer =='option_4') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>

                                                               <h3 class=" h6 my-3 p-3  border border-dark"><b class="text-danger">Explaining  the correct answer:</b><br>{{$que->explaination}}</h3>
                                                           {{--     <a href="{{route('teacher.question.comment',['number'=>$assigned_paper->question_paper_id,'id'=>$que->id])}}" class="btn btn-success">Click here for Feedback </a> --}}
                                                            {{-- <a href="#" class="btn btn-success feedbackBtn">Click here for Feedback </a> --}}
                                                       </div>   
                                                           
                                                      @endforeach
                                          @endforeach
                                       </div>
                                       <div class="col-md-6 mt-2 ml-3">
                                              
                                              {{-- <button type="button" class="btn btn-danger " > Send Feedback to Admin</button> --}}
                               
                                        </div>   
                                      
                                 </div>
                            </li>
                          </ul>
                       </li>
                        <div class="modal fade mt-5 " id="quetion-meta1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Paper Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                             <div class="modal-body">
                              <div class="row">
             
                    
                                
                                    <div class="col-md-12 text-center">
                                          <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                                          <h3 class=" h6 mt-2"> Paper Title: {{$template->title}}</h3>
                                            <h3 class=" h6"> Paper Number: {{$assigned_paper->question_paper->number}}</h3>
                                    </div>


                                     <div class="col-md-12 text-center mt-3">
                                          <h3 class=" h5 text-danger text-bold"> Paper Layout</h3>
                                          <h3 class=" h6 mt-2"><b> Paper Layout:</b> {{$template->subject->name}} / {{$template->category->name}} / {{$template->branch->name??''}} / {{$template->twig->name??''}} / {{$template->leaf->name??''}} / {{$template->vein->name??'-'}} / C{{$template->class->name??''}} - {{$template->board->name??''}} / {{$template->q_type}}</h3>
                                              <h3 class=" h6 mt-3"> <b>Tree:</b> {{$template->subject->name}}</h3>
                                              <h3 class=" h6 "> <b>Trunk:</b> {{$template->category->name}}</h3>
                                              <h3 class=" h6 "> <b>Branch:</b> {{$template->branch->name??'None'}}</h3>
                                              <h3 class=" h6 "> <b>Twig:</b> {{$template->twig->name??'None'}}</h3>
                                              <h3 class=" h6 "><b> Leaf:</b> {{$template->leaf->name??'None'}}</h3>
                                              <h3 class=" h6 "><b>Vein:</b> {{$template->vein->name??'None'}}</h3>
                              
                                    </div>

                                      <div class="col-md-12 text-center m-2">
                                          <h3 class=" h5 text-danger text-bold"> Source Details</h3>
                                          <h3 class=" h6 mt-2"><b> Book Title:</b> {{$template->b_title}}</h3>
                                          <h3 class=" h6 "><b> Book Sub title:</b> {{$template->b_sub_title}}</h3>
                                          <h3 class=" h6 "><b> ISBN:</b> {{$template->isbn}}</h3>
                                          <h3 class=" h6 "><b> Year of Publication:</b> {{$template->publication_year}}</h3>
                                          <h3 class=" h6 "><b> Publisher:</b> {{$template->publisher}}</h3>
                                          <h3 class=" h6 "><b> Chapter title:</b> {{$template->chapter_title}}</h3>
                                    
                                         

                                    </div>

                                      <div class="col-md-12 text-center mt-2">
                                          <h3 class=" h5 text-danger text-bold"> Creater Details</h3>
                              
                                          <h3 class=" h6 "><b> Creater:</b> {{$template->creater}}</h3>
                                          <h3 class=" h6 "><b> Created At:</b> {{$template->created_at}}</h3>
                              
                                    
                                         
                                    </div>
                     
                            </div>
                            </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>
             
              </ul>
        
            </nav>




<!-- Feed back modal  -->
<div class="modal fade mt-5 ml-3" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <form action="#" method="post">
            @method('post')
            
            @csrf
            <label class="text-primary">Please write below</label>
            <textarea class="form-control" name="comment" rows="5" required="">{{old('comment',$comment->comment??'')}}</textarea>
            @error('comment') <span class="text-red-500">{{ $message }}</span>@enderror
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to feedback this question ?');">Save</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('afterScript')
<script type="text/javascript">
  $('.feedbackBtn').click(function () {
    
    $('#feedbackModal').modal('show');

  })


    $('#categccory').on('change', function() {
       let section_id = $(this).val();
       let type = 'section';
       let id =section_id;
       let date = $('#submit_date').val();
       if(!section_id || !date){

           Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Please Select send To Or Send By Date',
})
      }

      if(section_id == 'selected'){

        $('.get_student').show();
      }

       if(section_id == 'all'){

          type = 'all';
          id="all";
      }
      let str = 'class';
      if(section_id.indexOf(str) != -1){

      let class_id = section_id.split('-')[1];
          type = 'class';
          id=class_id;

     }
       $.ajax({
                  type: "POST",
                  url:'{{ route('teacher.send_paper',$assigned_paper->id) }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:{type:type,id:id},
                  success: function(data){
                    if(data.success){

                        $('.get_student').html(data.html);
                    }
                  }
                });
      
    });



      $('.assign_paper').on('click', function() {

        let result = confirm('Are you sure you want to assign this paper ?')

          let section_id = $('#category').val();
       let type = 'section';
       let id =section_id;
       let date = $('#submit_date').val();
          let student_id =    $('#search').attr('data-id');

          console.log(student_id);
       if(!section_id || !date){

           Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Please Select send To Or Send By Date',
})
      }

      if(section_id == 'selected'){

        $('.get_student').show();
      }

       if(section_id == 'all'){

          type = 'all';
          id="all";
      }
      let str = 'class';
      if(section_id.indexOf(str) != -1){

      let class_id = section_id.split('-')[1];
          type = 'class';
          id=class_id;

     }
        if(student_id){
             $('#search').attr('data-id','');
             $('#search').val('');
            $('#search-result').html('');
              type = 'student';
          id=student_id;
            
          }
       $.ajax({
                  type: "POST",
                  url:'{{ route('teacher.send_paper',$assigned_paper->id) }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:{type:type,id:id,date:date},
                  success: function(data){
                    if(data.success){

                                    Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: 'Paper Succesfully assigned',
                          })
      
                    }
                  }
                });
      
    })

      $("#search").on("keyup", function(){
var search = $(this).val();
if (search !=="") {
$.ajax({
                  type: "POST",
                  url:'{{ route('teacher.get_students') }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
data:{term:search},
success:function(data){
$("#search-result").html(data.html);
$("#search-result").fadeIn();
}  
});
}else{
$("#search-result").html("");  
$("#search-result").fadeOut();
}
});
// click one particular search name it's fill in textbox
$(document).on("click",".search-li", function(){
$('#search').val($(this).text());
$('#search').attr('data-id',$(this).attr('data-id'));
$('#search-result').fadeOut("fast");
});

    $('#assign_student_btn').on('click', function() {
   let id =    $('#search').attr('data-id');
       let date = $('#submit_date').val();
       if(!id || !date){

           Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Please Select send To Or Send By Date',
})
      }    let type  = 'student';
         $.ajax({
                  type: "POST",
                  url:'{{ route('teacher.send_paper',$assigned_paper->id) }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:{type:type,id:id,date:date},
                  success: function(data){
                    if(data.success ==true){

                      $('#search').val('');
                                  Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: 'Paper Succesfully assigned',
                          })

                    } else {
                                 Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'Paper already assigned to student',
                            })
                    }
                  }
                });
    });
     
</script>
@endsection