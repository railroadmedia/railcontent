<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Level;
use Monolog\Processor\IntrospectionProcessor;

/**
 * Tap class to add source file to our Monolog logs
 */
class AddSourceFileTap
{
    public function __invoke(Logger $logger): void
    {
        // add the introspection processor, skipping internal files so we can see the actual source of the message
        $logger->pushProcessor(new IntrospectionProcessor(
            level: Level::Debug,
            skipClassesPartials: [
                'Monolog\\',
                'Illuminate\\Log\\',
                'Illuminate\\',
            ]
        ));
    }
}
