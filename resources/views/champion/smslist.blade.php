@extends('adminlte::page')

@section('title', 'View User')

@section('content_header')
 <style>
   .button_append{
     width:95%;
   }

.holder_homeowner_all {
    height: 200px;
    width: 200px;
    border: 2px solid black;
}
#imgPreview_homeowner_all {
    max-width: 200px;
    max-height: 200px;
    min-width: 200px;
    min-height: 200px;
}

.holder_voter_all {
    height: 200px;
    width: 200px;
    border: 2px solid black;
}
#imgPreview_voter_all {
    max-width: 200px;
    max-height: 200px;
    min-width: 200px;
    min-height: 200px;
}

.holder_nominator_all {
    height: 200px;
    width: 200px;
    border: 2px solid black;
}
#imgPreview_nominator_all {
    max-width: 200px;
    max-height: 200px;
    min-width: 200px;
    min-height: 200px;
}

.holder_all_user {
    height: 200px;
    width: 200px;
    border: 2px solid black;
}
#imgPreview_all_user {
    max-width: 200px;
    max-height: 200px;
    min-width: 200px;
    min-height: 200px;
}

  </style>

@section('content')

 

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <div class="left d-flex align-items-center">
            <div class="icon_main">
              <i class="fas fa-user"></i>
            </div>
            <h3>Send SMS</h3>
          </div>         
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

         
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <form  method="post" id="user_custom_sms_homeowner" enctype='multipart/form-data' name="user_custom_sms_homeowner" style="border:none" action="{{ route('sendsms.list') }}">
                        <input type="hidden" value="all_users" name="all_users"  >
                      <div class="form-group">
                        <label>Send a Custom Text Message To Registered All Users:</label>    
                        <br>
                        <div class="row">
                          <div class="col-md-3">
                            <input type="button" class="first_name_users button_append" value="First Name" >   
                          </div> 
                          <div class="col-md-3">
                            <input type="button" class="last_name_users button_append" value="Last Name" >   
                          </div>  
                          <div class="col-md-6"></div>
                        </div><br>
                        <textarea  type="text" class="form-control" id="all_users_sms" name="all_users_sms" placeholder="Enter custom SMS" required></textarea>
                      </div>

                      <div class="add_photo position-relative" style="display: flex;align-items: center;font-size: 18px;color: #1C355E;border: 1px solid #1C355E;width: 179px;
                      justify-content: center;height: 50px;margin: 0 10px 0 0;">
                        <input id="files" class="upload_all_user" accept="image/png,image/jpeg,image/jpg" type="file" name="profile_all_user" style="position: absolute;top: 0;width: 100%;height: 100%;opacity: 0;cursor: pointer;">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 16.8889V2.11111C19 0.95 18.05 0 16.8889 0H2.11111C0.95 0 0 0.95 0 2.11111V16.8889C0 18.05 0.95 19 2.11111 19H16.8889C18.05 19 19 18.05 19 16.8889ZM5.80556 11.0833L8.44444 14.2606L12.1389 9.5L16.8889 15.8333H2.11111L5.80556 11.0833Z" fill="#1C355E"></path>
                        </svg>
                        ADD PHOTOS
                      </div><br>
                      <div style="display:none;" class="holder_all_user">
                        <img id="imgPreview_all_user" src="#" alt="pic" />
                      </div>

                      <div class="card-footer text-left" style="border-top: none;">
                        <button type="submit" class="btn btn-primary common_btn" style="margin-left: auto;
                        margin-right: unset;">Send</button> 
                      </div>
                    </form>
                  </div>


                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <form  method="post" id="user_custom_sms_homeowner" enctype='multipart/form-data' name="user_custom_sms_homeowner" style="border:none" action="{{ route('sendsms.list') }}">
                        <input type="hidden" value="all_homeowners" name="all_homeowners"  >
                      <div class="form-group">
                       
                        <label>Send a Custom Text Message To All Homeowners:</label>  
                        <br><div class="row">
                          <div class="col-md-3">
                            <input type="button" class="first_name_homeowner button_append" value="First Name" >   
                          </div> 
                          <div class="col-md-3">
                            <input type="button" class="last_name_homeowner button_append" value="Last Name" >   
                          </div>  
                          <div class="col-md-3">
                            <input type="button" class="address_homeowner button_append" value="Address" >   
                          </div>  
                          <div class="col-md-3">
                            <input type="button" class="contest_link_homeowner button_append" value="Link to Contest Entry" >   
                          </div>          
                        </div><br>      
                        <textarea type="text" class="form-control" id= "all_homeowners_sms" name="all_homeowners_sms" placeholder="Enter custom SMS" required></textarea>
                      </div>

                      <div class="add_photo position-relative" style="display: flex;align-items: center;font-size: 18px;color: #1C355E;border: 1px solid #1C355E;width: 179px;
                      justify-content: center;height: 50px;margin: 0 10px 0 0;">
                        <input id="files" class="upload_homeowner_all" accept="image/png,image/jpeg,image/jpg" type="file" name="profile_homeowner_all" style="position: absolute;top: 0;width: 100%;height: 100%;opacity: 0;cursor: pointer;">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 16.8889V2.11111C19 0.95 18.05 0 16.8889 0H2.11111C0.95 0 0 0.95 0 2.11111V16.8889C0 18.05 0.95 19 2.11111 19H16.8889C18.05 19 19 18.05 19 16.8889ZM5.80556 11.0833L8.44444 14.2606L12.1389 9.5L16.8889 15.8333H2.11111L5.80556 11.0833Z" fill="#1C355E"></path>
                        </svg>
                        ADD PHOTOS
                      </div><br>
                      <div style="display:none;" class="holder_homeowner_all">
                        <img id="imgPreview_homeowner_all" src="#" alt="pic" />
                      </div>




                      <div class="card-footer text-left" style="border-top: none;">
                        <button type="submit" class="btn btn-primary common_btn" style="margin-left: auto;
                        margin-right: unset;">Send</button> 
                      </div>
                    </form>
                  </div>

                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <form  method="post" id="user_custom_sms_homeowner" enctype='multipart/form-data' name="user_custom_sms_homeowner" style="border:none" action="{{ route('sendsms.list') }}">
                        <input type="hidden" value="all_nominators" name="all_nominators"  >
                      <div class="form-group">
                        <label>Send a Custom Text Message To All Nominators:</label>  
                        <br><div class="row">
                          <div class="col-md-3">
                            <input type="button" class="first_name_nominator button_append" value="First Name" >   
                          </div> 
                          <div class="col-md-3">
                            <input type="button" class="last_name_nominator button_append" value="Last Name" >   
                          </div>  
                          <div class="col-md-3">
                            <input type="button" class="address_nominator button_append" value="Address" >   
                          </div>  
                          <div class="col-md-3">
                            <input type="button" class="contest_link_nominator button_append" value="Link to Contest Entry" >   
                          </div>          
                        </div><br>             
                        <textarea type="text" class="form-control"  id= "all_nominators_sms" name="all_nominators_sms" placeholder="Enter custom SMS" required></textarea>
                      </div>

                      <div class="add_photo position-relative" style="display: flex;align-items: center;font-size: 18px;color: #1C355E;border: 1px solid #1C355E;width: 179px;
                      justify-content: center;height: 50px;margin: 0 10px 0 0;">
                        <input id="files" class="upload_nominator_all" accept="image/png,image/jpeg,image/jpg" type="file" name="profile_nominator_all" style="position: absolute;top: 0;width: 100%;height: 100%;opacity: 0;cursor: pointer;">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 16.8889V2.11111C19 0.95 18.05 0 16.8889 0H2.11111C0.95 0 0 0.95 0 2.11111V16.8889C0 18.05 0.95 19 2.11111 19H16.8889C18.05 19 19 18.05 19 16.8889ZM5.80556 11.0833L8.44444 14.2606L12.1389 9.5L16.8889 15.8333H2.11111L5.80556 11.0833Z" fill="#1C355E"></path>
                        </svg>
                        ADD PHOTOS
                      </div><br>
                      <div style="display:none;" class="holder_nominator_all">
                        <img id="imgPreview_nominator_all" src="#" alt="pic" />
                      </div>

                      <div class="card-footer text-left" style="border-top: none;">
                        <button type="submit" class="btn btn-primary common_btn" style="margin-left: auto;
                        margin-right: unset;">Send</button> 
                      </div>
                    </form>
                  </div>

                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <form  method="post" id="user_custom_sms_homeowner" enctype='multipart/form-data' name="user_custom_sms_homeowner" style="border:none" action="{{ route('sendsms.list') }}">
                        <input type="hidden" value="all_voters" name="all_voters"  >
                      <div class="form-group">
                        <label>Send a Custom Text Message To All Voters:</label>   
                        <br>
                        <div class="row">
                          <div class="col-md-3">
                            <input type="button" class="first_name_voter button_append" value="First Name" >   
                          </div> 
                          <div class="col-md-3">
                            <input type="button" class="last_name_voter button_append" value="Last Name" >   
                          </div>  
                          <div class="col-md-6"></div>
                        </div><br>          
                        <textarea type="text" class="form-control" id="all_voters_sms" name="all_voters_sms" placeholder="Enter custom SMS" required></textarea>
                      </div>

                      <div class="add_photo position-relative" style="display: flex;align-items: center;font-size: 18px;color: #1C355E;border: 1px solid #1C355E;width: 179px;
                      justify-content: center;height: 50px;margin: 0 10px 0 0;">
                        <input id="files" class="upload_voter_all" accept="image/png,image/jpeg,image/jpg" type="file" name="profile_voter_all" style="position: absolute;top: 0;width: 100%;height: 100%;opacity: 0;cursor: pointer;">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 16.8889V2.11111C19 0.95 18.05 0 16.8889 0H2.11111C0.95 0 0 0.95 0 2.11111V16.8889C0 18.05 0.95 19 2.11111 19H16.8889C18.05 19 19 18.05 19 16.8889ZM5.80556 11.0833L8.44444 14.2606L12.1389 9.5L16.8889 15.8333H2.11111L5.80556 11.0833Z" fill="#1C355E"></path>
                        </svg>
                        ADD PHOTOS
                      </div><br>
                      <div style="display:none;" class="holder_voter_all">
                        <img id="imgPreview_voter_all" src="#" alt="pic" />
                      </div>

                      <div class="card-footer text-left" style="border-top: none;">
                        <button type="submit" class="btn btn-primary common_btn" style="margin-left: auto;
                        margin-right: unset;">Send</button> 
                      </div>
                    </form>
                  </div>
            </div>    
          

         


        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')



