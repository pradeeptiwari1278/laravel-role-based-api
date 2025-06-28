<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only admin can create users
        return auth()->user()->roles->contains('name', 'admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Role is required.',
            'role_id.exists' => 'Invalid role selected.',
            'email.unique' => 'This email is already registered.',
        ];
    }
}
