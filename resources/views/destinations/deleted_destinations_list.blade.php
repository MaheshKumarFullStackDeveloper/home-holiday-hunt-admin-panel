@extends('adminlte::page')

@section('title', 'Deleted Destinations')

@section('content_header')
 

@section('content')




 <div class="container">
   <div class="alert d-none" id="flash-message"></div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center ">
               <h3 style="display:inline;">Deleted Destinatons</h3>
               
            </div>
            <div class="card-body">
               <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th class="display-none"></th>
                        <th>Destination</th>
                        @if(Gate::check('restore_destinations') || Gate::check('permanent_deleted_destinations'))
                        <th>Actions</th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($destinationList as $destination)
                     <tr >
                        <th class="display-none"></th>
                        <td>{{ ucfirst($destination->country_name ? $destination->country_name : $destination->city_name) }} <span class="{{ $destination->country_name ? 'badge badge-danger' : 'badge badge-warning' }}">{{ $destination->country_name ? 'Country' : 'City' }}</span></td>
                         @if(Gate::check('restore_destinations') || Gate::check('permanent_deleted_destinations'))
                        <td>
                          @can('restore_destinations')
                          <a class="action-button restore-button" title="Delete" href="javascript:void(0)" data-id="{{ $destination->id}}"><i class="text-success fa fa-undo"></i></a>
                           @endcan
                          <!--  @can('permanent_deleted_destinations')
                           <a class="action-button delete-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{$destination->id}}"><i class="text-danger fa fa-trash"></i></a>
                           @endcan -->
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
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#roles-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });

  

   //Restore Users.........    


 $('body').on('click','.restore-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure?",
text: "Are you sure you want to restore the destination ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('restore_destination') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.status == 1) {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-success");
         $('#flash-message').html('Destination Restore Successfully');
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


 
//Permanent Delete
     
  $('body').on('click','.delete-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure ?",
text: "Are you sure you want to Permanently Delete this Record  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('permanent_delete_destination') }}",
    type: 'post',
    data: {
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


  </script>
@stop
