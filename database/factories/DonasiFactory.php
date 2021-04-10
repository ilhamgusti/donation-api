<?php

namespace Database\Factories;

use App\Models\Donasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jenis_donasi'=> $this->faker->date(),
            'jumlah_rp' => $this->faker->randomNumber,
            'nama_barang' => $this->faker->word,
            'jumlah_barang'=>$this->faker->name,
            'tanggal_kirim'=>$this->faker->date,
            'kirim_lewat'=>$this->faker->name,
            'jumlah_barang'=>rand(3,50),
            'pending' => true,
            'user_id'=> User::factory(),

        ];
    }
}
