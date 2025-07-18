@extends('adminlte::page')
<style>
   .tab button.active {
  background-color: #1c355e;
  color: white;
    border: #1c355e;
}
.tab button{
background: rgba(0,0,0,.075);
    color: black;
    border: rgba(0,0,0,.075);
}

   .tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
   </style>
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
                  <h3>Champions</h3>
                  
               </div>
                <div style="display:none;" class="card-body card_body_hide">
                  <select class="form-control filter_form" id="search_champion">
                     <option selected disabled>All</option>
                     @for($i=2001;$i<=2022;$i++)
                     <option value="{{ $i }}" {{ $i==$search ? 'selected':''}}>{{ $i }}</option>
                     @endfor
                  </select>
               </div>
               {{-- @can('add_user')
               <a class="btn btn-sm btn-success" href="{{route('add_user')}}"><i class="fas fa-plus-circle mr-2"></i>Add New </a>
               @endcan   --}}
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif

               <div class="tab">
                  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">OLD FORMULA</button>
                  <button class="tablinks" onclick="openCity(event, 'Paris')">FINAL DEC 24</button>
                </div>

                <div id="London" class="tabcontent">
                  <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable ">
                     <!-- <h5>Leading Scorer for the Current Year</h5> -->
                     
                   
                    <div class="total_data">     
                       @foreach($winnerrr_old as $win)
                       <img src="{{ $win->userImages[0]->image }}" class="hotel_profile"/>
                       <span class="id_inner_wrapper"><strong class="mr-1">Home ID : </strong> {{$win->home_key_val}}</span>
                       <div class="pt-2 mb-2 mt-2">
                          <div class="d-flex">
                             <div class="home_inner_wrapper">
                                   <span class="p-2"><strong class="mr-2">No of Reviews : </strong> {{$win->reviews_count}}</span><br>
                                   <span class="p-2"><strong class="mr-2">Contact Number : </strong> {{ ($win->homeowner == '1') ? $win->homeowner_phone : $win->nominator_phone}}</span><br>
                                   <span class="p-2"><strong class="mr-2">Email Id : </strong> {{ ($win->homeowner == '1') ? $win->homeowner_email : $win->nominator_email}}</span><br>
                             </div>
                             <div class="home_inner_wrapper ml-5">
                                   <span class="p-2"><strong class="mr-2">Average Rating : </strong> {{$win->avg_rate}}</span><br>
                                   <span class="p-2"><strong class="mr-2">Status : </strong> {{$win->status==1 ? 'Active':'Inactive'}}</span><br> 
                                    <span class="p-2"><strong class="mr-2">Leading Home of : </strong> {{date('Y', strtotime($win->created_at))}}</span> 
                             </div>
                          </div>
                       </div>
                       <button style="background: #1c355e; color: white;" type="button" class="btn  mx-auto"  data-bs-toggle="modal" data-bs-target="#create_home_tour">Send SMS</button> 
                       @endforeach
                    </div>
                    @php $now = new DateTime();  $max_date = "2022/11/25"; $max = new DateTime($max_date); $maximun_day =  $max->diff($now)->format("%d"); @endphp
      
      <div class="modal fade home_tour home_tour_wrapper" id="create_home_tour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
           <div class="modal-body">
             <div class="content">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>              
               <h4>
                 <div class="textcontainer">
                     <img src="https://server3.rvtechnologies.in/Holiday-Home-Hunt-Admin-Panel/public/images/trophy-1.png" alt="">
                    <span class="particletext confetti">Champion of Holiday Home</span>
                    <img src="https://server3.rvtechnologies.in/Holiday-Home-Hunt-Admin-Panel/public/images/trophy-1.png" alt="">
                 </div>
               </h4>
               <div class="modal_btn_wrapper">
                   <br> <h5>Send SMS to let him know that he is the winner of Holiday Home</h5><br>
                 </div>  
                 <form id="signupvoter" action="{{route('champ_sms')}}" method="POST" > 
                   @csrf
                   @foreach($winnerrr_old as $wins)
                   <input type="hidden" name="phone_no" value="{{ ($wins->homeowner == '1') ? $wins->homeowner_phone : $wins->nominator_phone}}">
                   
                   <textarea style="height:150px;" type="text" class="form-control" name="send_smss" placeholder="Enter custom SMS" required>Congratulations, {{ ($wins->homeowner == '1') ? $wins->homeowner_first_name : $wins->nominator_first_name}} ! Your nominated home in {{ ($wins->homeowner == '1') ? $wins->homeowner_location : $wins->nominator_location}} is the champion for this year's Holiday Home Hunt. We will contact you shortly to inform you of how to claim your rewards. Thank you for joining Atlanta's Holiday Home Hunt!</textarea>
                   @endforeach
                   
                   <button type="submit" class="btn btn-primary">Send SMS</button> 
                 </form>
             
               </div>
             </div>
           </div>
         </div>
       </div>
      </div>
      
      
      
      
                       <thead>
                          <tr>
                             <th>Contestant</th>
                             <th>Location</th>
                             <th>Home Code</th>
                             <th>Published On(P)</th>
                             <th>Days published(Dp)(Diff(P,12/28))</th>
                             <th>No of Reviews(R)</th>
                             <th>Ave. Daily Reviews(AR)(R/Dp)</th>
                             <th>Bonus(B)(AR*Dp)</th>
                             <th>Average Rating</th>
                             <th>Score(S)(AR*Dp)</th>
                             <th>Final Score(S+B)</th>
                          </tr>
                       </thead>
                       <tbody>
                          @forelse($currentyearall_old as $yearall)   
                          
                        
                         
                          
                          <tr>                     
                            <td> {{ ($yearall->homeowner == '1') ? $yearall->homeowner_first_name : $yearall->nominator_first_name}} </td>
                            <td> {{ ($yearall->homeowner == '1') ? $yearall->homeowner_location : $yearall->nominator_location}}</td>
                            <td> {{$yearall->home_key_val}}</td>
                            <td>{!! date('m/d/Y', strtotime($yearall->approved_at)) !!}</td>
                              @php 
                                if( $yearall->approved_at){
                                   $date_expire = date("Y/m/d",strtotime($yearall->approved_at));   
                                   $date = new DateTime($date_expire);
                                   $now = new DateTime('2022/12/28');
                                }else{
                                   $date = new DateTime('2022/12/28');
                                   $now = new DateTime('2022/12/28'); 
                                }
                                @endphp
                                
                            <td>{!!  $date->diff($now)->format("%a"); !!}</td>
                            <td> {{$yearall->reviews_count}}</td>
                            <td> {{round($yearall->avg_daily_review,1)}}</td>
                            <td> {{round($yearall->bonus_old,2)}}</td>
                            <td> {{$yearall->avg_rate}}</td>
                            <td> {{round($yearall->bonus_old,2)}}</td>
                            <td> {{round($yearall->winner_old,2)}}</td>
                           
                          
                                   {{--  <td>
                                   
                                   <a class="action-button" title="View" href="view/{{$yearall->id}}"><i class="text-info fa fa-eye"></i></a>
                                   
                                   
                                </td> --}}     
                          </tr>
                          @empty
                          <tr>
                             <td colspan="11">No Record Found</td>
                          </tr>
                          @endforelse
                         
                       </tbody>
                    </table>

            </div>




            <div id="Paris" class="tabcontent">

               <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable table-responsive">
                  <!-- <h5>Leading Scorer for the Current Year</h5> -->
                  
                
                 <div class="total_data">     
                    @foreach($winnerrr as $win)
                    <img src="{{ $win->userImages[0]->image }}" class="hotel_profile"/>
                    <span class="id_inner_wrapper"><strong class="mr-1">Home ID : </strong> {{$win->home_key_val}}</span>
                    <div class="pt-2 mb-2 mt-2">
                       <div class="d-flex">
                          <div class="home_inner_wrapper">
                                <span class="p-2"><strong class="mr-2">No of Reviews : </strong> {{$win->reviews_count}}</span><br>
                                <span class="p-2"><strong class="mr-2">Contact Number : </strong> {{ ($win->homeowner == '1') ? $win->homeowner_phone : $win->nominator_phone}}</span><br>
                                <span class="p-2"><strong class="mr-2">Email Id : </strong> {{ ($win->homeowner == '1') ? $win->homeowner_email : $win->nominator_email}}</span><br>
                          </div>
                          <div class="home_inner_wrapper ml-5">
                                <span class="p-2"><strong class="mr-2">Average Rating : </strong> {{$win->avg_rate}}</span><br>
                                <span class="p-2"><strong class="mr-2">Status : </strong> {{$win->status==1 ? 'Active':'Inactive'}}</span><br> 
                                 <span class="p-2"><strong class="mr-2">Leading Home of : </strong> {{date('Y', strtotime($win->created_at))}}</span> 
                          </div>
                       </div>
                    </div>
                    {{-- <button style="background: #1c355e; color: white;" type="button" class="btn  mx-auto"  data-bs-toggle="modal" data-bs-target="#create_home_tour">Send SMS</button> --}} 
                    @endforeach
                 </div>
                 @php $now = new DateTime();  $max_date = "2022/11/25"; $max = new DateTime($max_date); $maximun_day =  $max->diff($now)->format("%d"); @endphp
  
  <div class="modal fade home_tour home_tour_wrapper" id="create_home_tour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>              
            <h4>
              <div class="textcontainer">
                  <img src="https://server3.rvtechnologies.in/Holiday-Home-Hunt-Admin-Panel/public/images/trophy-1.png" alt="">
                 <span class="particletext confetti">Champion of Holiday Home</span>
                 <img src="https://server3.rvtechnologies.in/Holiday-Home-Hunt-Admin-Panel/public/images/trophy-1.png" alt="">
              </div>
            </h4>
            <div class="modal_btn_wrapper">
                <br> <h5>Send SMS to let him know that he is the winner of Holiday Home</h5><br>
              </div>  
              <form id="signupvoter" action="{{route('champ_sms')}}" method="POST" > 
                @csrf
                @foreach($winnerrr as $wins)
                <input type="hidden" name="phone_no" value="{{ ($wins->homeowner == '1') ? $wins->homeowner_phone : $wins->nominator_phone}}">
                
                <textarea style="height:150px;" type="text" class="form-control" name="send_smss" placeholder="Enter custom SMS" required>Congratulations, {{ ($wins->homeowner == '1') ? $wins->homeowner_first_name : $wins->nominator_first_name}} ! Your nominated home in {{ ($wins->homeowner == '1') ? $wins->homeowner_location : $wins->nominator_location}} is the champion for this year's Holiday Home Hunt. We will contact you shortly to inform you of how to claim your rewards. Thank you for joining Atlanta's Holiday Home Hunt!</textarea>
                @endforeach
                
                <button type="submit" class="btn btn-primary">Send SMS</button> 
              </form>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                    <thead>
                       <tr>
                          <th>Contestant</th>
                          <th>Location</th>
                          <th>Home Code</th>
                          <th>Published On(P)</th>
                          <th>Days published(Dp)(Diff(P,12/28))</th>
                          <th>No of Reviews(R)</th>
                          <th>34-day competition x ADR(Score)</th>
                          <th>Ave. Daily Reviews(AR)(R/Dp)</th>
                          <th>Average Rating(Avg)</th>
                          <th>Final Score(Score*Avg)</th>
                       </tr>
                    </thead>
                    <tbody>
                       @forelse($currentyearall as $yearall)   
                       <tr>                     
                         <td> {{ ($yearall->homeowner == '1') ? $yearall->homeowner_first_name : $yearall->nominator_first_name}} </td>
                         <td> {{ ($yearall->homeowner == '1') ? $yearall->homeowner_location : $yearall->nominator_location}}</td>
                         <td> {{$yearall->home_key_val}}</td>
                         <td>{!! date('m/d/Y', strtotime($yearall->approved_at)) !!}</td>
                           @php 
                             if( $yearall->approved_at){
                                $date_expire = date("Y/m/d",strtotime($yearall->approved_at));   
                                $date = new DateTime($date_expire);
                                $now = new DateTime('2022/12/28');
                             }else{
                                $date = new DateTime('2022/12/28');
                                $now = new DateTime('2022/12/28'); 
                             }
                             @endphp
                             
                         <td>{!!  $date->diff($now)->format("%a"); !!}</td>
                         <td> {{$yearall->reviews_count}}</td>
                         <td>{{round($yearall->bonus,2)}}</td>
                         <td> {{round($yearall->avg_daily_review,1)}}</td>
                         <td> {{$yearall->avg_rate}}</td>
                         <td> {{round($yearall->winner,2)}}</td>
                        
                       
                                {{--  <td>
                                
                                <a class="action-button" title="View" href="view/{{$yearall->id}}"><i class="text-info fa fa-eye"></i></a>
                                
                                
                             </td> --}}     
                       </tr>
                       @empty
                       <tr>
                          <td colspan="10">No Record Found</td>
                       </tr>
                       @endforelse
                      
                    </tbody>
                 </table>











 
            </div>


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
<!-- <script type="text/javascript" src="{{asset('js/sortelements.js')}}"></script>
<script type="text/javascript" src="{{asset('js/table_sort_init.js')}}"></script> -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <script>
     

      function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
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
                      columns: [0,1,2,3,4,5,6,7,8,9,10]
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
  <script>
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

         $('#search_champion').change(function(){
            var search_query = $(this).val();
               window.location.href = "{{url('admin_panel/champion/list')}}" + "/" + search_query;
           });

     </script>
@stop
