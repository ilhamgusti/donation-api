<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';

    protected $fillable = [
        'jenis_donasi',
        'jumlah_rp',
        'nama_barang',
        'jumlah_barang',
        'tanggal_kirim',
        'kirim_lewat',
    ];
    //setiap donasi dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
