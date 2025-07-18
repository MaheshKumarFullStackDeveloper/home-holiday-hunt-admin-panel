@extends('adminlte::page')

@section('title', 'Edit Admin')

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
              <h3>{{ __('adminlte::adminlte.edit_admin') }}</h3>
            </div>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="updateAdminForm" method="post" action="{{ route('update_admin') }}">
              @csrf
              <input type="hidden" name="id" value="{{ $admin[0]->id }}">
              <div class="card-body form">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" value="{{ $admin[0]->name }}" maxlength="100">
                   <!--    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif -->
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ $admin[0]->email }}" readonly maxlength="100">
                      <!-- @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                      @endif -->
                    </div>
                  </div>
                  <div class="col-6">               
                    <div class="form-group">
                      <label for="role_id">{{ __('adminlte::adminlte.role') }}<span class="text-danger"> *</span></label>
                      <select name="role_id" class="form-control" id="role_id">
                          <!-- <option value="" hidden>Select Role</option> -->
                        <?php for ($i=0; $i < count($roles); $i++) { ?> 
                          <option value="{{ $roles[$i]->id }}" @if($admin[0]->role_id==$roles[$i]->id) selected @endif>{{ $roles[$i]->name }}</option>
                        <?php } ?>
                      </select>
                      <!-- @if($errors->has('role_id'))
                        <div class="error">{{ $errors->first('role_id') }}</div>
                      @endif -->
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                    <input type="password" name="password" class="form-control" id="password" maxlength="100">
                   <!--  @if($errors->has('password'))
                      <div class="error">{{ $errors->first('password') }}</div>
                    @endif -->
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                    <!-- @if($errors->has('password_confirmation'))
                      <div class="error">{{ $errors->first('password_confirmation') }}</div>
                    @endif -->
                  </div>
                </div>
               </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-left">
                <button type="text" class="btn btn-primary common_btn">{{ __('adminlte::adminlte.update') }}</button>
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
      $('#updateAdminForm').validate({
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
            email: true
          },
          role: {
            required: true
          },
          password: {
            minlength: 8
          },
          confirm_password: {
            minlength: 8,
            equalTo : "#password"
          },
        },
        messages: {
          name: {
            required: "The Name is required"
          },
          email: {
            required: "The Email is required",
            email: "Please enter a valid Email"
          },
          role: {
            required: "The Role is required"
          },
          password: {
            
            minlength: "Minimum length should be 8"
          },
          confirm_password: {
          
            minlength: "Minimum length should be 8",
            equalTo : "The Confirm Password must be equal to Password"
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
