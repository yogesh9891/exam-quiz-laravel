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
        Recieved Papers
    </h2>
     </table>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                       
                        <th class="px-4 py-2" style="">Paper ID  </th>
                        <th class="px-4 py-2" style="">Paper Title  </th>
                        <th class="px-4 py-2" style="width:50px">Class  </th>
                        <th class="px-4 py-2" style="width:20px">Sec  </th>
                        <th class="px-4 py-2" style="width:50px"> Sent   </th>
                        <th class="px-4 py-2" style="width:30px"> Recd   </th>
                        <th class="px-4 py-2" style="width:50px">Action </th>
                   
                       
                    </tr>
                </thead>
                <tbody>
                   @foreach($student_assigned as $number => $papers)
             
                    @foreach($papers as $title =>$classes)
                        @foreach($classes as $class_name =>$class)
                          @foreach($class as $section_name =>$sections)
                          @foreach($sections->whereIn('status',['submit','resubmit'])->unique('section_id') as $section)

                  <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $title }}</td>
                    <td>{{ $class_name }}</td>
                    <td>{{ $section_name }}</td>
                    <td>{{ $sections->count() }}</td>
                    <td>{{ $sections->whereIn('status',['submit','resubmit'])->count() }}</td>
                      
                           <td class="border px-4 py-2">  <a href="{{route('teacher.paper.students',['type'=>'recieved','section'=>$section->section_id??'','question_paper'=>$section->assigned_paper->id??''])}}" class="btn btn-primary btn-small"> View</a></td> 
                {{--         <td class="border px-4 py-2">{{$paper->question_paper->number??''}}</td>
                        <td class="border px-4 py-2">{{$paper->question_paper->template->title??''}}</td>
                        <td class="border px-4 py-2">{{$paper->student_assigned_paper->class->class->name??''}}</td>
                        <td class="border px-4 py-2">{{$paper->student_assigned_paper->section->section->name??''}}</td>
                        <td class="border px-4 py-2">40</td>
                        <td class="border px-4 py-2">1</td>
                
                           --}}
                 
                    
                      
                       
                    </tr> 
                    @endforeach
                    @endforeach
                    @endforeach
                    @endforeach
                    @endforeach
               {{--      @foreach($sections as $section)
                    <tr>
                       
        
             
                     
                          </td>
                           <td class="border px-4 py-2">{{$section->class->class->name??'no section'}}</td>
                           <td class="border px-4 py-2">{{$section->section?$section->section->name:'no section'}}</td>
                    
                           <td class="border px-4 py-2">{{$section->submit_papers_count}}/{{$section->assigned_papers_count}}</td>
                      
                       
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection