# User access API

# JSON Endpoints


<!-- START_4572abc09b0a4dfedb76009dca5d6065 -->
## Give or modify users access to specific content for a specific amount of time.


### HTTP Request
    `PUT railcontent/user-permission`


### Permissions
    - Must be logged in
    - Must have the create.user.permissions permission
    
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
        return [
            'data.type' => 'required|in:userPermission',
            'data.relationships.user.data.type' =>'required|in:user',
            'data.relationships.user.data.id' => 'required|integer',
            'data.relationships.permission.data.type' => 'required|in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.attributes.start_date' => 'required|date',
            'data.attributes.expiration_date' => 'nullable|date'
        ];
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
            "start_date": "2019-05-01",
            "expiration_date": "2019-06-01"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 10
                }
            },
            "user": {
                "data": {
                    "type": "user",
                    "id": "1"
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

### Response Example (200):

```json
{
    "data": {
        "type": "userPermission",
        "id": "1",
        "attributes": {
            "user": "1",
            "start_date": "2019-05-01 00:00:00",
            "expiration_date": "2019-06-01 00:00:00",
            "created_at": "2019-06-06 11:52:55",
            "updated_at": "2019-06-06 11:52:55"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": "10"
                }
            }
        }
    },
    "included": [
        {
            "type": "permission",
            "id": "10",
            "attributes": {
                "name": "Accusantium veniam ratione natus aperiam laboriosam. Est itaque natus voluptas esse. Provident dolores voluptas porro labore voluptas natus.",
                "brand": "brand"
            }
        }
    ]
}
```




<!-- END_4572abc09b0a4dfedb76009dca5d6065 -->

<!-- START_091f922183423b288cd6002e9275c608 -->
## Delete user access to content.


### HTTP Request
    `DELETE railcontent/user-permission/{userPermissionId}`


### Permissions
    - Must be logged in
    - Must have the delete.user.permissions permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_091f922183423b288cd6002e9275c608 -->

<!-- START_11e3427c786ec11eb4b04a07b221d9eb -->
## List active users permissions.


### HTTP Request
    `GET railcontent/user-permission`


### Permissions
    - Must be logged in
    - Must have the pull.user.permissions permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|only_active|    |Include the expired permissions if it's false. Default:true.|
|body|user_id|    |Only the permissions for the specified user are returned. Default:null.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/user-permission',
{
    "only_active": [],
    "user_id": 1
}
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

