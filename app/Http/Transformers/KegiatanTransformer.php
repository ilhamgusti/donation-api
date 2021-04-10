<?php

namespace App\Http\Transformers;

use App\Models\Kegiatan;

class KegiatanTransformer
{

    public static function toInstance(array $input, $kegiatan = null)
    {
        if (empty($kegiatan)) {
            $kegiatan = new Kegiatan();
        }

        foreach ($input as $key => $value) {
            switch ($key) {
                case'nama_Kegiatan':
                    $kegiatan->nama_kegiatan = $value;
                    break;
                case'alamat':
                    $kegiatan->alamat = $value;
                    break;
                case'noTel_kegiatan':
                    $kegiatan->noTel_kegiatan = $value;
                    break;
                case'emailkegiatan':
                    $kegiatan->emailkegiatan = $value;
                    break;
                case'jumlah_anak':
                    $kegiatan->jumlah_anak = $value;
                    break;
                case'jumlah_pengurus':
                    $kegiatan->jumlah_pengurus = $value;
                    break;
                case'kebutuhan_kegiatan':
                    $kegiatan->kebutuhan_kegiatan = $value;
                    break;
                case'sertifikat':
                    $kegiatan->sertifikat = $value;
                    break;
                case'ktp':
                    $kegiatan->ktp = $value;
                    break;
            }
        }

        return $kegiatan;
    }
}
