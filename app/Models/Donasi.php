<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\QueryFilters\Pending;

class Donasi extends Model
{
    use HasFactory, Filter;
    protected $table = 'donasi';
    protected $with = ['panti'];

    protected $fillable = [
        'jenis_donasi',
        'jumlah_rp',
        'nama_barang',
        'jumlah_barang',
        'tanggal_kirim',
        'kirim_lewat',
        'panti_id',
        'pending'
    ];

    protected function getFilters()
    {
        return [
            'App\QueryFilters\ByDate:tanggal_kirim,startDate,endDate',
            'App\QueryFilters\ByMonthAndYear:tanggal_kirim,tahun,bulan',
            Pending::class,
        ];
    }
    //setiap donasi dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function panti()
    {
        return $this->belongsTo(Panti::class, 'panti_id', 'id');
    }
}
