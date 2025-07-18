@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <!-- <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}"> -->
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif


@section('auth_body')
    <div class="login_wrap">
<!--       <div class="left">
          <div class="left_inner">
              <img src="images/logo.png"> 
          </div>
      </div>   -->
      <div class="right">
             <div class="right_inner">
                 <div class="logo_image">
                     <img src="images/login_logo.png">             
                 </div>
                 <div class="card-header-heading">
                    <h3 class="card-title float-none text-center">Admin Login</h3>
                </div>
            @if (session('message'))
            <div class="alert {{ session('class') }}" role="alert">
                  {!! session('message') !!}
                </div>
            @endif
                <form action="{{ $login_url }}" method="post" id="loginForm" class="position-relative">
                        {{ csrf_field() }}

                        {{-- Email field --}}
                        <div class="input-group mb-3 position-relative">
                            <label>Email</label>
                            <div class="icon">
                                <img src="images/email.png">
                            </div>
                            <input type="email" name="email" placeholder="Email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" autofocus>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- Password field --}}
                        <div class="input-group mb-4 position-relative">
                            <label>Password</label>
                            <div class="icon">
                                <img src="images/password.png">
                            </div>                            
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                            <i class="fas fa-eye view_pass"></i>
                        </div>

                        {{-- Login field --}}
                        <div class="row">
                            <div class="col-12">
                                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                    <img src="images/btn-arrow-white.png" alt="" class="mr-2">
                                    <span class="fas fa-sign-in-alt"></span>
                                    {{ __('adminlte::adminlte.log_in') }}
                                </button>
                            </div>
                        </div>
                    </form>
             </div>
        </div>
    </div>
@stop

@section('adminlte_js')

<style>
#toggle-link{
    float: right;
    color: #ffffff;
    font-size: 14px;
    background: #0f5132;
    padding: 2px 5px;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: auto;
}
#password{
background: transparent;
    border: none;
    width: fit-content;
}
#password_message{
    background: transparent;
    border-color: transparent;
    /*width: auto;*/
    padding: 0;
    /*text-align: right;*/
}
</style>
<script type="text/javascript">
    $(document).on('click','.view_pass',function(){
        console.log('view_pass');  
        $(this).removeAttr('class');
        if($('#password').attr('type')=='password'){
            $('#password').attr('type','text');
            $(this).addClass('fas fa-eye-slash view_pass');
        }else{
            $('#password').attr('type','password');
            $(this).addClass('fas fa-eye view_pass');
        }              
    })
</script>

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script>
    $('#loginForm').validate({
        ignore: [],
        debug: false,
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Email  is required",
                email: "Please enter a valid Email"
            },
            password: {
                required: "  Password is required"
            }
        }
    });



const password = document.getElementById('password_message');
const toggle = document.getElementById('toggle-link');

  toggle.addEventListener('click', function() {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
    // const passwordValue = password.value;
    // const halfLength = Math.floor(passwordValue.length * 1);
    // const hiddenChars = '•'.repeat(halfLength);
    // const visibleChars = passwordValue.slice(halfLength);
    // password.value = type === 'password' ? hiddenChars + visibleChars : password.value;
});




</script>
@stop