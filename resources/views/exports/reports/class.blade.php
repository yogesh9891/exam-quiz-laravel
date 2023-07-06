    <table>
                        <thead>
                            <tr>
                  
                                
                                <th >Name </th>
                                <th >Email </th>
                                <th >Class </th>
                                <th>Section </th>
                                <th> Assig</th>
                                <th>Correct</th>
                                <th >SBA</th>
                                <th>SWE</th>
                                <th>Late</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                              @if(!empty($data))
                        
                                  @foreach($data as $object)
                            <tr>
                              <td >{{ $object->user->name??'' }}</td>
                              <td>{{ $object->user->email??'' }}</td>
                              <td>{{ $object->class->class->name??'' }}</td>
                              <td>{{ $object->section->section->name??'' }}</td>
                              <td >{{ $object->user->assigned->count()??0 }}</td>
                              <td>{{ $object->user->assigned()->where(['sent_tag'=>0,'late_tag'=>0,'error_tag'=>0])->count()??0 }}</td>
                              <td>{{ $object->user->assigned()->where('sent_tag',1)->count()??0 }}</td>
                              <td>{{ $object->user->assigned()->where('error_tag',1)->count()??0 }}</td>
                              <td >{{ $object->user->assigned()->where('late_tag',1)->count()??0 }}</td>
                             
                            
                            
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>