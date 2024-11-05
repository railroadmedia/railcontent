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

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
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
