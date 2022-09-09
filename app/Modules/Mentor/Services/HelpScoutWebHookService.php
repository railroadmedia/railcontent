<?php

namespace App\Modules\Mentor\Services;

use Exception;
use HelpScout\Api\Webhooks\Webhook;
use HelpScout\Api\ApiClient;
use Railroad\RailHelpScout\Factories\ClientFactory;

/**
 * TODO: This should be part of a HelpScout Module once its migrated to MWP
 **/
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
        $webHooks->each(function ($webHook) use ($url) {
            if ($webHook['url'] == $url) {
                throw new Exception("URL $url already registered");
            }
        });

        $webHook = new Webhook();
        $secret = config('railhelpscout.webhook_secret');
        $webHook->hydrate([
                "url" => $url,
                "events" => $events,
                "secret" => $secret,
            ]
        );
        return $this->client->webhooks()->create($webHook);
    }

    public function unregisterWebHook(int $id)
    {
        return $this->client->webhooks()->delete($id);
    }

    public function getWebHook(int $id)
    {
        return $this->client->webhooks()->get($id);
    }

    public function getWebHooks(): \Illuminate\Support\Collection
    {
        return collect($this->client->webhooks()->list()->extract());
    }
}
