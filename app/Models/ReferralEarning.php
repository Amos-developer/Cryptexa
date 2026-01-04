<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralEarning extends Model
{
    protected $fillable = [
        'user_id',
        'from_user_id',
        'amount',
        'level',
        'type',
    ];
}
   