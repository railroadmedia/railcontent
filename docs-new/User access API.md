# User access API

# JSON Endpoints


<!-- START_4572abc09b0a4dfedb76009dca5d6065 -->
## Create/update user permission record and return data in JSON API format.


### HTTP Request
    `PUT railcontent/user-permission`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'userPermission'.|
|body|data.attributes.start_date|    |Permission name.|
|body|data.attributes.expiration_date|    |expiration date is null they have access forever; otherwise the user have access until the expiration date.|
|body|data.relationships.permission.data.type|  yes  |Must be 'permission'.|
|body|data.relationships.permission.data.id|  yes  |Must exists in permission.|
|body|data.relationships.user.data.type|  yes  |Must be 'user'.|
|body|data.relationships.user.data.id|  yes  |Must exists in user.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:userPermission',",
    "            'data.relationships.user.data.type' =>'required|in:user',",
    "            'data.relationships.user.data.id' => 'required|integer',",
    "            'data.relationships.permission.data.type' => 'required|in:permission',",
    "            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'permissions' . ',id',",
    "            'data.attributes.start_date' => 'required|date',",
    "            'data.attributes.expiration_date' => 'nullable|date'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission',
{
    "data": {
        "type": "userPermission",
        "attributes": {
            "start_date": "Permission 1",
            "expiration_date": "2019-06-01"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 1
                }
            },
            "user": {
                "data": {
                    "type": "user",
                    "id": {}
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
            "source": "data.relationships.user.data.id",
            "detail": "The user id must be an integer."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.start_date",
            "detail": "The start date is not a valid date."
        }
    ]
}
```




<!-- END_4572abc09b0a4dfedb76009dca5d6065 -->

<!-- START_091f922183423b288cd6002e9275c608 -->
## Delete user permission if exists


### HTTP Request
    `DELETE railcontent/user-permission/{userPermissionId}`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission/1',
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


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission',
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

