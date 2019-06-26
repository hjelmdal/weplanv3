<?php

namespace App\Models\WePlan;

use Illuminate\Database\Eloquent\Model;

class WeAbsense extends Model
{
    public function players() {
        return $this->belongsTo(WePlayer::class,'player_id','id');
    }
}
