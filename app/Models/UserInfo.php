<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = ["user_id","tel_iso","tel_number","tel_country","tel_dialcode"];
    public function User() {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
