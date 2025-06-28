<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\IndexRoleRequest;
use App\Http\Requests\Role\DestroyRoleRequest;
use App\Http\Requests\Role\ShowRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\Role\IndexRoleResource;
use App\Http\Resources\Role\ShowRoleResource;
use App\Http\Resources\Role\StoreRoleResource;
use App\Http\Resources\Role\UpdateRoleResource;

class RoleController extends Controller
{
    public function index(IndexRoleRequest $request)
    {
        $roles = Role::all();

        return response()->json([
            'message' => 'Roles fetched successfully',
            'data'    => IndexRoleResource::collection($roles)
        ]);
    }

    public function show(ShowRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        return response()->json([
            'message' => 'Role fetched successfully',
            'data'    => new ShowRoleResource($role)
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());

        return response()->json([
            'message' => 'Role created successfully',
            'data'    => new StoreRoleResource($role)

        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return response()->json([
            'message' => 'Role updated successfully.',
            'data'    => new UpdateRoleResource($role)
        ]);
    }

    public function destroy(DestroyRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
