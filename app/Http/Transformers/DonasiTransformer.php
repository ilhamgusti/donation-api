<?php

namespace App\Http\Transformers;

use App\Models\Donasi;

class DonasiTransformer
{

    public static function toInstance(array $input, $donasi = null)
    {
        if (empty($donasi)) {
            $donasi = new Donasi();
        }

        foreach ($input as $key => $value) {
            switch ($key) {
                case 'jenis_donasi':
                    $donasi['jenis_donasi'] = $value;
                    break;
                case 'jumlah_rp':
                    $donasi['jumlah_rp'] = $value;
                    break;
                case 'nama_barang':
                    $donasi['nama_barang'] = $value;
                    break;
                case 'jumlah_barang':
                    $donasi['jumlah_barang'] = $value;
                    break;
                case 'tanggal_kirim':
                    $donasi['tanggal_kirim'] = $value;
                    break;
                case 'kirim_lewat':
                    $donasi['kirim_lewat'] = $value;
                    break;
                case 'panti_id':
                    $donasi['panti_id'] = $value;
                    break;
            }
        }

        return $donasi;
    }
}
