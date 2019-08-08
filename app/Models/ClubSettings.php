<?php

namespace App\Models;

use App\Models\BadmintonPeople\BpClub;
use Illuminate\Database\Eloquent\Model;

class ClubSettings extends Model
{
    protected $fillable = ['id'];


    public function BpClub() {
        return $this->belongsTo(BpClub::class,'club_id','id');
    }
}
