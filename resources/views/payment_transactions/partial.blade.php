@foreach($transactionList as $key => $data)
             <tr>
              <td style="display:none;">{{ $data->name ?? ''}}</td>
              <td>{{ $data->txn_id  ?? ''}}</td>
              <td>{{ $data->amount  ?? ''}}</td>
                <td>@if($data->status=='success')<span class="badge badge-success">Success</span> @else <span class="badge badge-danger">Failed</span> @endif</td>
              <td>{!! date('Y/m/d H:i', strtotime($data->created_at)) !!}</td>
        
                    
                      <td>
                     
                    
                          <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                    
                          
                       
                     
                      </td>

                       
                    
             </tr>
             @endforeach