@extends('adminlte::page')

@section('title', 'Admin Details')

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
              <h3>{{ __('adminlte::adminlte.change_credentials') }}</h3>
          </div>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" class="form_wrap" id="change-password-form" action="{{ route('superadmin.updatePassword')}}">
            @csrf
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">


<div class="form-group">
                <div style=" position: relative;">
      <label for="new_password">{{ __('adminlte::adminlte.new_password') }}</label>
     <span id="toggle-password"><i class="fas fa-eye-slash eye-icon" id="icon-new-password"></i></span>
<input type="password" class="form-control validate-equalTo-blur error" id="new-password" name="new_password" aria-invalid="true" maxlength="14">
</div>
</div>

<div class="form-group">
                <div style=" position: relative;">
      <label for="new_password">{{ __('adminlte::adminlte.confirm_password') }}</label>
     <span id="confirm-toggle"><i class="fas fa-eye-slash eye-icon" id="icon-confirm-password"></i></span>
<input type="password" class="form-control" id="confirm-password" name="confirm_password" maxlength="14">
</div>
</div>



            
                <button type="submit" class="btn btn-primary common_btn">{{ __('adminlte::adminlte.save') }}</button>
              </div>

             
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<style>

.eye-icon{
  position: absolute;
    right: 16px;
    top: 45px;
    cursor: pointer;
}
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {


  const newpasswordField = document.getElementById('new-password');
  const newtoggleButton = document.getElementById('toggle-password');
  const newpasswordIcon = document.getElementById('icon-new-password');

  newtoggleButton.addEventListener('click', () => {
    const type = newpasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    const icontype = newpasswordField.getAttribute('type') === 'password' ? 'fas fa-eye eye-icon' : 'fas fa-eye-slash  eye-icon';
    newpasswordField.setAttribute('type', type);
    newpasswordIcon.setAttribute('class', icontype);
    // newtoggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
  });


  const confirmpasswordField = document.getElementById('confirm-password');
  const confirmtoggleButton = document.getElementById('confirm-toggle');
  const confirmpasswordIcon = document.getElementById('icon-confirm-password');

  confirmtoggleButton.addEventListener('click', () => {
    const type = confirmpasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    const icontype = confirmpasswordField.getAttribute('type') === 'password' ? 'fas fa-eye eye-icon' : 'fas fa-eye-slash eye-icon';
    confirmpasswordField.setAttribute('type', type);
    confirmpasswordIcon.setAttribute('class', icontype);
    // newtoggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
  });


  // Define custom validation rules
  $('#change-password-form').validate({
    rules: {
      new_password: {
        required: true,
        minlength: 8,
      },
      confirm_password: {
        required: true,
        minlength: 8,
        equalTo: '#new-password'
      }
    },
    messages: {
      new_password: {
        required: 'Please enter a new password.',
        minlength: 'Please enter at least {0} characters.'
      },
      confirm_password: {
        required: 'Please confirm your new password.',
        minlength: 'Please enter at least {0} characters.',
        equalTo: 'The passwords do not match.'
      }
    }
  });




});
</script>
@stop
