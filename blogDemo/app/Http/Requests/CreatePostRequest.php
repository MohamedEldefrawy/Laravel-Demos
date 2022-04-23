<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'title' => [
                'required',
                'min:3',
                'regex:/^([^0-9]*)$/',
                Rule::unique('posts', 'title')->ignore($this->post)
            ],
            'description' => 'required|min:10',
            'userId' => 'exists:users,id'
        ];
    }
}
