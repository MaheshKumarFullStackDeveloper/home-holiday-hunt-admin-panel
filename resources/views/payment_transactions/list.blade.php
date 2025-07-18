@extends('adminlte::page')

@section('title', 'Payment Transaction ')

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
                  <i class="fas fa-fw fa fa-newspaper "></i>
                </div>            
                <h3>Payment Transactions</h3>
              </div>          
          <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> 
             </div>

             <div class="text-right mb-3 collapse  " id="advanceOptions">
              <div class="advance-options" style="">
                 <div class="title">
                   <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                 </div>                      
                 <div class="left_option">
                   <div class="left_inner">
                     <h6>Select Date Range</h6>
                     <div class="button_input_wrap">
                      <div class="date_range_wrapper">
                       <i class="fas fa-calendar-alt mr-2"></i>
                       <input type="text" name="date_range"  autocomplete="off"  />
                      </div>
                       <div class="apply_reset_btn">
                         <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                         <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                       </div>                              
                     </div>                                                    
                   </div>
                      
                 </div>
              </div>
            </div>

        <div class="card-body">
           @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
           @endif
        
          <table style="width:100%" id="transaction-list" class="table table-bordered table-hover yajra-datatable">
            <thead>
              <tr>
                <th class="display-none"></th>
                <th>Transaction ID  </th>
                <th>Amount</th>
                <th>Status</th>
                 <th>Paid At</th>
                 
                <th>Actions</th>
                
           

              </tr>
            </thead>
            <tbody class="filter_date_show" id="payments_list">
                <tr>
                    <td colspan=5>No record Found</td>
                </tr>
            
            
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

       $('#transaction-list').DataTable( {

      dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                titleAttr: 'Excel',
                exportOptions: {
                      columns: [ 0, 1, 2, 3, 4]
                },
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
                customize: function(doc) {
     doc.content[1].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
},
            }
        ],
        select: {
            style: 'multi'
        },
        
    });


    $(document).ready(function() {

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
   
      today = mm + '/' + dd + '/' + yyyy;
   
      $('input[name="date_range"]').daterangepicker({
        "startDate": today,
        "endDate": today,
        "autoApply": true,
        autoUpdateInput: false,
        disableDates: ["we", "th"],
        locale: {
           cancelLabel: 'Clear'
        }
      });

      $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
      
    });

   
    // filter
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');


      console.log('date range');
      console.log(date_range);
      // return false;

      if(date_range.length==1)
        return false;
      $.ajax({
           url: '{{ route('filter_transactions') }}',
           method: 'post',
           data: {
               date_range: date_range
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               
               if(response.status) {
                $("#transaction-list").DataTable().clear().destroy();
                $('#payments_list').html(response.html);
                 $('#transaction-list').DataTable( {
                  dom: 'Bfrtip',
                    buttons: [
                        {
                            extend:    'copyHtml5',
                            text:      '<i class="fa fa-copy mr-1"></i> Copy',
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            },
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                            titleAttr: 'Excel',
                            exportOptions: {
                                  columns: [ 0, 1, 2, 3, 4]
                            },
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            },
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            },
                        }
                    ],
                    select: {
                        style: 'multi'
                    }
                });
    
              }
           }
       });
    });

    $('body').on('click','.reset-button',function(){
       $('input[name="date_range"]').val('');
       
       $('.advance_options_btn').hide();


        // update table data
        $.ajax({
           url: '{{ route('payment_transactions_reset') }}',
           method: 'post',
           data: {
               reset: true
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#transaction-list').DataTable().clear().destroy();
                  $('#payments_list').html(response.html);
                  $('#transaction-list').DataTable( {
                      dom: 'Bfrtip',
                        buttons: [
                            {
                                extend:    'copyHtml5',
                                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                                titleAttr: 'Copy',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                },
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                                titleAttr: 'Excel',
                                exportOptions: {
                                      columns: [ 0, 1, 2, 3, 4]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                                titleAttr: 'CSV',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                },
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                                titleAttr: 'PDF',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4]
                                },
                            }
                        ],
                        select: {
                            style: 'multi'
                        }
                    });

               }
           }
        });
        // update table data

     })
    // filter


  
</script>


@stop
