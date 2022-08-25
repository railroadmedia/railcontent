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
        Log::info("Register Web Hook $url");
        Log::info("Existing Web Hooks:");
        $alreadyRegistered = false;
        $webHooks->each(function ($webHook) use ($url, &$alreadyRegistered) {
            Log::info($webHook);

            if ($webHook['url'] == $url) {
                $alreadyRegistered = true;
                Log::warning("URL $url already registered");
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

    private function unregisterAllWebHooks()
    {
        $webHooks = $this->getWebHooks();
        $webHooks->each(function ($webHook) {
            Log::info($webHook);
            $this->client->webhooks()->delete($webHook["id"]);
        });
    }

    public function getWebHooks(): \Illuminate\Support\Collection
    {
        return collect($this->client->webhooks()->list()->extract());
    }
}
