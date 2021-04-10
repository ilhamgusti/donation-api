<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonasiRequest extends FormRequest
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
            'jenis_donasi'=> 'required|string',
            'jumlah_rp'=> 'required|integer',
            'nama_barang'=> 'required|string',
            'jumlah_barang'=> 'required|integer',
            'tanggal_kirim'=> 'required|date',
            'kirim_lewat'=> 'required|string',
        ];
    }
}
