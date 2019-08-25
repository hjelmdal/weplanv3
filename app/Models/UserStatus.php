<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class UserStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'user_id','password_at', 'consent_at', 'avatar_at', 'player_at','completed_at','team_at','approved_at','rejected_at'
        'user_id','type','content','data','data_old','approved_at','rejected_at','confirmed_at','created_at','updated_at'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password_at', 'consent_at', 'avatar_at', 'player_at','completed_at','team_at','approved_at','rejected_at','created_at','updated_at','deleted_at'
    ];

    public function user() {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public static function generateStatuses(User $user) {
        UserStatus::insert(["user_id" => $user->id, "type" => "password", "created_at" => now()]);
        UserStatus::insert(["user_id" => $user->id, "type" => "consent", "created_at" => now()]);
        UserStatus::insert(["user_id" => $user->id, "type" => "avatar", "created_at" => now()]);
        UserStatus::insert(["user_id" => $user->id, "type" => "player", "created_at" => now()]);

        return true;
    }
}
