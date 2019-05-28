---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/../../../docs-new/collection.json)

<!-- END_INFO -->

<!-- START_f6d838bb700192d56d216ae84700c66d -->
## Create/update a content hierarchy.

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/content/hierarchy" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentHierarchy","attributes":{"child_position":11},"relationships":{"parent":{"data":{"type":"content","id":1}},"child":{"data":{"type":"content","id":1}}}}}'

```
```javascript
const url = new URL("http://localhost/railcontent/content/hierarchy");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "data": {
        "type": "contentHierarchy",
        "attributes": {
            "child_position": 11
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

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.relationships.child.data.id",
            "detail": "The child field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.parent.data.id",
            "detail": "The parent field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/content/hierarchy`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'contentHierarchy'.
    data.attributes.child_position | integer |  optional  | The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.
    data.relationships.parent.data.type | string |  optional  | Must be 'content'.
    data.relationships.parent.data.id | integer |  optional  | Must exists in contents.
    data.relationships.child.data.type | string |  optional  | Must be 'content'.
    data.relationships.child.data.id | integer |  optional  | Must exists in contents.

<!-- END_f6d838bb700192d56d216ae84700c66d -->

<!-- START_522506d0e5c355eb192c83407b0da522 -->
## railcontent/content/hierarchy/{parentId}/{childId}
> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/content/hierarchy/1/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/hierarchy/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (204):

```json
null
```

### HTTP Request
`DELETE railcontent/content/hierarchy/{parentId}/{childId}`


<!-- END_522506d0e5c355eb192c83407b0da522 -->

