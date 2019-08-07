<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Models\UserStatus;
use App\Notifications\Auth\SendNewActivationCode;
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
    private $userStatus;

    /**
     * @param Request $request
     * @return User
     */
    private function userFromApiToken(Request $request)
    {
        if ($request->header('Authorization')) {
            $this->user = User::where('api_token', $request->header("Authorization"))->with("userStatus")->first();
            //$this->userStatus = $this->user->load("UserStatus");
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
        return response()->json(["message" => "OK", "user" => $user,"status" => $user->setStatus()]);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activateEmail(Request $request) {
        if($request->code) {
            $this->userFromApiToken($request);
            $hashed = $this->user->UserActivation->activation_hashed;
            if (password_verify($request->code, $hashed)) {
                $this->user->email_verified_at = now();
                $this->user->save();

                return response()->json(["input" => $request->code, "output" => $hashed], 200);

            } else {
                return response()->json(["errors" => ["Bad input" => "Forkert aktiveringskode"]], 400);
            }
        }
        return response()->json("none", 404);
    }

    public function sendNewActivationCode(Request $request) {
        if($this->userFromApiToken($request)) {
            try {
                $this->user->notify(new SendNewActivationCode());
                return response()->json(["message" => "En ny aktiveringskode er sendt til din email"],200);
            } catch (\Exception $exception) {

            }

        }
    }

    public function getUserStatus(Request $request) {
        $this->userFromApiToken($request);
        $status = [];
        $i = 0;
        $state_index = 0;
        if(!$this->user->email_verified_at) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Opsætning af brugerkonto!";
            $status[$i]["stepInfo"]["text"] = "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_checklist_7q37.svg";
            $status[$i]["contentComponent"] = "step0Welcome";
        } else {
            $state_index = 1;
        }
        $pw = false;
        $consent = false;
        $avatar = false;
        $i = 1; // hvis velkomst skærm ikke skal vises
        foreach ($this->user->userStatus as $s) {
            if($s->type == "password") {
                $pw = true;
            }
            if($s->type == "consent") {
                $consent = true;
            }
            if($s->type == "avatar") {
                $avatar = true;
            }
        }
        if(!$pw) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Adgangskode til brug for login";
            $status[$i]["stepInfo"]["text"] = "Da du har registreret din konto med Facebook eller Google, er det nødvendigt at sætte et password til WePlan, så du kan logge ind manuelt, hvis du skulle lukke din konto hos din social media udbyder.";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_checklist_7q37.svg";
            $status[$i]["contentComponent"] = "step1Password";
            $i++;
        }

        if(!$consent) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Vi bekymrer os om dine data!";
            $status[$i]["stepInfo"]["text"] = "I henhold til den nye GDPR forordning, skal vi bruge din tilladelse til at vi må behandle dine persondata";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_resume_folder_2_arse.svg";
            $status[$i]["contentComponent"] = "step2GDPR";
            $i++;
        }

        if(!$avatar) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Indstilling af profilbillede";
            $status[$i]["stepInfo"]["text"] = "Vi har behov for at du angiver et tydeligt billede af dit ansigt som profilbillede, for at din træner hurtigt og nemt kan sætte dig på træninger mv.";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_live_collaboration_2r4y.svg";
            $status[$i]["contentComponent"] = "step3Avatar";
            $i++;
        }

        if(!$this->user->player_id) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Tilknytning til spiller";
            $status[$i]["stepInfo"]["text"] = "For at kunne identificere dig som spiller, skal du angive dit spillerid fra Badminton Danmark nedenfor";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_hiring_cyhs.svg";
            $status[$i]["contentComponent"] = "step4Player";
            $i++;
        }

        $status[$state_index]["state"] = "current";
        return response()->json($status,200);

    }
}
