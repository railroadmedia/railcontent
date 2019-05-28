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

<!-- START_4572abc09b0a4dfedb76009dca5d6065 -->
## Create/update user permission record and return data in JSON API format.

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/user-permission" 
```
```javascript
const url = new URL("http://localhost/railcontent/user-permission");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
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
            "source": "data.relationships.user.data.id",
            "detail": "The user field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.permission.data.id",
            "detail": "The permission field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.start_date",
            "detail": "The start date field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/user-permission`


<!-- END_4572abc09b0a4dfedb76009dca5d6065 -->

<!-- START_091f922183423b288cd6002e9275c608 -->
## Delete user permission if exists

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/user-permission/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/user-permission/1");

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
        "detail": "Delete failed, user permission not found with id: 1"
    }
}
```

### HTTP Request
`DELETE railcontent/user-permission/{userPermissionId}`


<!-- END_091f922183423b288cd6002e9275c608 -->

<!-- START_11e3427c786ec11eb4b04a07b221d9eb -->
## Pull active user permissions.

IF "only_active" it's set false on the request the expired permissions are returned also
 IF "user_id" it's set on the request only the permissions for the specified user are returned

> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/user-permission" 
```
```javascript
const url = new URL("http://localhost/railcontent/user-permission");

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
    "data": []
}
```

### HTTP Request
`GET railcontent/user-permission`


<!-- END_11e3427c786ec11eb4b04a07b221d9eb -->

