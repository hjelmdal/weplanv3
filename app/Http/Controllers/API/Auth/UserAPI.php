<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Models\UserStatus;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAPI extends Controller
{
    private $user;

    private function userFromApiToken(Request $request)
    {
        if ($request->header('Authorization')) {
            $this->user = User::where('api_token', $request->header("Authorization"))->first();
            if (!$this->user) {
                return response()->json(["message" => 'Unauthorized'], 401);
            }
            //$user = Auth::loginUsingId($user->id);
        }
        return $this->user;
    }

    public function getMyUser(Request $request) {
        $user = $this->userFromApiToken($request);

        if(!$user->avatar) {
            $user->avatar = "/img/profile.png";
        }
        return response()->json(["message" => "OK", "user" => $user]);
    }

    public function patch(Request $request)
    {

        $this->userFromApiToken($request);

        if(!$this->user) {
            return response()->json(["errors" => ["user" => [0 => "Denne bruger eksisterer ikke"]]], 404);
        }


        if ($request->password) {
            $input = $request->validate([
                'password' => ['required',
                    'min:6',
                    'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
                    'confirmed']
            ]);
            $this->user->password = Hash::make($request->password);
            $this->updateUserStatus("password_at");
            $this->user->save();

            return response()->json("Password er succesfuldt opdateret!", 200);
        }

        if($request->gdpr) {
            $this->updateUserStatus("consent_at");
            return response()->json("Tak for dit samtykke!", 200);
        }


        return response()->json(["errors" => ["Form" => [0 => "Du har ikke udfyldt felterne"]]], 404);


    }

    private function updateUserStatus($field) {
        try {
            UserStatus::updateOrCreate(["user_id" => $this->user->id], ["user_id" => $this->user->id, $field => now()]);
        } catch (QueryException $e) {
            return response()->json(["errors" => ["SQL" => [0 => $e, 1 => "User: " . $this->user->id]]], 500);
        }
        return true;
    }
}
