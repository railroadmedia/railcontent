- [Assign Comments to managers - API endpoints](#assign-comments-to-managers---api-endpoints)
  * [Pull assigned to me comments - JSON controller](#pull-assigned-to-me-comments---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Delete comment assignation - JSON controller](#delete-comment-assignation---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)

<!-- ecotrust-canada.github.io/markdown-toc -->


# Assign Comments to managers - API endpoints


Pull assigned to me comments - JSON controller
--------------------------------------

`{ GET /assigned-comments }`

The managers have the ability to get comment assignments for.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/assigned-comments?user_id=232',
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

| path\|query\|body |  key      |  required |  default |  description\|notes                                                                                                         | 
|-------------------|-----------|-----------|----------|-----------------------------------------------------------------------------------------------------------------------------| 
| query             |  user_id  |  no       |          |  The user ID to get comment assignments for. Leave out this parameter to get the comments for the currently logged in user. | 




<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
query , user_id , no ,  , The user ID to get comment assignments for. Leave out this parameter to get the comments for the currently logged in user.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "results": {
        "2": {
            "id": 2,
            "content_id": 1,
            "comment": "comment text",
            "parent_id": null,
            "user_id": 145,
            "created_on": "2017-11-15 07:28:44",
            "deleted_at": null
        },
        "3": {
            "id": 3,
            "content_id": 1,
            "comment": "comment text 2",
            "parent_id": null,
            "user_id": 14,
            "created_on": "2017-11-15 07:31:54",
            "deleted_at": null
        }
    }
}

```


Delete comment assignation - JSON controller
--------------------------------------

`{ DELETE /assigned-comments/{id} }`

Delete comment assignations.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/assigned-comment/1',
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

| path\|query\|body |  key |  required |  description\|notes | 
|-------------------|------|-----------|---------------------| 
| path              |  id  |  yes      |  Id of the comment  | 





<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, description\|notes
path , id , yes, Id of the comment
-->


### Response Example

```204 No Content```
