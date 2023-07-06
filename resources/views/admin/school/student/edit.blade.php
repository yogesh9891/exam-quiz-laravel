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
              Add Student <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
              </h2>
                
        <form action="{{route('student.update',['school_id'=>$school->id,'student'=>$user->id])}}" method="post">
          @method('put')
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">
            <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mb-5 px-4 py-2 rounded  text-white text-uppercase">Student Login Detail</h1>
             </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Student Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter  Student Name"  required   value="{{ old('name',$user->name) }}" name="name">
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Student Email : <span class="text-red-500">Not Editable</span>
</label>
                  <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" required="" value="{{ old('email',$user->email) }}" name="email" readonly="" disabled="disabled">
                                </div>

              <div class="mb-4 col-md-6">
                  <label for="passwordInput1" class="block text-gray-700 text-sm font-bold mb-2">Password :</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput1" placeholder="Enter password"  name="password">
                  @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="passwordInput2" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password :</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput2" placeholder="Enter Confirm Password"  name="password_confirmation">
                  {{-- @error('password_confirmation') <span class="text-red-500">{{ $message }}</span>@enderror --}}
              </div>
              <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Student Details</h1>
             </div>
            <div class="mb-4 col-md-6">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Admission Id :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Student Admission Id" value="{{ old('admission_id',$user->student->admission_id) }}" name="admission_id" required>
                  @error('admission_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Roll Number :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Student Roll No" value="{{ old('roll_no',$user->student->roll_no) }}" name="roll_no" required>
                  @error('roll_no') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                 <div class="col-md-6 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Class</label>
                  <select  name="class_id" class="form-control"  id="class_id">
                    <option >--Select Class--</option>

                    @foreach($classes as $class)
                    <option value="{{$class->id}}" @if($user->student->class->id == $class->id) selected=""  @endif>{{$class->class->name}}</option>
                    @endforeach 
              
                </select> 

                @error('class_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-6 form-group">
               
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                  <select  name="section_id" class="form-control" id="section_html" >
                    <option >--Select Section--</option>
                    @if($classes->where('id',$user->student->class_id)->first()->sections)

                    @foreach($classes->where('id',$user->student->class_id)->first()->sections as $section)
                    <option value="{{$section->id}}"  @if($user->student->section_id == $section->id) selected=""  @endif >{{$section->section->name}}</option>
                    @endforeach
                    @endif
                        
              
                </select> 

                @error('section_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Parent Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter School  Name"  required  value="{{ old('parent_name',$user->student->parent_name) }}" name="parent_name">
                  @error('parent_name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                 <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Parent Relation :</label>
               <select class="form-control" name="parent_relation">
                  <option >--Select Parent Relation--</option>
                   <option value="father"  @if($user->student->parent_relation == 'father') selected=""  @endif>Father</option>
                   <option value="mother"  @if($user->student->parent_relation == 'mother') selected=""  @endif>Mother</option>
                   <option value="other"  @if($user->student->parent_relation == 'other') selected=""  @endif>Other</option>
               </select> 
                  @error('parent_relation') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Parent Email :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" required="" value="{{ old('parent_email',$user->student->parent_email) }}" name="parent_email">
                  @error('parent_email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Phone :</label>
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter  phone" value="{{ old('phone',$user->phone) }}" name="phone" >
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        
           
               <div class="col-md-8 form-group mt-3"> 

                <button type="submit" class="btn btn-primary">
                 update
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

@section('afterScript')
<script type="text/javascript">
    $('#class_id').on('change',function () {
       $class_id = $(this).val();

        $.ajax({
                  type: "POST",
                  url: "{{ route('class-section',$school->id) }}",
                  data: {class_id:$class_id},
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){

                    if(data.success){
                        $('#section_html').html(data.html)
                    }
                  }
                });
    })
</script>


@endsection