<?php

namespace App\Modules\DataVersion\Middleware;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Services\DataVersionService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class DataVersionUpdateMiddleware
{

    private DataVersionService $dataVersionService;

    public function __construct(DataVersionService $dataVersionService)
    {
        $this->dataVersionService = $dataVersionService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next, int $dataVersionKeyString)
    {
        $dataVersionKey = UserDataVersionKeyEnum::tryFrom($dataVersionKeyString);
        if (!$dataVersionKey) {
            throw new Exception("Data version key not found");
        }
        $response = $next($request);

        if (!$response->exception) {
            $version = $this->dataVersionService->incrementUserContextVersion($dataVersionKey, user()->id);
            return response()->json(['version' => $version]);
        }
        return $response;
    }
}
