<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Services\UserService;

class SyncTrialUsers extends Command
{
    protected $signature = 'ecommerce:SyncTrialUsers {startIndex=0} {endIndex=-1}';

    public function handle(UserService $userService )
    {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);
        $this->withProgressBar(
            $csv,
            function ($row) use ($headersRow, $userService) {
                $data = $this->getData($row, $headersRow);
                $shopifyId = $this->getValue($data, $headersRow, 'shopify_id');
                $trialExpirationDate = $this->getValue($data, $headersRow, 'trial_expiration_date');
                $userService->setTrialPeriod($shopifyId, $trialExpirationDate);
            }
        );
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'trial_users.csv';
        $filePath = app_path() . '/Modules/Ecommerce/Console/Commands/Data/' . $fileName;
        $file = file($filePath);
        $csv = array_map('str_getcsv', $file);
        $headersRow = $csv[0];
        unset($csv[0]);
        if ($endIndex == -1 or $endIndex > count($csv)) {
            $endIndex = count($csv);
        }
        $csv = array_slice($csv, $startIndex, $endIndex - $startIndex);
        return [$csv, $headersRow];
    }

    private function getData($row, $headersRow): array
    {
        $data = [];
        for ($i = 0; $i < count($row); $i++) {
            $data[$headersRow[$i]] = $row[$i];
        }
        return $data;
    }

    private function getValue(array $data, mixed $headersRow, string $name): ?string
    {
        if (!in_array($name, $headersRow)) {
            throw new Exception("Header '$name' does not exist in array");
        }

        return $data[$name] ?? "";
    }
}
