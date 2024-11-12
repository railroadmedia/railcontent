<?php

namespace App\Modules\DataVersion\Middleware;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Models\DataVersionConfig;
use App\Modules\DataVersion\Services\DataVersionService;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataVersionGetMiddleware
{

    private DataVersionService $dataVersionService;

    public function __construct(DataVersionService $dataVersionService)
    {
        $this->dataVersionService = $dataVersionService;
    }

    public function handle(Request $request, Closure $next, int $dataVersionKeyString): JsonResponse
    {
        $dataVersionKey = UserDataVersionKeyEnum::tryFrom($dataVersionKeyString);
        if (!$dataVersionKey) {
            throw new Exception("Data version key not found");
        }
        /** @var DataVersionConfig $config */
        $config = config("dataVersioning.$dataVersionKey->value");

        $currentVersion = intval($request->header('Data-Version')) ?? -1;
        $version = $this->dataVersionService->getUserDataVersion($dataVersionKey, user()->id);
        if (($config?->isEnabled() ?? false) && $version == $currentVersion) {
            return response()->json([
                'version' => 'No Change',
                'config' => $config,
            ]);
        }

        $response = $next($request);
        if (!$response->isSuccessful() || $response->exception) {
            return $response;
        }
        $data = $response?->getOriginalContent() ?? [];
        return response()->json([
            'version' => $version,
            'config' => $config?->toArray(),
            'data' => $data,
        ], $response->getStatusCode());
    }
}
