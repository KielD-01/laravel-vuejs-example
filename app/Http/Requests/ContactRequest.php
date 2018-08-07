<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'fullName' => 'required|between:3,50',
            'email' => 'required|email',
            'message' => 'required|between:20, 1200'
        ];
    }

    public function messages()
    {
        return [
            'fullName.required' => 'Full Name is required',
            'fullName.between' => 'Full Name length should be between :min and :max characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is not valid',
            'message.required' => 'Message is required',
            'message.between' => 'Message length should be between :min and :max',
        ];
    }
}
