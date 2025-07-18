@extends('adminlte::page')

@section('title', 'Advertisement')

@section('content_header')
 

@section('content')

 <div class="container">
      <div class="alert d-none" id="flash-message"></div>
   @if(session()->has('message'))
        <p class="alert alert-success">{{session('message')}}</p>
   @endif
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center ">
               <h3 style="display:inline;">Advertisements</h3>
               @can('add_ethinicity')
               <a class=" btn btn-sm btn-success float-right clear" href="add">Add New  </a>
               @endcan
            </div>
            <div class="card-body">
               <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th class="display-none"></th>
                        <th>Advertisement Label</th>
                        <th>Advertisement Show Area</th>
                        <th>Advertisement Time Slot</th>
                        <th>Status</th>
                         @if(Gate::check('edit_ethinicity') || Gate::check('delete_ethinicity'))
                        <th>Actions</th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($advertisements as $advertisement)
                     <tr >
                        <th class="display-none"></th>
                        <td>{{ ucfirst($advertisement->adv_txt) ?? '' }}</td>
                        <td>{{ $advertisement->adv_show_area==1 ? 'Dashboard':'' }} {{ $advertisement->adv_show_area==2 ? 'Chat List':'' }} {{ $advertisement->adv_show_area==3 ? 'Chat View':'' }}</td>
                        <td>{{ $advertisement->adv_show_btw ?? '' }}</td>
                        <td><input class="adv_status"  data-id="{{$advertisement->id}}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Enable" data-off="Disable" 
                           {{ $advertisement->adv_status == 1 ? 'checked':''}}></td>
                        @if(Gate::check('edit_ethinicity') || Gate::check('delete_ethinicity'))
                        <td>
                           @can('edit_ethinicity')
                           <a title="Edit" href="{{ route('advertisement.edit',$advertisement->id)}}"><i class="text-warning fa fa-edit"></i></a>
                           @endcan
                           @can('delete_ethinicity')
                           <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$advertisement->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
      text: "Are you sure you want to delete this Advertisement  ?",
      type: "warning",
      showCancelButton: true,
      }, function(willDelete) {
         if (willDelete) {
            $.ajax({
            url: "{{ route('advertisement.delete') }}",
            type: 'post',
            data: {
            "_token": "{{ csrf_token() }}",
            id: id
            },
            success: function(response) {
               if(response.success == true) {
                  $( "#flash-message" ).css("display","block");
                  $( "#flash-message" ).removeClass("d-none");
                  $( "#flash-message" ).addClass("alert-danger");
                  $('#flash-message').html('Advertisement Deleted Successfully');
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

$('.adv_status').change(function(){
         var id = $(this).data("id");
         var status_value = $(this).prop('checked') ? 1 : 0;

         $.ajax({
               type:"post",
               url:"{{ route('change.adv.status') }}",
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
  </script>
@stop
