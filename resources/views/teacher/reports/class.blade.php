@extends('layouts.app')
@section('before_body')

<style type="text/css">

</style>
@endsection
@section('content')
<div class="py-12">

            @livewire('reports.classes',['class'=>$class_array])
      

</div>
@endsection
@section('afterScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
 $(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
  </script>
@endsection
