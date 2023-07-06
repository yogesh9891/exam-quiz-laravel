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
               Classes -Section-Teacher
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">Class </th>
                        <th class="px-4 py-2">Section </th>
                        <th class="px-4 py-2">Teacher </th>
                        <th class="px-4 py-2">Total Students </th>
              {{--           <th class="px-4 py-2">Action</th> --}}
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)

                    @foreach($class->sections as $section)
                    <tr>
                        <td class="border px-4 py-2">{{ $section->id }}</td>
                        <td class="border px-4 py-2">{{ $class->class->name }}</td>
                        <td class="border px-4 py-2">{{ $section->section->name }}</td>
                        <td>   @if($section->teacher)
                                      <label class="badge badge-success">{{ $section->teacher->name }}</label>
                            @else

                                      <label class="badge badge-danger">No Teacher Assigned</label>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $section->section_student_count }}</td>                      
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection