<?php

namespace App\Modules\DataVersion\Controllers;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Services\DataVersionService;
use Illuminate\Routing\Controller;

class DataVersionController extends Controller
{
    private DataVersionService $dataVersionService;

    public function __construct(DataVersionService $dataVersionService)
    {
        $this->dataVersionService = $dataVersionService;
    }

    public function getUserDataVersion(string $dataKey): array
    {
        $user = user();
        $dataKey = UserDataVersionKeyEnum::tryFrom($dataKey);
        return $this->dataVersionService->getUserDataVersion($dataKey, $user->id);
    }
}
