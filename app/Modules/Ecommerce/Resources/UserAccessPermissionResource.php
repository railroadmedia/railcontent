<?php

namespace App\Modules\Ecommerce\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAccessPermissionResource extends JsonResource
{
    public function toArray($request): array
    {
        /** UserAccessPermission $this */
        return [
            'id' => $this->id,
            'brand' => $this->permission->brand,
            'permission_name' => $this->permission->name,
            'start_time' => $this->start_time,
            'expiration_time' => $this->getExpirationTime(),
            'status' => $this->status
        ];
    }
}
