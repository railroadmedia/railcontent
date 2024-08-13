<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Customer;
use App\Modules\Ecommerce\Models\Shopify\ShopifyOrderFix;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Shopify;
use Throwable;

class ShopifyOrdersCleanupReport extends Command
{
    protected $signature = 'shopify:orders-cleanup-report
                            {year : The year for which to make a report}
                            {--csv : (Optional) Generate the results in CSV format. If not selected, a table will be printed.}';

    protected $description = 'Create a report of the shopify_order_fixes entries for your chosen year';

    private Shopify $shopify;
    private array $tableRows = [];

    /**
     * @throws Throwable
     */
    public function handle(Shopify $shopify): int
    {
        $this->shopify = $shopify;
        $year = intval($this->argument('year'));
        if (!in_array($year, range(2010, 2023))) {
            $this->error('year must be between 2010 and 2023');
            return self::INVALID;
        }

        $csv = $this->option('csv');

        $tableHeader[] = '';
        foreach (range(1, 12) as $month) {
            $date = Carbon::parse(sprintf('%s-%s-01', $year, $month));
            $tableHeader[] = $date->format('Y-M');
        }

        $this->tableRows = $this->generateRows();

        foreach (range(1, 12) as $month) {
            $monthRowIndex = 0;
            $rangeStart = Carbon::parse(sprintf('%s-%s-01', $year, $month))->startOfMonth();
            $rangeEnd = Carbon::parse(sprintf('%s-%s-01', $year, $month))->endOfMonth();
            // get 5 random matches
            /** @var Collection<ShopifyOrderFix> $matches */
            $matches = ShopifyOrderFix::query()
                ->toSyncWithShopify(startProcessedAt: $rangeStart, endProcessedAt: $rangeEnd, matchedOnly: true)
                ->inRandomOrder()
                ->limit(5)
                ->get();
            foreach ($matches as $fix) {
                $this->addResults($fix, $monthRowIndex, $month, false);
            }
            for ($noResultLoop = 0; $noResultLoop < 5 - $matches->count();  $noResultLoop++) {
                for ($emptyLoop = 0; $emptyLoop < 3; $emptyLoop++) {
                    $this->tableRows[++$monthRowIndex][$month] = '';
                }
            }
            $this->tableRows[++$monthRowIndex][$month] = '';

            // get 5 random replaces
            /** @var Collection<ShopifyOrderFix> $replaces */
            $replaces = ShopifyOrderFix::query()
                ->toSyncWithShopify(startProcessedAt: $rangeStart, endProcessedAt: $rangeEnd, replacedOnly: true)
                ->inRandomOrder()
                ->limit(5)
                ->get();

            foreach ($replaces as $fix) {
                $this->addResults($fix, $monthRowIndex, $month, true);
            }
            for ($noResultLoop = 0; $noResultLoop < 5 - $replaces->count();  $noResultLoop++) {
                for ($emptyLoop = 0; $emptyLoop < 5; $emptyLoop++) {
                    $this->tableRows[++$monthRowIndex][$month] = '';
                }
            }
            $this->tableRows[++$monthRowIndex][$month] = '';

            // biggest replacement
            $biggestReplace = ShopifyOrderFix::query()
                ->selectRaw('order_total_usd - shopify_order_price as diff, shopify_order_price, order_total_usd, original_shopify_order_id')
                ->toSyncWithShopify(startProcessedAt: $rangeStart, endProcessedAt: $rangeEnd, replacedOnly: true)
                ->orderBy('diff', 'DESC')
                ->first();
            if ($biggestReplace) {
                $this->addResults($biggestReplace, $monthRowIndex, $month, true);
            } else {
                for ($emptyLoop = 0; $emptyLoop < 5;  $emptyLoop++) {
                    $this->tableRows[++$monthRowIndex][$month] = '';
                }
            }
        }

        if ($csv) {
            $this->info(implode(',', $tableHeader));
            foreach($this->tableRows as $tableRow) {
                $this->info(implode(',', $tableRow));
            }
        } else {
            $this->table($tableHeader, $this->tableRows);
        }
        return self::SUCCESS;
    }

    private function generateRows(): array
    {
        $columnTitles = $this->getColumnTitles();
        $rows = [];
        for ($i = 0; $i < count($columnTitles); $i++) {
            $row = [
                $columnTitles[$i]
            ];
            foreach (range(1, 12) as $month) {
                $row[$month] = '';
            }
            $rows[] = $row;
        }
        return $rows;
    }

    private function getColumnTitles(): array
    {
        foreach (range(1, 5) as $index) {
            $rows[] = "Random Match #$index";
            $rows[] = '             Shopify';
            $rows[] = '                  MC';
        }
        $rows[] = '';
        foreach (range(1, 5) as $index) {
            $rows[] = "Random Replace #$index";
            $rows[] = '             Shopify';
            $rows[] = '                  MC';
            $rows[] = '            Original';
            $rows[] = '            Replaced';
        }
        $rows[] = '';
        $rows[] = 'Biggest Diff Replace';
        $rows[] = '             Shopify';
        $rows[] = '                  MC';
        $rows[] = '            Original';
        $rows[] = '            Replaced';
        return $rows;
    }

    private function addResults(ShopifyOrderFix $fix, int &$monthRowIndex, int $month, bool $withPrices): void
    {
        $shopifyLink = sprintf('https://admin.shopify.com/store/musora/orders/%s', $fix->original_shopify_order_id);
        $rowsToFill = $withPrices ? 5 : 3;
        try {
            $orderResource = $this->shopify->getOrder($fix->original_shopify_order_id);
        } catch (NotFoundException $exception) {
            $this->tableRows[++$monthRowIndex][$month] = "Shopify order not found: $fix->original_shopify_order_id";
            for ($emptyLoop = 1; $emptyLoop < $rowsToFill;  $emptyLoop++) {
                $this->tableRows[++$monthRowIndex][$month] = '';
            }
            return;
        }
        $customerEmail = $orderResource->getAttributes()['customer']['email'];
        // staging stores appended a masking string
        if (Str::endsWith($customerEmail, '.ex')) {
            $customerEmail = Str::beforeLast($customerEmail, '.ex');
        }

        $user = User::firstWhere('email', $customerEmail);
        if ($user) {
            $mcLink = sprintf('https://admin.musora.com/admin#/users/%s', $user->id);
        } else {
            $customer = Customer::firstWhere('email', $customerEmail);
            if ($customer) {
                $mcLink = sprintf('https://admin.musora.com/admin#/customers/%s', $customer->id);
            } else {
                $mcLink = "Local user or customer not found: $customerEmail";
            }
        }

        $this->tableRows[++$monthRowIndex][$month] = $shopifyLink;
        $this->tableRows[++$monthRowIndex][$month] = $mcLink;

        if ($withPrices) {
            $this->tableRows[++$monthRowIndex][$month] = sprintf('$%s', number_format($fix->shopify_order_price, 2, '.', ','));
            $this->tableRows[++$monthRowIndex][$month] = sprintf('$%s', number_format($fix->order_total_usd, 2, '.', ','));
        }

        $this->tableRows[++$monthRowIndex][$month] = '';
    }
}
