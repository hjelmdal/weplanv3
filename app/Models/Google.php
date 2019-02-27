<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Google extends Model
{
    
    protected $table = 'users_google';
    public $timestamps = false;
    protected $fillable = ['token', 'refresh_token', 'expires_in', 'google_id','google_handle'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
