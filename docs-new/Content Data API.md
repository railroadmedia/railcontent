# Content Data API

# JSON Endpoints


<!-- START_2897a4200e3365f16bdc09c4a556e35c -->
## Call the method from service that create new data and link the content with the data.


### HTTP Request
    `PUT railcontent/content/datum`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|  required  | |string|Must be 'contentData'.|
|body|data.attributes.key|  required  | |string|The data key.|
|body|data.attributes.value|  required  | |string|Data value. |
|body|data.attributes.position|  optional  | |integer|The position of this datum relative to other datum with the same key under the same content id.|
|body|data.relationships.content.data.type|  required  | |string|Must be 'content'.|
|body|data.relationships.content.data.id|  required  | |integer|Must exists in contents.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum',
{
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 5
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
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
            "source": "data.attributes.key",
            "detail": "The key field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```




<!-- END_2897a4200e3365f16bdc09c4a556e35c -->

<!-- START_fb363b9c870922ffa55b96a23cd5a425 -->
## Call the method from service to update a content datum


### HTTP Request
    `PATCH railcontent/content/datum/{datumId}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|  required  | |string|Must be 'contentData'.|
|body|data.attributes.key|  optional  | |string|The data key.|
|body|data.attributes.value|  optional  | |string|Data value. |
|body|data.attributes.position|  optional  | |integer|The position of this datum relative to other datum with the same key under the same content id.|
|body|data.relationships.content.data.type|  optional  | |string|Must be 'content'.|
|body|data.relationships.content.data.id|  optional  | |integer|Must exists in contents.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum/1',
{
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 12
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
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

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Update failed, datum not found with id: 1"
    }
}
```




<!-- END_fb363b9c870922ffa55b96a23cd5a425 -->

<!-- START_a4137a74763de18a36fc0ff882de62d3 -->
## Call the method from service to delete the content data


### HTTP Request
    `DELETE railcontent/content/datum/{datumId}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum/1',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, datum not found with id: 1"
    }
}
```




<!-- END_a4137a74763de18a36fc0ff882de62d3 -->

