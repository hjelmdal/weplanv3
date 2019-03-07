<?php

namespace App\Models\WePlan;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeTeam extends Model
{
    use SoftDeletes;
    public function owner() {
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function players() {
        return $this->hasMany(WePlayer::class,'team_id','id');
    }
}
