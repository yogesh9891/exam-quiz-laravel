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
      
     
        Sent Papers
      
               
                {{-- <a href="{{route('question-paper.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create Section  </a> --}}
             
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        {{-- <th class="px-4 py-2">School </th> --}}
                    {{--     <th class="px-4 py-2">Paper ID </th> --}}
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Sent To</th>
                        <th class="px-4 py-2" style="width:50px">In Date</th>
                        <th class="px-4 py-2" style="width:50px">Deadline</th>
                 
                    
                       
                    </tr>
                </thead>
                <tbody>
                     @foreach($question_papers as $paper)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $paper->assigned_paper->school->name??'School is Missing' }}</td> --}}
                    
                        <td class="border px-4 py-2">{{$paper->assigned_paper->question_paper->template->subject->name??''}}</td>
                        <td class="border px-4 py-2">{{ $paper->assigned_paper->question_paper->template->title??'School is Missing' }}@if($paper->sent_tag)  &nbsp;&nbsp;<span class="badge badge-danger">SBA</span>@endif</td>
                        <td class="border px-4 py-2">{{ $paper->teacher->user->name??'School is Missing' }}</td>
                        <td class="border px-4 py-2">{{ $paper->created_at->format('d M')}}</td>
                            @php  $date=date_create($paper->submit_to);   @endphp
                        <td class="border px-4 py-2 text-danger">{{ date_format($date,"d M") }}</td>
                      
                      
                   
                      
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection