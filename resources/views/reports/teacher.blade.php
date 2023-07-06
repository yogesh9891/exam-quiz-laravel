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
          Teacher
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        <th class="px-4 py-2">Name </th>
                        <th class="px-4 py-2">Classes </th>
                  {{--       <th class="px-4 py-2">Email </th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Gender</th> --}}
              {{--           <th class="px-4 py-2">Action</th> --}}
                       
                    </tr>
                </thead>
                <tbody>
                  

                    @foreach($teachers as $teacher)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $teacher->teacher_id }}</td> --}}
                        <td class="border px-4 py-2">{{ $teacher->user->name }}</td>
                   {{--      <td class="border px-4 py-2">{{ $teacher->user->email }}</td>
                        <td class="border px-4 py-2">{{ $teacher->user->phone }}</td> --}}
                        <td class="border px-4 py-2">{{ $teacher->section_assigned }}</td>
                                           
                    </tr>
                    @endforeach
             
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection