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
                Manage Paper Top Part &nbsp;
                <a href="{{route('paper.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New </a>
                
     </h2>
       <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">Paper Top Part Name</th>
                        <th class="px-4 py-2">Belongs To Template ID</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($papers as $paper)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                           
                        <td class="border px-4 py-2">{{ $paper->name }}</td>
                        <td class="border px-4 py-2">{{$paper->template->number??'No Template'}}</td>
                        <td class="border px-4 py-2 d-flex">
                                   <a  href="{{route('paper.show',$paper)}}" class="bg-warning hover:bg-green-700 text-white px-4 rounded mr-2">View  </a>
                                    <a href="{{route('paper.edit',$paper)}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2">Edit Top Part</a>
                         	  <form action="{{route('paper.destroy',$paper)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete Top Part
                                                </button>                          

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>


@endsection