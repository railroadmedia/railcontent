<?php

namespace App\Modules\Content\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ContentBuilder extends Builder
{
    public function whereTypes(array $types): self
    {
        return $this->whereIn('type', $types);
    }

    public function whereNotFuture(): self
    {
        return $this->where('published_on', '<=', Carbon::now());
    }

    public function whereStatuses(array $statuses): self
    {
        return $this->whereIn('status', $statuses);
    }
}
