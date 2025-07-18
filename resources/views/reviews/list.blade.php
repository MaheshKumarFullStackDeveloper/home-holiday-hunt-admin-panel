@extends('adminlte::page')

@section('title', 'Reviews')

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

					<h3>Reviews</h3>


				</div>
				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif


					<table style="width:100%" id="review-list" class="table table-bordered table-hover yajra-datatable">
						<thead>
							<tr>
								<th>Username</th>
								<th>Product Name</th>
								<th>Description</th>
								 
								<th>Rating</th>
							</tr>
						</thead>
						<tbody>
				 
							@forelse($allReviews as $key => $review)
							<tr>
							  
							   <td>{{ $review->user->first_name ?? '' }} {{ $review->user->last_name ?? '' }}</td>
							   <td>{{$review->order->orderItems[0]->product->name ?? 'N/A'}}</td>
							   <td>{{$review->description}}</td>
							   <td>@for($i=0;$i< $review->rating;$i++ )<i class="fa fa-star text-warning" aria-hidden="true"></i>@endfor</td>

							</tr>
							@empty
							 
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
 
@stop


@section('js')

 <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
	
		// 	$(document).ready(function() {
		// 	$('#review-list').DataTable({
		// 		stateSave: true,
		// 		columnDefs: [{
		// 			targets: 0,
		// 			render: function(data, type, row) {
		// 				return data;
		// 			}
		// 		}]
		// 	});
		// }); 

   
       $(document).ready(function() {
      $('#review-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
          }
        }]
      });
    });


 
</script>
@stop