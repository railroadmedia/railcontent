<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;

class LeadgenLesson extends Model
{
    use HasFactory;

    public function leadgen(): BelongsTo
    {
        return $this->belongsTo(Leadgen::class, 'brand_id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(LeadgenLessonAsset::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(LeadgenLessonAssignment::class);
    }

    public function delete()
    {
        LeadgenLessonAsset::where('leadgen_lesson_id', '=', $this->id)->delete();
        LeadgenLesson::where('id', '=', $this->id)->delete();
    }

    protected $guarded = [
        'id'
    ];
}
