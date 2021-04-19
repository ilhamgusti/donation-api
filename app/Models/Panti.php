<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panti extends Model
{
    use HasFactory;
    protected $table = 'panti';

    protected $fillable = [
        'nama_panti',
        'alamat',
        'noTel_panti',
        'emailPanti',
        'jumlah_anak',
        'jumlah_pengurus',
        'kebutuhan_panti',
        'sertifikat',
        'isVerified_ktp',
        'isVerified_sertifikat',
        'ktp'
    ];

    //1 panti hanya diurus oleh 1 user account dengan tipe 1
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    //1 panti mempunyai banyak kegiatan
    public function kegiatan(){
        return $this->hasMany(Kegiatan::class, 'id');
    }
    //1 panti mempunyai banyak kegiatan
    public function donasi(){
        return $this->hasMany(Donasi::class, 'id');
    }
}
