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

```json
{   
    "data": {
        "type": "permission",
        "attributes": {
            "name": "voluptatem",
            "brand": "brand"
        }
    }
}
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
        data: {
            type: "permission",
            attributes: {
                name: "new-name"
            },
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
|body|data.attributes.content_type|yes||||
|body|data.relationships.permission.data.type|yes|must be 'permission'|||
|body|data.relationships.permission.data.id|yes||||
|body|data.relationships.content.data.type|no|must be 'content'|||
|body|data.relationships.content.data.id|no||||


### Validation Rules
