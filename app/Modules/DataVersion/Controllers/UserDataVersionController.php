<?php

namespace App\Modules\DataVersion\Controllers;

use App\Modules\DataVersion\Models\UserDataVersion;
use App\Modules\DataVersion\Services\DataVersionService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;

abstract class UserDataVersionController extends Controller
{
    private DataVersionService $dataVersionService;

    public function __construct(DataVersionService $dataVersionService)
    {
        $this->dataVersionService = $dataVersionService;
    }

    abstract public function getDataVersionKey();

    abstract public function getData(User $user);

    public function all(Request $request): array
    {
        $currentVersion = intval($request->header('Data-Version')) ?? -1;
        $version = $this->dataVersionService->getUserDataVersion($this->getDataVersionKey(), user()->id);
        if ($version == $currentVersion) {
            return ['version' => 'No Change'];
        }
        $data = $this->getData(user());
        return [
            'version' => $version,
            'data' => $data
        ];
    }

    protected function dataUpdateResponse($wasUpdated): array
    {
        $version = $this->dataVersionService->incrementUserContextVersion($this->getDataVersionKey(), user()->id);;
        return [
            'version' => $version,
        ];
    }

}
