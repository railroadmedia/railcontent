- [Comments - API endpoints](#comments---api-endpoints)
  * [Comment a content - JSON controller](#comment-a-content---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Change comment - JSON controller](#change-comment---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Delete comment - JSON controller](#delete-comment---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)
  * [Reply to a comment - JSON controller](#reply-to-a-comment---json-controller)
    + [Request Example](#request-example-3)
    + [Request Parameters](#request-parameters-3)
    + [Response Example](#response-example-3)
  * [Pull comments - JSON controller](#pull-comments---json-controller)
    + [Request Example](#request-example-4)
    + [Request Parameters](#request-parameters-4)
    + [Response Example](#response-example-4)
  * [Get linked comments - JSON controller](#get-linked-comments---json-controller)
    + [Request Example](#request-example-5)
    + [Request Parameters](#request-parameters-5)
    + [Response Example](#response-example-5)
  * [Like a comment - JSON controller](#like-a-comment---json-controller)
    + [Request Example](#request-example-6)
    + [Response Example](#response-example-6)
  * [Unlike a comment - JSON controller](#unlike-a-comment---json-controller)
    + [Request Example](#request-example-7)
    + [Response Example](#response-example-7)

<!-- ecotrust-canada.github.io/markdown-toc -->


# Comments - API endpoints

Comment a content - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Add a comment to a content if the request data pass the validation. Only authenticated users can add comments and the content type should allow comments.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment',
    type: 'put'
   	data: {comment: 'my comment', content_id: 1} 
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
| path\|query\|body |  key           |  required |  default |  description\|notes                                                 | 
|-----------------|----------------|-----------|----------|---------------------------------------------------------------------| 
| body            |  comment       |  yes      |          |  The comment description.                                           | 
| body            |  content_id    |  yes      |          |  The content id you want to assign the comment to.                  | 
| body            |  display_name  |  yes      |          |  The display name that should be displayed; by default empty string | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , comment , yes , , The comment description.
body , content_id , yes , , The content id you want to assign the comment to.
body , display_name , yes ,  , The display name that should be displayed; by default empty string
-->


### Response Example

```200 OK```

```json

{
    "status": "ok",
    "code": 200,
    "results": {
        "id": 5,
        "content_id": 1,
        "parent_id": null,
        "user_id": 1,
        "comment": "my comment",
        "created_on": "2017-11-15 07:53:48",
        "deleted_at": null
    }
}

```
```403 Not allowed``` Content type not allow comments

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"The content type does not allow comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can add comment. Please sign in."
      }
}
```

Change comment - JSON controller
--------------------------------------

`{ PATCH /comment/{id} }`

Change comment. Administrator can edit any comment; other users can edit only their comments. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/3',
    type: 'patch'
   	data: {comment: 'my comment modified'} 
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
| path\|query\|body |  key           |  required |  default |  description\|notes                                 | 
|-----------------|----------------|-----------|----------|-----------------------------------------------------| 
| path            |  id            |  yes      |          |  Id of the comment you want to edit.                | 
| body            |  comment       |  no       |          |  The description of the comment.                    | 
| body            |  content_id    |  no       |          |  The content id this comment belongs to.            | 
| body            |  parent_id     |  no       |          |  The parent comment id if the comment it's a reply. | 
| body            |  user_id       |  no       |          |  User id.                                           | 
| body            |  display_name  |  no       |          |  The display name.                                  | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , The user permission id.
body , user_id , no , , The user id.
body , permission_id , no , , The permission id.
body , start_date , no ,  , The date when the user has access.
body , expiration_date , no ,  , If expiration date is null they have access forever; otherwise the user have access until the expiration date.
-->


### Response Example

```201 OK```

```json
{
    "status": "ok",
    "code": 201,
    "results": {
        "id": 3,
        "content_id": 1,
        "parent_id": null,
        "user_id": 1,
        "comment": "my comment modified",
        "created_on": "2017-11-15 07:31:54",
        "deleted_at": null
    }
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
        "detail":"Update failed, comment not found with id: 3"
      }
}
```
```403 Not allowed``` 

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Update failed, you can update only your comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can modify own comments. Please sign in."
      }
}
```

Delete comment - JSON controller
--------------------------------------

`{ DELETE /comment/{id} }`

Delete content comment or mark comment as deleted: if the user it's admin the comment with all his replies will be deleted, otherwise the comment with the replies are only soft deleted (marked as deleted).

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/2',
    type: 'delete'
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
| path            |  id  |  yes      |  Id of the comment. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the comment.   
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
        "detail":"Delete failed, comment not found with id: 1"
      }
}
```
```403 Not allowed``` 

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Delete failed, you can delete only your comments."
      }
}
```


Reply to a comment - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Add a reply to a comment if the request data pass the validation. Only authenticated users can add replies and the content type should allow comments.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/reply',
    type: 'put'
   	data: {comment: 'my reply', parent_id: 3} 
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
| path\|query\|body |  key        |  required |  default |  description\|notes                              | 
|-----------------|-------------|-----------|----------|--------------------------------------------------| 
| body            |  comment    |  no       |          |  The comment description.                        | 
| body            |  parent_id  |  no       |          |  The comment id you want to assign the reply to. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , comment , no , , The comment description.
body , parent_id , no , , The comment id you want to assign the reply to.
-->


### Response Example

```200 OK```


```json
{
    "status": "ok",
    "code": 200,
    "results": {
        "id": 6,
        "content_id": 1,
        "parent_id": 3,
        "user_id": 1,
        "comment": "my reply",
        "created_on": "2017-11-15 08:36:38",
        "deleted_at": null
    }
}
```

```403 Not allowed``` Content type not allow comments

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"The content type does not allow comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can reply to comment. Please sign in."
      }
}
```

Pull comments - JSON controller
--------------------------------------

`{ GET /comment }`

Pull the comments based on the criteria passed in request:

`content_id`   => pull the comments for given content id

 `user_id`      => pull user's comments
 
`content_type` => pull the comments for the contents with given type


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment?page=3&limit=25&content_id=3&user_id=9923',
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

### Request Parameters

| path\|query\|body |  key                  |  required |  default        |  description\|notes                                                               | 
|-------------------|-----------------------|-----------|-----------------|-----------------------------------------------------------------------------------| 
| query             |  page                 |  no       |  1              |  Pagination page.                                                                 | 
| query             |  limit                |  no       |  10             |  Amount of comments to pull per page.                                             | 
| query             |  sort                 |  no       |  '-created_on'  |  Sort column name and direction. If it starts with - it will be descending order. | 
| query             |  content_id           |  no       |                 |  Only comments for this content id will be returned.                              | 
| query             |  user_id              |  no       |                 |  Only comments by this user id will be pulled.                                    | 
| query             |  content_type         |  no       |                 |  Only comments on content with this type will be pulled.                          | 
| query             |  assigned_to_user_id  |  no       |                 |  Only comments assigned to this user will be pulled.                              | 



<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
query , page , no , 1 , Pagination page.
query , limit , no , 10 , Amount of comments to pull per page.
query , sort , no , '-created_on' , Sort column name and direction. If it starts with - it will be descending order.
query , content_id , no , , Only comments for this content id will be returned.
query , user_id , no ,  , Only comments by this user id will be pulled.
query , content_type , no ,  , Only comments on content with this type will be pulled.
query , assigned_to_user_id , no ,  , Only comments assigned to this user will be pulled.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "page": 1,
    "limit": 10,
    "total_results": 3,
    "results": {
        "2": {
            "id": 2,
            "content_id": 1,
            "comment": "comment text",
            "parent_id": null,
            "user_id": 1,
            "created_on": "2017-11-15 07:28:44",
            "deleted_at": null,
            "replies": []
        },
        "3": {
            "id": 3,
            "content_id": 1,
            "comment": "comment text 2",
            "parent_id": null,
            "user_id": 1,
            "created_on": "2017-11-15 07:31:54",
            "deleted_at": null,
            "replies": {
                0: {
                    "id": 4,
                    "content_id": 1,
                    "comment": "my reply to your comment",
                    "parent_id": 3,
                    "user_id": 1,
                    "created_on": "2017-11-15 07:34:48",
                    "deleted_at": null
                }
            }
        }
    },
    "filter_options": null
}

```

Get linked comments - JSON controller
--------------------------------------

`{ GET /comment/{id} }`

Get the linked comments.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/3,
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

### Request Parameters

| path\|query\|body |  key    |  required |  default |  description\|notes                   | 
|-------------------|---------|-----------|----------|---------------------------------------| 
| path              |  id     |  yes      |          |  The comment id                       | 
| query             |  limit  |  no       |  10      |  Amount of comments to pull per page. | 



<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
path , id, yes, , The comment id
query , limit , no , 10 , Amount of comments to pull per page.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "page": 1,
    "limit": 10,
    "total_results": 3,
    "results": {
        "0": {
           "id": 4,
           "content_id": 1,
           "comment": "Doloribus ad vitae possimus libero aperiam doloremque est molestiae. Nihil eum.",
           "parent_id": 3,
           "user_id": 1,
           "created_on": "2017-11-15 07:34:48",
           "deleted_at": null,
           "replies":[]
        }
    },
    "filter_options": null
}

```

Like a comment - JSON controller
--------------------------------------

`{ PUT /comment-like/{id} }`

Authenticated user like a comment.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment-like/1',
    type: 'put'
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
    "status": "ok",
    "code": 200,
    "results": true
}
```

Unlike a comment - JSON controller
--------------------------------------

`{ DELETE /comment-like/{id} }`

Authenticated user unlike a comment.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment-like/1',
    type: 'delete'
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
    "status": "ok",
    "code": 200,
    "results": true
}
```
