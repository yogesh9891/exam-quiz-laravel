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
                <a href="{{route('assigned_paper.index')}}"  class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</a>
              <span class="text-center"> PREVIEW FULL QUESTION PAPER </span>
   
     </div>

        <form>
          <div class="bg-white  sm:p-6 sm:pb-4">
            <div class="row">
             
                 
                        <div class="col-md-12 text-center">
                              <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                              <h3 class=" h6 mt-2"> Paper Title: &nbsp;&nbsp; {{$template->title}}</h3>
                                <h3 class=" h6"> Paper Number:  &nbsp;&nbsp; {{$questions_paper[0]->number}}</h3>
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
                            <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase"> Question :{{$no+1}}. </h1>
                                        <h3 class=" h5 mt-3"><b> {{$question->question->instruction}}</b></h3>

                                        @foreach($question->question->sub_questions as $key =>$que)
                                         @php $lettter = chr($key+65); @endphp
                                        <h3 class=" h6 mt-5 p-1 ml-3  border border-dark"><b>{{--  {{$no+1}} --}}{{$lettter}}: {{$que->question}}</h3>
                                          <div class="ml-5">
                                                  
                                                     <p> a.&nbsp;&nbsp;{{$que->option_1}}  @if($que->answer =='option_1') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> b.&nbsp;&nbsp; {{$que->option_2}}  @if($que->answer =='option_2') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> c.&nbsp;&nbsp;{{$que->option_3}} @if($que->answer =='option_3') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> d.&nbsp;&nbsp;{{$que->option_4}} @if($que->answer =='option_4') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>

                                                 <h3 class=" h6 my-3 p-3  border border-dark"><b class="text-danger">Explaining  the correct answer:</b><br>{{$que->explaination}}</h3>
                                          </div>  
                                             
                                        @endforeach
                            @endforeach
                        </div>
                            
               </div>
            </div>

@endsection
