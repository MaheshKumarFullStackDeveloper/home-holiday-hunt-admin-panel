@extends('adminlte::page')

@section('title', 'Destinations')

@section('content_header')
 

@section('content')

 <div class="container">
   <div class="alert d-none" id="flash-message"></div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center ">
               <h3 style="display:inline;">Destinations</h3>
           
             @can('add_destinations')

               <a class=" btn btn-sm btn-success float-right clear" href="add">Add New  </a>
             @endcan
            </div>
            <div class="card-body">
               <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                         
                        <th>Country Name</th>
                        <th>Available Cities</th>
                        <th>Status</th>
                         @if(Gate::check('edit_destinations') || Gate::check('delete_destinations'))
                        <th>Actions</th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($destinationList as $destination)
                     <tr >
                         
                        <td>{{ ucfirst($destination->country_name) ?? '' }}</td>
                         <td>
                         @if(is_array($destination->available_city) && count($destination->available_city))
                            @foreach($destination->available_city as $key=> $city)
                            @if($loop->last)
                             <img src="{!! explode('=',$city['image'])[0] !!}" height="16px" width="16px"> {!! explode('=',$city['image'])[1] !!}
                             @else
                             <img src="{!! explode('=',$city['image'])[0] !!}"  height="16px" width="16px"> {!! explode('=',$city['image'])[1] !!},
                             @endif
                            @endforeach
                         @else
                            N/A
                         @endif
</td>
                       <td><input @can('edit_destinations') @else disabled @endcan   class="destination_status"  data-id="{{$destination->id}}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Enable" data-off="Disable"  {{ $destination->country_status==1 ? 'checked':'' }} >
                       </td>
                        @if(Gate::check('edit_destinations') || Gate::check('delete_destinations'))
                        <td>
                            @can('edit_destinations')
                           <a title="Edit" href="{{ route('edit_destination',$destination->id)}}"><i class="text-warning fa fa-edit"></i></a>
                             @endcan
                              @can('delete_destinations')
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$destination->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                             @endcan
                        </td>
                          @endif
                       
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#roles-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
          }
        }]
      });
    });

  
$('body').on('click','.delete-button',function(e){
var id = $(this).attr('data-id');
var obj = $(this);
swal({
title: "Are you sure?",
text: "Are you sure you want to move this Country to the Recycle Bin  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
$.ajax({
url: "{{ route('delete_destination') }}",
type: 'post',
data: {
"_token": "{{ csrf_token() }}",
id: id
},
success: function(response) {
if(response.trim() == 'success') {
$( "#flash-message" ).css("display","block");
$( "#flash-message" ).removeClass("d-none");
$( "#flash-message" ).addClass("alert-danger");
$('#flash-message').html('Destination Deleted Successfully');
obj.parent().parent().remove();
setTimeout(() => {
$( "#flash-message" ).addClass("d-none");
}, 5000);
}
else {
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






    $(document).ready(function(){
    
    toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "positionClass": "toast-top-right"
          };
  
    $('.destination_status').change(function(){
              var id = $(this).data("id");
              var status_value = $(this).prop('checked') == true ? 1 : 0;
              $.ajax({
                     type:"post",
                     url:"{{ route('change.destination.status') }}",
                     data:{
                      "_token": "{{ csrf_token() }}", 
                  id:id,
                  status_value:status_value,
                 },
                 success:function(response){
                  // toastr.success(response.message);
                    console.log(response);
                 }
              }); 
      });    
   });
  </script>
@stop
