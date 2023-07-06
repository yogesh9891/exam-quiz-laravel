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
               Students
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        <th class="px-4 py-2">Adminssion ID </th>
                        <th class="px-4 py-2">Roll No </th>
                        <th class="px-4 py-2">Name </th>
                        <th class="px-4 py-2" style="width:200px">Email </th>
                        <th class="px-4 py-2" style="width: 50px;">Class</th>
                        <th class="px-4 py-2"  style="width: 50px;">Sec</th>
              {{--           <th class="px-4 py-2">Action</th> --}}
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $section)

                    	
                  			  @foreach($section->section_student as $student)
			                    <tr>
			                          
			                         
			         	   <td class="border px-4 py-2">{{$student->admission_id}}</td>	
			         	   <td class="border px-4 py-2">{{$student->roll_no}}</td>	
			         	   <td class="border px-4 py-2">{{$student->user->name}}</td>	
			         	   <td class="border py-2" >{{$student->user->email}}</td>	
                        <td class="border px-4 py-2" >{{$section->class?$section->class->class->name:'no class'}} </td>
                           <td class="border px-4 py-2">{{$section->section?$section->section->name:'no section'}}</td>  
			                        

			                      
			                       
			                    </tr>
                  		  @endforeach
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection