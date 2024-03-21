<?php

namespace App\Modules\FeatureFlagging\Middlewares;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class GuardFeature
{
    // Implementation copied from https://github.com/ylsideas/feature-flags
    // https://github.com/ylsideas/feature-flags/blob/main/src/Middlewares/GuardFeature.php
    public function __construct(
        protected Application $application,
    ) {
    }

    /**
     * @throws BindingResolutionException
     */
    public function handle(
        Request $request,
        Closure $next,
        string $feature,
        string $state = 'on',
        $abort = 403,
        $message = '',
    ): mixed {
        if (
            ($this->check($state)
                ? ! FeatureFlagging::accessible($feature)
                : FeatureFlagging::accessible($feature))
        ) {
            $this->application->abort($abort, $message);
        }

        return $next($request);
    }

    /**
     * Returns true for 'on' and false for 'off'.
     */
    protected function check(string $state): bool
    {
        if ($state === 'on') {
            return true;
        } elseif ($state === 'off') {
            return false;
        }

        throw new \InvalidArgumentException('$state parameters is expected to being be `on` or `off`');
    }
}
