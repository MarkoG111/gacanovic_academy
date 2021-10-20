<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|regex:/^[\d\w\_\-\.]{6,30}$/|exists:user,username',
            'password' => 'required|regex:[^[A-z0-9.?!]{6,}]'
        ];
    }

    public function message()
    {
        return [
            'username.required' => 'Username is required.',
            'username.regex' => 'Username is not in good format.',
            'username.exists' => 'Username doesn"t exists in our system.',
            'password.required' => 'Password is required.',
            'password.regex' => 'Password is not in good format.'
        ];
    }
}
