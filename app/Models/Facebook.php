<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    
    protected $table = 'users_facebook';
    public $timestamps = false;
    protected $fillable = ['token', 'refresh_token', 'expires_in', 'facebook_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
