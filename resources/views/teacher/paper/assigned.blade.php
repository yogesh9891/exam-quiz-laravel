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
               Assigned Papers &nbsp;
                {{-- <a href="{{route('question-paper.create')}}" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create Section  </a> --}}
             
                
     </h2>
       <table class="table-fixed w-full" id="table">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                     

                        <th class="px-4 py-2">Paper ID </th>
               
                        <th class="px-4 py-2 filter">Tree</th>
                        <th class="px-4 py-2 filter ">Trunk</th>
                        <th class="px-4 py-2 filter">Branch</th>
                        <th class="px-4 py-2 filter">Twig</th>
                        <th class="px-4 py-2 filter">Leaf</th>
                        <th class="px-4 py-2 filter">Vein</th>
                        <th class="px-4 py-2 filter" style="width:50px;">Class</th>
                        <th class="px-4 py-2 filter" style="width:50px;">Section</th>
                        <th class="px-4 py-2" style="width:50px;">Action</th>
                       
                    </tr>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">No.</th> --}}
                        
                     

                        <td class="px-4 py-2">Papper ID </td>
               
                        <td class="px-4 py-2 filter">Tree</td>
                        <td class="px-4 py-2 filter ">Trunk</td>
                        <td class="px-4 py-2 filter">Branch</td>
                        <td class="px-4 py-2 filter">Twig</td>
                        <td class="px-4 py-2 filter">Leaf</td>
                        <td class="px-4 py-2 filter">Vein</td>
                        <td class="px-4 py-2 filter" style="widtd:50px;">Class</td>
                        <td class="px-4 py-2 filter" style="widtd:50px;">Section</td>
                        <td class="px-4 py-2" style="width:50px;">Action</td>
                       
                    </tr>

                </thead>
                <tbody>
                     @foreach($question_papers as $paper)
                     @foreach($paper->section_assigned->groupBy('section_id') as $value =>$section)
                    <tr>
                
                        <td class="border px-4 py-2">{{$paper->question_paper->number}}</td>
                        <td class="border px-4 py-2">{{ $paper->template->subject->name??'None' }}</td>
                        <td class="border px-4 py-2">{{ $paper->template->category->name??'None' }}</td>
                        <td class="border px-4 py-2">{{ $paper->template->branch->name??'None' }}</td>
                        <td class="border px-4 py-2">{{ $paper->template->twig->name??'None' }}</td>
                        <td class="border px-4 py-2">{{ $paper->template->leaf->name??'None' }}</td>
                        <td class="border px-4 py-2">{{ $paper->template->vein->name??'None' }}</td>
                    
                        <td class="border px-4 py-2"style="widtd:50px;" >{{ $paper->class->class->name??'Class is Missing' }}</td>
                        <td class="border px-4 py-2">{{$section[0]->section->section->name??''}}</td>
                
                        <td class="border px-4 py-2 ">
                            <a href="{{route('teacher.paper.show',$paper->id)}}" class="btn btn-warning btn-sm"> Assign More </a>
                            <a href="{{route('teacher.paper.students',['type'=>'assigned','section'=>$section[0]->section_id??'','question_paper'=>$section[0]->assigned_paper->id??''])}}" class="btn btn-primary btn-small"> View</a>
                        
                        
                        </td> 
                       
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>


   </div>
</div>
</div>



@endsection

@section('afterScript')
<script type="text/javascript">



    var table = $('#table').DataTable();
 
    $("#table thead td").each( function ( i ) {
        console.log(i)
    if(i!=0&&i!=9){

                let text =  $(this).text()
        var select = $('<select class="form-control"><option value="">'+text+'</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( i )
                    .search( $(this).val() )
                    .draw();
            } );
 
            

        table.column( i ).data().unique().sort().each( function ( d, j ) {
   
            select.append( '<option value="'+d+'">'+d+'</option>' )

            
    } );
    }
} );
</script>

</script>
@endsection