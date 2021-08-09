<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hari_acara'=>'sometimes|required|string',
            'sesi_acara'=>'sometimes|required|string',
            'acara'=>'sometimes|required',
            'sesi_makan'=>'sometimes|required|string',
            'pending'=>'sometimes|required|integer',
             'keterangan' => 'sometimes|string',
        ];
    }
}
