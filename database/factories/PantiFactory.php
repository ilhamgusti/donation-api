<?php

namespace Database\Factories;

use App\Models\Panti;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PantiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Panti::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_panti'=> $this->faker->name,
            'alamat' => $this->faker->address,
            'noTel_panti' => $this->faker->e164PhoneNumber,
            'emailPanti'=>$this->faker->email,
            'jumlah_anak' => $this->faker->randomDigitNotNull,
            'jumlah_pengurus' => $this->faker->randomDigitNotNull,
            'kebutuhan_panti' => $this->faker->paragraph(3,true),
            'sertifikat' =>$this->faker->image('public/storage/images',400,300, null, false),
            'ktp' =>$this->faker->image('public/storage/images',400,300, null, false),
            'user_id'=> User::where('tipe',1)->get()->random()
        ];
    }
}
