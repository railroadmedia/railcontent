# Permissions API

# JSON Endpoints


<!-- START_82b005afd78be37707ededcd4afc2d84 -->
## railcontent/permission

### HTTP Request
    `GET railcontent/permission`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "permission",
            "id": "1",
            "attributes": {
                "name": "permission 1",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "permission 2",
                "brand": "brand"
            }
        }
    ]
}
```




<!-- END_82b005afd78be37707ededcd4afc2d84 -->

<!-- START_00fbbab029caab0b24691443083c1788 -->
## Create a new permission and return it in JSON API format


### HTTP Request
    `PUT railcontent/permission`


### Permissions
    - create.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|    |Must be 'permission'.|
|body|data.attributes.name|    |Permission name.|
|body|data.attributes.brand|    |brand|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:permission',",
    "            'data.attributes.name' => 'required|max:255',",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
{
    "data": {
        "type": "permission",
        "attributes": {
            "name": "Permission 1",
            "brand": "voluptatem"
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "name": null,
            "brand": null
        }
    }
}
```




<!-- END_00fbbab029caab0b24691443083c1788 -->

<!-- START_4342e3c5e05a771e85749f018f936e97 -->
## Dissociate (&quot;unattach&quot;) permissions from a specific content or all content of a certain type


### HTTP Request
    `PATCH railcontent/permission/dissociate`


### Permissions
    - disociate.permissions required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentPermission'.|
|body|data.attributes.content_type|    |Required without content.|
|body|data.relationships.permission.data.type|  yes  |Must be 'permission'.|
|body|data.relationships.permission.data.id|  yes  |Must exists in permission.|
|body|data.relationships.content.data.type|    |Required without content_type.  Must be 'content'.|
|body|data.relationships.content.data.id|    |Required without content_type. Must exists in content.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:contentPermission',",
    "            'data.relationships.permission.data.type' => 'required|in:permission',",
    "            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'permissions' . ',id',",
    "            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',",
    "            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',id',",
    "            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',type'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/dissociate',
{
    "data": {
        "type": "contentPermission",
        "attributes": {
            "content_type": "course"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 1
                }
            },
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        }
    }
}
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
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.permission.data.type",
            "detail": "The permission type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.permission.data.id",
            "detail": "The permission id field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content id are present."
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
    - update.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|    |Must be 'permission'.|
|body|data.attributes.name|    |Permission name.|
|body|data.attributes.brand|    |brand|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:permission',",
    "            'data.attributes.name' => 'required|max:255',",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
{
    "data": {
        "type": "permission",
        "attributes": {
            "name": "Permission 1",
            "brand": "eos"
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "name": null,
            "brand": null
        }
    }
}
```




<!-- END_d4001b71581880f49c6f7083414bd750 -->

<!-- START_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->
## Delete a permission if exist and it&#039;s not linked with content id or content type


### HTTP Request
    `DELETE railcontent/permission/{permissionId}`


### Permissions
    - delete.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
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
    - assign.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentPermission'.|
|body|data.attributes.content_type|    |Required without content.|
|body|data.relationships.permission.data.type|    |Must be 'permission'.|
|body|data.relationships.permission.data.id|    |Must exists in permission.|
|body|data.relationships.content.data.type|    |Required without content_type.  Must be 'content'.|
|body|data.relationships.content.data.id|    |Required without content_type. Must exists in content.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:contentPermission',",
    "            'data.relationships.permission.data.type' => 'required|in:permission',",
    "            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'permissions' . ',id',",
    "            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',",
    "            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',id',",
    "            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',type'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/assign',
{
    "data": {
        "type": "contentPermission",
        "attributes": {
            "content_type": "course"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 1
                }
            },
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        }
    }
}
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
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.permission.data.type",
            "detail": "The permission type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.permission.data.id",
            "detail": "The permission id field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.type",
            "detail": "The content type field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content id field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content id are present."
        }
    ]
}
```




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

