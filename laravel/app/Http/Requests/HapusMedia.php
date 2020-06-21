<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Media;

class HapusMedia extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $media = Media::findOrFail($this->route('media'));
        return $media->postingan->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
