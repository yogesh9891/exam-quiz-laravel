<div>
   <h2 class="font-semibold text-xl text-gray-800 leading-tight my-3" > Generate Reports - Paper   &nbsp;</h2>
   <div class="row">
                   

                            <div class="col-md-4 mt-3">
                                <label>Class</label>

                                 <select class="form-control" wire:model="filter.class">
                                    <option value="" selected="">--Select Class --</option>
                                    @if(count($classes) >0))
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class->name}}</option>
                                    @endforeach
                                     @else
                                    <option value="">None</option>
                                    @endif
                                </select>
                            </div>
                             <div class="col-md-4 mt-3">
                                <label>Section</label>

                                <select class="form-control" wire:model="filter.section">
                                    <option value="">--Select Section --</option>

                                        @if($sections)
                                              @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->section->name}}</option>
                                        @endforeach
                                     
                                        @endif
               
                                </select>
                            </div>
                                   <div class="col-md-4 mt-3">
                            <label>Tree</label>
                            <select class="form-control" wire:model="filter.tree" {{-- wire:click="loadPaper()" --}}>
                                <option value="">--Select Tree --</option>
                                @foreach($trees as $tree)
                                <option value="{{$tree->id}}">{{$tree->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Trunk</label>

                            <select class="form-control" wire:model="filter.trunk"   >
                                <option value="">--Select Trunk --</option>
                                      @foreach($trunks as $trunk)
                                <option value="{{$trunk->id}}">{{$trunk->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
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
                                <label>Start Date</label>

                                <input type="date" name="" class="form-control" wire:model="filter.start_date" >
                            </div>

                            <div class="col-md-4 mt-3">
                                <label>End Date</label>
                
                                <input type="date" name="" class="form-control" wire:model="filter.end_date">
                            </div>  
                              
                </div>

        </div>

          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
              <div class="container mt-3">
                <div class="row">
                    @if(!empty($objects))
                    <button type="button" class="btn btn-success" wire:click='export()'>Export</button>
                    @endif
                      <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                  
                                
                                <th >Paper ID </th>
                                <th >Paper Title </th>
                                <th  style="width:50px">Class </th>
                                <th  style="width:50px">Sec </th>
                                <th style="width: 50px;"> Assign</th>
                                <th  style="width: 50px;">Correct</th>
                                <th  style="width: 50px;">SBA</th>
                                <th   style="width: 50px;">SWE</th>
                                <th   style="width: 50px;">Late</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                              @if(!empty($objects))
                                    dsfgds
                                  @foreach($objects as $number => $papers)
                                {{ $number }}
                                @endforeach
                       
                          
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
</div>
