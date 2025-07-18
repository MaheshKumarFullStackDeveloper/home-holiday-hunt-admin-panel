@extends('adminlte::page')

@section('title', 'Edit Ethnicity')

@section('content_header')


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
                  <h3> Edit Ethnicity</h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form id="editInterestForm" autocomplete="off" method="post", action="{{ route('update_ethnicity') }}" onload="myFunction()">
                  @csrf
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <input type="hidden" name="ethnicity_id" value="{{ $editEthnicity->id}}">
                              <label for="name">Name<span class="text-danger"> *</span></label>
                              <input type="text" name="name" value="{{ $editEthnicity->name}}" class="form-control" id="name" maxlength="100">
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
            <div class="card-footer text-left">
            <button type="text" class="btn btn-primary common_btn">Save</button>
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
  <script>
    
    
    $(document).ready(function() {

 

      $('#editInterestForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true,
            alpha:true,
             remote:{
                  type:"post",
                  url:"{{route('check_ethnicity')}}",
                  data: {
                        "name": function() { return $("#name").val(); },
                        "_token": "{{ csrf_token() }}",
                       
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "Ethnicity is already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
          },
           
        },
        messages: {
          name: {
            required: "Ethnicity is required",
           
          },
          
        }
      });

      jQuery.validator.addMethod("alpha", function(value, element) { 
      return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
  // just ascii letters
},"Please use alphabets only");

   
 

    });
  </script>
@stop
