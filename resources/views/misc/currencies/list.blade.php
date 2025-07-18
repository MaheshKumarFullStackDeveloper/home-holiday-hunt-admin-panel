 

@extends('adminlte::page')

@section('title', 'Currencies')

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
          
          <h3> Currencies</h3>
         
           @can('add_misc')

           <a class="btn btn-sm btn-success" href="{{ route('add_country') }}"> Add New Currency</a>
          @endcan 

        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          
          <table style="width:100%" id="jobseekers-list" class="table table-bordered table-hover table-wants">
            <thead>
              <tr>
                  <th class="display-none"></th>
                 <th>  Currency</th>
                 <th>Country Name </th>
                <th>ISO </th>
                <th>Status</th>
        @can('delete_misc')

               <th>{{ __('adminlte::adminlte.actions') }}</th> 
          @endcan    
              </tr>
            </thead>
            <tbody>
                
              @foreach ($mdCurrencies as $country)
               
                <tr>
                    <th class="display-none"></th>
                    <td>{{ $country->name }} </td>  
                    <td>{{ $country->country }} </td>  
                    <td>
                      {{  $country->values  }}
                      </td>
                      

         

                      <td>
                        @if($country->values!='KES')
                        <input   @can('edit_misc') @else disabled  @endcan   class="currency_status"  data-id="{{$country->id}}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Enable" data-off="Disable"  {{ $country->status==1 ? 'checked':'' }} >
                        @else
                        <p class="p-1 alert-success {{ $country->values=='KES' ? '':'d-none' }}">Default</p> 
                        @endif 
                      </td>
                      
                        
                         
                        
                       @can('delete_misc')  
                         <td>
                          @if($country->values!='KES')
                       <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$country->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                        @else
                        <p class="p-1 alert-success {{ $country->values=='KES' ? '':'d-none' }}">Default</p> 
                        @endif 
                      </td>
                       @endcan
                     
                    
                </tr>
              
              @endforeach
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
    $(document).ready(function() {
      $('#jobseekers-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });

    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Currency to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url:  '{{ route("delete_country") }}',
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                $( "#flash-message" ).css("display","block");
                $( "#flash-message" ).removeClass("d-none");
                $( "#flash-message" ).addClass("alert-danger");
                $('#flash-message').html('Currency Deleted Successfully');
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
  
    $('.currency_status').change(function(){
              var id = $(this).data("id");
              var status_value = $(this).prop('checked') == true ? 1 : 0;
              $.ajax({
                     type:"post",
                     url:"{{ route('change.currency.status') }}",
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
