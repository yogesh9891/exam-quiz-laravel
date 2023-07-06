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
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('template.index')}}" class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</a>
                &nbsp;
 Edit  Template &nbsp;
                
     </h2>

        <form action="{{route('template.update',$paper->id)}}" method="post">
          @csrf
          @method('put')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">  
        <div class="row">

            

              <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Paper Title and Number</h1>
             </div>
              <div class="col-md-12 form-group">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Paper Title</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Template Title" name="title" value="{{old('title',$paper->title)}}">
                  @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              {{--   <div class="col-md-6 form-group">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Paper Number :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Paper Number" name="number" value="{{old('number',$paper->number)}}">
                  @error('number') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> --}}
             <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Subject Tree And Class</h1>
             </div>
              <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Tree</label>
                  <select wire:model="subject_id" name="subject_id" class="form-control" >
                           <option value="" selected>--Select Subject--</option>
                @foreach($trees as $tree)
                <option value="{{$tree->id}}" @if($paper->subject_id == $tree->id) selected="" @endif>{{$tree->name}}</option>
                @endforeach
                </select> 

                @error('subject_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Trunk :</label>
                  <select   name="category_id" class="form-control" data-type="Branch" onchange="getcategory(this)" data-child="branch_html" >
                     <option >--Select Topic--</option>
                  @foreach($trunks as $trunk)
                        <option value="{{$trunk->id}}" @if($paper->category_id == $trunk->id) selected="" @endif>{{$trunk->name}}</option>
                 @endforeach
                </select> 
                   @error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Branch :</label>
                          <select wire:model="subject_id" name="branch_id" class="form-control"  id="branch_html"  data-type="Twig" onchange="getcategory(this)" data-child="twig_html">
                           <option value="" >--Select Branch--</option>
                           @if($paper->branch_id)
                             @foreach($branches as $branch)
                              <option value="{{$branch->id}}"  @if($paper->branch_id == $branch->id) selected="" @endif>{{$branch->name}}</option>
                            @endforeach
                           @else
                           <option  value="">None</option>
                           @endif
                </select> 

              </div>

            

               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Twig :</label>
                
                  <select wire:model="subject_id" name="twig_id" class="form-control"  id="twig_html" data-type="Leaf" onchange="getcategory(this)" data-child="leaf_html">
                           <option value="" selected>--Select Twig--</option>
                            @if($paper->twig_id)
                             @foreach($twiges as $twig)
                              <option value="{{$twig->id}}"  @if($paper->twig_id == $twig->id) selected="" @endif>{{$twig->name}}</option>
                              @endforeach
                           @else
                           <option value="">None</option>
                           @endif
                         </select>
              </div>
              <div class="col-md-12 my-3"></div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Leaf :</label>
                  <select wire:model="subject_id" name="leaf_id" class="form-control" id="leaf_html"  data-type="Vein" onchange="getcategory(this)" data-child="vein_html" >
                           <option value="" selected>--Select Leaf--</option>
                            @if($paper->leaf_id)
                             @foreach($leaves as $leaf)
                             <option value="{{$leaf->id}}"  @if($paper->leaf_id == $leaf->id) selected="" @endif>{{$leaf->name}}</option>
                            @endforeach
                           @else
                           <option value="">None</option>
                           @endif
                </select> 
              </div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Vein :</label>
                  <select wire:model="subject_id" name="vein_id" class="form-control"  id="vein_html">
                           <option value="" selected>--Select Vein--</option>
                            @if($paper->vein_id)
                               @foreach($veins as $vein)
                              <option value="{{$vein->id}}"  @if($paper->vein_id == $vein->id) selected="" @endif>{{$vein->name}}</option>
                       @endforeach
                           @else
                           <option value="">None</option>
                           @endif
                </select> 
              </div>
               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Class :</label>
                  <select wire:model="class_id" name="class_id" class="form-control"  wire:model="class_id" required>
                  @foreach($classes as $class)
                        <option value="{{$class->id}}"  @if($paper->class_id == $class->id) selected="" @endif>{{$class->name}}</option>
                 @endforeach
                </select> 
                   @error('class_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Board and Q type</h1>
             </div>
              <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Board :</label>
                  @if($boards)
                  <select wire:model="board_id" name="board_id" class="form-control" id="board" required>
          
                  @foreach($boards as $board)
                        <option value="{{$board->id}}"  @if($paper->board_id == $board->id) selected="" @endif >{{$board->name}}</option>
                 @endforeach
                </select> 
                 @endif
                 @error('board_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">State Board :</label>
                <div id="state_html">
                   @if($paper->state_id)
                    <select  name="state_id" class="form-control" >
                           <option selected>--Select State--</option>
                               @foreach($states as $state)
                              <option value="{{$state->id}}"  @if($paper->state_id == $state->id) selected="" @endif>{{$state->name}}</option>
                            @endforeach 
                           @endif
                </select>

                </div>
              
              </div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Q-Type :</label>
                  <select wire:model="q_type" name="q_type" class="form-control" required>
                  <option value="Essay Type"  @if($paper->q_type == 'Essay Type') selected="" @endif  >Essay Type</option>
                  {{-- <option value="Mixed"  @if($paper->q_type == 'Mixed') selected="" @endif >Mixed</option> --}}
                  <option value="MCQ"  @if($paper->q_type == 'MCQ') selected="" @endif >MCQ</option>
                </select> 
                  @error('q_type') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                  <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Source Details</h1>
             </div>
                <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Title</label>
               <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Title" value="{{old('b_title',$paper->b_title)}}" name="b_title">
                  @error('b_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Sub-Title</label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Sub title" value="{{old('b_sub_title',$paper->b_sub_title)}}" name="b_sub_title">
                  @error('b_sub_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                 <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Publisher</label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Publisher" value="{{old('publisher',$paper->publisher)}}" name="publisher">
                  @error('publisher') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> 

              <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">ISBN, PUB YEAR & CHAPTER </label>
                <div class="col-md-4 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Isbn"value="{{old('isbn',$paper->isbn)}}" name="isbn">
                  @error('isbn') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-4 form-group">

                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Publication Year" value="{{old('publication_year',$paper->publication_year)}}" name="publication_year">
                    @error('publication_year') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-2 form-group">
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Chapter" name="chapter_source" value="{{old('chapter_source',$paper->chapter_source)}}" min="1">
                    @error('chapter_source') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                 <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Chapter Title </label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Chapter Title" value="{{old('chapter_title',$paper->chapter_title)}}" name="chapter_title">
                  @error('chapter_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> 

                 {{-- <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Paper Create & Date</label>
                <div class="col-md-5 form-group">
                   <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Chapter Title" wire:model="chapter_title">
                    @error('chapter_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> 
              <div class="col-md-5 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Paper Number" wire:model="number">
                  @error('number') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> --}}

               <div class="col-md-6 form-group mt-3"> 

                <button  type="submit" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded  text-white">
                 Save
                  </button>
              </div>

        </div>
      </div>
  </form>
   </div>
</div>
</div>


@endsection



@section('afterScript')
<script type="text/javascript">

function getcategory(e) {

      let  $parent_id = $(e).val();
      let type = $(e).attr('data-type');
      let child = $(e).attr('data-child');

        $.ajax({
                  type: "POST",
                  url:'{{ route('get-category') }}',
                  data: {parent_id:$parent_id,type:type},
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                    if(data.success){

                     $('#'+child).html(data.html)
                    }
                  }
                });
}

$('#board').change(function () {
 let board = $(this).val();

   $.ajax({
                  type: "POST",
                  url:'{{ route('get-board') }}',
                  data: {board_id:board},
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                    if(data.success){

                     $('#state_html').html(data.html)
                    } else {
                         $('#state_html').html('')
                    }
                  }
                });
})
    
</script>


@endsection
