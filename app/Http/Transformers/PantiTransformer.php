<?php

namespace App\Http\Transformers;

use App\Models\Panti;

class PantiTransformer
{

    public static function toInstance(array $input, $panti = null)
    {
        if (empty($panti)) {
            $panti = new Panti();
        }

        foreach ($input as $key => $value) {
            switch ($key) {
                case'nama_panti':
                    $panti->nama_panti = $value;
                    break;
                case'alamat':
                    $panti->alamat = $value;
                    break;
                case'noTel_panti':
                    $panti->noTel_panti = $value;
                    break;
                case'emailPanti':
                    $panti->emailPanti = $value;
                    break;
                case'jumlah_anak':
                    $panti->jumlah_anak = $value;
                    break;
                case'jumlah_pengurus':
                    $panti->jumlah_pengurus = $value;
                    break;
                case'kebutuhan_panti':
                    $panti->kebutuhan_panti = $value;
                    break;
                case'sertifikat':
                    $panti->sertifikat = $value;
                    break;
                case'ktp':
                    $panti->ktp = $value;
                    break;
                case'lat':
                    $panti->lat = $value;
                    break;
                case'lon':
                    $panti->lon = $value;
                    break;
            }
        }

        return $panti;
    }
}
