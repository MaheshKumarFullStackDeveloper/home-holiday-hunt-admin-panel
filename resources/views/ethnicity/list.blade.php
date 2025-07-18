@extends('adminlte::page')

@section('title', 'Ethnicity')

@section('content_header')
 

@section('content')

 <div class="container">
   <div class="alert d-none" id="flash-message"></div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center ">
               <h3 style="display:inline;">Ethnicities</h3>
               @can('add_ethinicity')
               <a class=" btn btn-sm btn-success float-right clear" href="add">Add New  </a>
               @endcan
            </div>
            <div class="card-body">
               <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th class="display-none"></th>
                        <th>Name</th>
                         @if(Gate::check('edit_ethinicity') || Gate::check('delete_ethinicity'))
                        <th>Actions</th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($ethnicityList as $ethnicity)
                     <tr >
                        <th class="display-none"></th>
                        <td>{{ ucfirst($ethnicity->name) ?? '' }}</td>
                        @if(Gate::check('edit_ethinicity') || Gate::check('delete_ethinicity'))
                        <td>
                           @can('edit_ethinicity')
                           <a title="Edit" href="edit/{{$ethnicity->id}}"><i class="text-warning fa fa-edit"></i></a>
                           @endcan
                           @can('delete_ethinicity')
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$ethnicity->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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

  
$('body').on('click','.delete-button',function(e){
var id = $(this).attr('data-id');
var obj = $(this);
swal({
title: "Are you sure?",
text: "Are you sure you want to move this Ethnicity to the Recycle Bin  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
$.ajax({
url: "{{ route('delete_ethnicity') }}",
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
$('#flash-message').html('Ethnicity Deleted Successfully');
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
