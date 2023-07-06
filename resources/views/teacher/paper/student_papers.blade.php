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
                {{-- Recieved From Class 7-B&nbsp; --}}
                List of  Papers From Class {{ $section->class->class->name??'' }} - {{ $section->section->name??'' }}&nbsp;
        
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">Paper ID</th> --}}
                        
                        <th class="px-4 py-2">Name </th>
                        <th class="px-4 py-2">Admission ID</th>
                    
                        <th class="px-4 py-2">Action </th>
                 
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($student_assigneds as $paper)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $paper->assigned_paper->question_paper->number }}</td> --}}
                    
                        <td class="border px-4 py-2">{{$paper->student->user->name??'no student'}}
                            @if($paper->sent_tag) <span class="badge badge-warning">SBA</span>@endif
                            @if($paper->error_tag) <span class="badge badge-danger">SWE</span>@endif
                            @if($paper->late_tag) <span class="badge badge-info">Late</span>@endif
                            @if($paper->status=='checked'&&!$paper->sent_tag&&!$paper->error_tag&&!$paper->late_tag)

                             <span class="badge badge-success text-capitalize">All correct</span> @endif
                        </td>
                        <td class="border px-4 py-2">{{$paper->student->admission_id}}</td>
                      
                          <td class="border px-4 py-2">
                            @if($paper->status =='assign'|| $paper->status=='saved')
                            <span class="badge badge-danger">Not Submitted</span>
                            @else
                            <a href="{{route('teacher.paper.answer',$paper->id)}}" class="btn btn-primary btn-sm">View </a>
                            @endif
        
                          
                     
                        
                        </td> 
                     
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection