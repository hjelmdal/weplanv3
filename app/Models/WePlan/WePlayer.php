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
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function team() {
        return $this->belongsTo(WeTeam::class,'team_id','id');
    }


}
