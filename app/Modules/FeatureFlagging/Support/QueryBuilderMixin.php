<?php

namespace Modules\FeatureFlagging\Support;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */
class QueryBuilderMixin
{
    // Implementation taken from: https://github.com/ylsideas/feature-flags
    // File: https://github.com/ylsideas/feature-flags/blob/main/src/Support/QueryBuilderMixin.php
    public function whenFeatureIsAccessible(): callable
    {
        return fn (string $feature, callable $action): \Illuminate\Contracts\Database\Query\Builder => $this->when(FeatureFlagging::accessible($feature), $action);
    }

    public function whenFeatureIsNotAccessible(): callable
    {
        return fn (string $feature, callable $action): \Illuminate\Contracts\Database\Query\Builder => $this->when(! FeatureFlagging::accessible($feature), $action);
    }
}
