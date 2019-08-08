<?php

namespace App\Models\BadmintonPeople;


use App\Models\ClubSettings;
use Illuminate\Database\Eloquent\Model;

class BpClub extends Model
{
    protected $fillable = array('id','club_id','name','team_name','address','postal_code','city','contact_email','email','association','area');

    public function BpPlayers() {
        return $this->hasMany(BpPlayer::class,'club_id','club_id');
    }

    public function ClubSettings() {
        return $this->hasOne(ClubSettings::class,'club_id','club_id');
    }

}
