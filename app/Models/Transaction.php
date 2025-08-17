<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaksis';
    
    protected $fillable = ['user_id', 'paket_id', 'order_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    // Helper method to check if user has paid
    public static function userHasPaid($userId)
    {
        return self::where('user_id', $userId)
                   ->where('status', 'success')
                   ->exists();
    }
}
