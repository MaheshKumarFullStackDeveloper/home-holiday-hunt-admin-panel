  

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
          
          <h3> Deleted Currencies</h3>
             
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
                 <th> Country Name</th>
                 <th> Currency</th>
                <th>ISO </th>
                

              @if(Gate::check('permanent_deleted_currency') || Gate::check('restore_currency'))

               <th>{{ __('adminlte::adminlte.actions') }}</th> 
             
             @endif

              </tr>
            </thead>
            <tbody>
                
              @foreach ($countriesList as $country)
              
                <tr>
                    <th class="display-none"></th>
                    <td> {{ $country->country }}</td>  
                    <td> {{ $country->name }}</td>  
                    <td>
                      {{  $country->values  }}
                      </td>

                    @if(Gate::check('permanent_deleted_currency') || Gate::check('restore_currency')) 
                     
                     
                      <td>
                        @can('restore_currency')
                        <a class="action-button restore-button" title="Restore" href="javascript:void(0)"  data-id="{{$country->id}}"><i class="text-success fa fa-undo"></i></a>
                        @endcan

                         @can('permanent_deleted_currency')
                        <a class="action-button delete-button" title=" Permanent Delete" href="javascript:void(0)" data-id="{{$country->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                        @endcan   
                        
                         
                      </td>
                       

                      @endif
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
 

//Restore Admin.........    
$('body').on('click','.restore-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure?",
text: "Are you sure you want to restore the  Country ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('restore_country_list') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-success");
         $('#flash-message').html('Currency Restore Successfully');
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
 
    

//Permanent Delete Admin
$('body').on('click','.delete-button',function(e){
var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure ?",
text: "Are you sure you want to Permanently Delete this Record ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('permanent_delete_country_list') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-danger");
         $('#flash-message').html('Currency  Deleted Successfully');
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
