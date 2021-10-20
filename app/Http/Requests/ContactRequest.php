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
            'email' => 'required|email',
            'subject' => 'required|regex:/[A-z0-9]+/',
            'message' => 'required|regex:/[A-z0-9]+/'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not in good format.',
            'subject.required' => 'Subject is required.',
            'subject.regex' => 'Subject is not in good format.',
            'message.required' => 'Message is required.',
            'message.regex' => 'Message is not in good format.'
        ];
    }
}
