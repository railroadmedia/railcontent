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
                    <!-- START_2897a4200e3365f16bdc09c4a556e35c -->
## Call the method from service that create new data and link the content with the data.

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/content/datum" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentData","attributes":{"key":"description","value":"indsf fdgg  gfg","position":8},"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```
```javascript
const url = new URL("http://localhost/railcontent/content/datum");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 8
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

### HTTP Request
`PUT railcontent/content/datum`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'contentData'.
    data.attributes.key | string |  required  | The data key.
    data.attributes.value | string |  required  | Data value. 
    data.attributes.position | integer |  optional  | The position of this datum relative to other datum with the same key under the same content id.
    data.relationships.content.data.type | string |  required  | Must be 'content'.
    data.relationships.content.data.id | integer |  required  | Must exists in contents.

<!-- END_2897a4200e3365f16bdc09c4a556e35c -->

        
                    <!-- START_fb363b9c870922ffa55b96a23cd5a425 -->
## Call the method from service to update a content datum

> Example request:

```bash
curl -X PATCH "http://localhost/railcontent/content/datum/1" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentData","attributes":{"key":"description","value":"indsf fdgg  gfg","position":13},"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```
```javascript
const url = new URL("http://localhost/railcontent/content/datum/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 13
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

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Update failed, datum not found with id: 1"
    }
}
```

### HTTP Request
`PATCH railcontent/content/datum/{datumId}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'contentData'.
    data.attributes.key | string |  optional  | The data key.
    data.attributes.value | string |  optional  | Data value. 
    data.attributes.position | integer |  optional  | The position of this datum relative to other datum with the same key under the same content id.
    data.relationships.content.data.type | string |  optional  | Must be 'content'.
    data.relationships.content.data.id | integer |  optional  | Must exists in contents.

<!-- END_fb363b9c870922ffa55b96a23cd5a425 -->

        
                    <!-- START_a4137a74763de18a36fc0ff882de62d3 -->
## Call the method from service to delete the content data

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/content/datum/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/datum/1");

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

> Example response (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, datum not found with id: 1"
    }
}
```

### HTTP Request
`DELETE railcontent/content/datum/{datumId}`


<!-- END_a4137a74763de18a36fc0ff882de62d3 -->

        
