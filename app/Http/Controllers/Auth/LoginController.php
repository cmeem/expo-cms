<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
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
    protected $redirectTo = RouteServiceProvider::HOME ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(['status'=>'active','email'=>$request->email,'password' => $request->password],$request->remember);
    }
    /**
     * Redirect the user to the Google authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider($serviceProvider)
    {
        return Socialite::driver($serviceProvider)->redirect();
    }

        /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($serviceProvider)
    {
        try {
            $user = Socialite::driver($serviceProvider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');

        }
        // only allow people with @company.com to login
        // if(explode("@", $user->email)[1] !== 'gmail.com'){
        //     return redirect()->to('/');
        // }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->status != 'active'){
                return redirect()->route('login')->with('error', 'your account is inactive');
            }
            if(!$existingUser->social_id){
                $existingUser->update([
                    'social_id' => $user->id,
                ]);
            };
            auth()->login($existingUser, true);
        } else {

            // create a new user
            $newUser                  = new User;
            $newUser->status          = 'active';
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->social_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();

            auth()->login($newUser, true);


        }
        return redirect()->to('/');
    }
}
