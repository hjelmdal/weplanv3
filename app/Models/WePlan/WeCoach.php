<?php

namespace App\Models\WePlan;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WeCoach extends Model
{
    public function user() {
        return $this->hasOne(User::class,'player_id','id');
    }

    public function WePlayer() {
        return $this->belongsTo(WePlayer::class, 'player_id', 'id');
    }
}