@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


 <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>


<script>
$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!",
  max_selected_options: 3
})
</script>



<script type="text/javascript">
// All homeowner 
$(".first_name_homeowner").on("click",function () {
  var first_name_homeowner = 'first_name_homeowner';
    $('#all_homeowners_sms').val($('#all_homeowners_sms').val()+" "+first_name_homeowner);
});
$(".last_name_homeowner").on("click",function () {
  var last_name_homeowner = 'last_name_homeowner';
    $('#all_homeowners_sms').val($('#all_homeowners_sms').val()+" "+last_name_homeowner);
});
$(".address_homeowner").on("click",function () {
  var address_homeowner = 'address_homeowner';
    $('#all_homeowners_sms').val($('#all_homeowners_sms').val()+" "+address_homeowner);
});
$(".contest_link_homeowner").on("click",function () {
  var contest_link_homeowner = 'contest_link_homeowner';
    $('#all_homeowners_sms').val($('#all_homeowners_sms').val()+" "+contest_link_homeowner);
});

//All Nominator

$(".first_name_nominator").on("click",function () {
  var first_name_nominator = 'first_name_nominator';
    $('#all_nominators_sms').val($('#all_nominators_sms').val()+" "+first_name_nominator);
});
$(".last_name_nominator").on("click",function () {
  var last_name_nominator = 'last_name_nominator';
    $('#all_nominators_sms').val($('#all_nominators_sms').val()+" "+last_name_nominator);
});
$(".address_nominator").on("click",function () {
  var address_nominator = 'address_nominator';
    $('#all_nominators_sms').val($('#all_nominators_sms').val()+" "+address_nominator);
});
$(".contest_link_nominator").on("click",function () {
  var contest_link_nominator = 'contest_link_nominator';
    $('#all_nominators_sms').val($('#all_nominators_sms').val()+" "+contest_link_nominator);
});


