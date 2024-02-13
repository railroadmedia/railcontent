<?php

namespace App\Modules\Ecommerce\Resources;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\UserManagementSystem\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class AccessCodeResource extends JsonResource
{
    public Collection $products;

    public function toArray($request): array
    {
        /** @var AccessCode $accessCode */
        $accessCode = $this->resource;
        return [
            'id' => $accessCode->id,
            'code' => $accessCode->code,
            'brand' => $accessCode->brand,
            'product_ids' => $accessCode->product_ids ?? [],
            'is_claimed' => $accessCode->is_claimed,
            'note' => $accessCode->note,
            'source' => $accessCode->source,
            'claimer' => new UserResource($accessCode->claimer),
            'products' => ProductResource::collection($this->products),
            'claimed_on' => $accessCode->claimed_on ? Carbon::parse($accessCode->claimed_on)->toDateTimeString() : null,
            'created_at' => $accessCode->created_at ? Carbon::parse($accessCode->created_at)->toDateTimeString() : null,
            'updated_at' => $accessCode->updated_at ? Carbon::parse($accessCode->updated_at)->toDateTimeString() : null,
        ];
    }
}
