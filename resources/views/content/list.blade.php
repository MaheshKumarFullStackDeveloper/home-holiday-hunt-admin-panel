@extends('adminlte::page')

@section('title', 'Website Pages')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Website Pages</h3>
      {{--  <a class="btn btn-success" href="{{ route('add_mobile_page') }}">Create Website Page</a> --}}
          </div>
          <div class="card-body">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Title</th>
                  <th>Status</th>
                <!--  <th>Section</th> -->
             @can('manage_content_action')
                  <th>Actions</th>
              @endcan  
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($mobilePagesList); $i++) { ?>
                  <tr>

              
                    <td class="display-none"></td>
                    <td>{{ ucwords(str_replace('_',' ',$mobilePagesList[$i]->section)) }}</td>
                    <!-- <td>{{ $mobilePagesList[$i]->section }}</td> -->
                    <!-- <td class="{{ $mobilePagesList[$i]->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $mobilePagesList[$i]->status == 'active' ? "Active" : "Inactive" }}</td> -->
                   <!--  <td class="{{ $mobilePagesList[$i]->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $mobilePagesList[$i]->status == 'active' ? "Active" : "Inactive" }}</td>  -->

                    <td><input {{ ($mobilePagesList[$i]->id == '6') ? 'disabled' : '' }} class="user_status"  data-id="{{ $mobilePagesList[$i]->id }}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Enable" data-off="Disable"  {{ $mobilePagesList[$i]->status=='active' ? 'checked':'' }} >
                       </td>

             @can('manage_content_action')
                      <td>
                       @can('view_mobile_content')
                          <a href="{{ route('content.mobilePage.view', ['id' => $mobilePagesList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                     
                      @can('edit_mobile_content')
                          <a href="{{ route('content.mobilePage.edit', ['id' => $mobilePagesList[$i]->id]) }}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                     @endcan   
                        
                      </td>

              @endcan        
                    
                  </tr>
                <?php } ?>
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
  <script>
   
   $(document).ready(function(){
$('.user_status').change(function(){
         var id = $(this).data("id");
         //alert(id);
         var status_value = $(this).prop('checked') == true ? 'active' : 'inactive';
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
    });


    $('#pages-list').DataTable( {
      stateSave: true,
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>
@stop
