<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbahProfil extends FormRequest
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
            "nama" => 'required',
            "email" => 'required|email',
            "tempat_lahir" => 'required',
            "tanggal_lahir" => 'required|date',
            "alamat" => 'required',
            "no_hp" => 'required',
            "foto" => 'mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'unique' => ':attribute sudah digunakan',
            'required' => 'Kolom :attribute wajib diisi.',
            'date' => ':attribute tidak valid',
            'email' => 'Alamat E-Mail tidak valid',
            'mimes' => 'Format file :attribute harus jpeg,jpg, atau png'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'email' => 'Alamat E-Mail',
            'password' => 'Password',
            "tempat_lahir" => 'Tempat Lahir',
            "tanggal_lahir" => 'Tanggal Lahir',
            "alamat" => 'ALamat',
            "no_hp" => 'No HP'
        ];
    }
}
