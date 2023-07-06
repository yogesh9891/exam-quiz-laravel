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
                Manage Schools &nbsp;
                <a href="{{route('admin.schools.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New </a>
                
     </h2>
     
        
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">School ID</th>
                        <th class="px-4 py-2">Action</th>
                        <th class="px-4 py-2">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    
                        <td class="border px-4 py-2"><a href="{{route('report.school',$school)}}">{{$school->school_id }}  ( {{( $school->school?$school->school->name:'' ) }} )</a></td>
                        <td class="border px-4 py-2 d-flex">
                        <a href="{{route('admin.schools.edit',$school->id)}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2">Edit School</a> 
                         	  <form action="{{route('admin.schools.destroy',$school->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete School
                                                </button>                          
                                        </form>
                        </td>
                         <td class="border px-4 py-2">
                                 <a href="{{ route('teachers.index',$school) }}" class="bg-success hover:bg-green-700 text-white px-4 rounded mr-2"> Teachers </a>

                                <a href="{{ route('student.index',$school) }}" class="bg-info hover:bg-green-700 text-white px-4 rounded mr-2"> Students </a>                    

                                 <a href="{{ route('class.index',$school) }}" class="bg-warning hover:bg-warning-700 text-white px-4 rounded mr-2">  Teacher-Class Realtionship </a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection