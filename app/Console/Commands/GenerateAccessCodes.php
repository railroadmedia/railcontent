<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Symfony\Component\Console\Input\InputArgument;

class GenerateAccessCodes extends Command
{

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generateAccessCodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate access codes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    // mandatory arguments: PRODUCT_ID, AMOUNT
    // optional arguments: BRAND, SOURCE

    // artisan generateAccessCodes PRODUCT_ID AMOUNT [SOURCE]
    // ex1: artisan generateAccessCodes 124 10
    // ex2: artisan generateAccessCodes 20 30 test-deal
    // ex3: artisan generateAccessCodes 7 100 sweetwater-2023-deal

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ProductRepository $productRepository)
    {

        $source = $this->argument('source') ?? null;

        $now = Carbon::now()
            ->toDateTimeString();

        $emails = [
            'caleb@drumeo.com',
            'mircea@musora.com',
        ];

        $accessCodes = [];

        $amountToCreate = $this->argument('amountToGenerate');
        $productId = $this->argument('productId');

        $product = $productRepository->findProduct($productId);

        if (!$product) {
            $this->info('No product found for product id ' . $productId . ". Exiting now.");
            die();
        }

        $brand = $product->getBrand();

        for ($i = 1; $i <= $amountToCreate; $i++) {
            $code = bin2hex(
                openssl_random_pseudo_bytes(24 / 2)
            );

            $accessCodes[] = [
                'code' => strtoupper($code),
                'product_ids' => serialize([(integer) $productId]),
                'is_claimed' => false,
                'claimer_id' => null,
                'claimed_on' => null,
                'brand' => $brand,
                'note' => null,
                'source' => $source,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        $this->databaseManager->connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->insert($accessCodes);

        Mail::send(
            'emails.generateAccessCodes',
            [
                'accessCodeData' => $accessCodes,
                'product' => $product,
                'source' => $source ?? 'no source'
            ],
            function (\Illuminate\Mail\Message $message) use ($emails, $now, $amountToCreate) {
                $subject = 'Musora - ' . $amountToCreate . ' Access Codes Generated on ' . $now;
                $message->from('support@musora.com', 'Musora');
                $message->to($emails)
                    ->subject($subject);
            }
        );

        $this->info(
            'Emails sent to: '.implode(', ', $emails)
        );

        $this->info(
            $this->argument('amountToGenerate').' access codes for \''.$this->argument('productId').'\' have been created.'
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [
                'productId',
                InputArgument::REQUIRED,
                'The product id.',
            ],
            [
                'amountToGenerate',
                InputArgument::REQUIRED,
                'Amount of codes to generate.',
            ],
            [
                'source',
                InputArgument::OPTIONAL,
                'The source describes where the codes are going',
            ],
        ];
    }

}
