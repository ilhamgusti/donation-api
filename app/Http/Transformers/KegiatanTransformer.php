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
                case "hari_acara":
                    $kegiatan["hari_acara"] = $value;
                    break;
                case "sesi_acara":
                    $kegiatan["sesi_acara"] = $value;
                    break;
                case "acara":
                    $kegiatan["acara"] = $value;
                    break;
                case "sesi_makan":
                    $kegiatan["sesi_makan"] = $value;
                    break;
                case "pending":
                    $kegiatan["pending"] = $value;
                    break;
            }
        }

        return $kegiatan;
    }
}
