<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use App\Models\Panti;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class KegiatanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kegiatan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hari_acara'=> $this->faker->date(),
            'sesi_acara' => $this->faker->sentence(6,true),
            'acara' => $this->faker->sentence(6,true),
            'sesi_makan'=>$this->faker->name,
            'pending' => true,
            'user_id'=> User::where('tipe',1)->get()->random(),
            'panti_id'=> Panti::all()->random(),

        ];
    }
}
