<?php

namespace App\Models\WePlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeDecline extends Model
{
    protected $fillable = ['id','training_id','description','start_date','end_date','type_id','category_id'];
    use SoftDeletes;
}
