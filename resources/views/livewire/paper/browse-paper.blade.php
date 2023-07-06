 <div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight my-3" > Browse Papers  &nbsp;</h2>
    <div class="row">
       {{--   <div class="col-md-12">
             <h2 class="text-info h5"> Filters &nbsp;</h2>
        </div> --}}
                <div class="col-md-4 mt-1">
                    <label>Tree</label>
                    <select class="form-control" wire:model="filter.tree" {{-- wire:click="loadPaper()" --}}>
                        <option value="">--Select Tree --</option>
                        @foreach($trees as $tree)
                        <option value="{{$tree->id}}">{{$tree->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mt-1">
                    <label>Trunk</label>

                    <select class="form-control" wire:model="filter.trunk"   >
                        <option value="">--Select Trunk --</option>
                              @foreach($trunks as $trunk)
                        <option value="{{$trunk->id}}">{{$trunk->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mt-1">
                    <label>Branch</label>

                    <select class="form-control" wire:model="filter.branch">
                        <option value="" selected="">--Select Branch --</option>
                        @if(count($branches) >0))
                              @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                        @else
                        <option value="">None</option>
                        @endif
                    </select>
                </div>
                 <div class="col-md-4 mt-3">
                    <label>Twig</label>

                    <select class="form-control" wire:model="filter.twig">
                        <option value="" selected="">--Select Twig --</option>
                        @if(count($twiges) >0))
                              @foreach($twiges as $twig)
                        <option value="{{$twig->id}}">{{$twig->name}}</option>
                        @endforeach
                    {{--      @else
                        <option value="">None</option> --}}
                        @endif
                    </select>
                </div>
                 <div class="col-md-4 mt-3">
                    <label>Leaf</label>

                    <select class="form-control" wire:model="filter.leaf">
                        <option value="" selected="">--Select Leaf --</option>
                        @if(count($leaves) >0))
                              @foreach($leaves as $leaf)
                        <option value="{{$leaf->id}}">{{$leaf->name}}</option>
                        @endforeach
                      {{--    @else
                        <option value="">None</option> --}}
                        @endif
                    </select>
                </div>
                
                  <div class="col-md-4 mt-3">
                    <label>Vein</label>

                    <select class="form-control" wire:model="filter.vein">
                        <option value="" selected="">--Select Vein --</option>

                        @if(count($veins) >0))
                              @foreach($veins as $vein)
                        <option value="{{$vein->id}}">{{$vein->name}}</option>
                        @endforeach
                      {{--    @else
                        <option value="">None</option> --}}
                        @endif
                    </select>
                </div>
                <div class="col-md-4 col-md-offset-4 mt-3">
                    <label>Class</label>

                    <select class="form-control" wire:model="filter.class">
                        <option value="" selected="">--Select Class --</option>
                        @if(count($classes) >0))
                        @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->class->class->name}}-{{$class->section->name}}</option>
                        @endforeach
                         @else
                        <option value="">None</option>
                        @endif
                    </select>
                </div>
                 <div class="col-md-4  mt-3">
                    <label>Date-Wise </label>

                    <select class="form-control" wire:model="filter.sort">
                        <option value="">Newest</option>
                        <option value="">Oldest</option>
                    </select>
                </div>

           {{--      <div class="col-md-4 mt-3">
                    <label>Section</label>

                    <select class="form-control">
                        <option value="">--Select Section --</option>
                    </select>
                </div>
                <div class="col-md-4 mt-3">
                    <label>Student</label>

                    <select class="form-control">
                        <option value="">--Select Student --</option>
                    </select>
                </div>
                <div class="col-md-4 mt-3">
                    <label>Start Date</label>

                    <input type="date" name="" class="form-control">
                </div>

                <div class="col-md-4 mt-3">
                    <label>End Date</label>
    
                    <input type="date" name="" class="form-control">
                </div>   --}}
                  
    </div>
    <div class="container mt-3">
        <div class="row">

                <div class="col-md-12 ">
                <p class="text-info ">   Papers</p>
                 <p class="text-danger  text-center" wire:loading > {{$loading_message}}</p>

                 </div>

             @if(!empty($objects))
            <nav class="nav" role="navigation" >
        
              <ul class="nav__list col-md-12">

                @foreach($objects as $object)
                <li class=" border border-primary p-2 mb-2">
                    <div class=" border-bottom border-danger p-2">
                        @php $assigned_section = array_keys($object->section_assigned->where('class_id',$object->class_id)->groupBy('section_id')->toArray());
                        sort($assigned_section);
                           
                         @endphp
                    <button class="badge badge-info btn-sm mb-2 "> Assigned To:</button><b>

                          @foreach($assigned_section as $id)
                       @php  $section = \App\Models\Section::with('section','class')->find($id); @endphp

                       @if($section)
                          {{$section->class->class->name}}{{$section->section->name}}
                          @if(!$loop->last)|
                          @endif
                       @endif

                        @endforeach
                        

                    </b>
                      <a href="{{route('teacher.paper.show',$object->id)}}" class=" float-right btn btn-warning btn-sm " >Click to Assign</a>
                    </div>
                    <div class="p-2">
                    <h3 class="text-primary">{{$object->question_paper->number}} ({{$object->template->title}})
                      <button class=" float-right "  data-toggle="modal" data-target="#quetion-meta{{$object->id}}"><i class=" pb-3 fa fa-info-circle"></i></button>
                     </h3>   
                      <h3 class=" h5 text-danger mt-1 col-md-12"> {{$object->question_paper->paper->name}}</h3>
                       <h3 class=" h6  col-md-12 "><b>{{$object->question_paper->paper->defination_heading}}</b><br>{{$object->question_paper->paper->defination_decription}}</h3>

                    
                 </div>
                  <input id="group-{{$object->id}}" type="checkbox" hidden />
                  <label for="group-{{$object->id}}" class="pb-1">
                    <span class="fa fa-plus text-primary"></span>
                   </label>
                          <ul class="group-list">
                            <li> 
                             <div class="row">
                            
                      
                            <h3 class=" h6 pt-2 col-md-12 ml-4"><b>{{$object->question_paper->paper->word_heading}}</b><br>{{$object->question_paper->paper->word_decription}}</h3>
                            <h3 class=" h6  col-md-12 ml-4"><b>{{$object->question_paper->paper->example_heading}}</b><br>{{$object->question_paper->paper->example_decription}}</h3>
             
                      
 
                          <div class="col-md-12 mt-2">
                        @foreach($object->question_paper->question_paper as $no =>$question)
                            {{-- <h1 class="bg-blue-500 hover:bg-blue-700 mt-3  px-4 py-2 rounded  text-white text-uppercase">  </h1> --}}
                                        <h3 class=" h5 mt-3 ml-3"><b>Question: {{$no+1}}: {{$question->question->instruction}}</b></h3>

                                        @foreach($question->question->sub_questions as $key =>$que)
                                      @php $lettter = chr($key+65); @endphp
                                        <h3 class=" h6 mt-3 p-1 ml-3  border border-dark"><b>{{$lettter}}: {{$que->question}}</h3>
                                          <div class="ml-5">
                                                  
                                                     <p>a.&nbsp;&nbsp;{{$que->option_1}}  @if($que->answer =='option_1') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>b.&nbsp;&nbsp;{{$que->option_2}}  @if($que->answer =='option_2') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>c.&nbsp;&nbsp;{{$que->option_3}} @if($que->answer =='option_3') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>
                                                     <p>d.&nbsp;&nbsp;{{$que->option_4}} @if($que->answer =='option_4') <i class="fa fa-check text-success border border-secondary p-2 ml-3"> </i>   <b class="text-primary"> The green tick sign indicates this answer is correct.</b> @endif</p>

                                                 <h3 class=" h6 my-3 p-3  border border-dark"><b class="text-danger">Explaining  the correct answer:</b><br>{{$que->explaination}}</h3>
                                          </div>  
                                             
                                        @endforeach
                            @endforeach
                        </div> 

                            
                      </div>
                            </li>
                          </ul>
                </li>
                        <div class="modal fade mt-5 ml-2 " id="quetion-meta{{$object->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Paper Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                             <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                              <h3 class=" h5 text-danger text-bold"> Paper Title & Number</h3>
                                              <h3 class=" h6 mt-2"> Paper Title: &nbsp;&nbsp; {{$object->template->title}}</h3>
                                                <h3 class=" h6"> Paper Number:  &nbsp;&nbsp; {{$object->question_paper->number}}</h3>
                                        </div>


                                         <div class="col-md-12 text-center mt-3">
                                              <h3 class=" h5 text-danger text-bold"> Paper Layout</h3>
                                              <h3 class=" h6 mt-2"><b> Paper Layout:</b> &nbsp;&nbsp; {{$object->template->subject->name}} / {{$object->template->category->name}} / {{$object->template->branch->name??''}} / {{$object->template->twig->name??''}} / {{$object->template->leaf->name??''}} / {{$object->template->vein->name??'-'}} / C{{$object->template->class->name??''}} - {{$object->template->board->name??''}} / {{$object->template->q_type}}</h3>
                                                  <h3 class=" h6 mt-3"> <b>Tree: </b>&nbsp;&nbsp;{{$object->   template->subject->name}}</h3>
                                                  <h3 class=" h6 "> <b>Trunk:</b> &nbsp;&nbsp; {{$object->template->category->name}}</h3>
                                                  <h3 class=" h6 "> <b>Branch:</b> &nbsp;&nbsp;{{$object->template->branch->name??'None'}}</h3>
                                                  <h3 class=" h6 "> <b>Twig:</b> &nbsp;&nbsp; {{$object->template->twig->name??'None'}}</h3>
                                                  <h3 class=" h6 "><b> Leaf:</b> &nbsp;&nbsp; {{$object->template->leaf->name??'None'}}</h3>
                                                  <h3 class=" h6 "><b>Vein:</b> &nbsp;&nbsp; {{$object->template->vein->name??'None'}}</h3>
                                  
                                        </div>

                                          <div class="col-md-12 text-center m-2">
                                              <h3 class=" h5 text-danger text-bold"> Source Details</h3>
                                              <h3 class=" h6 mt-2"><b> Book Title:</b> &nbsp;&nbsp; {{$object->template->b_title}}</h3>
                                              <h3 class=" h6 "><b> Book Sub title:</b> &nbsp;&nbsp; {{$object->template->b_sub_title}}</h3>
                                              <h3 class=" h6 "><b> ISBN:</b> &nbsp;&nbsp; {{$object->template->isbn}}</h3>
                                              <h3 class=" h6 "><b> Year of Publication:</b> &nbsp;&nbsp; {{$object->template->publication_year}}</h3>
                                              <h3 class=" h6 "><b> Publisher:</b> &nbsp;&nbsp; {{$object->template->publisher}}</h3>
                                              <h3 class=" h6 "><b> Chapter title:</b> &nbsp;&nbsp; {{$object->template->chapter_title}}</h3>
                                        
                                             

                                        </div>

                                          <div class="col-md-12 text-center mt-2">
                                              <h3 class=" h5 text-danger text-bold"> Creater Details</h3>
                                  
                                              <h3 class=" h6 "><b> Creater:</b> &nbsp;&nbsp; {{$object->template->creater}}</h3>
                                              <h3 class=" h6 "><b> Created At:</b> &nbsp;&nbsp; {{$object->template->created_at}}</h3>
                                  
                                        
                                             
                                        </div>
                               
                                  </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                @endforeach
              </ul>
        
            </nav>
          {{--   @else
             <div class="col-md-12 ">
              
                 <h2 class="text-danger h3 text-center"  >No Paper Found </h2>

                 </div> --}}
            @endif
        </div>
    </div>
</div>