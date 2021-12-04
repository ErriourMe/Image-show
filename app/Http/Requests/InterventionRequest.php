<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterventionRequest extends FormRequest
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
            'quality' => 'integer|nullable|min:1|max:100',
            'link' => 'required|url',
            'width' => 'nullable|integer|min:10',
            'height' => 'nullable|integer|min:10',
            'ext' => 'nullable|in:webp,jpg,png',
            'quality' => 'nullable|integer|min:1|max:100',
        ];
    }
}
