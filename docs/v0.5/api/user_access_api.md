# User Access API

[Table Schema](../schema/table-schema.md#table-railcontent_user_permissions)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ GET /*/user-permission }`

List active users permissions.

### Permissions

- Must be logged in
- Must have the 'pull.user.permissions' permission 

### Request Parameters



|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|only_active|no|true| bool| include the expired permissions if it's false|
|body|user_id|no| null| | only the permissions for the specified user are returned|

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/user-permission',
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
         "type":"userPermission",
         "id":"1",
         "attributes":{  
            "user":"1",
            "start_date":"2019-05-24 06:32:15",
            "expiration_date":"2019-06-03 06:32:15",
            "created_at":"2019-05-24 06:32:15",
            "updated_at":{  
               "date":"1970-07-11 10:56:36.000000",
               "timezone_type":3,
               "timezone":"UTC"
            }
         },
         "relationships":{  
            "permission":{  
               "data":{  
                  "type":"permission",
                  "id":"1"
               }
            }
         }
      },
      {  
         "type":"userPermission",
         "id":"2",
         "attributes":{  
            "user":"1",
            "start_date":"2019-05-24 06:32:15",
            "expiration_date":null,
            "created_at":"2019-05-24 06:32:15",
            "updated_at":{  
               "date":"2009-01-27 05:36:22.000000",
               "timezone_type":3,
               "timezone":"UTC"
            }
         },
         "relationships":{  
            "permission":{  
               "data":{  
                  "type":"permission",
                  "id":"2"
               }
            }
         }
      }
   ],
   "included":[  
      {  
         "type":"permission",
         "id":"1",
         "attributes":{  
            "name":"id",
            "brand":"brand"
         }
      },
      {  
         "type":"permission",
         "id":"2",
         "attributes":{  
            "name":"id",
            "brand":"brand"
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/user-permission }`

Give or modify users access to specific content for a specific amount of time.

### Permissions

- Must be logged in
- Must have the 'create.user.permissions' permission to create

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'userPermission'||
|body|data.attributes.start_date|yes| | |The date when the user has access.|
|body|data.attributes.expiration_date|no| | | If expiration date is null they have access forever; otherwise the user have access until the expiration date.|
|body|data.relationships.permission.data.type|yes| |must be 'permission'|
|body|data.relationships.permission.data.id|yes||||
|body|data.relationships.user.data.type|yes| |must be 'user'||
|body|data.relationships.user.data.id|yes||||


### Validation Rules

```php
[
    'data.relationships.user.data.id' => 'required|integer',
    'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'permissions' . ',id',
    'data.attributes.start_date' => 'required|date',
    'data.attributes.expiration_date' => 'nullable|date'
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/user-permission',
    data: {
        type: "userPermission",
        attributes: {
              start_date: "2019-05-26 06:48:27"
        },
        relationships:{
            permission:{
                data:{
                    type: "permission",
                    id: 1
                }
            },
            user:{
                data:{
                    type: "user",
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
      "type":"userPermission",
      "id":"1",
      "attributes":{  
         "user":"1",
         "start_date":"2019-05-26 06:48:27",
         "expiration_date":null,
         "created_at":"2019-05-24 06:48:27",
         "updated_at":"2019-05-24 06:48:27"
      },
      "relationships":{  
         "permission":{  
            "data":{  
               "type":"permission",
               "id":"1"
            }
         }
      }
   },
   "included":[  
      {  
         "type":"permission",
         "id":"1",
         "attributes":{  
            "name":"nobis",
            "brand":"brand"
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/user-permission/{ID} }`

Delete user access to content.


### Permissions

- Must be logged in
- Must have the 'delete.user.permissions' permission

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes| | |Id of the user permission.|

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/user-permission/1',
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
