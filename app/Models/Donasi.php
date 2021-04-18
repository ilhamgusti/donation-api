<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory, Filter;
    protected $table = 'donasi';

    protected $fillable = [
        'jenis_donasi',
        'jumlah_rp',
        'nama_barang',
        'jumlah_barang',
        'tanggal_kirim',
        'kirim_lewat',
    ];

    protected function getFilters()
    {
        return [
            'App\QueryFilters\ByDate:tanggal_kirim,startDate,endDate',
            'App\QueryFilters\ByMonthAndYear:tanggal_kirim,month,year',
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
