<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Notification;
use \App\Notifications\NewUserRegistered;

class AuthController extends Controller
{
    private $apiToken;
    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    }
    /**
     * Client Login
     * @param Request
     * @return User
     */
    public function postLogin(Request $request)
    {


        // Validations
        $rules = [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages(),
            ],400);
        } else {
            // Fetch User
            $user = User::where('email',$request->email)->first();
            if($user) {
                // Verify the password
                if( password_verify($request->password, $user->password) ) {
                    // Update Token
                    $postArray = ['api_token' => $this->apiToken];
                    $login = User::where('email',$request->email)->update($postArray);

                    if($login) {
                        return response()->json([
                            'name'         => $user->name,
                            'email'        => $user->email,
                            'auth_token' => $this->apiToken,
                        ]);
                    }
                } else {
                    return response()->json([
                        'message' => 'Invalid Password'
                    ],403);
                }
            } else {
                return response()->json([
                    'message' => 'User not found',
                ],404);
            }
        }
    }
    /**
     * Register
     */
    public function postRegister(Request $request)
    {
        // Validations
        $rules = [
            'name'     => 'required|min:3',
            'email'    => 'required|unique:users,email',
            'password' => 'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages()
            ],400);
        } else {
            $postArray = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'api_token' => $this->apiToken
            ];
            // $user = User::GetInsertId($postArray);
            $user = User::insert($postArray);
            $user1 = User::where("email",$request->email)->get();
            Notification::send($user1,new NewUserRegistered($user1));

            if($user) {
                return response()->json([
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'access_token' => $this->apiToken,
                ]);
            } else {
                return response()->json([
                    'message' => 'Registration failed, please try again.',
                ],404);
            }
        }
    }
    /**
     * Logout
     */
    public function postLogout(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token',$token)->first();
        if($user) {
            $postArray = ['api_token' => null];
            $logout = User::where('id',$user->id)->update($postArray);
            if($logout) {
                return response()->json([
                    'message' => 'User Logged Out',
                ],200);
            }
        } else {
            return response()->json([
                'message' => 'User not found',
            ],404);
        }
    }
}
