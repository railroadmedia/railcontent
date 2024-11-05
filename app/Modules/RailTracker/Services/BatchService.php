<?php

namespace App\Modules\RailTracker\Services;

use Illuminate\Support\Facades\Redis;
use App\Modules\RailTracker\ValueObjects\ExceptionVO;
use App\Modules\RailTracker\ValueObjects\RequestVO;

class BatchService
{
    public $batchKeyPrefix;

    /**
     * BatchService constructor.
     */
    public function __construct()
    {
        $this->batchKeyPrefix = config('railtracker.batch_prefix', 'railtracker_');
    }

    /**
     * @return \Illuminate\Redis\Connections\Connection
     */
    public function connection()
    {
        return Redis::connection(config('railtracker.redis_connection_name'));
    }

    /**
     * @param RequestVO $requestVO
     */
    public function storeRequest(RequestVO $requestVO)
    {
        if ($this->connection()) {
            $setKey = $this->batchKeyPrefix . 'set' . '_' . $requestVO->uuid;

            $this->connection()->sadd($setKey, serialize($requestVO));
        }
    }

    /**
     * @param RequestVO $requestVO
     */
    public function removeRequest(RequestVO $requestVO)
    {
        if ($this->connection()) {
            $setKey = $this->batchKeyPrefix . 'set' . '_' . $requestVO->uuid;

            $this->connection()->del([$setKey]);
        }
    }

    /**
     * @param ExceptionVO $exceptionVO
     * @param string $uuid
     */
    public function storeException(ExceptionVO $exceptionVO)
    {
        if ($this->connection()) {
            $uuid = $exceptionVO->uuid;

            $setKey = $this->batchKeyPrefix . 'set' . '_' . $uuid;

            $this->connection()->sadd($setKey, [serialize($exceptionVO)]);
        }
    }

    /**
     * @param string|array $forget
     */
    public function forget($forget)
    {
        if ($this->connection()) {
            if (!is_array($forget)) {
                $forget = [$forget];
            }

            foreach ($forget as $key) {
                $this->connection()->del($key);
            }
        }
    }
}
