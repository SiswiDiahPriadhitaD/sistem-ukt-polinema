<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Role tidak boleh kosong',
            'name.string' => 'Nama Role harus berupa string',
            'name.unique' => 'Nama Role sudah ada',
        ];
    }
}
