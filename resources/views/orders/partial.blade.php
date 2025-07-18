@forelse($orders as $key => $order)

	<tr id="order_row_{{ $order->id }}" data-id="{{ $order->id }}">
								<td>{{ $order->token }}</td>
								<td id="column_status_{{ $order->id }}"><span class="badge {{ $order->status==1 ? 'badge-danger':'' }}{{ $order->status==2 ? 'badge-danger':'' }}{{ $order->status==3 ? 'badge-primary':'' }}{{ $order->status==4 ? 'badge-success':'' }}">{{ $order->status==1 ? 'Pending':'' }}{{ $order->status==2 ? 'Confirmed':'' }}{{ $order->status==3 ? 'Inprogress':'' }}{{ $order->status==4 ? 'Completed':'' }}</span></td>

								<td>{{ date('Y/m/d h:i:s', strtotime($order->created_at))  }}</td>

								<td id="column_is_assigned_{{ $order->id }}" >

									<select class="form-control select-delivery-agent" aria-label="Default select example" id="select-delivery-agent"     @can('edit_order') @else disabled @endcan >
										<option selected>Select Deliver Agent</option>
										@foreach($deliveryAgents as $key => $agent)
										@if($agent->is_available==1 && $agent->is_locked==0)
										<option value="{{ $agent->id }}" {{ $order->is_assigned!=0 && $agent->id==$order->delivery_agent_id ? 'selected':'' }}>{{ $agent->first_name }} {{ $agent->last_name }}</option>
										@endif
										@endforeach
									</select>
								</td>




								<td>

									<a class="action-button" title="View" href="view/{{$order->id}}"><i class="text-info fa fa-eye"></i></a>




								</td>

							</tr>

@empty


<tr>
	<td colspan="5">No data available in table
</td>
</tr>

@endforelse