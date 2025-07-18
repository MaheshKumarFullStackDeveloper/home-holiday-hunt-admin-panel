@extends('adminlte::page')

@section('title', 'Feedbacks')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Feedbacks</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Status</th>
            
              @can('manage_contact_us_action')

                  <th>Actions</th>
          
              @endcan
                </tr>
              </thead>
              <tbody>
                @forelse($contactUsMessagesList as $key =>$data)
                  <tr>
                    <td class="display-none"></td>
                    <td>{{ $data->email ?? '' }}</td>
                    <td>{{  ucfirst(substr_replace($data->message,'...',40))  ?? 'N/A' }}</td>
                   <td>
                    <select name="status_dropdown"  @can('reply_contact_us')  @else disabled @endcan  class="form-control" contact_id="{{ $data->id }}" {{ $data->status==='resolved' || $data->status==='dropped' ? 'disabled':'' }}>
                      <option value="pending" {{ $data->status==='pending' ? 'selected':''}}>Pending</option>
                      <option value="dropped" {{ $data->status==='dropped' ? 'selected':''}}>Dropped</option>
                      <option value="resolved" {{ $data->status==='resolved' ? 'selected':''}}>Resolved</option>
                    </select>
                   </td>
                   
                    @can('manage_contact_us_action')   
                     <td>
                    
                      @can('view_contact_us')

                      <a href="{{ route('contact_us.view',$data->id)}}" title="View"><i class="text-info fa fa-eye"></i></a> 
                       @endcan
                   
                        @can('reply_contact_us')
                       <a href="mailto:demo@gmail.com" title="Mail to"><i class="text-info fa fa-reply"></i></a>
                       @endcan
                    </td>

                    @endcan
                   
                    
                    
                  
                  </tr>
                  @empty
                  <tr><td colspan="3">Record Not Found.</td></tr>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script>
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data ;
        }
      }]
    });

    // var ratingEl = document.getElementsByClassName('rating');
    // var rating;
    // for (let i = 0; i < ratingEl.length; i++) {
    //   const element = ratingEl[i];
    //   rating = $(element).val();
    //   for(let i = 1; i <= 5; ++i) {
    //     if(rating >= i) {
    //       $("#"+i+"_"+rating).removeClass('text-grey');
    //       $("#"+i+"_"+rating).addClass('text-warning');
    //     }
    //   }
    // }




 $(document).ready(function(){
   
  toastr.options = {
          "closeButton": true,
          "newestOnTop": false,
          "positionClass": "toast-top-right"
        };

  $('select[name ="status_dropdown"]').on('change',function(){
      var contact_id = $(this).attr('contact_id');
      var selected_value = $(this).val();
      //alert(selected_value+contact_id);
     
      $.ajax({
          type:"post",
          url:"{{ route('contact.statusUpdate') }}",
          data:{
          "_token": "{{ csrf_token() }}", 
          id:contact_id,
          status:selected_value,
          },
          success:function(response){
              if(response.success == true)
              {
                toastr.success("Status Updated");
              }
              else{
                toastr.success("Failed");
              }
            
          
        } 
      });

  });
 });








  </script>
@stop
