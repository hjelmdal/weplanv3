<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\BadmintonPeople\BpPlayer;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\WePlan\WePlayer;
use App\Notifications\Auth\SendNewActivationCode;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            $this->user = User::where('api_token', $request->header("Authorization"))->with("userStatus","roles")->first();
            //$this->userStatus = $this->user->load("UserStatus");
            if (!$this->user) {
                return response()->json(["message" => 'Unauthorized'], 401);
            }
            if(!$this->user->avatar) {
                $this->user->avatar = "/img/profile.png";
            }
            //$user = Auth::loginUsingId($user->id);
        }
        return $this->user;
    }

    public function getMyUser(Request $request) {
        $user = $this->userFromApiToken($request);

        return response()->json(["message" => "OK", "user" => $user,"status" => $user->setStatus()]);
    }

    public function authRoles(Request $request) {
        $user = $this->userFromApiToken($request);
        if(!$request->roles) {
            return response()->json("Bad input",400);
        }
        if($user->hasAnyRole($request->roles)) {
            return response()->json("OK",200);
        }
        return response()->json("Forbidden!",403);

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
            $cont = $this->user->name . " har sat sit password";
            $this->updateUserStatus("password",$cont);

            return response()->json("Password er succesfuldt opdateret!", 200);
        }

        if($request->gdpr) {
            $now = Carbon::parse(now());

            $cont = $this->user->name.' har givet samtykke til behandling af dennes data d. '.$now->format("d. M Y H:i");
            $this->updateUserStatus("consent",$cont);
            return response()->json("Tak for dit samtykke!", 200);
        }

        if($request->playerId && $request->playerConfirm) {
            $cont = $this->user->name." har indsendt sit Badminton ID";
            $this->updateUserStatus("player",$cont, $request->playerId);
            return response()->json("jaah!",200);
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

            Log::info("old". $old_avatar);
            $user->avatar = "/storage/" .$file;
            $user->save();
            $this->updateUserStatus("avatar",$user->name.' har uploadet en ny avatar til godkendelse',$user->avatar,$old_avatar);
            return response()->json(["status" => "success", "url" =>  "/storage/".$file, "request" => $file]);

        }

        return response()->json(["status" => "error", "message" => "Bad request!"],400);

    }


    private function updateUserStatus($type,$content = null,$data = null, $data_old = null) {
        try {

            UserStatus::updateOrCreate(["user_id" => $this->user->id, "type" => $type], ["user_id" => $this->user->id, "type" => $type, "content" => $content, "data" => $data, "data_old" => $data_old, "confirmed_at" => now()]);
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
            if($this->user->UserActivation) {
                $hashed = $this->user->UserActivation->activation_hashed;
                if (password_verify($request->code, $hashed)) {
                    $this->user->email_verified_at = now();
                    $this->user->UserActivation->delete();
                    $this->user->save();
                    $msg = "Tillykke - din email er nu aktiveret!";
                    return response()->json(["message" => $msg, "output" => $hashed], 200);

                }
                else {
                    return response()->json(["errors" => ["form" => "Forkert aktiveringskode"]], 400);
                }
            } else {
                return response()->json(["errors" => ["form" => "Din mailadresse er allerede aktiveret"]], 400);
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
                Log::error("Gensend aktiveringsmail fejlet:");
                Log::error($exception);
                return response()->json(["message" => "Der opstod en fejl"],400);
            }
        }
        return response()->json(["message" => "Du har ikke adgang"],401);
    }

    public function complete(Request $request) {
        $arr["pw"] = false;
        $arr["consent"] = false;
        $arr["avatar"] = false;
        $arr["player"] = false;
        $this->userFromApiToken($request);
        foreach ($this->user->userStatus as $s) {
            if($s->type == "password") {
                $arr["pw"] = true;
            }
            if($s->type == "consent") {
                $arr["consent"] = true;
            }
            if($s->type == "avatar") {
                $arr["avatar"] = true;
            }
            if($s->type == "player" || $s->type == "coach") {
                $arr["player"] = true;
            }
        }

        if($this->user->email_verified_at && $arr["pw"] && $arr["consent"] && $arr["avatar"] && $arr["player"]) {
            return response()->json(["message" => "Tillykke! Din bruger er aktiveret"],200);
        } else {
            return response()->json(["message" => "Brugeren mangler godkendelser","errors" => $arr],400);
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all($filter = null) {

        try {
            $users = User::all();
            $users->load(["roles","UserStatus","WePlayer.BpPlayer.BpClub"]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["errors" => ["form" => "No users found"]],404);
        }
        $array = array();
        foreach($users as $user) {
            if($user->UserStatus->count() > 0) {
                $user = $this->setStatuses($user);
            }
            if($filter == "activated" && $user->email_verified_at) {
                $array[] = $user;
            } elseif($filter == "incomplete" && !$user->isComplete()) {
                $array[] = $user;
            } elseif($filter == "dissociated" && !$user->player_id) {
                $array[] = $user;
            }
        }

        if($filter) {
            return response()->json($array,200);
        }
        return response()->json($users,200);
    }

    private function setStatuses(User $user) {
        if($user->UserStatus->count() > 0) {
            foreach ($user->UserStatus as $status) {
                if ($status->type == "player") {
                    $user->suggested_player = $status->data;
                    $user->matched_weplayer = WePlayer::where("dbf_id", $user->suggested_player)->first();

                    if (!$user->matched_weplayer) {
                        $user->matched_bpplayer = BpPlayer::where("dbf_id", $user->suggested_player)->first();
                    }
                }
            }
        }
        return $user;
    }

    public function filteredUsers(Request $request) {
        if($request->filter) {
            switch ($request->filter) {
                case "activated":
                    return $this->all("activated");
                    break;
                case "incomplete":
                    return $this->all("incomplete");
                    break;
                case "dissociated":
                    return $this->all("dissociated");
            }

        }
        return response()->json("Ingen brugere fundet",404);
    }

    public function associatePlayer(Request $request) {
        if(!$request->playerId || !$request->userId) {
            return response()->json(["errors" => ["form" => "Bad request"]], 400);
        } else {

            $this->user = User::findOrFail($request->userId);

            $this->user->player_id = $request->playerId;
            $this->user->assignRole('player');
            $this->user->save();
            $this->user->load(["WePlayer.BpPlayer.BpClub"]);
        }
        return response()->json($this->user,200);
    }

    public function dissociatePlayer(Request $request) {
        if(!$request->playerId || !$request->userId) {
            return $this->badRequest();
        } else {

            $this->user = User::findOrFail($request->userId);

            if($this->user->player_id != $request->playerId) {
                return $this->badRequest();
            }
            $this->user->player_id = null;
            $this->user->removeRole('player');
            $this->user->save();
            $this->user->load(["UserStatus"]);
            $this->user = $this->setStatuses($this->user);
        }
        return response()->json($this->user,200);
    }


    public function getUserStatus(Request $request) {
        $this->userFromApiToken($request);
        $status = [];
        $i = 0;
        $state_index = 0;

            $status[$i]["step"] = $i;
            $status[$i]["hideNav"] = true;
            $status[$i]["state"] = "current";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Opsætning af brugerkonto!";
            $status[$i]["stepInfo"]["text"] = "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.";
            $status[$i]["stepInfo"]["svg"] = "/base/media/wizard/undraw_checklist_7q37.svg";
            $status[$i]["contentComponent"] = "step0Welcome";
            $i++;


        if(!$this->user->email_verified_at) {
            $status[$i]["step"] = $i;
            $status[$i]["state"] = "pending";
            $status[$i]["icon"] = "";
            $status[$i]["stepInfo"] = array();
            $status[$i]["stepInfo"]["title"] = "Opsætning af brugerkonto!";
            $status[$i]["stepInfo"]["text"] = "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.";
            $status[$i]["stepInfo"]["svg"] = "/img/yes.svg";
            $status[$i]["contentComponent"] = "step1Activate";
            $i++;
        } else {
            $state_index = 1;
        }
        $pw = false;
        $consent = false;
        $avatar = false;
        $player = false;
        //$i = 1; // hvis velkomst skærm ikke skal vises
        foreach ($this->user->userStatus as $s) {
            if($s->type == "password" && $s->confirmed_at && !$s->rejected_at) {
                $pw = true;
            }
            if($s->type == "consent" && $s->confirmed_at && !$s->rejected_at) {
                $consent = true;
            }
            if($s->type == "avatar" && $s->confirmed_at && !$s->rejected_at) {
                $avatar = true;
            }
            if($s->type == "player" && $s->confirmed_at && !$s->rejected_at) {
                $player = true;
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

        if(!$player) {
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

        $status[$i]["step"] = $i;
        $status[$i]["hideNav"] = true;
        $status[$i]["state"] = "pending";
        $status[$i]["icon"] = "";
        $status[$i]["stepInfo"] = array();
        $status[$i]["stepInfo"]["title"] = "Tak for din tid!";
        $status[$i]["stepInfo"]["text"] = "Du har nu givet os de nødvendige oplysninger vi skal bruge til din profil. Du vil modtage en mail fra os, når en administrator eller en træner har godkendt dig.";
        $status[$i]["stepInfo"]["svg"] = "/img/confetti.svg";
        $status[$i]["contentComponent"] = "stepsCompleted";


        return response()->json($status,200);

    }

    private function badRequest($data = null) {
        return response()->json(["errors" => ["form" => "Bad request"],"data" => $data], 400);
    }
}
