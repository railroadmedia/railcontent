# Hierarchy API

# JSON Endpoints


<!-- START_f6d838bb700192d56d216ae84700c66d -->
## Create/update a content hierarchy.


### HTTP Request
    `PUT railcontent/content/hierarchy`


### Permissions
    - create.content.hierarchy required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentHierarchy'.|
|body|data.attributes.child_position|    |The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.|
|body|data.relationships.parent.data.type|    |Must be 'content'.|
|body|data.relationships.parent.data.id|    |Must exists in contents.|
|body|data.relationships.child.data.type|    |Must be 'content'.|
|body|data.relationships.child.data.id|    |Must exists in contents.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/hierarchy',
{
    "data": {
        "type": "contentHierarchy",
        "attributes": {
            "child_position": 2
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            },
            "child": {
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
            "source": "data.type",
            "detail": "The json data type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.child.data.type",
            "detail": "The child type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.child.data.id",
            "detail": "The child id field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.parent.data.type",
            "detail": "The parent type field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.parent.data.id",
            "detail": "The parent id field is required."
        }
    ]
}
```




<!-- END_f6d838bb700192d56d216ae84700c66d -->

<!-- START_522506d0e5c355eb192c83407b0da522 -->
## railcontent/content/hierarchy/{parentId}/{childId}

### HTTP Request
    `DELETE railcontent/content/hierarchy/{parentId}/{childId}`


### Permissions
    - delete.content.hierarchy required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/hierarchy/1/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_522506d0e5c355eb192c83407b0da522 -->

