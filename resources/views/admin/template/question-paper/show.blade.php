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
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                <button wire:click="back()" class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</button>
              <span class="text-center"> Preview/Assign Full Question Paper </span>
                
     </div>

        <form>
          <div class="bg-white  sm:p-6 sm:pb-4">
            <div class="row">
                 <h3 class=" h5 text-danger text-bold mb-2"> Assign Paper To School/Class</h3>
                  <div class="col-md-12 text-center">
            <div class="d-flex ">
                <select class="form-control ml-2 school_group">
                   @foreach($school_groups as $group)
                   <option value="">--Select School Group ---</option>
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
                </select>
                  <select class="form-control ml-2 get_school">
                   <option value="">--Select School ---</option>
                 
                </select>
                  <select class="form-control ml-2 get_class" >
                     <option value="">--Select Class ---</option>
                </select>

            </div>
                <button type="button" class="btn btn-success assign_paper float-right my-2 w-20">Assign</button>
                 
                        <div class="col-md-12 text-center mt-5">
                              <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                              <h3 class=" h6 mt-2"> Paper Title: &nbsp;&nbsp; {{$template->title}}</h3>
                                <h3 class=" h6"> Paper Number:  &nbsp;&nbsp; {{$questions_paper[0]->number}}</h3>
                        </div>

                         <div class="col-md-12 text-center mt-3">
                              <h3 class=" h5 text-danger text-bold"> Paper Layout</h3>
                              <h3 class=" h6 mt-2"><b> Paper Layout:</b> &nbsp;&nbsp; {{$template->subject->name}} / {{$template->category->name}} / {{$template->branch->name??''}} / {{$template->twig->name??''}} / {{$template->leaf->name??''}} / {{$template->vein->name??'-'}} / C{{$template->class->name??''}} - {{$template->board->name??''}} / {{$template->q_type}}</h3>
                                  <h3 class=" h6 mt-3"> <b>Tree: </b>&nbsp;&nbsp;{{$template->subject->name}}</h3>
                                  <h3 class=" h6 "> <b>Trunk:</b> &nbsp;&nbsp; {{$template->category->name}}</h3>
                                  <h3 class=" h6 "> <b>Branch:</b> &nbsp;&nbsp;{{$template->branch->name??'None'}}</h3>
                                  <h3 class=" h6 "> <b>Twig:</b> &nbsp;&nbsp; {{$template->twig->name??'None'}}</h3>
                                  <h3 class=" h6 "><b> Leaf:</b> &nbsp;&nbsp; {{$template->leaf->name??'None'}}</h3>
                                  <h3 class=" h6 "><b>Vein:</b> &nbsp;&nbsp; {{$template->vein->name??'None'}}</h3>
                  
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
    </div>


     <div class="bg-white  shadow-xl sm:rounded-lg px-4  mt-5">
             <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="row">
                           <h3 class=" h5 text-danger col-md-12 text-center"> {{$paper->name}}</h3>
                         <div class="col-md-12">
                            <h3 class=" h6 my-2 p-3  border border-dark"><b>{{$paper->defination_heading}}:</b><br>{{$paper->defination_decription}}</h3>
                            <h3 class=" h6 my-2 p-3 border border-dark"><b>{{$paper->word_heading}}:</b><br>{{$paper->word_decription}}</h3>
                            <h3 class=" h6 my-2 p-3 border border-dark"><b>{{$paper->example_heading}}:</b><br>{{$paper->example_decription}}</h3>
             
                        </div>

                          <div class="col-md-12 mt-5">
                            @foreach($questions_paper as $no =>$question)
                            <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> Question: {{$no+1}} </h1>
                                        <h3 class=" h5 mt-3"><b> {{$question->question->instruction}}</b></h3>

                                        @foreach($question->question->sub_questions as $key =>$que)
                                      @php $lettter = chr($key+65); @endphp
                                        <h3 class=" h6 mt-5 p-1 ml-3  border border-dark"><b>{{--  {{$no+1}} --}}{{$lettter}}: {{$que->question}}</h3>
                                          <div class="ml-5">
                                                  
                                                     <p>a.&nbsp;&nbsp;{{$que->option_1}}  @if($que->answer =='option_1') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>b.&nbsp;&nbsp;{{$que->option_2}}  @if($que->answer =='option_2') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>c.&nbsp;&nbsp;{{$que->option_3}} @if($que->answer =='option_3') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>d.&nbsp;&nbsp;{{$que->option_4}} @if($que->answer =='option_4') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>

                                                 <h3 class=" h6 my-3 p-3  border border-dark"><b class="text-danger">Explaining  the correct answer:</b><br>{{$que->explaination}}</h3>
                                          </div>  
                                             
                                        @endforeach
                            @endforeach
                        </div>

                            <div class="col-md-12">
                               <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> Assign Paper. </h1>
                           </div>
                              <div class=" col-md-12 d-flex my-3">
                                <select class="form-control mx-2 school_group" >
                                   @foreach($school_groups as $group)
                                   <option>--Select School Group ---</option>
                                <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                                </select>
                                  <select class="form-control mx-2 get_school">
                                   <option>--Select School ---</option>
                                 
                                </select>
                                  <select class="form-control mx-2 get_class">
                                     <option>--Select Class ---</option>
                                </select>
                                <button type="button" class="btn btn-success assign_paper">Assign</button>

                            </div>
                            
               </div>
            </div>

@endsection
@section('afterScript')
<script type="text/javascript">
    $('.school_group').on('change', function() {
       let school_group_id = $(this).val();
console.log(school_group_id)
           if(!school_group_id){
            alert('Please Select School Group')
      }

       $.ajax({
                  type: "GET",
                  url:'{{ url('get-school') }}/'+school_group_id,
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                    if(data.success){

                        $('.get_school').html(data.html);
                    }
                  }
                });
    });

     $('.get_school').on('change', function() {

          let school_id = $(this).val();

           if(!school_id){
            alert('Please Select School Group')
      }

       $.ajax({
                  type: "GET",
                  url:'{{ url('get-class') }}/'+school_id,
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                    if(data.success){
                         if(data.success){

                        $('.get_class').html(data.html);
                    }
                    
                    }
                  }
    })
    });

      $('.assign_paper').on('click', function() {

        let result = confirm('Are you sure you want to assign this paper ?')

          let school_group_id1 = $('.school_group').val();
          let school_id1 = $('.get_school').val();
          let class_id1 = $('.get_class').val();
          let question_paper_id = '{{$questions_paper[0]->id}}';
          let template_id = '{{$template->id}}';

           if(!school_group_id1 || !school_id1 || !class_id1){
              Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'Please Select School Group ,School and Class!',
                                })
return 0;
        
      }

       $.ajax({
                  type: "POST",
                  url:'{{ route('paper_assigned') }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:{school_group_id:school_group_id1,school_id:school_id1,class_id:class_id1,question_paper_id:question_paper_id,template_id:template_id},
                  success: function(data){
                    if(data.success){
                      

                             
                             Swal.fire(
                                      'Congrats!',
                                      'Paper assigned successfully',
                                      'success'
                                    )
                                                         
                            } else {
                                  Swal.fire({
                                  icon: 'warning',
                                  title: 'Already Sign',
                                  text: 'Paper already assign to this class!',
                                })

                                // alert('Paper already assign to this class');
                            }
                    
                    
                  }
    })
    })
     
</script>
@endsection
