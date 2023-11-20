<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'brand' => 'drumeo',
        ];
    }
}
