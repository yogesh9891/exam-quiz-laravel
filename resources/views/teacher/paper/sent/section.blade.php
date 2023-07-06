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
               Classes
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        <th class="px-4 py-2">Class - Sec </th>
                        {{-- <th class="px-4 py-2">Teacher </th> --}}
                        {{-- <th class="px-4 py-2">Total Students </th> --}}
                        <th class="px-4 py-2">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($section_assigneds as $section)
              
                    {{-- @foreach($sections as $section) --}}
                    <tr>
                 
                    
                        <td class="border px-4 py-2">{{$section->class?$section->class->class->name:'no class'}} - {{$section->section->section->name??'no section'}}</td>
             
                     
                          </td>
                           <td class="border px-4 py-2">{{$section->section_student_count}}</td>
                           <td class="border px-4 py-2">  <a href="{{route('section.edit',['class_id'=>$section->class_id,'section'=>$section->section->id])}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2"> View Students</a></td>
                       
                       
                    </tr>
                    {{-- @endforeach --}}
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection