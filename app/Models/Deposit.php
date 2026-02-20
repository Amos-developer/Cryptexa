<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    // 🔐 Deposit statuses
    public const STATUS_WAITING   = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_EXPIRED   = 'expired';

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'payment_id',
        'token_id',
        'pay_address',
        'pay_currency',
        'pay_amount',
        'txid',
        'status',
    ];

    protected $casts = [
        'amount'      => 'float',
        'pay_amount'  => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
