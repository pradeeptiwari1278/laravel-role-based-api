<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserResource extends JsonResource
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
                return [
                    'id'   => $role->id,
                    'name' => $role->name,
                ];
            }),
        ];
    }
}
