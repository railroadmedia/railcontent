<?php

namespace App\Modules\RailTracker\tests\Resources\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Modules\RailTracker\Trackers\ExceptionTracker;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(\Throwable $e): void
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Throwable $e): \Illuminate\Http\Response
    {
        /**
         * @var $exceptionTracker ExceptionTracker
         */
        $exceptionTracker = app(ExceptionTracker::class);

        $exceptionTracker->trackException($request, $e);

        return parent::render($request, $e);
    }
}
