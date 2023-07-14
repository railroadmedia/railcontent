<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;
use Railroad\Railcontent\Services\PermissionService;

class CreatePermission extends Command
{

    protected const BRANDS = ["drumeo", "guitareo", "pianote", "singeo"];

    protected $signature = 'content:createPermission 
                            {brand : The brand to use}
                            {name : The name to use for the permission}';

    protected $description = 'Create a new permission with the given name for the given brand';

    public function handle(PermissionService $permissionService)
    {
        $brand = $this->argument('brand');

        if (!in_array($brand, self::BRANDS)) {
            $this->error("$brand is not a valid brand");
            return self::FAILURE;
        }

        $name = $this->argument('name');
        $this->info("Creating new permission for $brand, named '$name'");

        $permission = $permissionService->create(
            $name,
            $brand
        );

        $this->info("New permission for {$permission["brand"]}, named '{$permission["name"]}' successfully created");
        return self::SUCCESS;
    }

}
