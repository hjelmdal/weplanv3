<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivation extends Model
{
    protected $fillable = ["user_id","activation_code","activation_hashed"];
    protected $hidden = ["activation_code"];

    public function user() {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
