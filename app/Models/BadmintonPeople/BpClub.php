<?php

namespace App\Models\BadmintonPeople;


use Illuminate\Database\Eloquent\Model;

class BpClub extends Model
{
    protected $fillable = array('id','club_id','name','team_name','address','postal_code','city','contact_email','email','association','area');

}
