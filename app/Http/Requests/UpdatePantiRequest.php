<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePantiRequest extends FormRequest
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
            'nama_panti'=>'sometimes|required|string',
            'lat'=>'sometimes|required|string',
            'lon'=>'sometimes|required|string',
            'alamat'=>'sometimes|required|string',
            'noTel_panti'=>'sometimes|required',
            'emailPanti'=>'sometimes|required|email|string',
            'jumlah_anak'=>'sometimes|required|integer',
            'jumlah_pengurus'=>'sometimes|required|integer',
            'kebutuhan_panti'=>'sometimes|required|string',
            'sertifikat'=>'sometimes|required|file|mimes:png,jpg,jpeg',
            'ktp'=>'sometimes|required|file|mimes:png,jpg,jpeg',
            'keterangan' => 'sometimes|string',
            'status'=>'sometimes|integer',
        ];
    }
}
