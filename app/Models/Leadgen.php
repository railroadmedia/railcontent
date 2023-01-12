<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadgen extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function lessons()
    {
        return $this->hasMany(LeadgenLesson::class)->orderBy('display_order');
    }
}
