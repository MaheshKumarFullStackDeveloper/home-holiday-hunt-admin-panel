@extends('adminlte::page')

@section('title', 'Add Admin')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <div class="icon_main">
                <i class="fas fa-fw fa-universal-access "></i>
              </div>                  
              <h3>{{ __('adminlte::adminlte.add_admin') }}</h3>
            </div>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addAdminForm" autocomplete="off" method="post", action="{{ route('save_admin') }}" onload="myFunction()">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-6">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" maxlength="100">
                       
                    </div>
                  </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                    <input type="text" name="email" class="form-control" id="email"   maxlength="100"  / >
                    
                    
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="role_id">{{ __('adminlte::adminlte.role') }}<span class="text-danger"> *</span></label>
                    <select name="role_id" class="form-control" id="role_id">
                      <option value="" hidden>{{ __('adminlte::adminlte.select_role') }}</option>
                      <?php for ($i=0; $i < count($roles); $i++) { ?> 
                        <option value="{{ $roles[$i]->id }}">{{ $roles[$i]->name }}</option>
                      <?php } ?>
                    </select>
                    
                  </div>
                </div>
               
                <div class="col-6">
                  <div class="form-group">
                    <label for="password">Contact Number<span class="text-danger"> *</span></label>
                    <br>
                    <input type="tel"  name="phone_number" class="form-control"  id="txtPhone" />
                    <input type="hidden"  name="country_code" class="form-control"  id="country_code" /> 
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                    <input     type="password" name="password" class="form-control" id="password" maxlength="100">
                   
                     
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                    <input   type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                     
                    
                  </div>
                </div>
               </div>
              </div>
             
              <div class="card-footer text-left">
                <button type="text" class="btn btn-primary common_btn">{{ __('adminlte::adminlte.save') }}</button>
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
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
 
<script type="text/javascript">
  $(function () {
      var code = "+91 "; // Assigning value from model.
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

function myFunction() {
  document.getElementById("email").val('');
}

  $("input").attr("autocomplete", "new-password");
    
    $(document).ready(function() {

 

      $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true,
            alpha :true,
            maxlength:100,
          },
          email: {
            required: true,
            email: true,
            remote:{
                  type:"get",
                  url:"{{route('check_admin_email')}}",
                  data: {
                        "email": function() { return $("#email").val(); },
                        "_token": "{{ csrf_token() }}",
                       
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "Email ID already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
          },
          phone_number:{
            required: true,
            phone_valid: true,
          },
          role_id: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          confirm_password: {
            required: true,
            minlength: 8,
            equalTo : "#password"
          },
        },
        messages: {
          name: {
            required: "The Name is required",
           
          },
          email: {
            required: "The Email is required",
            email: "Please enter a valid Email"
          },
          role_id: {
            required: "The Role is required"
          },
          password: {
            required: "The Password is required",
            minlength: "Minimum length should be 8"
          },
          confirm_password: {
            required: "The Confirm Password is required",
            minlength: "Minimum length should be 8",
            equalTo : "The Confirm Password must be equal to Password"
          },
        }
      });

      jQuery.validator.addMethod("alpha", function(value, element) { 
      return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
  // just ascii letters
},"Please use alphabets only");

   
   jQuery.validator.addMethod("phone_valid", function(value, element) { 
      return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
  // just ascii letters
},"Please enter vaild numer");
  

    });
  </script>
@stop
