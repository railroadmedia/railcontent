<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class ProductType extends Model
{
    use HasFactory;
    use RevisionableTrait;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $guarded = [
        'id'
    ];
}
