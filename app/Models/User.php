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
