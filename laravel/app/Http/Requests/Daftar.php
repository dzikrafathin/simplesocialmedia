<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Daftar extends FormRequest
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
            'nama' => 'required',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required'
        ]; 
    }

    public function messages()
    {
        return [
            'unique' => ':attribute sudah digunakan',
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => 'Alamat E-Mail tidak valid'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'email' => 'Alamat E-Mail',
            'password' => 'Password'
        ];
    }
}
