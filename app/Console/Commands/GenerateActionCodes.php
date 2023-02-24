<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputArgument;

class GenerateActionCodes extends Command
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
    protected $name = 'generateActionCodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate actions codes.';

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

    // artisan generateActionCodes PRODUCT_ID AMOUNT [BRAND] [SOURCE]
    // ex1: artisan generateActionCodes 124 10
    // ex2: artisan generateActionCodes 20 30 guitareo
    // ex3: artisan generateActionCodes 7 100 pianote sweetwater-2023-deal

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $brand = 'drumeo';

        if ($this->argument('brand')) {
            $brand = $this->argument('brand');
            $this->info('success');
        }

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

        $sourceInfo = ($source) ?  ' source "' . $source . '"' : ' no source attribute';

        $answer = $this->ask(
            'Confirm to create ' . $amountToCreate . ' actions codes for product with id ' . $productId . ' for brand "' . $brand .
            '" and with' . $sourceInfo . '. Enter "yes" if this is correct'
        );

        if($answer !== 'yes'){
            $this->info('Exiting now without creating action codes.');
            die();
        }

        $this->databaseManager->connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->insert($accessCodes);

        Mail::send(
            'emails.generateActionCodes',
            [
                'actionCodeData' => $accessCodes,
                'codeType' => $this->argument('productId'),
            ],
            function (\Illuminate\Mail\Message $message) use ($emails, $now, $amountToCreate) {
                $subject = $amountToCreate . ' Codes Generated on ' . $now;
                $message->from('support@drumeo.com', 'Drumeo');
                $message->to($emails)
                    ->subject($subject);
            }
        );

        $this->info(
            'Emails sent to: '.implode(', ', $emails)
        );

        $this->info(
            $this->argument('amountToGenerate').' action codes for \''.$this->argument('productId').'\' have been created.'
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
                'brand',
                InputArgument::OPTIONAL,
                'brand if other than drumeo',
            ],
            [
                'source',
                InputArgument::OPTIONAL,
                'The source describes where the codes are going',
            ],
        ];
    }

}
