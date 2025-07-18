@extends('adminlte::page')

@section('title', 'Users') 

@section('content_header')
 

@section('content')
  
 <div class="container">
   <div class="alert d-none" role="alert" id="flash-message">        
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                   <div class="icon_main">
                     <i class="fas fa-fw fa-universal-access "></i>
                  </div>
                  <h3>Review Reports</h3>
               </div>
              {{--  @can('add_user')
               <a class="btn btn-sm btn-success" href="{{route('add_user')}}"><i class="fas fa-plus-circle mr-2"></i>Add New </a>
               @endcan  --}}
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable">
                  <thead>
                     <tr>
                        <th>Location</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Reported By</th>
                        <th>Reported To</th>   
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
               
                     @forelse($usersList as $key => $data)
                   
                     <tr>
                        <td> {{ $data->location  ?? ''}}</td>
                        <td> {{ $data->review_id_user->rate_count  ?? ''}}</td>
                        <td> {{ $data->review_id_user->comment  ?? 'N/A'}}</td>
                        <td> {{ $data->reported_by_user->first_name  ?? ''}}</td>
                        <td> {{ $data->reported_to_user->first_name  ?? ''}}</td> 
                        <td><a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $data->id}}"><i class="text-danger fa fa-trash-alt"></i></a></td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="6">No Record Found</td>
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript"src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>">
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>
  <script>
            $('#users-list').DataTable( {

dom: 'Bfrtip',
  buttons: [
      {
          extend:    'csvHtml5',
          text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
          titleAttr: 'CSV',
          exportOptions: {
              columns: [0,1,2,3,4]
          },
      },
  ],
  select: {
      style: 'multi'
  },    
  
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 100 );
          }
        }],
         
     
});
     </script>
  <script>
   
   $(document).ready(function(){
      $('.user_status').change(function(){
         var id = $(this).data("id");
         var status_value = $(this).prop('checked') == true ? 0 : 1;
         $.ajax({
               type:"post",
               url:"{{ route('change.user.status') }}",
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


  
     


   
$('body').on('click','.delete-button',function(e){
   var id = $(this).attr('data-id');
  // alert(id);
   var obj = $(this);
   swal({
   title: "Are you sure?",
   text: "Are you sure you want to Permanently Delete this Review?",
   type: "warning",
   showCancelButton: true,
   }, function(willDelete) {
   if (willDelete) {
      $.ajax({
      url: "{{ route('delete_reports') }}",
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
      $('#flash-message').html('Review Deleted Successfully');
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

$('body').on('click','.cancel-button',function(e){
   var id = $(this).attr('data-id');
   var obj = $(this);
   
   swal({
   title: "Are you sure?",
   text: "Are you sure you want to cancel this User Subscription?",
   type: "warning",
   showCancelButton: true,
   }, function(willCancel) {
   if (willCancel) {
      $.ajax({
      url: "{{ route('cancel_Subscription') }}",
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
      $('#flash-message').html('User Subscription Cancelled');
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

$('body').on('click','.cancel-button2',function(e){
   var id = $(this).attr('data-id');
   var obj = $(this);
   
   swal({
   title: "Opps...",
   text: "No Subscription Plan",
   type: "warning",
   });
}); 


});




//check data 

$(document).ready(function(){
  $message = localStorage.getItem('success_data'); 
  if($message != null){
      
           $( "#flash-message" ).css("display","block");
           $( "#flash-message" ).removeClass("d-none");
           $( "#flash-message" ).addClass("alert-success");
           $('#flash-message').html($message);
           
           setTimeout(function(){
            $('#flash-message').html( );
            localStorage.removeItem("success_data");
           },1000);
    

  }  
});
 
  </script>
@stop