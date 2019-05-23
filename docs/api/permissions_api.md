# Permissions API

[Table Schema](../schema/table-schema.md#table-railcontent_permissions)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ GET /*/permission }`

List permissions.

### Permissions

- Must be logged in
- Must have the 'pull.permissions' permission to pull permissions

### Request Parameters



|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{
    "data":[
      {
            "type":"permission",
            "id":"1",
            "attributes":{
                "name":"drumeo_membership",
                "brand":"brand"
            }
      },
      {
            "type":"permission",
            "id":"2",
            "attributes":{
                "name":"drumming_system",
                "brand":"brand"
            }
      }
    ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/permission }`

Create a new permission.

### Permissions

- Must be logged in
- Must have the 'create.permission' permission to create

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'permission'||
|body|data.attributes.name|yes||||
|body|data.attributes.brand|no|Default brand from config file|||


### Validation Rules

```php
[
    'data.attributes.name' => 'required|max:255'
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission',
    data: {
        type: "permission",
        attributes: {
              name: "voluptatem"
        }
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{
    "data":{
        "type":"permission",
        "id":"1",
        "attributes":{
            "brand":"brand",
            "name":"voluptatem"
        }
    }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PATCH /*/permission/{ID} }`

Change permission name or the brand where the permission it's available.

### Permissions

- Must be logged in
- Must have the 'update.permission'' permission to update

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'permission'||
|body|data.attributes.name|||||
|body|data.attributes.brand|||||

### Validation Rules

```php
[
    'data.attributes.name' => 'max:255'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission/1',
    type: 'patch', 
    data: {
        type: "permission",
        attributes: {
              name: "new-name"
        },
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{
    "data":{
        "type":"permission",
        "id":"1",
        "attributes":{
            "brand":"brand",
            "name":"new-name"
        }
    }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/permission/{ID} }`

Delete an existing permission and all the links with contents.


### Permissions

- Must be logged in
- Must have the 'delete.permission' permission

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|permission id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission/1',
    type: 'delete', 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```204 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->


### `{ PUT /*/permission/assign }`

Assign permission to a specific content or to all content of certain type.

### Permissions

- Must be logged in
- Must have the 'assign.permission' permission to assign

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'contentPermission'||
|body|data.attributes.content_type|Required without content|||| 
|body|data.relationships.permission.data.type|yes|must be 'permission'|||
|body|data.relationships.permission.data.id|yes||||
|body|data.relationships.content.data.type|Required without content type|must be 'content'|||
|body|data.relationships.content.data.id|Required without content type ||||


### Validation Rules

```php
[
    'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
           config('railcontent.table_prefix'). 'permissions' . ',id',
    'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
           config('railcontent.database_connection_name') . '.' .
           config('railcontent.table_prefix'). 'content' .
           ',id',
    'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
           config('railcontent.database_connection_name') . '.' .
           config('railcontent.table_prefix'). 'content' .
           ',type'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission/assign',
    data: {
       type: "contentPermission",
       attributes: {
            content_type: "course"
       },
       relationships: {
                   permission: {
                       data: {
                           type: "permission",
                           id: 1
                       }
                   }
               }
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{
    "data":{
        "type":"contentPermission",
        "id":"1",
        "attributes":{
            "content_type":"course",
            "brand":"brand"
        },
        "relationships": {
            "permission": {
                "data": {
                  "type": "permission",
                  "id": 1
                }
            }
        }
    },
    "included": {
      "type": "permission",
      "id": 1,
      "attributes": {
        "name": "iusto",
        "brand": "brand"
      }
    }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->


### `{ PATCH /*/permission/dissociate }`

Dissociate permissions from a specific content or all content of a certain type.

### Permissions

- Must be logged in
- Must have the 'disociate.permissions' permission

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'contentPermission'||
|body|data.attributes.content_type|Required without content|||| 
|body|data.relationships.permission.data.type|yes|must be 'permission'|||
|body|data.relationships.permission.data.id|yes||||
|body|data.relationships.content.data.type|Required without content type|must be 'content'|||
|body|data.relationships.content.data.id|Required without content type ||||


### Validation Rules

```php
[
    'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'permissions' . ',id',
    'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
        config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'content' .
        ',id',
    'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
        config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'content' .
        ',type'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/permission/dissociate',
    type: 'patch',
    data: {
       type: "contentPermission",
       attributes: {
            content_type: "course"
       },
       relationships: {
                   permission: {
                       data: {
                           type: "permission",
                           id: 1
                       }
                   }
               }
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json

```