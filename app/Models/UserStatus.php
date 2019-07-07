<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','password_at', 'consent_at', 'avatar_at', 'player_at','completed_at','team_at','approved_at','rejected_at'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_at', 'consent_at', 'avatar_at', 'player_at','completed_at','team_at','approved_at','rejected_at','created_at','updated_at','deleted_at'
    ];
}
