<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Services\ProductService;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Mail;

class GenerateAccessCodes extends Command
{
    private DatabaseManager $databaseManager;

    // mandatory arguments: productId, amount
    // optional arguments: brand, source, --execute

    // artisan generateAccessCodes PRODUCT_ID AMOUNT [SOURCE]
    // ex1: artisan generateAccessCodes 124 10
    // ex2: artisan generateAccessCodes 20 30 test-deal
    // ex3: artisan generateAccessCodes 7 100 sweetwater-2023-deal
    protected $signature = 'generateAccessCodes
                            {productId}
                            {amount}
                            {source?}
                            {--execute : Execute this command. Without this flag, it will be simulated}';

    protected $description = 'Generate access codes.';

    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();
        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function handle(ProductService $productService): int
    {
        $source = $this->getSource();

        $now =
            Carbon::now()
                ->toDateTimeString();

        $emails = [
            'alexandre@musora.com',
            'caleb@drumeo.com',
        ];

        $accessCodes = [];

        $amountToCreate = $this->getAmount();
        $productId = $this->getProductId();
        $simulate = $this->isSimulation();

        $product = $productService->getById($productId);

        if (!$product) {
            $this->info('No product found for product id ' . $productId . ". Exiting now.");
            die();
        }

        $brand = $product->brand;
        $bar = $this->output->createProgressBar($amountToCreate);
        $bar->start();

        for ($i = 1; $i <= $amountToCreate; $i++) {
            $code = AccessCode::generateNewCode();

            $accessCodes[] = [
                'code' => strtoupper($code),
                'product_ids' => serialize([(int)$productId]),
                'is_claimed' => false,
                'claimer_id' => null,
                'claimed_on' => null,
                'brand' => $brand,
                'note' => null,
                'source' => $source,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $bar->advance();
        }

        $bar->finish();

        if (!$simulate) {
            collect($accessCodes)
                ->chunk(1000)
                ->each(function ($chunk) {
                    $this->databaseManager->connection(config('ecommerce.database_connection_name'))
                        ->table('ecommerce_access_codes')
                        ->insert($chunk->toArray());
                });

            Mail::send(
                'emails.generateAccessCodes',
                [
                'accessCodeData' => $accessCodes,
                'product' => $product,
                'source' => $source ?? 'no source',
            ],
                function (\Illuminate\Mail\Message $message) use ($emails, $now, $amountToCreate) {
                    $subject = 'Musora - ' . $amountToCreate . ' Access Codes Generated on ' . $now;
                    $message->from('support@musora.com', 'Musora');
                    $message->to($emails)
                        ->subject($subject);
                }
            );

            $this->info(
                'Emails sent to: ' . implode(', ', $emails)
            );

            $this->info(
                $amountToCreate . ' access codes for \'' . $productId . '\' have been created.'
            );
        } else {
            $this->table(
                [
                'code',
                'product_ids',
                'is_claimed',
                'claimer_id',
                'claimed_on',
                'brand',
                'note',
                'source',
                'created_at',
                'updated_at',
            ],
                $accessCodes
            );

            $this->info(
                $amountToCreate . ' access codes for \'' . $productId . '\' have been simulated.'
            );
        }

        return $this::SUCCESS;
    }

    protected function getProductId(): int
    {
        return $this->argument('productId');
    }

    protected function getAmount(): int
    {
        return $this->argument("amount");
    }

    protected function getSource(): ?string
    {
        return $this->argument('source') ?? null;
    }

    protected function isSimulation(): bool
    {
        return $this->option("execute") == false;
    }
}
