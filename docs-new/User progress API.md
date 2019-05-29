# User progress API

# JSON Endpoints


<!-- START_c0f3be7f8a8582faf9eded5ca139e05e -->
## Start a content for the authenticated user


### HTTP Request
    `PUT railcontent/start`


### Permissions


### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|

### Validation Rules
```php
{
    "data.type": "required|in:userContentProgress",
    "data.relationships.content.data.type": "required|in:content",
    "data.relationships.content.data.id": "required|numeric|exists:testbench.railcontent_content,id"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/start',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required."
        }
    ]
}
```




<!-- END_c0f3be7f8a8582faf9eded5ca139e05e -->

<!-- START_c771ec122eac231459ef2eeb003a51b6 -->
## Set content as complete for the authenticated user


### HTTP Request
    `PUT railcontent/complete`


### Permissions


### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|

### Validation Rules
```php
{
    "data.type": "required|in:userContentProgress",
    "data.relationships.content.data.type": "required|in:content",
    "data.relationships.content.data.id": "required|numeric|exists:testbench.railcontent_content,id"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/complete',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required."
        }
    ]
}
```




<!-- END_c771ec122eac231459ef2eeb003a51b6 -->

<!-- START_b2202db6547dcbe6b75e0cbc642af8de -->
## Reset content progress for authenticated user


### HTTP Request
    `PUT railcontent/reset`


### Permissions


### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|

### Validation Rules
```php
{
    "data.type": "required|in:userContentProgress",
    "data.relationships.content.data.type": "required|in:content",
    "data.relationships.content.data.id": "required|numeric|exists:testbench.railcontent_content,id"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/reset',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required."
        }
    ]
}
```




<!-- END_b2202db6547dcbe6b75e0cbc642af8de -->

<!-- START_0300c7a6d3d72c86c7cd80b0736a1e10 -->
## Save the progress on a content for the authenticated user


### HTTP Request
    `PUT railcontent/progress`


### Permissions


### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|

### Validation Rules
```php
{
    "data.type": "required|in:userContentProgress",
    "data.relationships.content.data.type": "required|in:content",
    "data.relationships.content.data.id": "required|numeric|exists:testbench.railcontent_content,id"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/progress',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required."
        }
    ]
}
```




<!-- END_0300c7a6d3d72c86c7cd80b0736a1e10 -->

