@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
 

@section('content')

<div class="container px-1">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                  <div class="icon_main">
                     <i class="fas fa-fw fa-user-friends "></i>
                  </div>
                  <h3>Add Plan</h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form id="addPlan" method="post"  action="{{ route('subscription-plan.save_plan') }}" onload="resetForm()" autocomplete="off" enctype="multipart/form-data">
                  @csrf
                  <div class="row mx-0">
                    
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="first_name">Plan Name<span class="text-danger"> *</span></label>
                           <input type="text" name="plan_name" class="form-control" id="plan_name" >
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="last_name">Plan Duration </label>
                           <select class="form-select form-control" aria-label="Default select example" name="plan_duration" id="plan_duration">
                             <option value="">--Select Plan Duration--</option>
                             <option value="1">1 Month</option>
                             <option value="2">2 Month</option>
                             <option value="3">3 Month</option>
                             <option value="4">4 Month</option>
                             <option value="5">5 Month</option>
                             <option value="6">6 Month</option>
                             <option value="7">7 Month</option>
                             <option value="8">8 Month</option>
                             <option value="9">9 Month</option>
                             <option value="10">10 Month</option>
                             <option value="11">11 Month</option>
                             <option value="12">12 Month</option>
                           </select>               
                        </div>
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                           <label for="plan_price">Plan Price($)<span class="text-danger"> *</span></label>
                           <br>
                           <input type="text"  name="plan_price" class="form-control"  id="planPrice"  autocomplete="false"/>
                           
                        </div>
                     </div>
                     
                  </div>
                  <div class="card-footer text-left">
                     <button type="text" class="btn btn-primary common_btn addagent_btn">{{ __('adminlte::adminlte.save') }}</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>



@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

<style>
 .profile-image-show{
        position: relative;
 }

 #profile_picture{
     border:1px solid red;
     width:100% !important;
     height:100% !important;
     border-radius:20%;
     position:absolute;
     opacity:0;
     
  }
</style>

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript">
  $(function () {
      var code = "+91";  
      $('#txtPhone').val(code);
      $('#txtPhone').intlTelInput({
          autoHideDialCode: true,
          autoPlaceholder: "ON",
          dropdownContainer: document.body,
          formatOnDisplay: true,
           
          initialCountry: "auto",
          nationalMode: true,
          placeholderNumberType: "MOBILE",
          preferredCountries: ['US'],
          separateDialCode: true
      });
     


       
  });

  $("#txtPhone").on('focusout',function(){
    var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
     $('#country_code').val(code);
  });

</script>


  <script>
    $(document).ready(function() {

        $("input").attr("autocomplete", "new-password");
    

    
      //Validator
  $('#addPlan').validate({
ignore: [],
debug: false,
rules: {
plan_name: {
required: true,
},
plan_duration: {
required: true,
remote:{
type:"post",
url:"{{route('subscription-plan.checkPlan')}}",
data: {
"plan_duration": function() { return $("#plan_duration").val(); },
"_token": "{{ csrf_token() }}",
},
dataFilter: function (result) {
var json = JSON.parse(result);
if (json.msg == 1) {
return "\"" + $("#plan_duration").val()+ " months plan already existed, Please choose another one" + "\"";
} else {
return 'true';
}
}    
}
},
plan_price: {
required: true,
digits: true,
},
},
messages: {
plan_name :{
required: "Plan Name is required"
},
plan_duration: {
required: "Plan Duration is required"
},
plan_price:{
required:"Plan Price is required",
digits: "Only digits are required",
},
}
});
 

jQuery.validator.addMethod("phone_valid", function(value, element) { 
return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
// just ascii letters
},"Please enter vaild numer");
jQuery.validator.addMethod("alpha", function(value, element) { 
return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
// just ascii letters
},"Please use alphabets only");
         
      
    });






$('#profile_picture').on('change',function(){
           var files = this.files[0];
        
        if(files.size > 2010000){

            swal({
            title: "Error",
            text: "The file is too large. Allowed maximum size is 2MB.",
            type: "warning",
            showCancelButton: true,
            });

          this.value =null;
           

        }else{
           var blob_url = URL.createObjectURL(event.target.files[0]);
        $('#profileImage').attr('src', blob_url);
        $("#profileImage").removeClass("d-none");
        $(".thumb_nails").addClass("d-none");
        $("#profile_picture").addClass("d-none");
        $(".remove-pro-img").removeClass("d-none");
        } 
    });





$(".remove-pro-img").click(function(evt){      
   
                  $(".remove-pro-img").addClass("d-none");
                  $("#profileImage").addClass("d-none");
                  $(".thumb_nails").removeClass("d-none");
                  $("#profile_picture").removeClass("d-none");
                $("#profile_picture").val(null);  
    
 
  });


  </script>
@stop
