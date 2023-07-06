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
                
        <form action="{{route('student.store',$school->id)}}" method="post">
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">
            <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mb-5 px-4 py-2 rounded  text-white text-uppercase">Student Login Detail</h1>
             </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Student Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Student Name"  required   value="{{ old('name') }}" name="name">
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Student Email :</label>
                  <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" required="" value="{{ old('email') }}" name="email">
                  @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

              <div class="mb-4 col-md-6">
                  <label for="passwordInput1" class="block text-gray-700 text-sm font-bold mb-2">Password :</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput1" placeholder="Enter Password"  name="password">
                  @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="passwordInput2" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password :</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput2" placeholder=" Confirm Password"  name="password_confirmation">
                  {{-- @error('password_confirmation') <span class="text-red-500">{{ $message }}</span>@enderror --}}
              </div>
              <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Student Details</h1>
             </div>
            <div class="mb-4 col-md-6">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Admission ID :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Student Admission ID" value="{{ old('admission_id') }}" name="admission_id" required>
                  @error('admission_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Roll Number :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Student Roll No" value="{{ old('roll_no') }}" name="roll_no" required>
                  @error('roll_no') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                 <div class="col-md-6 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Class</label>
                  <select  name="class_id" class="form-control"  id="class_id">
                    <option >--Select Class--</option>

                    @foreach($classes as $class)
                    <option value="{{$class->id}}" >{{$class->class->name}}</option>
                    @endforeach 
              
                </select> 

                @error('class_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-6 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                  <select  name="section_id" class="form-control" id="section_html" >
                    <option >--Select Section--</option>
                    @if($classes[0]->sections)

                    @foreach($classes[0]->sections as $section)
                    <option value="{{$section->id}}" >{{$section->section->name}}</option>
                    @endforeach
                    @endif
                        
              
                </select> 

                @error('section_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">DOB:</label>
                  <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Student DOB" required="" value="{{ old('dob') }}" name="dob">
                  @error('dob') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">City :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Student City" value="{{ old('city') }}" name="city" >
                  @error('city') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Parent Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Parent  Name"  required  value="{{ old('parent_name') }}" name="parent_name">
                  @error('parent_name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Parent Relation :</label>
               <select class="form-control" name="parent_relation">
                  <option >--Select Parent Relation--</option>
                   <option value="father">Father</option>
                   <option value="mother">Mother</option>
                   <option value="other">Other</option>
               </select> 
                  @error('parent_relation') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Parent Email :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Parent Email" required="" value="{{ old('parent_email') }}" name="parent_email">
                  @error('parent_email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Phone :</label>
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Phone Number" value="{{ old('phone') }}" name="phone" >
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        
           
               <div class="col-md-8 form-group mt-3"> 

                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add this teacher ?');">
                 Add
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