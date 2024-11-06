<?php

namespace App\Modules\DataVersion\Middleware;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Services\DataVersionService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class DataVersionGetMiddleware
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
        $currentVersion = intval($request->header('Data-Version')) ?? -1;
        $version = $this->dataVersionService->getUserDataVersion($dataVersionKey, user()->id);
        if ($version == $currentVersion) {
            return response()->json(['version' => 'No Change']);
        }

        $response = $next($request);
        if ($response->exception) {
            return $response;
        }
        $data = $response?->getOriginalContent() ?? [];
        return response()->json([
            'version' => $version,
            'data' => $data,
        ]);
    }
}
