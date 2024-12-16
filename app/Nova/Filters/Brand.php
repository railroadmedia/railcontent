<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  mixed  $value
     */
    public function apply(NovaRequest $request, $query, $value): Builder
    {
        $brand_id = \App\Models\Brand::where('name', $value)->firstOrFail()->id;

        return $query->where('brand_id', $brand_id);
    }

    /**
     * Get the filter's available options.
     */
    public function options(NovaRequest $request): array
    {
        $brands = \App\Models\Brand::get();
        $brands = $brands->mapWithKeys(function ($item) {
            return [$item['name'] => $item['name']];
        });

        return $brands->toArray();
    }
}
