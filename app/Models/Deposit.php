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
        'provider_payload',
        'provider_status_raw',
        'processed_at',
        'txid',
        'status',
    ];

    protected $casts = [
        'amount'      => 'float',
        'pay_amount'  => 'float',
        'provider_payload' => 'array',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
