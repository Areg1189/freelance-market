<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
//            'keywords'=> 'required_if:category,null|required_if:skill,null',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
//            'keywords.required' => 'A Keywords is required',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
//    public function attributes()
//    {
//        return [
//            'keywords' => 'Keywords',
//        ];
//    }
}
