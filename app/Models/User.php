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
        'name',
        'email',
        'phone',
        'balance',
        'role',
        'password',
        'withdrawal_pin',
        'referral_code',
        'referred_by',
        'verification_code',
        'verification_expires_at',
        'email_verified_at',
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
            'password' => 'hashed',
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

    protected static function booted()
    {
        static::creating(function ($user) {

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
