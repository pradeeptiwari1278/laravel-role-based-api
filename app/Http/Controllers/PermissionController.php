<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModulePermission;
use App\Http\Requests\Permission\userRolePermissionsRequest;
use App\Http\Requests\Permission\AssignPermissionRequest;
use App\Http\Requests\Permission\IndexPermissionRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Permission\UserRoleModulePermissionResource;

class PermissionController extends Controller
{
    public function index(IndexPermissionRequest $request)
    {
        $permissions = Permission::all();
        return PermissionResource::collection($permissions);
    }

    public function assignPermissionsToRole(AssignPermissionRequest $request)
    {
        $roleId        = $request->role_id;
        $moduleId      = $request->module_id;
        $permissionIds = $request->permission_ids;

        // Optional: remove existing permissions for this role & module
        RoleModulePermission::where('role_id', $roleId)
            ->where('module_id', $moduleId)
            ->delete();

        // Assign new ones
        foreach ($permissionIds as $permissionId) {
            RoleModulePermission::create([
                'role_id'       => $roleId,
                'module_id'     => $moduleId,
                'permission_id' => $permissionId,
            ]);
        }

        return response()->json([
            'message' => 'Permissions assigned successfully.',
        ]);
    }

    public function userRolePermissions(userRolePermissionsRequest $request)
    {
        $auth  = auth()->user();
        $users = $auth->hasRole('admin') ? User::with('roles')->get() : [$auth->load('roles')];

        return response()->json([
            'message' => 'Role-module-permissions fetched successfully.',
            'data'    => UserRoleModulePermissionResource::collection($users),
        ]);
    }
}
