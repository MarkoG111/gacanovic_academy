<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'username' => 'required|regex:/^[\d\w\_\-\.]{6,30}$/|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:4|regex:/^[A-z]{3,}[0-9]{1,}$/',
            'passwordConfirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required.',
            'username.regex' => 'Username must have min. 6 characters.',
            'username.unique' => 'This username already exists.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not in propper format.',
            'email.unique' => 'This email is already taken.',
            'password.require' => 'Password is required.',
            'password.regex' => 'Password must have 3 letters and min. 1 number.',
            'passwordConfirm.same' => 'Passwords do not match.'
        ];
    }
}
