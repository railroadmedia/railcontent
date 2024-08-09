<?php

use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Handler\NullHandler;
use Monolog\Handler\SocketHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['stderr', 'papertrail', 'sentry'],
            'name' => env('STACK_LOG_CHANNEL_NAME', 'stack-log-channel'),
            'ignore_exceptions' => false,
        ],

        'sentry' => [
            'driver' => 'sentry',
            // The minimum logging level at which this handler will be triggered
            // Available levels: debug, info, notice, warning, error, critical, alert, emergency
            'level' => env('LOG_LEVEL', 'error'),
            'bubble' => true, // Whether the messages that are handled can bubble up the stack or not
        ],
    ],

];
