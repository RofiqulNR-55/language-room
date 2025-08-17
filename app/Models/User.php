<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan ini kalau ingin set role saat create user
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Cek apakah user sudah membayar
    public function hasPaid()
    {
        return Transaction::userHasPaid($this->id);
    }
}
