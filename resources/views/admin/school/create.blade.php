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
                <a href="{{route('admin.schools.index')}}" class="btn btn-warning ">Back </a>&nbsp; &nbsp;  Create School </h2>
    
        <form action="{{route('admin.schools.store')}}" method="post">
              @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

              <div class="mb-4 col-md-12">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> School Group</label>
                  <select class="form-control" name="school_group_id">
                @foreach($school_groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
                  </select>
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
  
                  <div class="mb-4 col-md-6">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">School ID:</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter School Id" value="{{ old('school_id') }}" name="school_id" required>
                  @error('school_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">School Name:</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter School  Name"  required  value="{{ old('school_name') }}" name="school_name">
                  @error('school_name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Admin Name:</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter School Admin Name"  required   value="{{ old('name') }}" name="name">
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Admin Email:</label>
                  <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" required="" value="{{ old('email') }}" name="email">
                  @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-8">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Admin phone" value="{{ old('phone') }}" name="phone" >
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               {{--   <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> Region</label>
                  <select class="form-control" name="region">
                    <option>North</option>
                    <option>South</option>
                    <option>East</option>
                    <option>West</option>
                  </select>
                  @error('region') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> --}}
              <div class="mb-4 col-md-6">
                  <label for="passwordInput1" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput1" placeholder="Enter password"  name="password">
                  @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="passwordInput2" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
                  <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passwordInput2" placeholder="Enter Confirm Password"  name="password_confirmation">
                  {{-- @error('password_confirmation') <span class="text-red-500">{{ $message }}</span>@enderror --}}
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> Classes</label>
                  <select class="form-control" id="class_id" multiple="" size="12">
                      @foreach($classes as $class)
                      <option value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                  </select>
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
                  <button  type="button" class="btn btn-success btn-sm my-3" id="add_class">Add Class and Section</button>
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> Section</label>
                  <select class="form-control"  id="section_id" multiple="" size="12">
                       @foreach($sections as $section)
                      <option value="{{$section->id}}">{{$section->name}}</option>
                      @endforeach
                  </select>
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

               <div class="mb-4 col-md-12 d-flex flex-wrap" id="class_html">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> Class List</label>
                  {{--   <div class="mt-3 ml-4" >
                      <h5  class="text-primary">Class 1</h5> 
                      <ul class="ml-5">
                        <li class="mt-3">  A   <button type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button></li>
                        <li  class="mt-3" >B <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button>  </li>
                        <li class="mt-3" >C <button  type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >D <button  type="button"  class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >E <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >F <button  type="button"  class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >G <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                      </ul>
                      <button  type="button" class="btn btn-danger btn-sm my-3 "><i class="fa
                        fa-trash "> </i> Remove Class</button>
                    </div>

                         <div class="mt-3 ml-4">
                      <h5  class="text-primary">Class 1</h5> 
                      <ul class="ml-5">
                        <li class="mt-3">  A   <button type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button></li>
                        <li  class="mt-3" >B <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button>  </li>
                        <li class="mt-3" >C <button  type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >D <button  type="button"  class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >E <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >F <button  type="button"  class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                        <li class="mt-3" >G <button   type="button" class="btn btn-danger btn-sm ml-5 "><i class="fa fa-times"> </i></button> </li>
                      </ul>
                      <button  type="button" class="btn btn-danger btn-sm my-3 " onclick="removeDiv(this)"><i class="fa
                        fa-trash "> </i> Remove Class</button>
                    </div> --}}
              </div>
        
           
               <div class="col-md-8 form-group mt-3"> 

                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add this School ?');">
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

  function removeDiv(e) {
    console.log(  $(e))
   $(e).parent().remove()
  }
    $('#add_class').on('click',function () {

     var classes = [];
     var sections = [];
    $('#class_id').children('option:selected').each( function() {
         var $this = $(this);
         console.log($this)
         classes.push( { text: $this.text(), value: $this.val()} );
    });
     $('#section_id').children('option:selected').each( function() {
         var $this = $(this);
         console.log($this)
         sections.push( { text: $this.text(), value: $this.val()} );
    });
console.log(sections.length,classes.length)
      if(sections.length <=0 || classes.length <=0){
       alert('Please Select classes and section')
      }

       $.ajax({
                  type: "POST",
                  url:'{{ url('admin/get-class') }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:{classes:classes,sections:sections},
                  success: function(data){
                    if(data.success){

                      $('#class_html').html(data.html)
                    }
                  }
                });
  });

</script>
@endsection