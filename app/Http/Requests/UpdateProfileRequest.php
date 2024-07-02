<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'no_hp' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:L,P',
        ];
    }

    public function messages()
    {
        return [
            'no_hp.regex' => 'Nomor HP tidak valid',
            'alamat.string' => 'Alamat harus berupa string',
            'jenis_kelamin.in' => 'Jenis kelamin harus berupa L atau P',
        ];
    }
}
