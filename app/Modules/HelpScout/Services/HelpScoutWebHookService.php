<?php

namespace App\Modules\HelpScout\Services;

use App\Modules\HelpScout\Factories\ClientFactory;
use Exception;
use HelpScout\Api\Webhooks\Webhook;
use HelpScout\Api\ApiClient;
use Log;

class HelpScoutWebHookService
{
    private ApiClient $client;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->client = $clientFactory::build();
    }

    public function registerWebHook(string $url, array $events)
    {
        $webHooks = $this->getWebHooks();
        Log::debug("Register Web Hook $url");
        Log::debug("Existing Web Hooks:");
        $alreadyRegistered = false;
        $webHooks->each(function ($webHook) use ($url, &$alreadyRegistered) {
            Log::debug($webHook);

            if ($webHook['url'] == $url) {
                $alreadyRegistered = true;
                Log::info("URL $url already registered");
            }
        });

        if ($alreadyRegistered) {
            return;
        }

        $webHook = new Webhook();
        $secret = config('helpscout.webhook_secret');
        $webHook->hydrate([
                "url" => $url,
                "events" => $events,
                "secret" => $secret,
            ]
        );
        return $this->client->webhooks()->create($webHook);
    }

    public function unregister($url)
    {
        $webHooks = $this->getWebHooks();
        $webHooks->each(function ($webHook) use ($url) {
            Log::debug($webHook);
            if ($webHook["url"] == $url) {
                $this->client->webhooks()->delete($webHook["id"]);
            }
        });
    }

    public function getWebHooks(): \Illuminate\Support\Collection
    {
        return collect($this->client->webhooks()->list()->extract());
    }
}
