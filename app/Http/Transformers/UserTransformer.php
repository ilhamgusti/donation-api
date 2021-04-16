<?php

namespace App\Http\Transformers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTransformer
{

    public static function toInstance(array $input, $user = null)
    {
        if (empty($user)) {
            $user = new User();
        }

        foreach ($input as $key => $value) {
            switch ($key) {
                case 'nama':
                    $user['nama'] = $value;
                case 'email':
                    $user['email'] = $value;
                case 'no_tel':
                    $user['no_tel'] = $value;
                case 'alamat':
                    $user['alamat'] = $value;
                case 'tipe':
                    $user['tipe'] = $value;
                case 'password':
                    $passwordValue = Hash::make($value);
                    $user['password'] = $passwordValue;
            }
        }

        return $user;
    }
}
