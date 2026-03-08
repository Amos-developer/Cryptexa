<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySalaryPayment extends Model
{
    protected $fillable = ['user_id', 'admin_id', 'amount', 'rank', 'active_members', 'week_number', 'year', 'is_auto_paid', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
