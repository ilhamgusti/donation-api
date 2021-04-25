<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserRequest extends FormRequest
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
            'email'=>'sometimes|required|string',
            'nama'=>'sometimes|required|string',
            'alamat'=>'sometimes|required|string',
            'no_tel'=>'sometimes|required',
            'online'=>'sometimes|required',
            'password'=>'sometimes|required',
        ];
    }
}
