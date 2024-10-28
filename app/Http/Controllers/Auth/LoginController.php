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
    }
   public function login(Request $request)
   {
      $input = $request->all();
      $this->validate($request,[
        //'username'=>'required|username',
        'password'=>'required'
      ]);

      if(auth()->attempt(array('username'=>$input['username'],'password'=>$input['password'])))
      {
         if(auth()->user()->role=="Admin")
        {
            return redirect()->route('admin.home');
        }
        else if(auth()->user()->role=="Teacher")
        {
            return redirect()->route('teacher.home');
        }
        if(auth()->user()->role=="Parent")
        {
            return redirect()->route('parent.home');
        }
        if(auth()->user()->role=="Child")
        {
            return redirect()->route('child.home');
        }
        else 
        {
            return redirect()->route('home');
        }

      }
      else
      {
        return redirect()->route('login')->with('error','Input proper username/password');
      }

      
   }
   public function logout(Request $request)
   {
       // Perform the logout
       $this->guard()->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();

       // Redirect to the login page instead of the home page
       return redirect()->route('login');
   }

    
}
