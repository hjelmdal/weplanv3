<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAPI extends Controller
{

    private function userFromApiToken($request) {
        if($request->header('Authorization')){
            $user = User::where('api_token', $request->header("Authorization"))->first();
            if(!$user) {
                return response()->json(["message" => 'Unauthorized'],401);
            }
            //$user = Auth::loginUsingId($user->id);
        }
        return $user;
    }

    public function patch(Request $request)
    {

        $user = $this->userFromApiToken($request);


        if($request->password && $user) {
            $input = $request->validate([
                'password' => ['required',
                    'min:6',
                    'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
                    'confirmed']
            ]);
            $user->password = Hash::make($request->password);


            $user->save();
            //$request->session()->flash('message', 'Dine brugeroplysninger er opdateret!');
            return response()->json("Password er succesfuldt opdateret!", 200);
        }
        return response()->json("No data",404);

    }
}
