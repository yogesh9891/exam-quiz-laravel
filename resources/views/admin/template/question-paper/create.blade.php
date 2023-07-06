@extends('layouts.app')
  @section('before_body')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
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
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Question Paper
              </h2>
                        @if($errors->any())
       @foreach ($errors->all() as $error)
              <p class="text-red-500">{{ $error }}</p> 
      @endforeach
    @endif  
        <form action="{{route('question-paper.store')}}" method="post">
            @csrf
               <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="row">
                         <div class="col-md-6 form-group">
                           <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Template</label>
                            <select  name="template_id" class="form-control" required="" id="template_id">
                              <option >--Select Template--</option>

                              @foreach($templates as $template)
                              <option value="{{$template->id}}" >{{$template->number}}</option>
                              @endforeach 
                        
                          </select> 

                          @error('template_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        
                         <div class="col-md-6 form-group">
                           <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Paper Top Part</label>
                          <div id="paper_html">
                              
                          </div>

                          @error('template_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                         <div class="col-md-12 form-group">
                            <div id="result"></div>
                         </div>

                      
                      
                     
                         <div class="col-md-8 form-group mt-3"> 

                          <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to create this paper ?');">
                           Create
                            </button>
                        </div>
                      </div>
                </div>
              </form>
            </div>

          <div class="bg-white  shadow-xl sm:rounded-lg px-4 py-4 mt-5">
             <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="row">
                    <div class="col-md-12" id="question_html">
                      

                    </div>
                   <div class="col-md-8 form-group mt-3"> 
                  
                    <button type="submit" class="btn btn-primary" id="add_question_btn">
                     Add Quesion
                      </button>
                  </div>
               </div>
            </div>
    </div>
   </div>
</div>
</div>


@endsection


@section('afterScript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">

  function removeQuestion(e) {
  let option_value = $(e).attr('id');
   let option =  $('#selectpicker').children('option[value=' + option_value + ']');
        option.prop('disabled', false)
        $(e).parent().remove()
  }

  $('#template_id').on('change',function () {
      let template_id = $(this).val();

      if(!template_id){
        $('#result').append('<span class="text-danger">Please select Template</span>')
      }

       $.ajax({
                  type: "GET",
                  url:'{{ url('get-question') }}/'+template_id,
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                    if(data.success){

                     $('#paper_html').html(data.paper_html)
                     $('#question_html').html(data.questions_html)
                       $('#selectpicker').select2();
                    }
                  }
                });
  });


  $('#selectpicker').select2();

  $('#add_question_btn').click(function () {

    var question = $('#selectpicker option:selected');
    var question_id = $('#selectpicker').val();
    if(question_id){

     let question_no =  $('#result').children().length+1;
      $html = `<div class="my-3">  Q : ${question.text()} <button type="button"  id="${question.val()}" class="btn btn-danger" onclick="removeQuestion(this)"><i class="fa fa-times"> </i></button><input type="hidden" name="question_id[]" value="${question.val()}"></div>`;
    $('#result').append($html);

    question.attr('disabled','disabled')
  } else {
    $('#result').append('<span class="text-danger">Please select question</span>')
  }

    
  })
</script>
@endsection
