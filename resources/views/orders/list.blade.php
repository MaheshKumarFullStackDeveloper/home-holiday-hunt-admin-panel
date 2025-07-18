@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
@stop

@section('content')

<div class="container">
	<div class="alert d-none" role="alert" id="flash-message">
	</div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header alert d-flex justify-content-between align-items-center">
                 	<h3>Orders</h3>
                 	 <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> 
				</div>

				<!--start filter -->
				  <div class="text-right mb-3 collapse  " id="advanceOptions">
              <div class="advance-options" style="">
                 <div class="title">
                   <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                 </div>                      
                 <div class="left_option">
                   <div class="left_inner">
                     <h6>Select Date Range</h6>
                     <div class="button_input_wrap">
                      <div class="date_range_wrapper">
                       <i class="fas fa-calendar-alt mr-2"></i>
                       <input type="text" name="date_range" autocomplete="off"   />
                      </div>
                       <div class="apply_reset_btn">
                         <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                         <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                       </div>                              
                     </div>                                                    
                   </div>
                      
                 </div>
              </div>
            </div>

				<!--end filter -->



				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif


					<table style="width:100%" id="delivery-agents-list" class="table table-bordered table-hover yajra-datatable">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Status</th>
								<th>Placed On</th>
								<th>Is Assigned</th>

								<th>Actions</th>
							</tr>
						</thead>
						<tbody class="filter_date_show" id="orders_list">
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
								<td colspan="4">No Record Found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript"src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>
 

<script>
	$(document).ready(function() {

	
			// $('#delivery-agents-list').DataTable({
			// 	stateSave: true,
			// 	columnDefs: [{
			// 		targets: 0,
			// 		render: function(data, type, row) {
			// 			return data;
			// 		}
			// 	}]
			// });

 $('#delivery-agents-list').DataTable( {

      dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                titleAttr: 'Excel',
                exportOptions: {
                      columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            }
        ],
        select: {
            style: 'multi'
        }
    });


		$('body').on('click', '.delete-button', function(e) {

			var id = $(this).attr('data-id');
			var obj = $(this);

			swal({
				title: "Are you sure?",
				text: "Are you sure you want to  user   ?",
				type: "warning",
				showCancelButton: true,
			}, function(willDelete) {
				if (willDelete) {
					$.ajax({
						url: "{{ route('delete_user') }}",
						type: 'post',
						data: {
							id: id
						},
						success: function(response) {

							if (response.trim() == 'success') {

								$("#flash-message").css("display", "block");
								$("#flash-message").removeClass("d-none");
								$("#flash-message").addClass("alert-danger");
								$('#flash-message').html('User Deleted Successfully');
								obj.parent().parent().remove();
								setTimeout(() => {
									$("#flash-message").addClass("d-none");
								}, 5000);

							} else {
								console.log("FALSE");
								setTimeout(() => {
									alert("Something went wrong! Please try again.");
								}, 500);

							}

						}
					});
				}
			});
		});


	});




	$(document).ready(function() {

		toastr.options = {
			"closeButton": true,
			"newestOnTop": false,
			"positionClass": "toast-top-right"
		};

		$('.is_available').change(function() {

			var id = $(this).data("id");
			var status_value = $(this).prop('checked') == true ? 1 : 0;
			$.ajax({
				type: "post",
				url: "{{ route('check.delivery.agent.availity') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					id: id,
					status_value: status_value,
				},
				success: function(response) {
					toastr.success(response.message);
					console.log(response);
				}
			});
		});
		$('.is_locked').change(function() {
			var id = $(this).data("id");
			var status_value = $(this).prop('checked') == true ? 1 : 0;
			$.ajax({
				type: "post",
				url: "{{ route('change.delivery.agent.status') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					id: id,
					status_value: status_value,
				},
				success: function(response) {
					toastr.success(response.message);
					console.log(response);
				}
			});
		});
	});


	$(".select-delivery-agent").change(function() {
		var order_id = $(this).closest("tr").data('id');
		var agent_id = $(this).find(":selected").val();
		$.ajax({
			type: "post",
			url: "{{ route('order.assign.agent') }}",
			data: {
				"_token": "{{ csrf_token() }}",
				order_id: order_id,
				agent_id: agent_id,
			},
			success: function(response) {

				if (response.success == true) {
					$('#column_status_' + order_id+' span').removeClass('badge-danger');
					$('#column_status_' + order_id+' span').addClass('badge-primary');
					$('#column_status_' + order_id+' span').text('Inprogress');
					toastr.success(response.message);
				} else {
					toastr.success(response.message);
				}
				//   console.log(response);
			}
		});
	});


  //Start date range picker code

    $(document).ready(function() {

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
   
      today = mm + '/' + dd + '/' + yyyy;
   
      $('input[name="date_range"]').daterangepicker({
        "startDate": today,
        "endDate": today,
        "autoApply": true,
        autoUpdateInput: false,
        disableDates: ["we", "th"],
        locale: {
           cancelLabel: 'Clear'
        }
      });

      $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
      
    });


     // filter
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');


      console.log('date range');
      console.log(date_range);
      // return false;

      if(date_range.length==1)
        return false;
      $.ajax({
           url: '{{ route('filter_orders') }}',
           method: 'post',
           data: {
               date_range: date_range
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               
               if(response.status) {
               	 $('#delivery-agents-list').DataTable().clear().destroy();
                $('#orders_list').html(response.html);

                 $('#delivery-agents-list').DataTable( {

      dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                titleAttr: 'Excel',
                exportOptions: {
                      columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
            }
        ],
        select: {
            style: 'multi'
        }
    }); 

                $(".select-delivery-agent").change(function() {
		var order_id = $(this).closest("tr").data('id');
		var agent_id = $(this).find(":selected").val();
		$.ajax({
			type: "post",
			url: "{{ route('order.assign.agent') }}",
			data: {
				"_token": "{{ csrf_token() }}",
				order_id: order_id,
				agent_id: agent_id,
			},
			success: function(response) {

				if (response.success == true) {
					$('#column_status_' + order_id+' span').removeClass('badge-danger');
					$('#column_status_' + order_id+' span').addClass('badge-primary');
					$('#column_status_' + order_id+' span').text('Inprogress');
					toastr.success(response.message);
				} else {
					toastr.success(response.message);
				}
				//   console.log(response);
			}
		});
	});

  

              }
           }
       });
    });





   $('body').on('click','.reset-button',function(){
       $('input[name="date_range"]').val('');
       
       //$('.advance_options_btn').hide();


        // update table data
        $.ajax({
           url: '{{ route('orders_reset') }}',
           method: 'post',
           data: {
               reset: true
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#delivery-agents-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                  $('#delivery-agents-list').DataTable( {
                      dom: 'Bfrtip',
                        buttons: [
                            {
                                extend:    'copyHtml5',
                                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                                titleAttr: 'Copy',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                                titleAttr: 'Excel',
                                exportOptions: {
                                      columns: [ 0, 1, 2, 3, 4]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                                titleAttr: 'CSV',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                },
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                                titleAttr: 'PDF',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                },
                            }
                        ],
                        select: {
                            style: 'multi'
                        }
                    });

               }
           }
        });
        // update table data

     })
    // filter




</script>
@stop