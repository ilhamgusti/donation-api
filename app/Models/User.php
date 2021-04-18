<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'no_tel',
        'alamat',
        'tipe',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'api_token', 
        'tokens'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 1 user bisa memiliki banyak donasi namun hanya yang bertipe donatur atau tipe = 0
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'user_id');
    }

    // 1 panti dimiliki 1 user account dengan tipe 1
    public function panti()
    {
        return $this->hasOne(Panti::class, 'user_id');
    }
}
