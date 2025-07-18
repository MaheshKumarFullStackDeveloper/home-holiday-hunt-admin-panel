@extends('adminlte::page')

@section('title', 'Edit Currencies')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Edit Currencies</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="update_country" method="post"   action="{{route('update_country')}}"  >
              @csrf
              <div class="card-body">                
                <div class="row">
                    <input type="hidden" name="country_id" value="{{ $selCountry->id }}"    >
                     
                  <div class="col-12">
                    <div class="form-group">
                      <label for="country">Country Name<span class="text-danger"> *</span></label>
                      <input type="text" name="country" value="{{ $selCountry->country }}" class="form-control" id="country" maxlength="100">
                     
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="currency_name">Currency Name<span class="text-danger"> *</span></label>
                      <input type="text" name="currency_name" value="{{ $selCountry->currency_name }}" class="form-control" id="currency_name" maxlength="100">
                     
                    </div>
                  </div>    
                    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="iso_code">Currency Code (ISO)<span class="text-danger"> *</span></label>
                      <input type="text" name="iso_code" value="{{ $selCountry->iso_code  }}" class="form-control" id="iso_code" maxlength="10">
                   
                    </div>
                  </div>                

                    
               </div>
              </div>
             
              <div class="card-footer">
                <button type="submit" id="submit_btn" class="btn btn-primary">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>



<script>
    $('#update_country').validate({ // initialize the plugin 
    rules: {
        country: {
            required: true,
            alpha:true,
 
        },
        currency_name: {
            required: true,
            alpha:true,
    
        },
        iso_code:{
           required: true,
           alpha:true,
            
 
 
        },
     },
 messages : {
    country: {
        required: "Country name is  required"
      },
      currency_name: {
        required: "Currency name is  required",
       
      },
      iso_code: {
           required: "Currency code is required",
      },
  
 
    }

});


jQuery.validator.addMethod("alpha", function(value, element) { 
      return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
  // just ascii letters
},"Please use alphabets only");

</script>








@stop
