- [Content datum - API endpoints](#content-datum---api-endpoints)
  * [Store content datum - JSON controller](#store-content-datum---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Update content datum - JSON controller](#update-content-datum---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Delete content datum - JSON controller](#delete-content-datum---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)

<!-- ecotrust-canada.github.io/markdown-toc -->


# Content datum - API endpoints


Store content datum - JSON controller
--------------------------------------

`{ PUT /content/datum }`

Create a new content datum record based on request data and return the new created datum data in JSON format.

Only users with 'create.content.data' ability can create content datum.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum',
    type: 'put'
  	data: {content_id: 3, key: 'description' value: 'very long description here'} 
		// position will automatically be set to the end of the stack if you dont pass one in
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

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                               | 
|-----------------|--------------|-----------|----------|---------------------------------------------------------------------------------------------------| 
| body            |  content_id  |  yes      |          |  The content id this datum belongs to.                                                            | 
| body            |  key         |  yes      |          |  The key of this datum; also know as the name.                                                    | 
| body            |  value       |  yes      |          |  The value of the datum.                                                                          | 
| body            |  position    |  no       |  1       |  The position of this datum relative to other datum with the same key under the same content id. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , content_id , yes ,  , The content id this datum belongs to.
body , key , yes ,  , The key of this datum; also know as the name.
body , value , yes ,  , The value of the datum.
body , position , no , 1 , The position of this datum relative to other datum with the same key under the same content id.
-->


### Response Example

```200 OK```

```json

{
	"id":12,
	"key":"description",
	"value":"very long description here",
	"position":1
}

```

Update content datum - JSON controller
--------------------------------------

`{ PATCH /content/datum/{id} }`

Update the content datum with the request data and return the updated datum in JSON format. 

Only users with 'update.content.data' ability can update content datum.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum/73',
    type: 'patch'
  	data: {value: 'another long description here'}
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

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                              | 
|-----------------|--------------|-----------|----------|--------------------------------------------------------------------------------------------------| 
| path            |  id          |  yes      |          |  Id of the datum you want to edit.                                                               | 
| body            |  content_id  |  no       |          |  The content id this datum belongs to.                                                           | 
| body            |  key         |  no       |          |  The key of this datum; also know as the name.                                                   | 
| body            |  value       |  no       |          |  The value of the datum.                                                                         | 
| body            |  position    |  no       |  1       |  The position of this datum relative to other datum with the same key under the same content id. | 
                     | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , Id of the datum you want to edit.
body , content_id , no ,  , The content id this datum belongs to.
body , key , no ,  , The key of this datum; also know as the name.
body , value , no ,  , The value of the datum.
body , position , no , 1 , The position of this datum relative to other datum with the same key under the same content id.
-->


### Response Example

```201 OK```

```json
{
	"id":73,
	"key":"description",
	"value":"another long description here",
	"position":1
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
        "detail":"Update failed, datum not found with id: 513"
      }
}
```
Delete content datum - JSON controller
--------------------------------------

`{ DELETE /content/datum/{id} }`

Delete content datum if exists in the database. 

Only users with 'delete.content.data' ability can delete content's data.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum/2',
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

| path\|query\|body |  key |  required |  default |  description\|notes                    | 
|-----------------|------|-----------|----------|----------------------------------------| 
| path            |  id  |  yes      |          |  Id of the content datum you want to delete. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content datum you want to delete.
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
        "detail":"Delete failed, datum not found with id: 2"
      }
}
```

