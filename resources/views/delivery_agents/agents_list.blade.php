@extends('adminlte::page')

@section('title', ' Delivery Agents')

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
            <div class="d-flex align-items-center">
              <div class="icon_main">
                <i class="fas fa-fw fa-user-friends "></i>
              </div>               
              <h3>Marketing Users</h3>
            </div>
            @can('add_delivery_agent')
            <a class="btn btn-sm btn-success d-none" href="add"><i class="fas fa-plus-circle mr-2"></i>Add New Delivery Agent</a> 
            @endcan
        </div>    
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <table style="width:100%" id="delivery-agents-list" class="table table-bordered table-hover yajra-datatable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                
                
                @can('manage_delivery_agent_action')
                <th>Actions</th> 
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse($agentsList as $key => $data)
             <tr> 
              <td>{{ $data->first_name ?? ''}} {{ $data->last_name ?? ''}} </td> 
              <td> {{ $data->email ?? ''}} </td>
              <td> (+{{ $data->country_code ?? ''}}){{ $data->phone_number ?? ''}} </td>
              
             @can('manage_delivery_agent_action')
            
                      <td>
                        @can('view_delivery_agent')
                          <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                         
                       @endcan
                       @can('edit_delivery_agent')
                          <a class="action-button" title="Edit" href="{{ route('edit_delivery_agent',$data->id)}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_delivery_agent')
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                       @endcan
                      </td>
                      @endcan
                    
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
   
   $(document).ready(function(){

    $(document).ready(function() {
      $('#delivery-agents-list').DataTable( {
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
text: "Are you sure you want to move this Delivery Agent to the Recycle Bin?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('delete.agent') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.success == 1) {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-danger");
         $('#flash-message').html(' Delivery Agent Deleted Successfully');
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


});




 $(document).ready(function(){
    
  toastr.options = {
          "closeButton": true,
          "newestOnTop": false,
          "positionClass": "toast-top-right"
        };

    $('.is_available').change(function(){
           
            var id = $(this).data("id");
            var status_value = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
               type:"post",
               url:"{{ route('check.delivery.agent.availity') }}",
               data:{
                "_token": "{{ csrf_token() }}", 
                id:id,
                status_value:status_value,
               },
               success:function(response){
              
                 toastr.success(response.message);
                
              } 
                
               
            }); 
    });
     $('.is_locked').change(function(){
            var id = $(this).data("id");
            var status_value = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
                   type:"post",
                   url:"{{ route('change.delivery.agent.status') }}",
                   data:{
                    "_token": "{{ csrf_token() }}", 
                id:id,
                status_value:status_value,
               },
               success:function(response){
                toastr.success(response.message);
                  console.log(response);
               }
            }); 
    });    
 });

 




  </script>
@stop
