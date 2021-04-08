<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panti extends Model
{
    use HasFactory;
    protected $table = 'panti';

    //1 panti hanya diurus oleh 1 user account dengan tipe 1
    public function user()
    {
        return $this->hasOne(User::class, 'user_id','id');
    }

    //1 panti mempunyai banyak kegiatan
    public function kegiatan(){
        return $this->hasMany(Kegiatan::class, 'kegiatan_id','id');
    }
}
