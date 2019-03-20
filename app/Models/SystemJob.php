<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemJob extends Model
{
    protected $fillable = array('id','job_id','handle','status','runtime','updated_count','created_count','errors_count','runtime','data_checksum');
}
