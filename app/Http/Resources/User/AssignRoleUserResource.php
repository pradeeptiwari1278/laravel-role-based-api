<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignRoleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Role(s) assigned successfully.',
            'user' => [
                'id'    => $this->id,
                'name'  => $this->name,
                'email' => $this->email,
                'roles' => $this->roles->map(function ($role) {
                    return [
                        'id'   => $role->id,
                        'name' => $role->name,
                    ];
                }),
            ],
        ];
    }
}
