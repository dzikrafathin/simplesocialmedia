<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbahKomentar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $komentar = $this->route('komentar');
        return $komentar->user_id == $this->user()->id;
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
        ];
    }

    public function messages() {
        return [
            'required' => 'Kolom komentar wajib diisi'
        ];
    }
}
