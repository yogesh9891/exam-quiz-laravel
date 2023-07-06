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
                <a href="{{route('teachers.index',$school->id)}}" class="btn btn-warning ">Back </a>&nbsp; &nbsp;  Create Teacher 
                 <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
              </h2>
                
        <form action="{{route('teachers.store',$school->id)}}" method="post">
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

  

              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2"> Name :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter Teacher Name"  required   value="{{ old('name') }}" name="name">
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2"> Email :</label>
                  <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" required="" value="{{ old('email') }}" name="email">
                  @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="mb-4 col-md-6">
                  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Phone :</label>
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Teacher phone" value="{{ old('phone') }}" name="phone" >
                  @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
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
