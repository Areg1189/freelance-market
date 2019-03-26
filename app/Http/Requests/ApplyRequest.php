<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('apply_job');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'GET') return [];
        return [
            'message' => 'required|string',
            'budget' => 'required|numeric',
//            'count_day' => 'required|numeric',
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
            'message' => 'Message',
            'budget' => 'Budget',
//            'count_day' => 'End Day',
        ];
    }
}
