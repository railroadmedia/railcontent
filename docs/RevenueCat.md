# RevenueCat

RevenueCat sends notifications any time an event happens in the app.
The webhook URL field  and the authorization header value are set via the RevenueCat dashboard. 


## Webhook Events Types

### INITIAL_PURCHASE
A new subscription has been purchased.

Musora Actions:
- Get user based on email address or revenuecat original app user id
- Create a new Musora user if not exists
- Create a Musora Subscription for user
- If it is not a Trial purchase => create a new Musora payment
- Assign the product to the user

### RENEWAL
An existing subscription has been renewed or a lapsed user has resubscribed.

Musora Actions:
- Get user based on email address or revenuecat original app user id
- Create a new Musora user if not exists
- Update user’s Musora Subscription with the new expiration date and increase total_cycles_paid
- Create a new Musora payment
- Update user product with the new expiration date

### PRODUCT_CHANGE
A subscriber has changed the product of their subscription.

Musora Actions:
- Get user based on email address or revenuecat original app user id
- Create a new Musora user if not exists
- Create a new Musora Subscription for the new product
- Create a new Musora payment
- Assign the new product to the user

### CANCELLATION
A subscription or non-renewing purchase has been canceled or refunded.

Musora Actions:
- Get user based on email address or revenuecat original app user id
- Create a new Musora user if not exists
- Update user’s Musora Subscription with the new expiration date and increase total_cycles_paid
- Create a new Musora payment
- Update user product with the new expiration date


### BILLING_ISSUE
There has been a problem trying to charge the subscriber. This does not mean the subscription has expired.

Musora Actions:
- No action has been taken


### EXPIRATION
A subscription has expired and access should be removed.

Musora Actions:
- Get user based on email address or revenuecat original app user id
- Create a new Musora user if not exists
- Update user’s Musora Subscription with the expiration date and the expiration reason

### SUBSCRIPTION_PAUSED
The subscription is set to be paused at the end of the period.

Musora Actions:
- No action has been taken

### TRANSFER
A transfer of transactions and entitlements was initiated between one App User ID(s) to another.

Musora Actions:
- Get user based on revenuecat old original app user id(transferred_from)
- Update user’s revenuecat original app user id with the new revenuecat original app user id(transferred_to)


## New mobile app endpoints

Set user credentials after initial purchase and provide user token [endpoint](https://red-shadow-611407.postman.co/workspace/Team-Workspace~38bb093f-0978-4a83-8423-944a3c78fd51/request/9725390-e2c71e6f-f04c-41d5-863f-24b8d1ed292e?ctx=documentation)

Restore Musora user subscriptions [endpoint](https://red-shadow-611407.postman.co/workspace/Team-Workspace~38bb093f-0978-4a83-8423-944a3c78fd51/request/9725390-16f522c8-f83f-48ef-b406-531aee2598f0?ctx=documentation)
