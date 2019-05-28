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

<!-- START_6bf34590090ea43f90bc0b8aca783f73 -->
## Fetch likes for content with pagination.

> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/content-like/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content-like/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": [],
    "meta": {
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/content-like\/1?page=1",
        "first": "http:\/\/localhost\/railcontent\/content-like\/1?page=1",
        "last": "http:\/\/localhost\/railcontent\/content-like\/1?page=0"
    }
}
```

### HTTP Request
`GET railcontent/content-like/{id}`


<!-- END_6bf34590090ea43f90bc0b8aca783f73 -->

<!-- START_c864f9442ee531ba11d7259fb511a17c -->
## Authenticated user like content.

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/content-like" \
    -H "Content-Type: application/json" \
    -d '{"data":{"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```
```javascript
const url = new URL("http://localhost/railcontent/content-like");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "data": {
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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/content-like`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.relationships.content.data.type | string |  required  | Must be 'content'.
    data.relationships.content.data.id | integer |  required  | Must exists in contents.

<!-- END_c864f9442ee531ba11d7259fb511a17c -->

<!-- START_4f7915ff2544f600944155f3e2c529eb -->
## Authenticated user dislike content.

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/content-like" \
    -H "Content-Type: application/json" \
    -d '{"data":{"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```
```javascript
const url = new URL("http://localhost/railcontent/content-like");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "data": {
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
    method: "DELETE",
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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`DELETE railcontent/content-like`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.relationships.content.data.type | string |  required  | Must be 'content'.
    data.relationships.content.data.id | integer |  required  | Must exists in contents.

<!-- END_4f7915ff2544f600944155f3e2c529eb -->

