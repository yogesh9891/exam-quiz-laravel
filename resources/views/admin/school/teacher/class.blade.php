@extends('layouts.app')
	
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
          
      <h2 class="font-semibold text-xl text-gray-800 leading-tight my-3">Teacher-Class &nbsp; </h2>
  
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                    
                        
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Class</th>
                        <th class="px-4 py-2">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                   
                    
                        <td class="border px-4 py-2">{{$teacher->teacher->name??''}}</td>
                        <td class="border px-4 py-2 d-flex">{{$teacher->class->class->name??'' }}  
                            @php  $collect = collect($teacher->class->sections()->where('teacher_id',$teacher->teacher_id)->get())  @endphp

                         {{ $collect?implode(' | ',array_keys(($collect->groupBy('section.name')->toArray()))):'' }} </td>
                      
                       <td> <a class="btn btn-primary" href="{{ url('schools/'.$teacher->school_id.'/teacher-modify?class='.$teacher->class_id.'&teacher='.$teacher->teacher_id) }}"> Modify</a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection