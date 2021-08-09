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
            'jenis_donasi' => 'sometimes|required|string',
            'jumlah_rp' => 'sometimes|required|integer',
            'nama_barang' => 'sometimes|required|string',
            'jumlah_barang' => 'sometimes|required|integer',
            'tanggal_kirim' => 'sometimes|required|date',
            'kirim_lewat' => 'sometimes|required|string',
            'panti_id' => 'sometimes|required',
            'pending' => 'sometimes|required|integer',
             'keterangan' => 'sometimes|string'
        ];
    }
}
