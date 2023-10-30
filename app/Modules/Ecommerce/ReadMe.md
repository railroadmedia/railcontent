# Ecommerce

## Shopify

### Webhook Registration
https://shopify.dev/docs/apps/webhooks

Shopify webhooks are used to sync user content permissions from changes in shopify.

View registered webhooks using
```r mwp artisan shopify:getShopifyWebhooks```

Run command to register webhooks
```r mwp artisan shopify:registerShopifyWebhook```

You can remove registered webhooks by base url using
```r mwp artisan shopify:deleteShopifyWebhooks https://beta-testing.musora.com```

