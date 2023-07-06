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
                Students &nbsp;
                <span class="d-inline float-right"> {{$class->name}}</span>
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">Admission Id</th>
                        <th class="px-4 py-2">Name </th>
                        <th class="px-4 py-2">Class </th>
                        <th class="px-4 py-2">Section </th>
                 
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    
                        <td class="border px-4 py-2">{{$student->user?$student->user->name:'no student'}}</td>
                        <td class="border px-4 py-2">{{$student->admission_id}}</td>
                        <td class="border px-4 py-2">{{$student->class->class->name}}</td>
                        <td class="border px-4 py-2">{{$student->section->section->name}}</td>
                     
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection