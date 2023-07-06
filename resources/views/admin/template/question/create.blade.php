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
                <a href="{{route('question.index')}}" class="btn btn-warning">Back </a>  Create Questions </h2>
                @if($errors->any())
       @foreach ($errors->all() as $error)
              <p class="text-red-500">{{ $error }}</p> 
      @endforeach
    @endif 

        <form action="{{route('question.store')}}" method="post">
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row ">
                      <div class="col-md-6 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Template</label>
                  <select  name="template_id" class="form-control" required="">
                    <option >--Select Template--</option>

                    @foreach($templates as $template)
                    <option value="{{$template->id}}" >{{$template->number}} - {{$template->title}}</option>
                    @endforeach 
              
                </select> 
              </div>
                   <div class="mb-4 col-md-8">
                              <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Question Instruction:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="What do you want student to do? (Ex: Fill in the blanks with... or Choose the correct word... etc)"  required   value="{{ old('instruction') }}" name="instruction">
                              @error('instruction') <span class="text-red-500">{{ $message }}</span>@enderror
                         </div>
                           <div class="mb-4 col-md-4">
                              <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">marks</label>
                              <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Question Maximum marks according ot number of question"  required  min="5" value="{{ old('marks') }}" name="marks">
                              @error('instruction') <span class="text-red-500">{{ $message }}</span>@enderror
                         </div>
            
                      <div class="questin-div">

                      <div class="col-md-12 sub_question" id="sub_question_html">
                        <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 1:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)" value="{{old('question.0')}}"  name="question[]">
                              <br>
                               @error('question.0') <span class="text-red-500">The sub question 1 is required</span>@enderror
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[0]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]"  value="{{old('option_1.0')}}"  >
                              <br>
                                 @error('option_1.0') <span class="text-red-500">The choice 1 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[0]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]"  value="{{old('option_2.0')}}" ><br>
                                 @error('option_2.0') <span class="text-red-500">The choice 2 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[0]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]"  value="{{old('option_3.0')}}" ><br>
                                 @error('option_3.0') <span class="text-red-500">The choice 3 is required</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[0]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]"  value="{{old('option_4.0')}}" ><br>
                               @error('option_4.0') <span class="text-red-500">The choice 4 is required</span>@enderror
                          </div>
                          <span class="text-danger"> *Note for paper creator: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct">{{old('explaintion.0')}}</textarea>
                                    @error('explaintion.0') <span class="text-red-500">The Answer explaition is required</span>@enderror
                              </div>
                        </div>

                     
                  
                     <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 2:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)" value="{{old('question.1')}}"  name="question[]">
                              <br>
                               @error('question.1') <span class="text-red-500">The sub question 2 is required</span>@enderror
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[1]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]"  value="{{old('option_1.1')}}"  >
                              <br>
                                 @error('option_1.1') <span class="text-red-500">The choice 1 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[1]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]"  value="{{old('option_2.1')}}" ><br>
                                 @error('option_2.1') <span class="text-red-500">The choice 2 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[1]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]"  value="{{old('option_3.1')}}" ><br>
                                 @error('option_3.1') <span class="text-red-500">The choice 3 is required</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[1]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]"  value="{{old('option_4.1')}}" ><br>
                               @error('option_4.1') <span class="text-red-500">The choice 4 is required</span>@enderror
                          </div>
                          <span class="text-danger"> *Note for paper creater: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct">{{old('explaintion.1')}}</textarea>
                                    @error('explaintion.1') <span class="text-red-500">The Answer explaition is required</span>@enderror
                              </div>
                     </div>

                     <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 3:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)" value="{{old('question.2')}}"  name="question[]">
                              <br>
                               @error('question.2') <span class="text-red-500">The sub question 3 is required</span>@enderror
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[2]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]"  value="{{old('option_1.2')}}"  >
                              <br>
                                 @error('option_1.2') <span class="text-red-500">The choice 1 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[2]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]"  value="{{old('option_2.2')}}" ><br>
                                 @error('option_2.2') <span class="text-red-500">The choice 2 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[2]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]"  value="{{old('option_3.2')}}" ><br>
                                 @error('option_3.2') <span class="text-red-500">The choice 3 is required</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[2]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]"  value="{{old('option_4.2')}}" ><br>
                               @error('option_4.2') <span class="text-red-500">The choice 4 is required</span>@enderror
                          </div>
                          <span class="text-danger"> *Note for paper creater: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct">{{old('explaintion.2')}}</textarea>
                                    @error('explaintion.1') <span class="text-red-500">The Answer explaition is required</span>@enderror
                              </div>
                     </div>

                     <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 4:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)" value="{{old('question.3')}}"  name="question[]">
                              <br>
                               @error('question.3') <span class="text-red-500">The sub question 4 is required</span>@enderror
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[3]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]"  value="{{old('option_1.3')}}"  >
                              <br>
                                 @error('option_1.3') <span class="text-red-500">The choice 1 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[3]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]"  value="{{old('option_2.3')}}" ><br>
                                 @error('option_2.3') <span class="text-red-500">The choice 2 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[3]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]"  value="{{old('option_3.3')}}" ><br>
                                 @error('option_3.3') <span class="text-red-500">The choice 3 is required</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[3]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]"  value="{{old('option_4.3')}}" ><br>
                               @error('option_4.3') <span class="text-red-500">The choice 4 is required</span>@enderror
                          </div>
                          <span class="text-danger"> *Note for paper creater: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct">{{old('explaintion.3')}}</textarea>
                                    @error('explaintion.1') <span class="text-red-500">The Answer explaition is required</span>@enderror
                              </div>
                     </div>

                    <div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning">Sub Question 5:</label>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)" value="{{old('question.4')}}"  name="question[]">
                              <br>
                               @error('question.4') <span class="text-red-500">The sub question 5 is required</span>@enderror
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[4]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]"  value="{{old('option_1.4')}}"  >
                              <br>
                                 @error('option_1.4') <span class="text-red-500">The choice 1 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[4]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]"  value="{{old('option_2.4')}}" ><br>
                                 @error('option_2.4') <span class="text-red-500">The choice 2 is required</span>@enderror
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[4]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]"  value="{{old('option_3.4')}}" ><br>
                                 @error('option_3.4') <span class="text-red-500">The choice 3 is required</span>@enderror
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[4]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]"  value="{{old('option_4.4')}}" ><br>
                               @error('option_4.4') <span class="text-red-500">The choice 4 is required</span>@enderror
                          </div>
                          <span class="text-danger"> *Note for paper creater: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct">{{old('explaintion.4')}}</textarea>
                                    @error('explaintion.1') <span class="text-red-500">The Answer explaition is required</span>@enderror
                              </div>
                     </div>
                    </div>
                      

                      </div>
                    
                  </div>
                 <hr class="my-3">
                  <button  type="button" class="btn btn-sm btn-secondary add_sub_question" onclick="addSubQuestionDiv(this)"><i class="fa fa-plus"> </i> Add Sub Question</button>
                 </div>
                 <br>
                 <br>
                  <div class="col-md-12 form-group mt-3"> 

                <button type="submit" class="btn btn-primary btn-lg">
                 Create
                  </button>
              </div>
    </div>
</form>
   </div>
</div>
</div>


@endsection

@section('afterScript')

<script>
         function removeSubQuestionDiv(e) {

        $(e).parent().parent().remove();
    }

 function addSubQuestionDiv(e) {

    console.log($(e))
        let sub_questin_div = $(e).parent().siblings('.questin-div').children('.sub_question');
        let sub_questin_number = $('#sub_question_html').children().length+1;
       let html = `<div class="row">
                          <div class="mb-4 col-md-12">
                              <label for="exampleFormControlInput1" class="py-2 my-4 badge badge-warning mr-2">Sub Question ${sub_questin_number}:</label><button  type="button" class="btn btn-sm btn-danger ml-3 " onclick="removeSubQuestionDiv(this)"><i class="fa fa-times"></i> Remove </button>
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 mb-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Sub Question (Ex: That is ...... house. or Where is ...... house?)"   name="question[]">
                            
                            </div>
                          <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">A</label>
                             <input type="radio" name="answer_option[]" class="mt-3 mr-2" value="option_1">
                     
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 1" name="option_1[]">
                       
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">B</label>
                                <input type="radio" name="answer_option[]" class="mt-3 mr-2" value="option_2">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 2"  name="option_2[]">
                              
                          </div>
                           <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">C</label>
                              <input type="radio" name="answer_option[]" class="mt-3 mr-2" value="option_3">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 3"   name="option_3[]">
                            
                          </div>
                             <div class="mb-4 col-md-6 d-flex">
                            <label class=" text-gray-700 text-sm font-bold mt-3 mr-2">D</label>
                             <input type="radio" name="answer_option[]" class="mt-3 mr-2" value="option_4">
                              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Choice 4" name="option_4[]">
                            
                          </div>
                          <span class="text-danger"> *Note for paper creater: Click radio button next to choice to indicate correct answer. Radio button should turn blue of correct answer. </span>
                                <div class="my-4 col-md-12 d-flex">
                              
                                <textarea class="form-control"  name="explaintion[]" placeholder="Explain why the indicated answer is correct"></textarea>
                             
                              </div>
                        </div>`;
$('#sub_question_html').append(html);
  e.preventDefault();


     }
</script>
@endsection