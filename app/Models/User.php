<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'balance',
        'role',
        'password',
        'account_id',
        'language',
        'withdrawal_pin',
        'withdrawal_network',
        'withdrawal_address',
        'referral_code',
        'referred_by',
        'verification_code',
        'verification_expires_at',
        'email_verification_code',
        'email_verification_expires_at',
        'email_verified_at',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_enabled',
        'two_factor_confirmed_at',
        'junior_leader_bonus_paid',
        'elite_leader_bonus_paid',
        'legendary_leader_bonus_paid',
        'grand_leader_bonus_paid',
        'notification_preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'two_factor_confirmed_at' => 'datetime',
            'password' => 'hashed',
            'notification_preferences' => 'array',
        ];
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referralEarnings()
    {
        return $this->hasMany(ReferralEarning::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            // Generate account_id
            if (empty($user->account_id)) {
                do {
                    $accountId = str_pad(
                        random_int(10000000, 99999999),
                        8,
                        '0',
                        STR_PAD_LEFT
                    );
                } while (self::where('account_id', $accountId)->exists());

                $user->account_id = $accountId;
            }

            // Generate referral_code
            if (empty($user->referral_code)) {
                do {
                    $code = str_pad(
                        random_int(0, 99999999),
                        8,
                        '0',
                        STR_PAD_LEFT
                    );
                } while (self::where('referral_code', $code)->exists());

                $user->referral_code = $code;
            }
        });
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
