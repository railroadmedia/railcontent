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
            'permission_name' => $this->getDescription(),
            'permission_id' => $this->permission_id,
            'duration' => $this->getDuration(),
            'start_time' => $this->actualStartTime?->toDateTimeString() ?? '',
            'expiration_time' => $this->actualExpirationTime?->toDateTimeString() ?? '',
            'status' => $this->status,
            'source' => $this->source,
            'time_lifetime' => $this->time_lifetime,
            'time_days'=> $this->time_days,
            'time_months'=> $this->time_months,
        ];
    }
}
