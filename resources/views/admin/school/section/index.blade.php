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
                 Class -  {{$class->class->name}} Manage Sections &nbsp;
                <a href="{{route('section.create',$class->id)}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create Section  </a>
         {{--        <span class="d-inline float-right">Class -  {{$class->class->name}}</span> --}}
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        <th class="px-4 py-2" width="50px">Section </th>
                        <th class="px-4 py-2">Teacher </th>
                        <th class="px-4 py-2" width="50px">Total Students </th>
                        <th class="px-4 py-2">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $section)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $loop->iteration }}</td> --}}
                    
                        <td class="border px-4 py-2">{{$section->section?$section->section->name:'no section'}}</td>
                        <td class="border px-4 py-2">
                            @if($section->teacher)
                                      <label class="badge badge-success text-capitalize">{{ $section->teacher->name }} </label> ({{ $section->teacher->email }})
                            @else

                                      <label class="badge badge-danger">No Teacher Assigned</label>
                            @endif
                          </td>
                           <td class="border px-4 py-2">{{$section->section_student_count}}</td>
                        <td class="border px-4 py-2 d-flex">
                            <a href="{{route('section.edit',['class_id'=>$class,'section'=>$section->section->id])}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2">Vew Students</a>
                       {{--   	  <form action="{{route('section.destroy',['class_id'=>$class,'section'=>$section->section->id])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Remove
                                                </button>   --}} 

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