<?php

namespace App\Http\Requests;

use App\Postingan;
use Illuminate\Foundation\Http\FormRequest;

class UbahPostingan extends FormRequest
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
            'isi' => 'required'
        ];
    }
}
