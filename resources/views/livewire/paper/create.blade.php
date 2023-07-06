    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <button wire:click="back()" class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</button>
                &nbsp;
 Create Paper &nbsp;
                
     </h2>

        <form>
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

            

              <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Paper Title and Number</h1>
             </div>
              <div class="col-md-6 form-group">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Paper Title</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Paper Title" wire:model="title">
                  @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-6 form-group">
                  <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Paper Number :</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Paper Number" wire:model="number">
                  @error('number') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
             <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Subject Tree And Class</h1>
             </div>
              <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Tree</label>
                  <select wire:model="subject_id" name="subject_id" class="form-control" >
                           <option value="" selected>--Select Subject--</option>
                @foreach($trees as $tree)
                <option value="{{$tree->id}}">{{$tree->name}}</option>
                @endforeach
                </select> 

                @error('subject_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Trunk :</label>
                  <select  wire:change="changeEvent($event.target.value,4)" wire:model="category_id" name="category_id" class="form-control" >
                     <option value="" selected>--Select Topic--</option>
                  @foreach($trunks as $trunk)
                        <option value="{{$trunk->id}}">{{$trunk->name}}</option>
                 @endforeach
                </select> 
                   @error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Branch :</label>
                 @if($branches)
                  <select  wire:change="changeEvent($event.target.value,3)"  wire:model="branch_id" name="branch_id" class="form-control" >
                   @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                 @endforeach
                 @endif
                </select> 

              </div>

            

               <div class="col-md-3 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Twig :</label>
                  @if($twiges)
                  <select  wire:change="changeEvent($event.target.value,2)" wire:model="twig_id" name="twig_id" class="form-control" >
                  @foreach($twiges as $twig)
                        <option value="{{$twig->id}}">{{$twig->name}}</option>
                 @endforeach
                </select> 
                @endif
              </div>
              <div class="col-md-12 my-3"></div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Leaf :</label>
                 @if($leaves)
                  <select  wire:change="changeEvent($event.target.value,1)" wire:model="leaf_id" name="leaf_id" class="form-control" >
                  @foreach($leaves as $leaf)
                        <option value="{{$leaf->id}}">{{$leaf->name}}</option>
                 @endforeach
                 @endif
                </select> 
              </div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Vein :</label>
                  @if($veins)
                  <select wire:model="type" name="vein_id" wire:model="vein_id" class="form-control" >
                  @foreach($veins as $vein)
                        <option value="{{$vein->id}}">{{$vein->name}}</option>
                 @endforeach
                 @endif
                </select> 
              </div>
               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Class :</label>
                  <select wire:model="class_id" name="class_id" class="form-control"  wire:model="class_id" required>
                  @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
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
                  <select wire:model="board_id" name="board_id" class="form-control" required>
          
                  @foreach($boards as $board)
                        <option value="{{$board->id}}">{{$board->name}}</option>
                 @endforeach
                 @endif
                </select> 
                 @error('board_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">State Board :</label>
                      @if($states)
                  <select wire:model="state_id" name="state_id" class="form-control" required>
                  <option>--Select State Board</option>
                  @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                 @endforeach
               </select>
                @error('state_id') <span class="text-red-500">{{ $message }}</span>@enderror
                 @endif
              </div>

               <div class="col-md-4 form-group">
                 <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Q-Type :</label>
                  <select wire:model="q_type" name="q_type" class="form-control" required>
                  <option value="Essay Type">Essay Type</option>
                  <option value="Mixed">Mixed</option>
                  <option value="MCQ">MCQ</option>
                </select> 
                  @error('q_type') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                  <div class="col-md-12">
                    <h1 class="bg-blue-500 hover:bg-blue-700 my-5 px-4 py-2 rounded  text-white text-uppercase">Source Details</h1>
             </div>
                <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Title</label>
               <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Title" wire:model="b_title">
                  @error('b_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Sub-Title</label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Sub title" wire:model="b_sub_title">
                  @error('b_sub_title') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                 <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Book Publisher</label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Publisher" wire:model="publisher">
                  @error('publisher') <span class="text-red-500">{{ $message }}</span>@enderror
              </div> 

              <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">ISBN, PUB YEAR & CHAPTER </label>
                <div class="col-md-4 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Book Isbn" wire:model="isbn">
                  @error('isbn') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-4 form-group">

                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Publication Year" wire:model="publication_year">
                    @error('publication_year') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
                <div class="col-md-2 form-group">
                  <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Chapter" wire:model="chapter_source" min="1">
                    @error('chapter_source') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>

                 <label for="exampleFormControlInput1" class=" col-md-2 block text-gray-700 text-sm font-bold mb-2">Chapter Title & Chapter Number</label>
                <div class="col-md-10 form-group">
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Chapter Title & Chapter Number" wire:model="chapter_title">
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

                <button wire:click.prevent="store()" type="button" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded  text-white">
                 Save
                  </button>
              </div>

        </div>
      </div>
  </form>