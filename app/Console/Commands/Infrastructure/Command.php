<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Console\Command as CommandBase;
use Illuminate\Database\Eloquent\Builder;

abstract class Command extends CommandBase
{

    public function withProgressBarChunked(Builder $query, callable $function, $chunks = 1000): void
    {
        $count = $query->count();
        $this->info("Processing query...");

        $bar = $this->output->createProgressBar($count);
        $bar->setFormat('debug');
        $bar->start();

        $query->chunk($chunks, function ($items) use ($function, $bar) {
            foreach ($items as $item) {
                call_user_func($function, $item);
                $bar->advance();
            }
        });

        $this->info("Processing Completed");

    }
}
