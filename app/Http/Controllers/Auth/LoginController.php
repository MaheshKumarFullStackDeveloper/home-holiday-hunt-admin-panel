<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function login(Request $request)
    {

        //echo "hello";die;
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
     //   dd($request->all());
        //echo"<pre>";print_r($request->all());die;

        if (\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin_panel/dashboard');
        }
       // echo "hello";die;
        session()->flash('status', 'Invalid credentials. Please check and try again.');
        session()->flash('message', 'Invalid credentials. Please check and try again.');
        session()->flash('class', 'alert-danger');


        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request) {
       
       //  dd($request->all());
         if(\Auth::guard('admin')->check()){
          \Auth::guard('admin')->logout();
           return redirect('/login');
          }else{
             return redirect('/login');
       }
    }

}
