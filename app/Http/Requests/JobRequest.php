<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('add_jobs') && auth()->user()->verifyPayPalEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required|exists:freelance_titles,id',
            'title' => 'required|string|max:40',
            'description' => 'required',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'budget' => 'required',
            'attachment_id' => 'array',
            'agree' => 'required',
//            'plan' => 'required|exists:plans,id'
        ];
    }
}
