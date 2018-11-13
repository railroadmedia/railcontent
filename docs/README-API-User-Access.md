- [User Access - API endpoints](#user-access---api-endpoints)
  * [Give/modify user access - JSON controller](#give-modify-user-access---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Delete user access - JSON controller](#delete-user-access---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Pull users permissions - JSON controller](#pull-users-permissions---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)

<!-- ecotrust-canada.github.io/markdown-toc -->


# User Access - API endpoints


Give/modify user access - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Give or modify users access to specific content for a specific amount of time.

Only users with 'create.user.permissions' ability can give user access.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission',
    type: 'put'
  	data: {user_id: '1', permission_id: 24, start_date: '2018-07-11 05:21:23', expiration_date: '2018-12-11 05:21:23'} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters
| path\|query\|body |  key              |  required |  default |  description\|notes                                                                                             | 
|-----------------|-------------------|-----------|----------|-----------------------------------------------------------------------------------------------------------------| 
| body            |  user_id          |  yes      |          |  The user id.                                                                                                   | 
| body            |  permission_id    |  yes      |          |  The permission id.                                                                                             | 
| body            |  start_date       |  yes      |          |  The date when the user has access.                                                                             | 
| body            |  expiration_date  |  no       |  null    |  If expiration date is null they have access forever; otherwise the user have access until the expiration date. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , user_id , yes , , The user id.
body , permission_id , yes , , The permission id.
body , start_date , yes ,  , The date when the user has access.
body , expiration_date , no , null , If expiration date is null they have access forever; otherwise the user have access until the expiration date.
-->


### Response Example

```200 OK```

```json

{ 
		"id":"1",
        "user_id":"1",
        "permissions_id":"1",
        "start_date":"2018-07-11 05:21:23",
        "expiration_date":null,
        "created_on":"2018-07-11 05:21:23",
        "updated_on":null
}

```

Delete user access - JSON controller
--------------------------------------

`{ DELETE /user-permission/{id} }`

Delete user access to content.

Only users with 'delete.user.permissions' ability can delete user's access.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission/1',
    type: 'delete',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  description\|notes    | 
|-----------------|------|-----------|------------------------| 
| path            |  id  |  yes      |  Id of the user permission. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the user permission.   
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, user permission not found with id: 1"
      }
}
```

Pull users permissions - JSON controller
--------------------------------------

`{ GET /user-permission }`

Get active users permissions. 

IF `only_active` it's set false on the request the expired permissions are returned also.

IF `user_id` it's set on the request only the permissions for the specified user are returned

Only users  with 'pull.user.permissions' ability can pull user's permissions.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key          |  required |  default |  description\|notes                                                   |                                                       | 
|-----------------|---------------|-----------|----------|-----------------------------------------------------------------------|-------------------------------------------------------| 
| body            |  user_id      |  no       |  null    |  If it's set only the permissions for the specified user are returned |  otherwise all the user permissions are returned.     | 
| body            |  only_active  |  no       |  true    |  If it's false the expired permissions are returned also              |  otherwise only active user permissions are returned. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , user_id , no , null , If it's set only the permissions for the specified user are returned, otherwise all the user permissions are returned.
body , only_active , no , true , If it's false the expired permissions are returned also, otherwise only active user permissions are returned.
-->


### Response Example

```200 OK```

```json
{
    "status":"ok",
    "code":200,
    "results":[
           {
            "id":"1",
            "user_id":"1",
            "permissions_id":"1",
            "start_date":"2018-07-11 06:34:45",
            "expiration_date":null,
            "created_on":"2018-07-11 06:34:45",
            "updated_on":null,
            "name":"nobis",
            "brand":"brand"
          },
          {
            "id":"1",
            "user_id":"2",
            "permissions_id":"1",
            "start_date":"2018-07-11 06:34:45",
            "expiration_date":null,
            "created_on":"2018-07-11 06:34:45",
            "updated_on":null,
            "name":"nobis",
            "brand":"brand"
          }
        ]
}

```