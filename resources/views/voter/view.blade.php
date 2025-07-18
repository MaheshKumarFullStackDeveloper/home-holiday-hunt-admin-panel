@extends('adminlte::page')

@section('title', 'View User')

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
            <h3>User Details</h3>
          </div>         
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form >
            <div class="row" style="pointer-events:none;">
            
         
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" placeholder="{{ $users->first_name }}"  readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control"  placeholder="{{ $users->last_name }}" readonly>
                </div>
              </div>
            
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Email</label>
                  <input readonly  type="email" class="form-control" placeholder="{{ $users->email }}"   >
                </div>
              </div>
             
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Created At</label>
                           <input type="text" class="form-control" value="{!! date('Y/m/d', strtotime($users->created_at)) !!}" name="dob"  readonly >
                        </div>
                     </div>
                    
                     {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group">
                        <hr>
                         <label>Reviews Detail</label>
                       
                  </div>  --}}
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
            <div class="form-group">
              <hr>
              <h4>Reviews</h4>
            </div>
            @forelse ($users->voterreview as $reviews)
            <div class="row">
                  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                      <label>Name</label>
                      
                      <input type="text" class="form-control" placeholder="{{ $reviews->user->homeowner == 1 ? $reviews->user->homeowner_first_name : $reviews->user->nominator_first_name }}"  readonly>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                      <label>Rating</label>
                      <input type="text" class="form-control" placeholder="{{ $reviews->rate_count }}"  readonly>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                      <label>Comment</label>
                      <input type="text" class="form-control" placeholder="{{ $reviews->comment }}"  readonly>
                    </div>
                  </div>  
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>Location</label>
                      <input type="text" class="form-control" placeholder="{{ $reviews->user->homeowner == 1 ? $reviews->user->homeowner_location : $reviews->user->nominator_location }}"  readonly>
                    </div>
                  </div>  
                  <hr>
            </div>
            @empty
            <p>No Reviews yet</p>
           @endforelse 
           </div>  



{{-- 
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
              @forelse ($users->voterreview as $voterreview)
              <div class="form-group">
                {{ $voterreview->user->first_name }}
             </div>
              @empty
                <p>No Review</p>
              @endforelse  
             
           </div> --}}
            <div class="row">
              {{-- @forelse ($users->userImages as $user)
              <div class="col-md-3 border p-3 m-3">
                <img width="100" height="100" src="{{ $user['image'] }}">
                </div>
                @empty
                <p>No Images</p>
              @endforelse  --}}
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
  $(function () {
      var code = "+"+"{{ $users->country_code}}{{ $users->phone_number}}"; // Assigning value from model.
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






 

@stop
