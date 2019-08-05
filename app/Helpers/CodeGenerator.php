<?php


namespace App\Helpers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CodeGenerator
{
    private $code = array();


    /**
     * @return array
     */
    public function generateActivationCode()
    {
        $this->code["plain"] = $regCode = mt_rand(100000, 999999);
        $regSplit = str_split($regCode, strlen($regCode) / 2);
        $this->code["formatted"] = $regFormat = $regSplit[0] . "-" . $regSplit[1];
        $this->code["hashed"] = Hash::make($regCode);

        return $this->code;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function setUserActivationCode(User $user) {
        $this->generateActivationCode();
        if($user) {

            $user->UserActivation()->updateOrCreate(["user_id" => $user->id], ["activation_code" => $this->code["plain"],"activation_hashed" => $this->code["hashed"]]);


        }
        return $this->code;
    }


}