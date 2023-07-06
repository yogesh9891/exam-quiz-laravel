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

                <div class="font-semibold text-xl text-gray-800 leading-tight">
                <button wire:click="back()" class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</button>
              <span class="text-center"> PREVIEW FULL QUESTION PAPER TEMPLATE</span>
                
     </div>

        <form>
      <div class="bg-white  sm:p-6 sm:pb-4">
        <div class="row">
            <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded  text-white text-uppercase">Paper Title and Number</h1>
             </div>
             
                 
               
                  <h1 class="col-md-10 h4"> Paper Title &nbsp;&nbsp; {{$paper->title}}</h1>
                  <h1 class="col-md-10 mt-2 h4"> Paper Number &nbsp;&nbsp; {{$paper->number}}</h1>
              
            
             <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mt-5 px-4 py-2 rounded  text-white text-uppercase">Subject Tree And Class</h1>
             </div>

             <table class="table table-bordered ml-3">
                
                  <tbody>
                    <tr>
                
                      <th scope="row">Tree</th>
                      <th>{{$paper->subject->name}}</th>
                    
                    </tr>
                    <tr>
                      <th scope="row">Trunk</th>
                      <td>{{$paper->category->name}}</td>
                 
                    </tr>
                    <tr><th scope="row">Branch</th><td>{{$paper->branch?$paper->branch->name:'None'}}</td></tr>
                    <tr><th scope="row">Twig</th><td>{{$paper->twig?$paper->twig->name:'None'}}</td></tr>
                    <tr><th scope="row">Leaf</th><td>{{$paper->leaf?$paper->leaf->name:'None'}}</td></tr>
                    <tr><th scope="row">Vein</th><td>{{$paper->vein?$paper->vein->name:'None'}}</td></tr>
                  </tbody>
                </table>
                  <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mt-5 px-4 py-2 rounded  text-white text-uppercase">Source Details</h1>
             </div>

             <table class="table table-bordered ml-3">
                
                  <tbody>
                    <tr>
                
                      <th scope="row">Book Title</th>
                      <th>{{$paper->b_title}}</th>
                    
                    </tr>
                    <tr>
                      <th scope="row">Book Sub title</th>
                      <td>{{$paper->b_sub_title}}</td>
                 
                    </tr>
                    <tr><th scope="row">ISBN</th><td>{{$paper->isbn}}</td></tr>
                    <tr><th scope="row">Year of Publication</th><td>{{$paper->publication_year}}</td></tr>
                    <tr><th scope="row">Publisher</th><td>{{$paper->publisher}}</td></tr>
                    <tr><th scope="row">Source Chapter Title</th><td>{{$paper->chapter_title}}</td></tr>
                  </tbody>
                </table>
                   <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 mt-5 px-4 py-2 rounded  text-white text-uppercase">Creater Details</h1>
             </div> 
              <table class="table table-bordered ml-3">
                
                  <tbody>
                    <tr>
                
                      <th scope="row">Creater</th>
                      <th>{{$paper->creater}}</th>
                    
                    </tr>
                    <tr>
                      <th scope="row">Created at</th>
                      <td>{{$paper->created_at}}</td>
                 
                    </tr>
               </tbody>
           </table>
   </div>
</div>
</div>


@endsection
