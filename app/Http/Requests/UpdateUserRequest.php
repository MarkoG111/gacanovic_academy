<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->input('hiddenUserField');
        return [
            'username' => ['required', 'regex:/^[\d\w\_\-\.]{6,30}$/', Rule::unique('user', 'username')->ignore($id, 'id_user')],
            'email' => ['required', 'email', Rule::unique('user', 'email')->ignore($id, 'id_user')],
            'password' => 'nullable|min:4|regex:/^[A-z]{3,}[0-9]{1,}$/',
            'active' => 'nullable',
            'role' => 'required|exists:role,id_role'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required...',
            'username.regex' => 'Username must have min. 6 characters.',
            'username.unique' => 'This username already exists',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not in good format.',
            'email.unique' => 'This email already exists',
            'password.regex' => 'Password must have 3 letters and min. 1 number.',
            'role.required' => 'Role is required.',
            'role.exists' => 'Role does not exists in system.'
        ];
    }
}
