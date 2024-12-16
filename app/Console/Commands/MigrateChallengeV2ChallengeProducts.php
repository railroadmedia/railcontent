<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;


class MigrateChallengeV2ChallengeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateChallengeV2ChallengeProducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateChallengeV2ChallengeProducts';


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->withExecutionTime(function () {
            $this->migrate();
        });
    }

    public function migrate(): void
    {
        $challengeProductIds = [461, 516, 517, 733, 734, 740, 741, 833, 844, 843, 842, 846, 851, 913, 928, 930, 1076, 1165, 1191, 1248];
        Product::query()->whereIn('id', $challengeProductIds)->update(
            ['digital_access_type' => Product::DIGITAL_ACCESS_TYPE_CHALLENGE_CONTENT_ACCESS]
        );
    }
}
