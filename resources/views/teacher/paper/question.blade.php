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
    <h2 class="font-semibold text-xl text-gray-800 leading-tight my-3">
               Comments/ Observations &nbsp;
                {{-- <a href="{{route('question-paper.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create Section  </a> --}}
             
                
     </h2>
    
      <h3 class=" h5 mt-2 p-1 "> {{$question->instruction->instruction}}</h3>
      <h3 class=" h6  p-1 ml-3  border border-dark"><b> {{$question->question}}</h3>
                                          <div class="ml-5">
                                                  
                                                     <p> a.&nbsp;&nbsp;{{$question->option_1}}  @if($question->answer =='option_1') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> b.&nbsp;&nbsp;{{$question->option_2}}  @if($question->answer =='option_2') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> c.&nbsp;&nbsp;{{$question->option_3}} @if($question->answer =='option_3') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p> d.&nbsp;&nbsp;{{$question->option_4}} @if($question->answer =='option_4') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>

                                                 <h3 class=" h6 my-3 p-3  border border-dark"><b class="text-danger">Explaining  the correct answer:</b><br>{{$question->explaination}}</h3>
                                              
                                          </div> 
        <form action="{{route('teacher.question.comment',['number'=>request()->segments()[3],'id'=>request()->segments()[4]])}}" method="post">
            @if($comment)
            @method('put')
            @else
            @method('post')
            @endif
            @csrf
            <label class="text-primary">Please write below</label>
            <textarea class="form-control" name="comment" rows="5" required="">{{old('comment',$comment->comment??'')}}</textarea>
            @error('comment') <span class="text-red-500">{{ $message }}</span>@enderror
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to comment this question ?');">Save</button>
        </form>


   </div>
</div>
</div>



@endsection