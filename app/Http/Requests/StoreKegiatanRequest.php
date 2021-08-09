<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
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
            'hari_acara'=>'required|string',
            'sesi_acara'=>'required|string',
            'acara'=>'required',
            'sesi_makan'=>'required|string',
            'pending'=>'required|integer',
            'panti_id'=>'required|integer',
            'keterangan' => 'sometimes|string'
        ];
    }
}
