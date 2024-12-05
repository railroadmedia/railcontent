<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\OnboardingBrand
 *
 * @property int $id
 * @property int $user_id
 * @property string[] $brands
 * @property string $first_brand
 * @property string $last_brand
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @mixin Eloquent
 * @property-read User $user
 */
class OnboardingBrand extends Model
{
    protected $table = 'onboarding_brands';

    protected $fillable = [ 'user_id', 'brands', 'first_brand', 'last_brand'];

    protected function brands(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? [] : explode(',', $value),
            set: fn ($value) => implode(',', $value),
        );
    }

    public function addBrand(string $brand): array
    {
        $brands = $this->brands;

        if (empty($brands)) {
            $this->update(['first_brand' => $brand]);
        }

        if (!in_array($brand, $brands)) {
            $brands[] = $brand;
            $this->update([
                'brands' => $brands,
                'last_brand' => $brand
            ]);
        }
        return $this->brands;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
