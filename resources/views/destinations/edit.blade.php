@extends('adminlte::page')

@section('title', 'Edit Destination')

@section('content_header')

@section('content')

<div class="container">
      <div class="alert d-none" id="flash-message"></div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                  <div class="icon_main">
                     <i class="fas fa-fw fa-universal-access "></i>
                  </div>
                  <h3> Edit  Destination</h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form id="editDestinationForm" autocomplete="off" method="post" action="{{ route('update_destination') }}" onload="myFunction()" enctype="multipart/form-data">
                  @csrf
                 
                  <div class="card-body">
                     <div class="row">
                <input type="hidden" name="destination_id" value="{{ $destination->id}}">                  
                  



                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="name">Country Name<span class="text-danger"> *</span></label>
                              <input type="text" name="name" class="form-control" id="name" maxlength="100" value="{{ $destination->country_name}}" readonly>
                           </div>
                        </div>

                        
                     <div class="col-md-12">
                           <div class="form-group" id="city_div_wrapper">
                              <label for="name" class="mb-2">Available Cities<span class="text-danger"> *</span></label>
                                

                           </div>
                      </div>
                      <div class="city_heading_content">
                         <table class="table w-100 text-center">
                            <thead>
                               <tr>
                                  <th>Cities</th>
                                  <th>Status</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>

                              @if(is_array($destination->available_city))
                              @forelse($destination->available_city as $key=> $city)
                                  <tr>
                                  <td><span><img src="{!! explode('=',$city['image'])[0] !!}" height="16px" width="16px"> {!! explode('=',$city['image'])[1] !!}</span></td>
                                  <td><input  class="city_status"  data-id="{{explode('=',$city['image'])[2]}}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Enable" data-off="Disable"  {{ explode('=',$city['image'])[3]==1 ? 'checked':'' }} ></td>
                                  <td><a class="action-button delete-button 123" title="Delete" href="javascript:void(0)" data-id="{{explode('=',$city['image'])[2]}}"><i class="text-danger fa fa-trash-alt"></i></a></td>
                               </tr>
                               @empty
                               <tr><td colspan="3">No Record Found</td></tr>
                               @endforelse
                               @else
                               <tr><td colspan="3">No Record Found</td></tr>
                               @endif
                                 
                               
                            </tbody>
                         </table>
                      </div>

                    

                     </div>
                  </div>
            </div>
            <div class="card-footer text-left">
<!--             <button type="text" class="btn btn-primary common_btn">Save</button> -->
            </div>
            </form>
       
         

         </div>
      </div>
   </div>
</div>
</div>
 
  

@endsection

@section('css')
 
@stop

@section('js')
 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>  
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>  

  <script>
  
  $(document).ready(function() {
$('#editDestinationForm').validate({
ignore: [],
debug: false,
rules: {
name: {
required: true,
alpha:true,
// remote:{
// type:"post",
// url:"{{route('check_destination')}}",
// data: {
// "name": function() { return $("#name").val(); },
// "_token": "{{ csrf_token() }}",
// },
// dataFilter: function (result) {
// var json = JSON.parse(result);
// if (json.msg == 1) {
// return "\"" + "Destination is already  exist" + "\"";
// } else {
// return 'true';
// }
// }    
// }
},
 
lat:{
   required:true,
}
},
messages: {
name: {
required: "Destination name is required",
},
profile_picture:{
   required:"Destination image is required",
   

},
lat:{
   required:"Please select Destination Location form map"
}
}
});
jQuery.validator.addMethod("alpha", function(value, element) { 
return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
// just ascii letters
},"Please use alphabets only");
});

 












    

$('body').on('click','.delete-button',function(e){
var id = $(this).attr('data-id');
var obj = $(this);
swal({
title: "Are you sure?",
text: "Are you sure you want to move this Destination to the Recycle Bin  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
$.ajax({
url: "{{ route('delete_city') }}",
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
$('#flash-message').html('Destination Deleted Successfully');
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

// $('#profile_picture').on('change',function(){
//            var files = this.files[0];
//         console.log(files.type);
       
//        const validImageTypes = ['image/jpeg', 'image/png'];
//       if (!validImageTypes.includes(files.type)) {
//           swal({
//             title: "Error",
//             text: "Invalid image type. Please use only png and jpeg type.",
//             type: "warning",
//             showCancelButton: true,
//             });

//           this.value =null;
//       }
//         if(files.size > 2010000){

//             swal({
//             title: "Error",
//             text: "The file is too large. Allowed maximum size is 2MB.",
//             type: "warning",
//             showCancelButton: true,
//             });

//           this.value =null;
           

//         }else{
//            var blob_url = URL.createObjectURL(event.target.files[0]);
//         $('#profileImage').attr('src', blob_url);
//         $("#profileImage").removeClass("d-none");
//         $(".thumb_nails").addClass("d-none");
//         $("#profile_picture").addClass("d-none");
//         $(".remove-pro-img").removeClass("d-none");
//         } 
//     });





$(".remove-pro-img").click(function(evt){      
   
                  $(".remove-pro-img").addClass("d-none");
                  $("#profileImage").addClass("d-none");
                  $(".thumb_nails").removeClass("d-none");
                  $("#profile_picture").removeClass("d-none");
                $("#profile_picture").val(null);  
    
 
  });


$('.city_status').change(function(){
              var id = $(this).data("id");
              var status_value = $(this).prop('checked') == true ? 1 : 0;
              $.ajax({
                     type:"post",
                     url:"{{ route('change.city.status') }}",
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
