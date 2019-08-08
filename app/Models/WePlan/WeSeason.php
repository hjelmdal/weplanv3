<?php

namespace App\Models\WePlan;

use Illuminate\Database\Eloquent\Model;

class WeSeason extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
