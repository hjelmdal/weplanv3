<?php

namespace App\Models;

use App\Models\WePlan\WePlayer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
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
        'password', 'remember_token',
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
        return $this->hasOne(WePlayer::class,'user_id','id');
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
}
