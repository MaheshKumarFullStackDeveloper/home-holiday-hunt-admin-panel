@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      @can('view_user')
      <div class="col-md-4 col-lg-4 col-xl-3 col-12 " >
        <div class="small-box user">
          <div class="inner">
            <div class="left">
              <i class="fa fa-users" style="color:white;font-size:20px" class="p-4"></i>
              {{-- <img src="https://server3.rvtechnologies.in/Siddiq-HiActa-Admin/public/images/user-two.svg" alt=""> --}}
            </div>
            <div class="right">
              <p>Champion</p>
              <h3>{{$usersCount ?? ''}}</h3>
            </div>
          </div>
           {{-- <a data-bs-toggle="modal" data-bs-target="#create_home_tour" href="{{ route('champion.list')}}" class="small-box-footer justify-content-between">
            More Info <img src="https://server3.rvtechnologies.in/Solomon-Royal-Miraa-Admin/public/images/next-three.svg" alt="">
          </a>  --}}
           <a href="{{ route('champion.list') }}"  class="small-box-footer justify-content-between">
            More Info
            <i class="fa fa-arrow-right"></i> 
            {{-- <img src="https://server3.rvtechnologies.in/Solomon-Royal-Miraa-Admin/public/images/next-three.svg" alt=""> --}}
          </a>
        </div>
      </div>
      @endcan
        @can('view_user')
        <div class="col-md-4 col-lg-4 col-xl-3 col-12 " >
          <div class="small-box user">
            <div class="inner">
              <div class="left">
                <i class="fa fa-users" style="color:white;font-size:20px" class="p-4"></i>
                {{-- <img src="https://server3.rvtechnologies.in/Siddiq-HiActa-Admin/public/images/user-two.svg" alt=""> --}}
              </div>
              <div class="right">
                <p>User</p>
                <h3>{{$usersCount ?? ''}}</h3>
              </div>
            </div>
            <a href="{{ route('user_list') }}" class="small-box-footer justify-content-between">
              More Info 
              <i class="fa fa-arrow-right"></i>
              {{-- <img src="https://server3.rvtechnologies.in/Solomon-Royal-Miraa-Admin/public/images/next-three.svg" alt=""> --}}
            </a>
          </div>
        </div>
          @endcan
        
         @can('view_admin')
         <div class="col-md-4 col-lg-4 col-xl-3 col-12">
          <div class="small-box admin">
            <div class="inner">
              <div class="left">
                <i class="fa fa-user" style="color:white;font-size:20px" class="p-4"></i>
                {{-- <img src="https://server3.rvtechnologies.in/Siddiq-HiActa-Admin/public/images/admin-icon.svg" alt=""> --}}
              </div>
              <div class="right">
                <p>Admin</p>
                <h3>{{$admincounts ?? ''}}</h3>
              </div>
            </div>
            <a href="{{ route('admins_list') }}" class="small-box-footer justify-content-between">
              More Info
              <i class="fa fa-arrow-right"></i> 
              {{-- <img src="https://server3.rvtechnologies.in/Solomon-Royal-Miraa-Admin/public/images/next-three.svg" alt=""> --}}
            </a>
          </div>
        </div>
        @endcan
      
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- Modal -->
<!-- <div id="confetti-wrapper-first-id"><p>Hei</p></div> -->
<div class="modal fade home_tour home_tour_wrapper" id="create_home_tour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>              
          <h4>
            <div class="textcontainer">
               
               <span class="particletext confetti"><center>Select Year</center></span>
              
            </div>
          </h4>
          <div class="modal_btn_wrapper">
            <div class="col-sm-12">
              <div class="form-group">
                <br><br><br>
                 <label for="last_name">PLEASE SELECT THE YEAR YOU WANT TO SEE THE DATA:</label><br><br>       
                 <input type="text" class="form-control" id="search-year2" name="search-year" value="{{ Session::get('years_data') ? Session::get('years_data') : '2023' }}">         
              </div>
           </div><br><br><br><br><br><br><br>
           
              
            
         
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- /.content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$( window ).load(function() {
  var loginyearr = "{{ Session::get('years_data')  }}";
  if(loginyearr == ''){
  $("#create_home_tour").modal("show");
  }
});

