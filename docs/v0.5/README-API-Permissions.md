- [Permissions - API endpoints](#permissions---api-endpoints)
  * [Store permission - JSON controller](#store-permission---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Change permission - JSON controller](#change-permission---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Delete permission - JSON controller](#delete-permission---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)
  * [Assign permission - JSON controller](#assign-permission---json-controller)
    + [Request Example](#request-example-3)
    + [Request Parameters](#request-parameters-3)
    + [Response Example](#response-example-3)
  * [Dissociate permission - JSON controller](#dissociate-permission---json-controller)
    + [Request Example](#request-example-4)
    + [Request Parameters](#request-parameters-4)
    + [Response Example](#response-example-4)
  * [Get permissions - JSON controller](#get-permissions---json-controller)
    + [Request Example](#request-example-5)
    + [Response Example](#response-example-5)

<!-- ecotrust-canada.github.io/markdown-toc -->


# Permissions - API endpoints


Store permission - JSON controller
--------------------------------------

`{ PUT /permission }`

Store a new permission in the CMS.

Only users with 'create.permission' ability can store permission.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission',
    type: 'put'
  	data: {name: 'drumeo edge'} 
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

| path\|query\|body |  key    |  required |  default                                    |  description\|notes                                       | 
|-----------------|---------|-----------|---------------------------------------------|-----------------------------------------------------------| 
| body            |  name   |  yes      |                                             |  The name of this permission - for example: 'drumeo edge' | 
| body            |  brand  |  no       |  The default brand from configuration file  |  The brand where the permission it's available            | 








<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , name , yes , , The name of this permission - for example: 'drumeo edge'
body , brand , no , The default brand from configuration file , The brand where the permission it's available
-->


### Response Example

```200 OK```

```json

{
	"id":24,
	"name":"drumeo edge",
    "brand":"brand"
}

```

Change permission - JSON controller
--------------------------------------

`{ PATCH /permission/{id} }`

Change permission name or the brand where the permission it's available.

Only users with 'update.permission' ability can update permission.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/73',
    type: 'patch'
  	data: {name: 'bass drum system',} 
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

| path\|query\|body |  key   |  required |  default |  description\|notes                            | 
|-----------------|--------|-----------|----------|------------------------------------------------| 
| path            |  id    |  yes      |          |  Id of the permission you want to change.      | 
| body            |  name  |  yes      |          |  The new name of this permission               | 
| body            |  brand |  no       |          |  The brand where the permission it's available | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes, , Id of the permission you want to change.
body , name , yes , , The new name of this permission 
body , brand, no , , The brand where the permission it's available
-->


### Response Example

```201 OK```

```json
{
	"id":73,
	"name":"bass drum system",
    "brand":"brand"
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, permission not found with id: 73"
      }
}
```

Delete permission - JSON controller
--------------------------------------

`{ DELETE /permission/{id} }`

Delete the permission and all the links with contents.

Only users with 'delete.permission' ability can delete permission.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/23',
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
| path            |  id  |  yes      |  Id of the permission. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the permission.   
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
        "detail":"Delete failed, permission not found with id: 23"
      }
}
```

Assign permission - JSON controller
--------------------------------------

`{ PUT /permission/assign }`

Assign permission to a specific content or to all content of certain type.

Only users with 'assign.permission' ability can assign permission to content/content type.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/assign',
    type: 'put'
  	data: {content_type: 'course', permission_id: 24} 
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

| path\|query\|body |  key            |  required |  default |  description\|notes                                         | 
|-----------------|-----------------|-----------|----------|-------------------------------------------------------------| 
| body            |  permission_id  |  yes      |          |  The permission id you want to assign to the content.       | 
| body            |  content_id     |  no       |  null    |  The content id you want to assign the permission to.       | 
| body            |  content_type   |  no       |  null    |  The type of contents you want to assign the permission to. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , permission_id , yes , , The permission id you want to assign to the content.
body , content_id , no , null , The content id you want to assign the permission to.
body , content_type , no , null , The type of contents you want to assign the permission to.
-->


### Response Example

```200 OK```

```json

{ 
  "id": 2,
  "content_id": null,
  "content_type": "course",
  "permission_id": 24,
  "name": "drumeo edge",
  "brand":"brand"
}

```

Dissociate permission - JSON controller
--------------------------------------

`{ PATCH /permission/dissociate }`

Dissociate permissions from a specific content or all content of a certain type.

Only users with 'disociate.permissions' ability can dissociate permission.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/dissociate',
    type: 'patch',
  	// Let's say there are 42 courses that have had permission id 23 assigned to them
    // ... there should then be 42 successful contentPermission table rows deleted.
    data: {content_type: 'course', permission_id: 23} ,
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

| path\|query\|body |  key            |  required |  default |  description\|notes                                        | 
|-----------------|-----------------|-----------|----------|------------------------------------------------------------| 
| body            |  permission_id  |  yes      |          |  The permission id you want to dissociate to the content.  | 
| body            |  content_id     |  no       |  null    |  The content id with which permission is associated.       | 
| body            |  content_type   |  no       |  null    |  The type of contents with which permission is associated. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , permission_id , yes , , The permission id you want to dissociate to the content.
body , content_id , no , null , The content id with which permission is associated.
body , content_type , no , null , The type of contents with which permission is associated.
-->


### Response Example

```200 OK```

```json

42

```

Get permissions - JSON controller
--------------------------------------

`{ GET /permission }`

Get all the permissions from the database.

Only users with 'pull.permissions' ability can pull permissions.


### Request Example

```js   
$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission',
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```


### Response Example

```200 OK```

```json
{
    "status":"ok",
    "code":200,
    "results":[
        {
            "id":1,
            "name":"drumeo_membership"
        },
        {
            "id":2,
            "name":"drumming_system"
        }
    ]
}

```
