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
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('paper.index')}}" class="btn btn-warning">Back </a>  Edit Paper </h2>
    
        <form action="{{route('paper.update',$paper->id)}}" method="post">
            @csrf
            @method('put')
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">
            <div class="col-md-6 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Template</label>
                  <select  name="template_id" class="form-control" required="">
                    <option >--Select Template--</option>

                    @foreach($templates as $template)
                    <option value="{{$template->id}}" @if($paper->template_id ==$template->id) selected="" @endif>{{$template->number}} - {{$template->title}}</option>
                    @endforeach 
              
                </select> 

                @error('template_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
             <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Paper Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Paper Name"  required   value="{{ old('name',$paper->name) }}" name="name">
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
   
            <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mb-5 px-4 py-2 rounded  text-white text-uppercase">Paper Detail</h1>
             </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Definition Heading :</label>
                  <textarea class="form-control" placeholder="Enter  Definition Heading" name="defination_heading">{{ old('defination_heading',$paper->defination_heading) }}</textarea>
                  @error('defination_heading') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
             <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Definition Answer :</label>
                  <textarea class="form-control" placeholder="Enter Definition Answer" name="defination_decription">{{ old('defination_decription',$paper->defination_decription) }}</textarea>
                  @error('defination_decription') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

            <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Example Heading :</label>
                  <textarea class="form-control" placeholder="Enter  Example Heading" name="word_heading">{{ old('word_heading',$paper->word_heading) }}</textarea>
                  @error('word_heading') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
             <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Example Answer :</label>
                <textarea class="form-control" placeholder="Enter Example Answer" name="word_decription">{{ old('word_decription',$paper->word_decription) }}</textarea>
                  @error('word_decription') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Example Sentence Heading :</label>
                     <textarea class="form-control" placeholder="Enter Example Sentence Heading" name="example_heading">{{ old('example_heading',$paper->example_heading) }}</textarea>
                  @error('example_heading') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
             <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Example Sentence Answer :</label>
                   <textarea class="form-control" placeholder="Enter Example Sentence Answer" name="example_decription">{{ old('example_decription',$paper->example_decription) }}</textarea>
                  @error('example_decription') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
          {{--     <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded  text-white text-uppercase">Question Details</h1>
             </div> --}}
           {{--   <div id="question_html"  class="col-md-12 ">
                <div class="row ">
                    <div class="col-md-12 mb-4">
                    <h1 class="btn  btn-success">Question 1</h1> <button  type="button" class="btn btn-sm btn-primary add_sub_question" onclick="addSubQuestionDiv(this)"><i class="fa fa-plus"></i>Add Sub Question</button>
                      </div>
                         <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Question Instruction:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Question Instruction"  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                         </div>
                      <div class="questin-div">

                      <div class="col-md-12 sub_question" id="sub_question_1">
                        <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 1:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question "  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                             </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="option1" class="mt-3 mr-2">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Sentence Answer"  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="option1" class="mt-3 mr-2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Sentence Answer"  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="option1" class="mt-3 mr-2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Sentence Answer"  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="option1" class="mt-3 mr-2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Sentence Answer"  required   value="{{ old('name') }}" name="name">
                              @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                          </div>
                            <div class="mb-4 col-md-12 d-flex">
                        
                            <textarea class="form-control" placeholder="Enter Answer Explaintion"></textarea>
                         
                          </div>
                          </div>
                         
                      </div>
                  </div>
                 <hr class="my-3">
                 </div>
             </div>
               

                 <div class="col-md-12">
                     <button type="button" class="w-100 btn btn-secondary" id="add_question">Add Question</button>
                 </div>
             </div>
             --}}
           
               <div class="col-md-12 form-group mt-3"> 

                <button type="submit" class="btn btn-primary">
                 Save
                  </button>
              </div>
            </div>
        </div>
    </div>
</form>
   </div>
</div>
</div>


@endsection
