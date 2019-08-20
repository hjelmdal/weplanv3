<?php

namespace App\Models;

use App\Models\WePlan\WePlayer;
use App\Notifications\NewUserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use AuthenticableTrait;
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web'; // or whatever guard you want to use

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["complete"];


    public function facebook(){
        return $this->hasOne(Facebook::class);
    }
    
    public function google(){
        return $this->hasOne(Google::class);
    }
    
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    public function WePlayer() {
        return $this->belongsTo(WePlayer::class,'player_id','id');
    }

    public function revoke() {
        $this->api_token = NULL;
        $this->save();
    }

    public function UserStatus() {
        return $this->hasMany(UserStatus::class,"user_id","id");
    }

    public function UserActivation() {
        return $this->hasOne(UserActivation::class,"user_id","id");
    }

    public function setStatus() {
        $status = $this->UserStatus()->get();
        return $status;
    }

    public function getCompleteAttribute() {
        return $this->isComplete();
    }


    public function isComplete() {
        $status = $this->UserStatus()->get();
        $arr["pw"] = false;
        $arr["consent"] = false;
        $arr["avatar"] = false;
        $arr["player"] = false;
        foreach ($status as $s) {
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

        if($this->email_verified_at && $arr["pw"] && $arr["consent"] && $arr["avatar"] && $arr["player"]) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack(Notification $notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
    
    public function sendEmailVerificationNotification()
    {
        Log::error("TEST");
        $this->notify(new NewUserRegistered());
    }


}
