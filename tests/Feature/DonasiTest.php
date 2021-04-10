<?php

namespace Tests\Feature;

use App\Models\Donasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DonasiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_a_donation() {

        // make an instance of the Employee Factory
        $data = Donasi::factory()->make([
            'pending'=> false
        ]);

        // post the data to the datas store method
        $response = $this->post(route('donasi.store'), [
            'jenis_donasi' => $data->jenis_donasi,
            'jumlah_rp'=> $data->jumlah_rp,
            'nama_barang'=> $data->nama_barang,
            'jumlah_barang'=> $data->jumlah_barang,
            'tanggal_kirim'=> $data->tanggal_kirim,
            'kirim_lewat'=> $data->kirim_lewat,
            'jumlah_barang'=> $data->jumlah_barang,
            'pending' => true,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('donasi', [
            'jenis_donasi' => $data->jenis_donasi,
            'jumlah_rp'=> $data->jumlah_rp,
            'nama_barang'=> $data->nama_barang,
            'jumlah_barang'=> $data->jumlah_barang,
            'tanggal_kirim'=> $data->tanggal_kirim,
            'kirim_lewat'=> $data->kirim_lewat,
            'jumlah_barang'=> $data->jumlah_barang,
            'pending' => true,
        ]);

    }
}
