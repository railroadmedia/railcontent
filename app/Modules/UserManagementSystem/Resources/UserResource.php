<?php

namespace App\Modules\UserManagementSystem\Resources;

use Modules\UserManagementSystem\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var User $user */
        $user = $this->resource;
        return [
            'id' => $user->id,
            'email' => $user->email,
            'display_name' => $user->display_name,
        ];
    }
}
