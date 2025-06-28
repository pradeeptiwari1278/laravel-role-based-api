<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;

Route::post('/login', [AuthController::class, 'login']);

// Group all routes under auth middleware (e.g. using Sanctum or Passport)
Route::middleware(['auth:sanctum'])->group(function () {

    // Admin creates new user and assigns role and user can update & delete & get by yourself
    Route::apiResource('/users', UserController::class);

    // Admin can create & list roles and assign a role to the any user
    Route::apiResource('roles', RoleController::class);

    // Create, Show, Update & delete modules by the Admin only
    Route::apiResource('modules', ModuleController::class);

    // Assign role(s) to a user
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole']);

    // Get roles, modules, and permissions for either all users (admin) or only the authenticated user
    Route::get('user-role-permissions', [PermissionController::class, 'userRolePermissions']);

    // List permissions (CRUD), usually seeded, rarely created via API
    Route::get('permissions', [PermissionController::class, 'index']);

    // Assign permissions to role for a specific module
    Route::post('permissions/assign', [PermissionController::class, 'assignPermissionsToRole']);

    // Route for Account access
    Route::apiResource('accounts', AccountController::class);

    // Route for Post
    Route::apiResource('posts', PostController::class);
});
