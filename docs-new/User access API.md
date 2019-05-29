# User access API

# JSON Endpoints


<!-- START_4572abc09b0a4dfedb76009dca5d6065 -->
## Create/update user permission record and return data in JSON API format.


### HTTP Request
    `PUT railcontent/user-permission`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|

### Validation Rules
```php
{
    "data.type": "in:userPermission",
    "data.relationships.user.data.type": "in:user",
    "data.relationships.user.data.id": "required|integer",
    "data.relationships.permission.data.type": "in:permission",
    "data.relationships.permission.data.id": "required|integer|exists:testbench.railcontent_permissions,id",
    "data.attributes.start_date": "required|date",
    "data.attributes.expiration_date": "nullable|date"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_4572abc09b0a4dfedb76009dca5d6065 -->

<!-- START_091f922183423b288cd6002e9275c608 -->
## Delete user permission if exists


### HTTP Request
    `DELETE railcontent/user-permission/{userPermissionId}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission/1',
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
        "detail": "Delete failed, user permission not found with id: 1"
    }
}
```




<!-- END_091f922183423b288cd6002e9275c608 -->

<!-- START_11e3427c786ec11eb4b04a07b221d9eb -->
## Pull active user permissions.

IF "only_active" it's set false on the request the expired permissions are returned also
 IF "user_id" it's set on the request only the permissions for the specified user are returned


### HTTP Request
    `GET railcontent/user-permission`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission',
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




<!-- END_11e3427c786ec11eb4b04a07b221d9eb -->