// All users 
$(".first_name_users").on("click",function () {
  var first_name_users = 'first_name_users';
    $('#all_users_sms').val($('#all_users_sms').val()+" "+first_name_users);
});
$(".last_name_users").on("click",function () {
  var last_name_users = 'last_name_users';
    $('#all_users_sms').val($('#all_users_sms').val()+" "+last_name_users);
});


// All voters 
$(".first_name_voter").on("click",function () {
  var first_name_voter = 'first_name_voter';
    $('#all_voters_sms').val($('#all_voters_sms').val()+" "+first_name_voter);
});
$(".last_name_voter").on("click",function () {
  var last_name_voter = 'last_name_voter';
    $('#all_voters_sms').val($('#all_voters_sms').val()+" "+last_name_voter);
});

/*   $(document).on("click", ".keywordClick", function () {
 var appendText = " " + $(this).attr('value');

  $('.all_users_sms').val( function( index, oldVal ) {
     return oldVal + appendText;
  });
}); */

 
</script>

<script>
  $(document).ready(()=>{
      $('.upload_homeowner_all').change(function(){
       $(".holder_homeowner_all").show();
       const file = this.files[0];
       console.log(file);
       if (file){
         let reader = new FileReader();
         reader.onload = function(event){
           console.log(event.target.result);
           $('#imgPreview_homeowner_all').attr('src', event.target.result);
         }
         reader.readAsDataURL(file);
       }
     });

     $('.upload_all_user').change(function(){
       $(".holder_all_user").show();
       const file = this.files[0];
       console.log(file);
       if (file){
         let reader = new FileReader();
         reader.onload = function(event){
           console.log(event.target.result);
           $('#imgPreview_all_user').attr('src', event.target.result);
         }
         reader.readAsDataURL(file);
       }
     });
     
     $('.upload_nominator_all').change(function(){
       $(".holder_nominator_all").show();
       const file = this.files[0];
       console.log(file);
       if (file){
         let reader = new FileReader();
         reader.onload = function(event){
           console.log(event.target.result);
           $('#imgPreview_nominator_all').attr('src', event.target.result);
         }
         reader.readAsDataURL(file);
       }
     });

     $('.upload_voter_all').change(function(){
       $(".holder_voter_all").show();
       const file = this.files[0];
       console.log(file);
       if (file){
         let reader = new FileReader();
         reader.onload = function(event){
           console.log(event.target.result);
           $('#imgPreview_voter_all').attr('src', event.target.result);
         }
         reader.readAsDataURL(file);
       }
     });
    });
</script>




 

@stop
