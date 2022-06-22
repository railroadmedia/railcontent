<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'bundle_id');
    }

    protected $guarded = [
        'id'
    ];
}
