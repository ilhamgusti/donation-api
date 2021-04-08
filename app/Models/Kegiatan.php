<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';

    // setiap kegiatan hanya dimiliki 1 panti
    public function panti()
    {
        return $this->belongsTo(Panti::class,'panti_id','id');
    }
}
