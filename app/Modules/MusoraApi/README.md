# Musora API

## APIs

### Onboarding

- `POST /musora-api/v1/onboarding/started`
- `POST /musora-api/v1/onboarding/about-completed`
- `POST /musora-api/v1/onboarding/gears`
- `POST /musora-api/v1/onboarding/topics`
- `POST /musora-api/v1/onboarding/genres`
- `POST /musora-api/v1/onboarding/experience`
- `POST /musora-api/v1/onboarding/goals`
- `POST /musora-api/v1/onboarding/skip-account-setup`
- `GET /musora-api/v1/onboarding/saved-answers`
- `GET /musora-api/v1/onboarding/answer-history-instrument`
- `GET /musora-api/v1/onboarding/answer-history-coach`
  
### Journeys

- `POST /musora-api/v5/journeys/{event}`

#### How To Implement Events

To define a new event (e.g., `event`), you need to create a new entry on the
journey config file (config/journeys.php) and define the event's schema
related to the APIs version.

```php
'filter-applied' => [
    'brand' => ['required', 'string'],
    'section' => ['required', 'string'],
    'filters' => ['nullable', 'array'],
    'filters.*' => ['required', 'string', 'regex:/([A-Z]|[a-z])\w+,([a-z]|[A-Z])\w+/'],
    'progress' => ['nullable', 'string']
],
```

This schema will be used by the routes to define which events are allowed, but also
to validate the request payload.

After defining the schema, simply implement your services based on the domain 
(e.g., Filters, RecSys, etc.) and add an entry into the JourneyController.

```php
match ($event) {
    'filter-applied' => $this->filtersJourneyService->trackFilterApplied($validated),
    'filter-group-applied' => $this->filtersJourneyService->trackFilterGroupApplied($validated),
    'sorting-applied' => $this->filtersJourneyService->trackSortingApplied($validated),
    default => '',
};
```
