<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'email' => 'required|email|exists:App\User,email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'exists' => ':attribute tidak terdaftar',
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => 'Alamat E-Mail tidak valid'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Alamat E-Mail',
            'password' => 'Password'
        ];
    }

}
