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
                  <h3>Users</h3>
               </div>
              {{--  @can('add_user')
               <a class="btn btn-sm btn-success" href="{{route('add_user')}}"><i class="fas fa-plus-circle mr-2"></i>Add New </a>
               @endcan  --}}
               <div class="card-body card_body_hide" style="margin-left: 700px;">
                  <!-- <select class="form-control filter_form " id="search_champion">
                     <option selected disabled>All</option>
                     @for($i=2001;$i<=2022;$i++)
                     <option value="{{ $i }}" >{{ $i }}</option>
                     @endfor
                  </select> -->

                  <input type="hidden" class="filter_form" id="search-year" name="search-year" value="{{ $searchqueryyear }}">
               </div>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <table style="width:100%;display:none;" id="users-lists">
                  <thead>
                     <tr>
                        <th>First Name Reviewed By</th>
                        <th>Last Name Reviewed By</th>
                        <th>Email Reviewed By</th>
                        <th>Phone Reviewed By</th>
                        <th>First Name Reviewed To</th>
                        <th>Last Name Reviewed To</th>
                        <th>Email Reviewed To</th>
                        <th>Phone Reviewed To</th>
                        <th>Location</th>
                        <th>Rating</th>
                        <th>Comment</th>
                     </tr>
                  </thead>
                 
                  <tbody>
                     @forelse($csv_list  as $keys => $datas)

                    
                     <tr>
                        <td> {{ $datas->reported_by_user[0]->first_name  ?? ''}}</td>
                        <td> {{ $datas->reported_by_user[0]->last_name  ?? ''}}</td>
                        <td> {{ $datas->reported_by_user[0]->email  ?? ''}}</td>
                        <td> {{ $datas->reported_by_user[0]->phone_number  ?? ''}}</td>
                       {{--  <td> {{ isset($datas->reported_to_user[0]->homeowner)  == 1 ? $datas->reported_to_user[0]->homeowner_first_name : $datas->reported_to_user[0]->nominator_first_name  }}</td> --}} 
                       <td> 
                           @foreach ($datas->reported_to_user as $item)
                              @if( $item->homeowner  == '1')
                              {{  $item->homeowner_first_name }}
                              @endif
                              @if( $item->homeowner  == '2')
                              {{  $item->nominator_first_name }}
                              @endif
                           @endforeach
                        </td> 
                        <td> 
                           @foreach ($datas->reported_to_user as $item)
                              @if( $item->homeowner  == '1')
                              {{  $item->homeowner_last_name }}
                              @endif
                              @if( $item->homeowner  == '2')
                              {{  $item->nominator_last_name }}
                              @endif
                           @endforeach
                        </td> 
                        <td> 
                           @foreach ($datas->reported_to_user as $item)
                              @if( $item->homeowner  == '1')
                              {{  $item->homeowner_email }}
                              @endif
                              @if( $item->homeowner  == '2')
                              {{  $item->nominator_email }}
                              @endif
                           @endforeach
                        </td> 
                        <td> 
                           @foreach ($datas->reported_to_user as $item)
                              @if( $item->homeowner  == '1')
                              {{  $item->homeowner_phone }}
                              @endif
                              @if( $item->homeowner  == '2')
                              {{  $item->nominator_phone }}
                              @endif
                           @endforeach
                        </td> 
                        <td> 
                           @foreach ($datas->reported_to_user as $items)
                              @if( $items->homeowner  == '1')
                              {{  $items->homeowner_location }}
                              @endif
                              @if( $items->homeowner  == '2')
                              {{  $items->nominator_location }}
                              @endif
                           @endforeach
                        </td> 
                        <td> {{ $datas->rate_count  ?? ''}}</td>
                        <td> {{ $datas->comment  ?? ''}}</td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="4">No Record Found</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
               <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @can('manage_user_action')
                        <th>Actions</th>
                        @endcan
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($usersList as $key => $data)
                     <tr>
                        <td> {{ $data->first_name  ?? ''}} {{ $data->last_name  ?? ''}}</td>
                        <td> {{ $data->email  ?? ''}}</td>
                        <td> {{ $data->phone_number  ?? 'N/A'}}</td>
                         @can('manage_user_action')
                        <td>
                            @can('view_user')
                           <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                            @endcan 
                          {{--    @can('edit_user')
                           <a class="action-button" title="Edit" href="edit/{{$data->id}}"><i class="text-warning fa fa-edit"></i></a>
                            @endcan --}}
                             @can('delete_voter')
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                            @endcan 
                        </td>
                         @endcan 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<script>
      $(document).ready(function() {
        $("#search-year").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });


        $('#search-year').change(function(){
            var search_query = $(this).val();
            window.location.href = "{{url('admin_panel/voter/list')}}" + "/" + search_query;
         });

      });
     
</script>




  <script>
$('#users-lists').DataTable({
   dom: 'Bfrtip',
   buttons: [
      {
            extend:    'csvHtml5',
            text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
            titleAttr: 'CSV',
            exportOptions: {
               columns: [ 0, 1,2,3,4,5,6,7,8,9,10]
            },
      },
   ],
   searching: false, paging: false, info: false,
   select: {
      style: 'multi'
   },    
});
            $('#users-list').DataTable( {

dom: 'Bfrtip',
  buttons: [
     /*  {
          extend:    'csvHtml5',
          text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
          titleAttr: 'CSV',
          exportOptions: {
              columns: [ 0, 1 , 2]
          },
      }, */
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
   var obj = $(this);
   swal({
   title: "Are you sure?",
   text: "Are you sure you want to move this User to the Recycle Bin  ?",
   type: "warning",
   showCancelButton: true,
   }, function(willDelete) {
   if (willDelete) {
      $.ajax({
      url: "{{ route('delete_userv') }}",
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
@stop
