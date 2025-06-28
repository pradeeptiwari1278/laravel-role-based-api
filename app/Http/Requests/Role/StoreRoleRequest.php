<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only allow users with admin role
        return $this->user()->roles->contains('name', 'admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Role name is required.',
            'name.unique' => 'This role already exists.',
        ];
    }
}
