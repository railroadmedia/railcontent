<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CohortList extends Model
{
    use HasFactory;

    public function cohort()
    {
        return $this->belongsTo(Cohort::class, 'cohort_id');
    }

    protected $guarded = [
        'id'
    ];
}
