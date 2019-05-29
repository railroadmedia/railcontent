# Permissions API

# JSON Endpoints


<!-- START_82b005afd78be37707ededcd4afc2d84 -->
## railcontent/permission

### HTTP Request
    `GET railcontent/permission`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": []
}
```




<!-- END_82b005afd78be37707ededcd4afc2d84 -->

<!-- START_00fbbab029caab0b24691443083c1788 -->
## Create a new permission and return it in JSON API format


### HTTP Request
    `PUT railcontent/permission`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Validation Rules
```php
{
    "data.attributes.name": "required|max:255"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
[]
   ,
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
            "source": "data.attributes.name",
            "detail": "The name field is required."
        }
    ]
}
```




<!-- END_00fbbab029caab0b24691443083c1788 -->

<!-- START_4342e3c5e05a771e85749f018f936e97 -->
## Dissociate (&quot;unattach&quot;) permissions from a specific content or all content of a certain type


### HTTP Request
    `PATCH railcontent/permission/dissociate`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Validation Rules
```php
{
    "data.relationships.permission.data.id": "required|integer|exists:testbench.railcontent_permissions,id",
    "data.relationships.content.data.id": "nullable|numeric|required_without_all:data.attributes.content_type|exists:testbench.railcontent_content,id",
    "data.attributes.content_type": "nullable|string|required_without_all:data.relationships.content.data.id|exists:testbench.railcontent_content,type"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/dissociate',
[]
   ,
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
            "source": "data.relationships.permission.data.id",
            "detail": "The permission field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content are present."
        }
    ]
}
```




<!-- END_4342e3c5e05a771e85749f018f936e97 -->

<!-- START_d4001b71581880f49c6f7083414bd750 -->
## Update a permission if exist and return it in JSON API format


### HTTP Request
    `PATCH railcontent/permission/{permissionId}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Validation Rules
```php
{
    "data.attributes.name": "required|max:255"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
[]
   ,
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
            "source": "data.attributes.name",
            "detail": "The name field is required."
        }
    ]
}
```




<!-- END_d4001b71581880f49c6f7083414bd750 -->

<!-- START_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->
## Delete a permission if exist and it&#039;s not linked with content id or content type


### HTTP Request
    `DELETE railcontent/permission/{permissionId}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, permission not found with id: 1"
    }
}
```




<!-- END_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->

<!-- START_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->
## Attach permission to a specific content or to all content of a certain type


### HTTP Request
    `PUT railcontent/permission/assign`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Validation Rules
```php
{
    "data.relationships.permission.data.id": "required|integer|exists:testbench.railcontent_permissions,id",
    "data.relationships.content.data.id": "nullable|numeric|required_without_all:data.attributes.content_type|exists:testbench.railcontent_content,id",
    "data.attributes.content_type": "nullable|string|required_without_all:data.relationships.content.data.id|exists:testbench.railcontent_content,type"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/assign',
[]
   ,
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
            "source": "data.relationships.permission.data.id",
            "detail": "The permission field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content are present."
        }
    ]
}
```




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

