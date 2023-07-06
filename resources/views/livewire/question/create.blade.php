    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <button wire:click="back()" class="btn btn-sm btn-warning"><i class="pe-7s-left-arrow"> </i> Back</button>
                &nbsp;
 Add Question &nbsp;
                
     </h2>

        <form>
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="row">

  
   
                <div class="col-md-12">
                     <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Question :</label>
                    <textarea wire:model="question" class="form-control required" name="question" id="question"></textarea>
                    @error('question') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
           
               <div class="col-md-6 form-group mt-3"> 

                <button wire:click.prevent="store()" type="button" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded  text-white">
                 Save
                  </button>
              </div>
            </div>
        </div>
    </div>
</form>

@section('afterScript')

<script>
      CKEDITOR.replace( 'question' );
</script>
@endsection