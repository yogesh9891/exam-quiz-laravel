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
     <h2 class="font-semibold text-xl text-gray-800 mb-3 leading-tight">
                Manage  Paper   Templates &nbsp;
                <a href="{{route('template.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New </a>
                
     </h2>
       <table class="table-fixed w-full mt-2" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Template Number</th>
                        <th class="px-4 py-2">Template Title (Explains Temp ID)</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($papers as $paper)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2"> {{ $paper->number }}</td>
                        <td class="border px-4 py-2">{{ $paper->title }}</td>
                        <td class="border px-4 py-2 d-flex">
                            <a  href="{{route('template.show',$paper->id)}}"class="bg-warning fo hover:bg-blue-700 px-4 rounded text-white mr-2" wire:click="show({{ $paper->id }})">View</a>
                             <a href="{{route('template.edit',$paper->id)}}" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white mr-2">Edit</a>
                              <form action="{{route('template.destroy',$paper->id)}}" method="post">
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