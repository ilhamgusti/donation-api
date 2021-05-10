<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\QueryFilters\ByDate;
use App\QueryFilters\Pending;
use App\Models\User;

class Kegiatan extends Model
{
    use HasFactory, Filter;
    protected $table = 'kegiatan';
    protected $with = ['panti'];


    protected function getFilters()
    {
        return [
            'App\QueryFilters\ByDate:hari_acara,startDate,endDate',
            'App\QueryFilters\ByMonthAndYear:hari_acara,tahun,bulan',
            Pending::class,
        ];
    }

    // setiap kegiatan hanya dimiliki 1 panti
    public function panti()
    {
        return $this->belongsTo(Panti::class, 'panti_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
