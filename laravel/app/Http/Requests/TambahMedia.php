<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahMedia extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $postingan = $this->route('postingan');
        return $postingan->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media' => 'required',
            'media.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }

    public function messages() {
        return [
            'required' => 'Wajib memasukan file foto',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format yang diperbolehkan adalah jpeg,png,jpg,gif'
        ];
    }

}
