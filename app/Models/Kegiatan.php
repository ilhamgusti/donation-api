<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\QueryFilters\ByDate;
use App\QueryFilters\Pending;

class Kegiatan extends Model
{
    use HasFactory, Filter;
    protected $table = 'kegiatan';


    protected function getFilters()
    {
        return [
            'App\QueryFilters\ByDate:hari_acara,startDate,endDate',
            'App\QueryFilters\ByMonthAndYear:hari_acara,month,year',
            Pending::class,
        ];
    }

    // setiap kegiatan hanya dimiliki 1 panti
    public function panti()
    {
        return $this->belongsTo(Panti::class, 'panti_id', 'id');
    }
}
