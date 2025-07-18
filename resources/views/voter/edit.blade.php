@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
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
                  <h3>Edit User </h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif

            
               <form id="user_edit_form"     enctype='multipart/form-data' class="dropzone" style="border:none" name="demoform">
                  <input class="form-control" type="hidden"  value="{{ $editUser->id }}" name="user_id" >
                  <input type="hidden" id="old_images_name"  name="old_images_name">
                  <div class="row">
                     
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>First Name</label>
                           <input type="text" class="form-control" maxlength="20"  value="{{ $editUser->first_name }}" name="first_name" readonly>

                        </div>
                     </div>
                     
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Last Name</label>
                           <input type="text" class="form-control" maxlength="20"  value="{{ $editUser->last_name }}" name="last_name" readonly>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Email</label>
                           <input readonly  type="email" class="form-control" value="{{ $editUser->email }}" name="email"  >
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Location</label>
                           <input readonly  type="location" class="form-control" value="{{ $editUser->location }}" name="location"  >
                        </div>
                     </div>  
                     @if($editUser->status  == '0')
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                        <label>Status</label>
                           <select data-placeholder="Pending" class="{{-- chosen-select --}} form-control w-100" name="status" id="status">
                              <option {{ ($editUser->status  == '0') ? 'selected' : ''}} value="0" disabled>Pending</option>
                              <option {{ ($editUser->status  == '1') ? 'selected' : ''}}value="1">Approved</option>
                              <option {{ ($editUser->status  == '2') ? 'selected' : ''}} value="2">Decline</option>
                           </select>
                        </div>
                     </div>
                     @elseif($editUser->status  == '1') 
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Status</label>
                           <input readonly  type="status" class="form-control" value="Approved" name="status"  >
                        </div>
                     </div> 
                     @else
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Status</label>
                           <input readonly  type="status" class="form-control" value="Decline" name="status"  >
                        </div>
                     </div> 
                     @endif
                 
            
                     
                    
                     
                     
                   
                           
                 
           
 </div>  
{{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
      <div class="form-group">
         <label>Is Active</label>
         <input type="checkbox" data-id="{{ $editUser->id }}" name="status" class="js-switch" {{ $editUser->user_locked == 0 ? 'checked' : '' }}>
      </div>
   </div>           
</div>  --}}
                  <div class="card-footer text-left">
                     @if($editUser->status  == '0')
                     <button type="text" class="btn btn-primary common_btn">{{ __('adminlte::adminlte.update') }}</button>
                     @else
                     <button disabled type="text" class="btn btn-primary common_btn">{{ __('adminlte::adminlte.update') }}</button>
                     @endif
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('css')

<link
rel="stylesheet"
href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
type="text/css"
/> 

<style>  
  .dropzoneDragArea {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    padding: 60px;
    text-align: center;
    margin-bottom: 15px;
    cursor: pointer;
}
.dropzone{
  box-shadow: 0px 2px 20px 0px #f2f2f2;
  border-radius: 10px;
}
</style>


@stop

@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>
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


 

</script>






<script>

/* $('#user_edit_form').validate({ // initialize the plugin
rules: {
first_name: {
required: true,
alpha:true,
rangelength:[3,20],
},
last_name: {
alpha:true,
},
email:{
required: true,
},



},
messages : {
first_name: {
required: "First name is  required"
},
last_name: {
required: "Last name is  required",
},
email: {
required: "Email  is  required",
},


}
}); */


/* 
jQuery.validator.addMethod("alpha", function(value, element) { 
      return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
  // just ascii letters
},"Please use alphabets only");

jQuery.validator.addMethod("phone_valid", function(value, element) { 
      return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
  // just ascii letters
},"Please enter vaild numer"); */






</script>






<script>


     
    
         //form submission code goes here
         $("form[name='demoform']").submit(function (event) {

         
           
          
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
               type: 'POST',
               url: "{{ route('update_user') }}",
               data: formData,
               cache: false,
               contentType: false,
               processData: false,
               success: (data) => {
                  if (data == "success") {
                     localStorage.setItem('success_data', 'User Updated Successfully');
                     window.location.href = "{{route('user_list')}}";
                  }
               },
               error: function (data) {
                  console.log(data);
               }
            });

         });

        
        
         


 


</script>










@stop
