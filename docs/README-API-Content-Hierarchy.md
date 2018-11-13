- [Content hierarchy - API endpoints](#content-hierarchy---api-endpoints)
  * [Store content hierarchy - JSON controller](#store-content-hierarchy---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Change child position in content hierarchy - JSON controller](#change-child-position-in-content-hierarchy---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Delete child from content hierarchy - JSON controller](#delete-child-from-content-hierarchy---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)

<!-- ecotrust-canada.github.io/markdown-toc -->


# Content hierarchy - API endpoints


Store/update content hierarchy - JSON controller
--------------------------------------

`{ PUT /content/hierarchy }`

Create/update content hierarchy specifying parent id, child id and child position.


Only users with 'create.content.hierarchy' ability can create/update contents hierarchy.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/hierarchy',
    type: 'put'
  	data: {parent_id: 3, child_id: 1, child_position: 22} 
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

| path\|query\|body |  key             |  required |  default |  description\|notes                                                                                                                                                      | 
|-----------------|------------------|-----------|----------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| body            |  parent_id       |  yes      |          |  The content id of the parent.                                                                                                                                           | 
| body            |  child_id        |  yes      |          |  The content id of the child.                                                                                                                                            | 
| body            |  child_position  |  no      |  null    |  The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , parent_id , yes ,  , The content id of the parent.
body , child_id , yes ,  , The content id of the child.
body , child_position , no , null , The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.
-->


### Response Example

```200 OK```

```json

{
    "status":"ok",
    "code":200,
    "results":{
        "id":"1",
        "parent_id":"3",
        "child_id":"1",
        "child_position":"22"
    }
}

```

Delete child from content hierarchy - JSON controller
--------------------------------------

`{ DELETE /content/hierarchy/{parentId}/{childId} }`

Delete the link between parent content and child content and reposition other childrens.


Only users with 'delete.content.hierarchy' ability can delete contents hierarchy.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/hierarchy/3/82',
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

| path\|query\|body |  key        |  required |  description\|notes        | 
|-----------------|-------------|-----------|----------------------------| 
| path            |  parent_id  |  yes      |  Id of the content parent. | 
| path            |  child_id   |  yes      |  Id of the child that should be removed from the hierarchy.          | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , parent_id , yes, Id of the content parent.
path , child_id , yes, Id of the child that should be removed from the hierarchy.    
-->


### Response Example

```204 No Content```  
