<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreelancerRequest extends FormRequest
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
//            'avatar' => 'required|mimes:jpeg,jpg,png|image|dimensions:min_width=100,min_height=200|max:2048',
//            'country_id' => 'required|numeric',
//            'city_id' => 'required|numeric',
//            'birthday' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
//            'message' => 'Message',
//            'budget' => 'Budget',
////            'count_day' => 'End Day',
        ];
    }
}
