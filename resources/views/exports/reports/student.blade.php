    <table>
                          <thead>
                            <tr><th >Name </th>  <td>{{ $data['user']['name']??'' }}</td></tr>
                            <tr><th >Emil </th>  <td>{{$data['user']['email']??'' }}</td></tr>
                            <tr><th >Class </th>  <td>{{ $data['class']['class']['name']??'' }}</td></tr>
                            <tr><th >Sec </th>  <td>{{ $data['section']['section']['name']??'' }}</td></tr>
                        </thead>
                        <tbody>
                        
                              @if(!empty($data['user']['assigned']))
                          <tr></tr>
                          <tr>
                            <th>Paper</th>
                            <th>Status</th>
                            <th>Correct</th>
                            <th>SBA</th>
                            <th>AWC</th>
                            <th>SWE</th>
                            <th>Late</th>
                          </tr>
                                  @foreach($data['user']['assigned'] as $paper)
                            <tr>
                              
                              <td >{{ $paper['assigned_paper']['question_paper']['number']??'' }}</td>
                              @if($paper['status']=='assign')
                              <td  style="color:red">Not Attemped </td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                          
                              @else
                              <td  style="color:green">Attemped </td>
                              <td>@if(!$paper['sent_tag']&&!$paper['error_tag']&&!$paper['late_tag']) correct @else  - @endif</td>
                              <td>@if($paper['sent_tag']) SBA @else  - @endif</td>
                              <td>@if($paper['error_tag']) SWC @else  - @endif</td>
                              <td>@if($paper['error_tag']) AWC @else  - @endif</td>
                              <td>@if($paper['late_tag']) late @else  - @endif</td>
                              
                              @endif
                         
                             
                            
                            
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>