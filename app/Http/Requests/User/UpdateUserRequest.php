<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $auth = auth()->user();
        $user = $this->route('user'); // Get the user from route

        return $auth->hasRole('admin') || $auth->id === $user->id;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id ?? null;

        return [
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'password' => 'nullable|min:6',
            'role_id'  => 'nullable|exists:roles,id',
        ];
    }
}
