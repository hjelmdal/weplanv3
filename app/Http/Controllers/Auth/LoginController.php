<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Facebook;
use App\Models\Google;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\User;

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
    protected $redirectTo = '/user';

    protected $loggedInRouteName = 'user.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    /**
     * Override Illuminate\Foundation\Auth\AuthenticatesUsers
     *
     * @return view
     */
    public function showLoginForm()
    {
        return view("login/login2");
    }
    
    public function redirectToGoogleLogin(Request $request){
        $request->session()->put('google-intent', 'login');
        return Socialite::driver('google')->redirect();
    }
    
    public function redirectToGoogleCreate(Request $request){
        $request->session()->put('google-intent', 'create');
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback(Request $request){
        /** @var User $user */
        $user = Socialite::driver('google')->user();
        
        $userObj = \App\Models\User::where('email', $user->getEmail())->whereHas('google', function(Builder $query) use ($user){
            $query->where('google_id', $user->getId());
        })->first();
        
        if($userObj != null){
            $this->guard()->login($userObj);
            return redirect()->route($this->loggedInRouteName);
        }
        elseif($request->session()->get('google-intent') == 'login'){
            $request->session()->flash('message', 'Ingen profil passede sammen med google - opret dig forneden');
            return redirect()->route('login');
        }
        
        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        if($userObj != null){
            $request->session()->flash('message', 'Emailen eksister allerede på en bruger');
            return redirect()->route('login');
        }
        
        if($request->session()->get('google-intent') == 'create'){
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($user->getAvatar(), $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
            
            DB::beginTransaction();
            $userObj = \App\Models\User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(uniqid()),
                'avatar' => $file
            ]);
            $facebook = new Google([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'google_id' => $user->getId()
            ]);
            $userObj->google()->save($facebook);
            $userObj->notify(new VerifyEmail());
            $this->guard()->login($userObj);
            
            DB::commit();
            return redirect()->route($this->loggedInRouteName);
        }
        redirect()->route('login');
    }
    
    public function redirectToFacebookLogin(Request $request){
        $request->session()->put('fb-intent', 'login');
        return Socialite::driver('facebook')->redirect();
    }
    
    public function redirectToFacebookCreate(Request $request){
        $request->session()->put('fb-intent', 'create');
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleFacebookCallback(Request $request)
    {
        /** @var User $user */
        $user = Socialite::driver('facebook')->user();
    
        $userObj = \App\Models\User::where('email', $user->getEmail())->whereHas('facebook', function (Builder $query) use ($user) {
            $query->where('facebook_id', $user->getId());
        })->first();
    
        if ($userObj != null) {
            $this->guard()->login($userObj);
            return redirect()->route($this->loggedInRouteName);
        } elseif ($request->session()->get('fb-intent') == 'login') {
            $request->session()->flash('message', 'Ingen profil passede sammen med facebook - opret dig forneden');
            return redirect()->route('login');
        }
    
        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        if ($userObj != null) {
            $request->session()->flash('message', 'Email already exist');
            return redirect()->route('login');
        }
    
        if ($request->session()->get('fb-intent') == 'create') {
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($user->getAvatar(), $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
        
            DB::beginTransaction();
            $userObj = \App\Models\User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(uniqid()),
                'avatar' => $file
            ]);
            $facebook = new Facebook([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'facebook_id' => $user->getId()
            ]);
            $userObj->facebook()->save($facebook);
            $userObj->notify(new VerifyEmail());
            $this->guard()->login($userObj);
        
            DB::commit();
            return redirect()->route($this->loggedInRouteName);
        }
        redirect()->route('login');
    }
}
