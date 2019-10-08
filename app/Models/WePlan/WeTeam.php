<?php

namespace App\Models\WePlan;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeTeam extends Model
{
    protected $fillable = ["id","name","max_players","active"];
    use SoftDeletes;
    public function owner() {
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function players() {
        return $this->hasMany(WePlayer::class,'team_id','id')->orderBy("gender","ASC")->orderBy("name","ASC");
    }
}
