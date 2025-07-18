@extends('adminlte::page')

@section('title', 'Add Currency')

@section('content_header')
 

@section('content')

  <?php 

 

// foreach($countries_with_currencies as $key => $value){
//   print_r($value->id);
//   print_r($value->country);
//   print_r($value->currency);
//   print_r($value->code);
//   print_r($value->symbol);
  
// }

?>  


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Add Currency</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="add_country" method="post"   action="{{route('save_country')}}"  >
              @csrf
              <div class="card-body">                
                <div class="row">

                 <div class="col-12">
                    <div class="form-group">
                      <label for="country">Country Name<span class="text-danger"> *</span></label>
                        <select class="form-control country" name="country" id="country">
                                <option hidden value="">Please Select country </option>
                            
                          @foreach($countries_with_currencies as $key => $value)
                                 
                                <option {{ in_array($value->country, $existing_currency)==true ? 'disabled':''}}
                                 currency="{{ $value->currency_name}}" code="{{ $value->iso_code}}"  >  {{$value->country}} </option>
                          @endforeach
                        </select>
                    </div>
                  </div> 

                 
              
                  <div class="col-12">
                    <div class="form-group">
                      <label for="currency_name">Currency Name<span class="text-danger"> *</span></label>
                      <input type="text" name="currency_name" class="form-control" id="currency_name"  readonly>
                     
                    </div>
                  </div>    
                    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="iso_code">Currency Code (ISO)<span class="text-danger"> *</span></label>
                      <input type="text" name="iso_code" class="form-control" id="iso_code" readonly>
                   
                    </div>
                  </div>                

                    
               </div>
              </div>
             
              <div class="card-footer">
                <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
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
   
$(document).ready(function(){
   $('.country').on('change',function(){
    var currency = $('option:selected', this).attr('currency');
    var iso_code = $('option:selected', this).attr('code');
      $("#currency_name").val(currency);
      $("#iso_code").val(iso_code);
   });
});



$('#add_country').validate({ // initialize the plugin
    
    rules: {
      country:{
           required: true,
           remote:{
                  type:"get",
                  url:"{{ route('check_country') }}",
                  data: {
                        "country": function() { return $("#country").val(); },
                        "_token": "{{ csrf_token() }}",               
                      },
                      dataFilter: function (result) {
                          console.log(result);
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + " Country name is already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
        },

     },
 messages : {
  country: {
           required: "Please select country",
      },
 
    }

});




</script>








@stop
