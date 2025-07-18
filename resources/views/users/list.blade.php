@extends('adminlte::page')

@section('title', 'Users') 

@section('content_header')
 

@section('content')
  
 <div class="container content_container">
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
                  <h3>Users</h3>
                  
               </div>
               <div class="card-body card_body_hide" style="margin-left: 514px;">
                  <!-- <select class="form-control filter_form " id="search_champion">
                     <option selected disabled>All</option>
                     @for($i=2001;$i<=2022;$i++)
                     <option value="{{ $i }}" >{{ $i }}</option>
                     @endfor
                  </select> -->

                  <input type="hidden" class="filter_form" id="search-year" name="search-year" value="{{ $searchqueryyear }}">
               </div>
               <div class="card-body card_body_hide">
                  <select class="form-control filter_form align-left w-50" id="search-users">
                  <option value="0" {{ isset($searchquery) && $searchquery==0 ? 'selected':''}}>All</option>
                  <option value="1" {{ isset($searchquery) && $searchquery==1 ? 'selected':'w'}}>Home Owner</option>
                  <option value="2" {{ isset($searchquery) && $searchquery==2 ? 'selected':''}}>Nominator</option>
                  </select>
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
                        <th>Name</th>
                        <th>Home Key</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th style="display:none;">Homeowner Name</th>
                        <th style="display:none;">Homeowner Number</th>
                        <th>Address</th>
                        <th style="display:none;">Total Days on the site</th>
                        <th id="owner_type">Type{{-- <i class="arrow down"></i> --}}</th>
                        <th>Status</th>
                        @can('manage_user_action')
                        <th>Actions</th>
                        @endcan
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($usersList as $key => $data)  
                     <tr>
                        <td>{{ ($data->homeowner == '1') ?  $data->homeowner_first_name." ". $data->homeowner_last_name :   $data->nominator_first_name  ." ".$data->nominator_last_name   }}</td>
                        <td> {{ $data->home_key_val  ?? 'N/A'}}</td>
                        <td>{{ ($data->homeowner == '1') ?  $data->homeowner_email:   $data->nominator_email }}</td>
                        <td>{{ ($data->homeowner == '1') ?  $data->homeowner_phone:   $data->nominator_phone }}</td>
                        <td style="display:none;">{{ ($data->homeowner == '1') ?  'N/A':   $data->homeowner_first_name." ". $data->homeowner_last_name }}</td>
                        <td style="display:none;">{{ ($data->homeowner == '1') ?  'N/A':   $data->homeowner_phone }}</td>
                        <td>{{ ($data->homeowner == '1') ? $data->homeowner_location :   $data->nominator_location }}</td> 
                        @php
                           if( $data->approved_at){
                              $date_expire = date("Y/m/d",strtotime($data->approved_at));   
                              $date = new DateTime($date_expire);
                              $now = new DateTime(); 
                           }else{
                              $date = new DateTime();
                              $now = new DateTime(); 
                           }
                        @endphp
                        <td style="display:none;" >{!! $date->diff($now)->format("%d days") !!}</td> 
                        @if($data->homeowner == '1') 
                        <td><span class="badge badge-success" style="font-size: 12px;">Homeowner</span></td>
                        @else 
                        <td><span class="badge badge-info" style="font-size: 12px;">Nominator</span></td>
                        @endif
                        @if($data->status == '0')
                        <td><span class="status_content_pending">Pending</span></td>
                        @elseif($data->status == '1')
                        <td><span class="status_content_approved">Approved</span></td>
                        @else
                        <td><span class="status_content_decline">Decline</span></td>
                        @endif
                        {{-- <td> {{ ($data->status == '0') ? 'Pending' : (($data->status == 1)  ? "Approved" : "Decline") }}</td> --}}
                       
                         @can('manage_user_action')
                        <td>
                            @can('view_user')
                           <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                            @endcan 
                             @can('edit_user')
                           <a class="action-button" title="Edit" href="edit/{{$data->id}}"><i class="text-warning fa fa-edit"></i></a>
                            @endcan
                             @can('delete_user')
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                            @endcan 
                        </td>
                         @endcan 
                     </tr>
                     @empty
                     <tr>
                        <td colspan="8">No Record Found</td>
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
 <script type="text/javascript"src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>
{{-- <script type="text/javascript" src="{{asset('js/sortelements.js')}}"></script>
<script type="text/javascript" src="{{asset('js/table_sort_init.js')}}"></script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<script>
      $(document).ready(function() {


        $("#search-year").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
      });
     
</script>


  <script>
            $('#users-list').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              {
                  extend:    'csvHtml5',
                  text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                  titleAttr: 'CSV',
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4,5,6,7] 
                  },
              },
          ],
          select: {
              style: 'multi'
          },
  

         "ordering": false,
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

 $('#search-users').change(function(){
    var search_query = $(this).val();
    if(search_query==1 || search_query==2){
       window.location.href = "{{url('admin_panel/users/list')}}" + "/" + search_query;
    }else{
        window.location.href = "{{url('admin_panel/users/list')}}";
    }
   });

   $('#search-year').change(function(){
      var search_query =$('#search-users').val();
    var search_query_year = $(this).val();
    
       window.location.href = "{{url('admin_panel/users/list')}}" + "/" + search_query+ "/" + search_query_year;
    
   });



   
$('body').on('click','.delete-button',function(e){
   var id = $(this).attr('data-id');
   var obj = $(this);
   swal({
   title: "Are you sure?",
   text: "Are you sure you want to move this User to the Recycle Bin  ?",
   type: "warning",
   showCancelButton: true,
   }, function(willDelete) {
   if (willDelete) {
      $.ajax({
      url: "{{ route('delete_user_u') }}",
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
      $('#flash-message').html('User Deleted Successfully');
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
{{--   <script>
      var table = $('#users-list');
    
    $('#owner_type')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            
            th.click(function(){
                
                table.find('td').filter(function(){
                    
                    return $(this).index() === thIndex;
                    
                }).sortElements(function(a, b){
                    
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                    
                }, function(){
                    
                    // parentNode is the element we want to move
                    return this.parentNode; 
                    
                });
                
                inverse = !inverse;
                    
            });
                
        });

     </script> --}}
@stop
