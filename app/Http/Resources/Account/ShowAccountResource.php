<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'account_name'  => $this->account_name,
            'balance'       => $this->balance,
            'created_at'    => $this->created_at->toDateTimeString(),
            'updated_at'    => $this->updated_at->toDateTimeString(),
        ];
    }
}
