<?php

namespace App\Console\Commands\Infrastructure;

class Timer
{
    private static $timers = [];

    public static function afterSeconds($seconds, callable $callback)
    {
        $calledFrom = debug_backtrace()[0];
        $hash = md5($calledFrom['file'] . $calledFrom['line']);
        $startTime = self::$timers [$hash] ?? null;
        if ($startTime) {
            $diff = microtime(true) - $startTime;
            $sec = intval($diff);
            if ($sec >= $seconds) {
                $callback();
                self::$timers[$hash] = microtime(true);
            }
        } else {
            self::$timers[$hash] = microtime(true);
        }
    }
}
