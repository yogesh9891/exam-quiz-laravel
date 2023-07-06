@extends('layouts.app')
@section('before_body')

<style type="text/css">

</style>
@endsection
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


            @livewire('reports.paper',['class'=>$class_array])

        </div>
   </div>
</div>
@endsection
@section('afterScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
@endsection