</script>
<script>
  $(document).ready(function() {
    $("#search-year2").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        startDate: "2022",
          endDate: "currentDate",
            maxDate: "currentDate"
    });
    $('#search-year2').change(function(){
      var search_query_year = $(this).val();
      window.location.href = "{{url('admin_panel/year')}}" + "/" + search_query_year;
    });
  });
 
</script>






<script type="text/javascript">
 function initparticles() {
   bubbles();
   hearts();
   lines();
   confetti();
   fire();
   sunbeams();
}

/*The measurements are ... whack (so to say), for more general text usage I would generate different sized particles for the size of text; consider this pen a POC*/

function bubbles() {
   $.each($(".particletext.bubbles"), function(){
      var bubblecount = ($(this).width()/50)*10;
      for(var i = 0; i <= bubblecount; i++) {
         var size = ($.rnd(40,80)/10);
         $(this).append('<span class="particle" style="top:' + $.rnd(20,80) + '%; left:' + $.rnd(0,95) + '%;width:' + size + 'px; height:' + size + 'px;animation-delay: ' + ($.rnd(0,30)/10) + 's;"></span>');
      }
   });
}

function hearts() {
   $.each($(".particletext.hearts"), function(){
      var heartcount = ($(this).width()/50)*5;
      for(var i = 0; i <= heartcount; i++) {
         var size = ($.rnd(60,120)/10);
         $(this).append('<span class="particle" style="top:' + $.rnd(20,80) + '%; left:' + $.rnd(0,95) + '%;width:' + size + 'px; height:' + size + 'px;animation-delay: ' + ($.rnd(0,30)/10) + 's;"></span>');
      }
   });
}

function lines() {
   $.each($(".particletext.lines"), function(){
      var linecount = ($(this).width()/50)*10;
      for(var i = 0; i <= linecount; i++) {
         $(this).append('<span class="particle" style="top:' + $.rnd(-30,30) + '%; left:' + $.rnd(-10,110) + '%;width:' + $.rnd(1,3) + 'px; height:' + $.rnd(20,80) + '%;animation-delay: -' + ($.rnd(0,30)/10) + 's;"></span>');
      }
   });
}

function confetti() {
   $.each($(".particletext.confetti"), function(){
      var confetticount = ($(this).width()/50)*10;
      for(var i = 0; i <= confetticount; i++) {
         $(this).append('<span class="particle c' + $.rnd(1,2) + '" style="top:' + $.rnd(10,50) + '%; left:' + $.rnd(0,100) + '%;width:' + $.rnd(6,8) + 'px; height:' + $.rnd(3,4) + 'px;animation-delay: ' + ($.rnd(0,30)/10) + 's;"></span>');
      }
   });
}

function fire() {
   $.each($(".particletext.fire"), function(){
      var firecount = ($(this).width()/50)*20;
      for(var i = 0; i <= firecount; i++) {
         var size = $.rnd(8,12);
         $(this).append('<span class="particle" style="top:' + $.rnd(40,70) + '%; left:' + $.rnd(-10,100) + '%;width:' + size + 'px; height:' + size + 'px;animation-delay: ' + ($.rnd(0,20)/10) + 's;"></span>');
      }
   });
}

function sunbeams() {
   $.each($(".particletext.sunbeams"), function(){
      var linecount = ($(this).width()/50)*10;
      for(var i = 0; i <= linecount; i++) {
         $(this).append('<span class="particle" style="top:' + $.rnd(-50,0) + '%; left:' + $.rnd(0,100) + '%;width:' + $.rnd(1,3) + 'px; height:' + $.rnd(80,160) + '%;animation-delay: -' + ($.rnd(0,30)/10) + 's;"></span>');
      }
   });
}

jQuery.rnd = function(m,n) {
      m = parseInt(m);
      n = parseInt(n);
      return Math.floor( Math.random() * (n - m + 1) ) + m;
}

initparticles();




</script>