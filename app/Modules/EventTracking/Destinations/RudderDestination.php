<?php

namespace App\Modules\EventTracking\Destinations;

use Illuminate\Support\Facades\Log;
use Rudder\Rudder;
use Rudder\RudderException;

class RudderDestination
{
    private bool $enabled = false;

    public function make(): void
    {
        $key = env('RUDDERSTACK_WRITE_KEY');
        if ($key) {
            try {
                Rudder::init($key, [
                    "data_plane_url" => "https://musoraalearg.dataplane.rudderstack.com",
                    "consumer" => "lib_curl",
                    "debug" => !app()->isProduction(),
                    "max_queue_size" => 10000,
                    "flush_at" => 100
                ]);
            } catch (\Exception $e) {
                Log::error("Rudderstack init failed: " . $e->getMessage());
                $this->enabled = false;
                return;
            }
            $this->enabled = true;
        } else {
            Log::error("Rudderstack init failed: RUDDERSTACK_WRITE_KEY not set");
            $this->enabled = false;
        }
    }

    /**
     * @throws RudderException
     */
    public function log_event($user_id, $name, $properties): void
    {
        if (!$this->enabled) {
            Log::error("Rudderstack disabled, event $name not logged.");
            return;
        }

        Rudder::track([
            "userId" => $user_id,
            "event" => $name,
            "properties" => $properties
        ]);
    }

    /**
     * @throws RudderException
     */
    public function set_user_properties($user_id, $array): void
    {
        if (!$this->enabled) {
            Log::error("Rudderstack disabled, user properties not set.");
            return;
        }

        Rudder::identify([
            'userId' => $user_id,
            'traits' => $array
        ]);
    }
}
