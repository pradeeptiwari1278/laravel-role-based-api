<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only admin can assign permissions
        return $this->user()->roles->contains('name', 'admin');
    }

    public function rules(): array
    {
        return [
            'role_id'        => 'required|exists:roles,id',
            'module_id'      => 'required|exists:modules,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Role ID is required.',
            'module_id.required' => 'Module ID is required.',
            'permission_ids.required' => 'You must provide at least one permission.',
        ];
    }
}

