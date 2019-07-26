<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Models\UserStatus;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


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
            $this->user->save();
            $cont = ["text" => $this->user->name . " har skiftet password."];
            $this->updateUserStatus("password",json_encode($cont));
            
            return response()->json("Password er succesfuldt opdateret!", 200);
        }

        if($request->gdpr) {
            $now = Carbon::parse(now());
            
            $cont = '{"text":"'.$this->user->name.' har givet samtykke til behandling af dennes data d. '.$now->format("d. M Y H:i").'"}';
            $this->updateUserStatus("consent",$cont);
            return response()->json("Tak for dit samtykke!", 200);
        }
        


        return response()->json(["errors" => ["form" => [0 => "Du har ikke udfyldt felterne"]]], 400);


    }
    
    public function saveAvatar(Request $request) {
        $user = $this->userFromApiToken($request);
        //$file = $request->file->storeAs('logos', $request->file->getClientOriginalName());
        $fileName = tempnam(sys_get_temp_dir(), 'profile-pic');
        copy($request->file, $fileName);
        $file = Storage::disk('public')->putFile('profile', new File($request->file));
        
        
        if($user) {
            $old_avatar = $user->avatar;
            $user->avatar = "/storage/" .$file;
            $user->save();
            $this->updateUserStatus("avatar",'{"text":"'.$user->name.' har uploadet en ny avatar til godkendelse","old":"'.$old_avatar.'","new":"'.$user->avatar.'"}');
            return response()->json(["status" => "success", "url" =>  "/storage/".$file, "request" => $file]);
    
        }
    
        return response()->json(["status" => "error", "message" => "Bad request!"],400);
    
    }
    
    
    private function updateUserStatus($type,$content = null) {
        try {
            UserStatus::updateOrCreate(["user_id" => $this->user->id, "type" => $type], ["user_id" => $this->user->id, "type" => $type, "content" => $content]);
        } catch (QueryException $e) {
            return response()->json(["errors" => ["SQL" => [0 => $e, 1 => "User: " . $this->user->id]]], 500);
        }
        return true;
    }
}
