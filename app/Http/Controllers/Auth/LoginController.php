<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Facebook;
use App\Models\Google;
use App\Models\UserStatus;
use App\Notifications\NewUserRegistered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
        session(['link' => url()->previous()]);
        return view("login/login2");
    }

    protected function redirectToPage($message = false) {

        if(session('url.intended')) {
            return redirect(session("url.intended"))->with($message);
        } else {
            return redirect("/user")->with($message);
        }
    }


    public function redirectToGoogleLogin(Request $request){
        $request->session()->put('google-intent', 'login');
        return Socialite::driver('google')->redirect();
    }
    
    public function redirectToGoogleCreate(Request $request){
        $request->session()->put('google-intent', 'create');
        return Socialite::driver('google')
            ->scopes(["openid", "https://www.googleapis.com/auth/userinfo.profile", "https://www.googleapis.com/auth/userinfo.email"]) // For any extra scopes you need, see https://developers.google.com/identity/protocols/googlescopes for a full list; alternatively use constants shipped with Google's PHP Client Library
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();
    }
    
    public function handleGoogleCallback(Request $request){
        /** @var User $user */
        $user = Socialite::driver('google')->user();
        
        $userObj = \App\Models\User::where('email', $user->getEmail())->whereHas('google', function(Builder $query) use ($user){
            $query->where('google_id', $user->getId());
        })->first();

        // User is found with Google associated account
        if($userObj != null){
            Auth::login($userObj,true);
            //$this->guard()->login($userObj);
            return $this->redirectToPage();
        }

        // Should not be relevant anymore, as we always use "create-intent"
        elseif($request->session()->get('google-intent') == 'login'){
            $request->session()->flash('message', 'Ingen profil passede sammen med google - opret dig forneden');
            return redirect()->route('login');
        }

        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        if($userObj != null){
            $google = new Google([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'google_id' => $user->getId()
            ]);
            $userObj->google()->save($google);
            Auth::login($userObj,true);

            return $this->redirectToPage(["message" => "Din Google account er nu tilknyttet din WePlan bruger"]);
            //$request->session()->flash('message', 'Emailen eksister allerede på en bruger');
            //return redirect()->route('login');
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
                'avatar' => "/storage/". $file
            ]);
            $google = new Google([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'google_id' => $user->getId()
            ]);
            $userObj->google()->save($google);
            if($userObj->avatar) {
                $content = json_encode(array("text" => "Avatar set from Google account","avatar" => $userObj->avatar));
                $this->setUserStatus($userObj, "avatar", $content,true);
            }
            $userObj->notify(new NewUserRegistered());
            Auth::login($userObj,true);
            //$this->guard()->login($userObj,true);

            DB::commit();
            return $this->redirectToPage();
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
            $this->guard()->login($userObj,true);
            return $this->redirectToPage();

        } elseif ($request->session()->get('fb-intent') == 'login') {
            $request->session()->flash('message', 'Ingen profil passede sammen med facebook - opret dig forneden');
            return redirect()->route('login');
        }

        $userObj = \App\Models\User::where('email', $user->getEmail())->first();
        if ($userObj != null) {
            $facebook = new Facebook([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'facebook_id' => $user->getId()
            ]);
            $userObj->facebook()->save($facebook);
            Auth::login($userObj,true);

            return $this->redirectToPage(["message" => "Din Facebook account er nu tilknyttet din WePlan bruger"]);

        }

        if ($request->session()->get('fb-intent') == 'create') {
            $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
            copy($user->getAvatar()."&width=500&height=500", $fileName);
            /** @var Filesystem $disk */
            $file = Storage::disk('public')->putFile('profile', new File($fileName));

            DB::beginTransaction();
            $userObj = \App\Models\User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(uniqid()),
                'avatar' => "/storage/". $file
            ]);
            $facebook = new Facebook([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'facebook_id' => $user->getId()
            ]);
            $userObj->facebook()->save($facebook);
            if($userObj->avatar) {
                $content = json_encode(array("text" => "Avatar set from Facebook account","avatar" => $userObj->avatar));
                $this->setUserStatus($userObj, "avatar", $content,true);
            }
            $userObj->notify(new NewUserRegistered());
            Auth::login($userObj,true);
            //$this->guard()->login($userObj);

            DB::commit();
            return $this->redirectToPage();
        }
        redirect()->route('login');
    }

    private function setUserStatus($user,$type,$content,$json = false) {
        if(!$json) {
            $content = json_encode(["text" => $content]);
        }
        try {
            UserStatus::updateOrCreate(["user_id" => $user->id], ["user_id" => $user->id, "type" => $type, "content" => $content]);
        } catch (QueryException $exception) {
            return $exception;
        }
        return true;
    }
}
