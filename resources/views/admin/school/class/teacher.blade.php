@extends('layouts.app')
@section('before_body')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    .modal-backdrop.fade.show {
    display: none;
}
</style>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg px-4 py-4">
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
                <a href="{{route('class.index',$school->id)}}" class="btn btn-warning ">Back </a>&nbsp; &nbsp;  Assign Teacher To Class: <span id="class_name">{{$class->class?$class->class->name:''}}</span>
                 <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
          
              </h2>
                
        <form action="{{route('class.update',['school_id'=>$school->id,'class'=>$class->class_id])}}" method="post" id="assign-form">
            @csrf
            @method('put')
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

        <input type="hidden" name="class_id" value="{{$class->id}}">

            

              <div class="mb-4 col-md-12">
                 <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2"> Choose Sections:</label>
                    <select id="multiple-checkboxes" name="section[]" multiple="multiple" class="form-control" required="">
                      @foreach($sections as $section)
                        <option value="{{$section->id}}">{{$section->section->name}} {{$section->teacher?'- '.$section->teacher->name:''}}</option>
                        @endforeach
                   
                    </select>
                    @error('section') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>


                 <div class="mb-4 col-md-12">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2"> Choose Teacher:</label>
                    <select name="teacher_id" id="cars"  class="form-control" required="">
                        <option value="">--Select Teacher</option>
                      @foreach($school_teachers as $teacher)
                      <option value="{{$teacher->user->id}}" >{{$teacher->user->name}} ({{$teacher->user->email}})  </option>
                      @endforeach
                      
                    </select>
                           @error('teacher_id') <span class="text-red-500">{{ $message }}</span>@enderror
               
              </div>
            
           
               <div class="col-md-8 form-group mt-3"> 

                <button type="button" class="btn btn-primary" id="assign_teacher">
                 Assign
                  </button>
              </div>
            </div>
        </div>
    </div>
</form>
   </div>
</div>
</div>

<div class="modal fade" style="top: 20%;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
          <table  class="table">
              <thead>
                <tr>
                  <th>Section</th>
                  <th>Teacher</th>
              </tr>
              </thead>
              <tbody id="table_body">
              
              </tbody>
          </table>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal_submit">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('afterScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
     $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
          enableCaseInsensitiveFiltering: true,
          buttonWidth:'600px',
           numberDisplayed: 4
        

        });
    });

     $('#modal_submit').on('click',function () {

        $('#assign-form').submit();
     });
     $('#assign_teacher').on('click',function () {
        if(!$('#cars').val() || !$('#multiple-checkboxes').val()){
           Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Please Select Teacher or Section',
            });
           return
         }
        let section_html ='';
         $("#multiple-checkboxes option:selected").each(function() {
             // console.log($(this).text())
             section_html += `<tr><td>${$('#class_teacher_id').text()} - ${$(this).text()}</td><td>${$('#cars option:selected').text()}</td></tr>`;
           
    });
         
         $('#table_body').html(section_html);

       $('#exampleModal').modal('show')
     })
</script>

@endsection
