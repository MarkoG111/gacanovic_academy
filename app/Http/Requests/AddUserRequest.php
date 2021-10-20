<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'password' => ['required', 'min:4', 'regex:/^[A-z]{3,}[0-9]{1,}$/'],
            'confirmPassword' => 'required|same:password',
            'active' => 'nullable',
            'role' => 'required|exists:role,id_role',
        ];
    }
}
