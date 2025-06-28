<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\DestroyUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\AssignRoleRequest;
use App\Http\Resources\User\IndexUserResource;
use App\Http\Resources\User\ShowUserResource;
use App\Http\Resources\User\StoreUserResource;
use App\Http\Resources\User\UpdateUserResource;
use App\Http\Resources\User\AssignRoleUserResource;

class UserController extends Controller
{
    public function index(IndexUserRequest $request)
    {
        return IndexUserResource::collection(User::with('roles')->get());
    }

    public function show(ShowUserRequest $request, User $user)
    {
        return new ShowUserResource($user->load('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->attach($request->role_id);

        return response()->json([
            'message' => 'User created and role assigned successfully.',
            'user'    => new StoreUserResource($user->load('roles'))
        ], 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        if ($request->has('role_id') && auth()->user()->hasRole('admin')) {
            $user->roles()->sync($request->role_id);
        }

        return response()->json([
            'message' => 'User updated successfully.',
            'user'    => new UpdateUserResource($user->load('roles'))
        ]);
    }

    public function destroy(DestroyUserRequest $request, User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }

    public function assignRole(AssignRoleRequest $request, User $user)
    {
        $user->roles()->syncWithoutDetaching([$request->role_id]);

        return response()->json([
            'message' => 'Role assigned successfully.',
            'user'    => new AssignRoleUserResource($user->load('roles'))
        ]);
    }
}
