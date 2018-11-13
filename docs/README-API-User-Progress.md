- [User progress on contents - API endpoints](#user-progress-on-contents---api-endpoints)
  * [Start authenticated user progress on content - JSON controller](#start-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Save authenticated user progress on content - JSON controller](#save-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Reset authenticated user progress on content - JSON controller](#reset-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)
  * [Complete authenticated user progress on content - JSON controller](#complete-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-3)
    + [Request Parameters](#request-parameters-3)
    + [Response Example](#response-example-3)

<!-- ecotrust-canada.github.io/markdown-toc -->


# User progress on contents - API endpoints


Start authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /start }`

Start authenticated user progress on content. Please see more details about content progress in [Progress-Bubbling](https://github.com/railroadmedia/railcontent/tree/user-permission#progress-bubbling) section.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/start',
    type: 'put'
  	data: {content_id: 2} 
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

| path\|query\|body |  key         |  required |  description\|notes                | 
|-----------------|--------------|-----------|------------------------------------| 
| body            |  content_id  |  yes      |  The content id you want to start. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id you want to start.
-->


### Response Example

```200 OK```

```json

{
  "status":"ok",
  "code":200,
  "results":true
}

```



Save authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /progress }`

Save the progress on a content for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/progress',
    type: 'put'
  	data: {content_id: 2, progress_percent: 30} 
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

| path\|query\|body |  key               |  required |  description\|notes                                 | 
|-----------------|--------------------|-----------|-----------------------------------------------------| 
| body            |  content_id        |  yes      |  The content id on which we save the user progress. | 
| body            |  progress_percent  |  yes      |  The progress percent.                              | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we save the user progress.
body , progress_percent , yes , The progress percent.  
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```

Reset authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /reset }`

Delete the content progress for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/reset',
    type: 'put'
  	data: {content_id: 2} 
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

| path\|query\|body |  key         |  required |  description\|notes                                  | 
|-----------------|--------------|-----------|------------------------------------------------------| 
| body            |  content_id  |  yes      |  The content id on which we reset the user progress. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we reset the user progress. 
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```

Complete authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /complete }`

Set content as complete for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/complete',
    type: 'put'
  	data: {content_id: 2} 
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

| path\|query\|body |  key         |  required |  description\|notes                                  | 
|-----------------|--------------|-----------|------------------------------------------------------| 
| body            |  content_id  |  yes      |  The content id on which we complete the user progress. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we complete the user progress. 
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```
