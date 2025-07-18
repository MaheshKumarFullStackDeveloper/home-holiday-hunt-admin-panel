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
                  <h3>Subscription Plan</h3>
               </div>
               
               @can('add_subscription_plans')
               <a class="btn btn-sm btn-success" href="{{route('subscription-plan.add_plan')}}"><i class="fas fa-plus-circle mr-2"></i>Add Plan</a> 
                @endcan

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
                        <th>Plan Name</th>
                         <th>Plan Duration</th>
                        <th>Plan Price($)</th>
                        <th>Status</th>

                       @if(Gate::check('edit_subscription_plans') || Gate::check('delete_subscription_plans'))
 
                        <th>Actions</th>

                        @endif
                        
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($plansList as $key => $data)
                     <tr>
                        <td> {{ $data->plan_name  ?? ''}}</td>
                        <td> {{ $data->plan_duration  ? $data->plan_duration.' months':''}}</td>
                        <td> {{ $data->plan_price  ? $data->plan_price:''}}</td>
                        <td><input  @can('edit_subscription_plans') @else disabled @endcan   class="plan_status" data-id="{{$data->id}}" type="checkbox"   data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Active" data-off="Inactive" {{ $data->plan_status==1 ? 'checked':'' }}></td>
          
                        
                 @if(Gate::check('edit_subscription_plans') || Gate::check('delete_subscription_plans'))
                        <td>
                  
                 <!--           <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                    -->
                    @can('edit_subscription_plans')
                           <a class="action-button" title="Edit" href="edit/{{$data->id}}"><i class="text-warning fa fa-edit"></i></a>

                    @endcan
                    
                    @can('delete_subscription_plans')       
              
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                    @endcan
                        </td>
                 @endif  
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  
  
  <script>
   
   $(document).ready(function(){
    $(document).ready(function() {
      $('#users-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 100 );
          }
        }]
      });
    });
  
     
//User Delete...........

$('body').on('click','.delete-button',function(e){
var id = $(this).attr('data-id');
var obj = $(this);
swal({
title: "Are you sure?",
text: "Are you sure you want to move this Plan to the Recycle Bin  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
$.ajax({
url: "{{ route('subscription-plan.delete_plan') }}",
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
$('#flash-message').html('Plan Deleted Successfully');
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

   $('.plan_status').change(function(){
           
            var id = $(this).data("id");
            var status_value = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
               type:"post",
               url:"{{ route('subscription-plan.change_plan_status') }}",
               data:{
                "_token": "{{ csrf_token() }}", 
                id:id,
                status_value:status_value,
               },
               success:function(response){
              
                 console.log(response)
                
              } 
                
               
            }); 
    });

 
  </script>
@stop
