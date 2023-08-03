<?php

namespace App\Modules\EventTracking;

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{

    public function emergency($message, array $context = array())
    {
        Log::emergency($message, $context);
    }

    public function alert($message, array $context = array())
    {
        Log::alert($message, $context);
    }

    public function critical($message, array $context = array())
    {
        Log::critical($message, $context);
    }

    public function error($message, array $context = array())
    {
        Log::error($message, $context);
    }

    public function warning($message, array $context = array())
    {
        Log::warning($message, $context);
    }

    public function notice($message, array $context = array())
    {
        Log::notice($message, $context);
    }

    public function info($message, array $context = array())
    {
        Log::info($message, $context);
    }

    public function debug($message, array $context = array())
    {
        Log::debug($message, $context);
    }

    public function log($level, $message, array $context = array())
    {
        Log::log($message, $context);
    }
}
