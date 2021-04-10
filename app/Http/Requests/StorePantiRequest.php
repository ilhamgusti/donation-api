<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePantiRequest extends FormRequest
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
            'nama_panti'=>'required|string',
            'alamat'=>'required|string',
            'noTel_panti'=>'required',
            'emailPanti'=>'required|email|string',
            'jumlah_anak'=>'required|integer',
            'jumlah_pengurus'=>'required|integer',
            'kebutuhan_panti'=>'required|string',
            'sertifikat'=>'required|file|mimes:png,jpg,jpeg',
            'ktp'=>'required|file|mimes:png,jpg,jpeg',
        ];
    }
}
