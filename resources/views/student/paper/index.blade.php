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
        @if(request()->routeIs('student.papers.saved'))
        Drafts
        @elseif(request()->routeIs('student.papers.sent'))
        Sent Papers
        @else
         Papers &nbsp;
        @endif
               
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
                        <th class="px-4 py-2">Sent By</th>
                        <th class="px-4 py-2" style="width:50px">In Date</th>
                        <th class="px-4 py-2" style="width:50px">Deadline</th>
                 
                        <th class="px-4 py-2" style="width:50px">Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                     @foreach($question_papers as $paper)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $paper->assigned_paper->school->name??'School is Missing' }}</td> --}}
                    
                        <td class="border px-4 py-2">{{$paper->assigned_paper->question_paper->template->subject->name??''}}</td>
                        <td class="border px-4 py-2">{{ $paper->assigned_paper->question_paper->template->title??'School is Missing' }}
                          @if($paper->status !='assign')
                          @if($paper->sent_tag) <span class="badge badge-warning">SBA</span>@endif
                          @if($paper->error_tag) <span class="badge badge-danger">SWE</span>@endif
                          @if($paper->late_tag) <span class="badge badge-info">Late</span>@endif
                          @if($paper->status=='checked'&&$paper->sent_tag&&!$paper->error_tag&&!$paper->late_tag) <span class="badge badge-success">Correct</span>@endif
                          @endif
                        </td>
                        <td class="border px-4 py-2">{{ $paper->teacher->user->name??'School is Missing' }}</td>
                        <td class="border px-4 py-2">{{ $paper->created_at->format('d M')}}</td>
                            @php  $date=date_create($paper->submit_to);   @endphp
                        <td class="border px-4 py-2 text-danger">{{ date_format($date,"d M") }}</td>
                      
                        </td>
                        {{-- <td class="border px-4 py-2">{{ $paper->class->class->name??'Class is Missing' }} -{{ $paper->section->section->name??'Class is Missing' }}</td> --}}
                        <td class="border px-4 py-2">
                            
                            @if($paper->status =='assign')
                             <a href="{{route('student.paper.show',$paper->id)}}" class="btn btn-primary">Open Paper</a>
                            @elseif($paper->status =='saved')
                            <a href="{{route('student.paper.edit',$paper->id )}}" class="btn btn-primary">Open</a>
                            @elseif($paper->status =='submit')
                             <a href="{{route('student.paper.edit',$paper->id)}}" class="btn btn-secondary">Checking</a>
                            @elseif($paper->status =='checked')
                             <a href="{{route('student.paper.checked',$paper->id)}}" class="btn btn-success"> View </a>
                            @elseif($paper->status =='sent'||'sent_saved')

                             <a href="{{route('student.paper.sent_back',$paper->id)}}" class="btn btn-primary">Open Paper</a> 

                               @elseif($paper->status =='sent_back')
                             <a href="{{route('student.paper.checked',$paper->id)}}" class="btn btn-danger">Teacher reviewd</a>
                            @endif




                        </td>
                      {{--   <td class="border px-4 py-2 d-flex">
                            <a href="{{route('question-paper.edit',$paper->number)}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2">Edit</a>
                              <form action="{{route('question-paper.destroy',$paper)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete
                                                </button>   

                            </form>
                     
                        
                        </td> --}}
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection