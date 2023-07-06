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
                Manage Class &nbsp;
                <a href="{{route('class.create',$school->id)}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create  Class </a>
                <span class="d-inline float-right">{{$school->school_id}} - {{$school->name}}</span>
                
     </h2>
       <table class="table-fixed w-full" id="DataTable">
                <thead>
                    <tr class="bg-gray-100">
                      {{--   <th class="px-4 py-2 w-20">No.</th> --}}
                        
                        <th class="px-4 py-2">Class </th>
                        <th class="px-4 py-2">Manage</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                    <tr>
                        {{-- <td class="border px-4 py-2">{{ $loop->iteration }}</td> --}}
                    
                        <td class="border px-4 py-2">{{$class->class?$class->class->name:'no class'}}</td>
                        <td class="border px-4 py-2 d-flex">
                    
                                 <a href="{{route('class.edit',['school_id'=>$school->id,'class'=>$class->id])}}" class="bg-warning hover:bg-warning-700 text-white px-4 rounded mr-2"> View / Assign Teacher </a> 

                            <a href="{{ route('section.index',$class->id) }}" class="bg-success hover:bg-green-700 text-white px-4 rounded mr-2"> View / Add / Edit Section </a>
                            </form>
                         	  <form action="{{route('class.destroy',['school_id'=>$school->id,'class'=>$class->id])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Remove
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