<?php

namespace App\Models\WePlan;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WeActivity extends Model
{
    public function players() {
        return $this->belongsToMany(WePlayer::class,'we_player_activities', 'activity_id','player_id')
            ->withPivot("confirmed_at","declined_at","signed_up_at")
            ->withTimestamps();
    }

    public function type() {
        return $this->belongsTo(WeActivityType::class,"type_id");
    }

    public function responsible() {
        return $this->belongsTo(User::class,"responsible_user");
    }
}
