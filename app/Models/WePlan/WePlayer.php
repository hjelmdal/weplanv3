<?php

namespace App\Models\WePlan;

use App\Models\BadmintonPeople\BpPlayer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WePlayer extends Model
{
    protected $fillable = ['id','name','gender','birthday','dbf_id','badmintonpeople_id'];
    use SoftDeletes;
    private $declines;




    public function user() {
        return $this->hasOne(User::class,'player_id','id');
    }

    public function BpPlayer() {
        return $this->belongsTo(BpPlayer::class,"dbf_id","dbf_id");
    }

    public function team() {
        return $this->belongsTo(WeTeam::class,'team_id','id');
    }

    public function activities() {
        return $this->belongsToMany(WeActivity::class,'we_player_activities','player_id', 'activity_id')
            ->withPivot("confirmed_at","declined_at")
            ->withTimestamps();
    }

    public function declines() {
        return $this->hasMany(WeDecline::class,'player_id','id');
    }




}
