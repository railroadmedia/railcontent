<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Image extends Model
{
    use HasFactory;
    use RevisionableTrait;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $guarded = [
        'id'
    ];
}
