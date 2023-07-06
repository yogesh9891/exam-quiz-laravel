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
                Manage School Teacher &nbsp;
                <a href="{{route('teachers.create',$school->id)}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New </a>
                <a href="{{route('report.school.teachers',$school->id)}}" class="btn btn-warning ml-3 ">Reports </a>
                <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
                
     </h2>
            <div class="d-flex mt-4  ">
           <form action="{{ route('teacher-import',$school->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4 d-flex col-md-6" style="max-width: 500px; margin: 0 auto;">
                    <input type="file" name="file" class="">
                
            </div>
            <button class="btn btn-primary mb-3">Import File</button>
          
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
                        
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    
                        <td class="border px-4 py-2">{{$teacher->user?$teacher->user->name:'no teacher'}}</td>
                        <td class="border px-4 py-2 d-flex">
                        <a href="{{url('schools/'.$school->id.'/teachers/'.$teacher->teacher_id.'/edit')}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white">Edit</a>
                         	  <form action="{{route('teachers.destroy',['school_id'=>$school->id,'teacher'=>$teacher->teacher_id])}}" method="post">
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