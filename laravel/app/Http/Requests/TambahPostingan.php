<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahPostingan extends FormRequest
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
            'isi' => 'required',
            'media.*' => 'image|mimes:jpeg,png,jpg,gif'
        ];
    }

    public function messages() {
        return [
            'required' => 'Kolom wajib diisi',
            'image' => 'File harus berupa gambar jpeg,png,jpg, atau gif'
        ];
    }
}
