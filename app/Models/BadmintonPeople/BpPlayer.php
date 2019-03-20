<?php

namespace App\Models\BadmintonPeople;

use App\Models\WePlan\WePlayer;
use Illuminate\Database\Eloquent\Model;

class BpPlayer extends Model
{
    protected $fillable = array('id', 'dbf_id', 'user_id', 'club_id', 'name', 'gender', 'birthday', 'age_group');
    protected $hidden = array('bp_id','created_at','deleted_at','updated_at');


    public function WePlayer() {
        return $this->HasOne(WePlayer::class,'dbf_id','dbf_id');
    }
}
