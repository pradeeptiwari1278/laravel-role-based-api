<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RoleModulePermission;

class UserRoleModulePermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'roles'   => $this->roles->map(function ($role) {
                $rolePermissions = RoleModulePermission::with(['module', 'permission'])
                    ->where('role_id', $role->id)
                    ->get();

                $modules = $rolePermissions->groupBy('module.name')->map(function ($items, $moduleName) {
                    return [
                        'module' => $moduleName,
                        'permissions' => $items->pluck('permission.name')->unique()->values(),
                    ];
                })->values();

                return [
                    'role_name' => $role->name,
                    'modules'   => $modules,
                ];
            })
        ];
    }
}
