<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayPalVerified extends FormRequest
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
//        $this->redirect = ""
        return [
//            'avatar' => 'required|mimes:jpeg,jpg,png|image|dimensions:min_width=100,min_height=200|max:2048',
            'address' => 'required|string',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'postal_code' => 'required|string',
            'pay_email' => 'required|string|max:255|email',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
//    public function messages()
//    {
//        return [
//            'avatar.required' => 'A file is required',
//            'country_id.string' => 'A title is string',
//        ];
//    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'avatar' => 'File',
            'address' => 'Address Line',
            'country_id' => 'Country',
            'city_id' => 'City',
            'postal_code' => 'Postal Code',
            'pay_email' => 'PayPal address',
        ];
    }
}
