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
                <a href="{{route('class.index',$school->id)}}" class="btn btn-warning ">Back </a>&nbsp; &nbsp;  Create Class 
                 <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
              </h2>
                
        <form action="{{route('class.store',$school->id)}}" method="post">
            @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

  

              <div class="mb-4 col-md-12">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2"> Choose Class :</label>
                    <select name="class[]" id="cars" multiple class="form-control">
                      @foreach($all_classes as $class)
                      <option value="{{$class->id}}" @if(array_search($class->id,$school_classes)) selected="" @endif>{{$class->name}}</option>
                      @endforeach
                      
                    </select>
                  @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
            
           
               <div class="col-md-8 form-group mt-3"> 

                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add this class ?');">
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
