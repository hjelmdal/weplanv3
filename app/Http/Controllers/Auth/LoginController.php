<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Facebook;
use App\Models\Google;
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
        
        
        //Try to login user with Google+
        $userObj = \App\Models\User::where('email', $user->getEmail())->whereHas('google', function(Builder $query) use ($user){
            $query->where('google_id', $user->getId());
        })->first();
        
        
        //Check if Google user is found
        if($userObj != null){
            $this->guard()->login($userObj);
            return redirect($this->redirectTo);
        }
        // Callback if user not found
        // elseif($request->session()->get('google-intent') == 'login'){
        //    $request->session()->flash('message', 'Ingen profil passede sammen med google - opret dig forneden');
        //    return redirect()->route('login');
        // }
        
        
        // Find user in system
        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        // If user exist with no relation to Google
        if($userObj != null){
            // Relate user to Google account
            $google = new Google([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'google_id' => $user->getId()
            ]);
            $userObj->google()->save($google);
            // Fetch avatar and save in filesystem
            $avatar = $user->getAvatar();
            $avatar = preg_replace('/\?sz=[\d]*$/', '', $avatar);
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($avatar, $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
            $userObj->avatar = "/" .$file;
            $userObj->save();
            
            Log::debug($avatar);
            
            
            $request->session()->flash('message', 'Din bruger er nu associeret med Google+ Login');
            
            // Login User
            $this->guard()->login($userObj);
            
            DB::commit();
            return redirect($this->redirectTo);
        }
        
        //If No user is found - sign up!
        if($request->session()->get('google-intent') == 'create'){
            Log::info($user->getAvatar());
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($user->getAvatar(), $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
            
            Log::notice("Avatar:" . $file);
            //DB::beginTransaction();
            $userObj = new \App\Models\User([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => "/" . $file,
                'password' => bcrypt(uniqid()),
                
            ]);
            
            $userObj->save();
    
            Log::debug("Avatar: " . $userObj->avatar);
            
            $google = new Google([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'google_id' => $user->getId()
            ]);
            $userObj->google()->save($google);
            //DB::commit();
            $this->guard()->login($userObj);
            
            
            $request->session()->flash('message', 'Du har nu oprettet en bruger med dit Google+ Login');
    
            // Send verification email
            return redirect()->route('verification.resend');
        }
        
        // If everything fails - redirect to Login
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
    
    public function handleFacebookCallback(Request $request){
        /** @var User $user */
        $user = Socialite::driver('facebook')->user();
        
        //Login user with Facebook model
        $userObj = \App\Models\User::where('email', $user->getEmail())->whereHas('facebook', function(Builder $query) use ($user){
            $query->where('facebook_id', $user->getId());
        })->first();
        
        // User is found - Login
        if($userObj != null){
            $this->guard()->login($userObj);
            return redirect($this->redirectTo);
        }
//        elseif($request->session()->get('fb-intent') == 'login'){
//            $request->session()->flash('message', 'Ingen profil passede sammen med facebook - opret dig forneden');
//            return redirect()->route('login');
//        }
        
        //Find user in system
        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        if($userObj != null){
            
            //Associate with Facebook
            $facebook = new Facebook([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'facebook_id' => $user->getId()
            ]);
            $userObj->google()->save($facebook);
            $this->guard()->login($userObj);
            
            DB::commit();
            // Fetch avatar
            $avatar = $user->getAvatar();
            $avatar = preg_replace('/\?sz=[\d]*$/', '', $avatar);
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($avatar, $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
            $userObj->avatar = "/" .$file;
            $userObj->save();
            Log::debug($avatar);
            $request->session()->flash('message', 'Din bruger er nu associeret med Facebook Login');
            return redirect($this->redirectTo);
        }
        
        if($request->session()->get('fb-intent') == 'create'){
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($user->getAvatar(), $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));
            
    
            $userObj = new \App\Models\User([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(uniqid()),
                'avatar' => "/" .$file
            ]);
            $facebook = new Facebook([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'facebook_id' => $user->getId()
            ]);
            $userObj->save();
            $userObj->facebook()->save($facebook);
            $this->guard()->login($userObj);
            
           
            
            // Send verification email
            return redirect()->route('verification.resend');
        }
        redirect()->route('login');
    }
}
