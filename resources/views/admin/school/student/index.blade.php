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
                Manage School Students &nbsp;

                <a href="{{route('student.create',$school->id)}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white mr-2">Create New </a>
                 <a href="{{route('teachers.index',$school->id)}}" class="btn btn-danger ml-2"> Add / Import Teachers ? </a>
          {{--        <select  name="class_id" class=""  id="class_id">
                    <option >--Select Class--</option>

                    @foreach($classes as $class)
                    <option value="{{$class->id}}" >{{$class->class->name}}</option>
                    @endforeach 
              
                </select> 
                  <select  name="section_id" class="" id="section_html" >
                    <option >--Select Section--</option>
                    @if($classes[0]->sections)

                    @foreach($classes[0]->sections as $section)
                    <option value="{{$section->id}}" >{{$section->section->name}}</option>
                    @endforeach
                    @endif
                        
              
                </select>  --}}
                <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
                
     </h2>
      <div class="d-flex my-4  ">
                  <form action="{{ route('student-import',$school->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                {{-- <div class="custom-file text-left"> --}}
                    <input type="file" name="file" placeholder="Choose file to import" >
                    {{-- <label for="customFile">Choose file to import</label> --}}
                {{-- </div> --}}
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to import this file ?');">Import File</button>
          
        </form> 
     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">Admission Id</th>
                        <th class="px-4 py-2">Name </th>
                        <th class="px-4 py-2">Class </th>
                        <th class="px-4 py-2">Section </th>
                        <th class="px-4 py-2">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    
                        <td class="border px-4 py-2">{{$student->admission_id}}</td>
                        <td class="border px-4 py-2">{{$student->user?$student->user->name:'no student'}}</td>
                        <td class="border px-4 py-2">{{$student->class->class->name}}</td>
                        <td class="border px-4 py-2">{{$student->section->section->name}}</td>
                        <td class="border px-4 py-2 d-flex">
                        <a href="{{url('schools/'.$school->id.'/student/'.$student->student_id.'/edit')}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white">Edit</a>
                         	  <form action="{{route('student.destroy',['school_id'=>$school->id,'student'=>$student->student_id])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete
                                                </button>                          
                            </form>
                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection