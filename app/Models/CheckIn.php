<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $fillable = ['user_id', 'streak', 'reward', 'check_in_date'];

    protected $casts = ['check_in_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
