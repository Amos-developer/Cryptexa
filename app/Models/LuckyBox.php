<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyBox extends Model
{
    protected $table = 'lucky_box_opens';
    protected $fillable = ['user_id', 'reward', 'open_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
