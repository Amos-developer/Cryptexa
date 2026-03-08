<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankBonus extends Model
{
    protected $fillable = [
        'user_id',
        'rank',
        'bonus_amount',
        'balance_before',
        'balance_after',
    ];

    protected $casts = [
        'bonus_amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
