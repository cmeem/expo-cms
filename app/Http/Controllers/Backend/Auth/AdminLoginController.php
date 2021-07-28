<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');;
    }

    public function showLoginForm(){
        return view('backend.auth.login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['status' => 'active','username' => $request->username, 'password' => $request->password], $request->remember)) {
            //if successful, then redirect to the admin dashboard
                // Cache::forget('settings');
                // Cache::forget('menu');
                return redirect()->intended(route('admin.dashboard'));
        }

        //if unsuccessful, then redirect to the login page with error
        return redirect()->back()->withErrors(['your Username or Password is Uncorrect'])->withInput($request->only('username','remember'));
    
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login.form'));
    }

}
