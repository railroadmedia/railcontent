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
                    <!-- START_82b005afd78be37707ededcd4afc2d84 -->
## railcontent/permission
> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/permission" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission");

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
`GET railcontent/permission`


<!-- END_82b005afd78be37707ededcd4afc2d84 -->

        
                    <!-- START_00fbbab029caab0b24691443083c1788 -->
## Create a new permission and return it in JSON API format

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/permission" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission");

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
            "source": "data.attributes.name",
            "detail": "The name field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/permission`


<!-- END_00fbbab029caab0b24691443083c1788 -->

        
                    <!-- START_4342e3c5e05a771e85749f018f936e97 -->
## Dissociate (&quot;unattach&quot;) permissions from a specific content or all content of a certain type

> Example request:

```bash
curl -X PATCH "http://localhost/railcontent/permission/dissociate" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission/dissociate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
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
            "source": "data.relationships.permission.data.id",
            "detail": "The permission field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content are present."
        }
    ]
}
```

### HTTP Request
`PATCH railcontent/permission/dissociate`


<!-- END_4342e3c5e05a771e85749f018f936e97 -->

        
                    <!-- START_d4001b71581880f49c6f7083414bd750 -->
## Update a permission if exist and return it in JSON API format

> Example request:

```bash
curl -X PATCH "http://localhost/railcontent/permission/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
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
            "source": "data.attributes.name",
            "detail": "The name field is required."
        }
    ]
}
```

### HTTP Request
`PATCH railcontent/permission/{permissionId}`


<!-- END_d4001b71581880f49c6f7083414bd750 -->

        
                    <!-- START_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->
## Delete a permission if exist and it&#039;s not linked with content id or content type

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/permission/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission/1");

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
        "detail": "Delete failed, permission not found with id: 1"
    }
}
```

### HTTP Request
`DELETE railcontent/permission/{permissionId}`


<!-- END_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->

        
                    <!-- START_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->
## Attach permission to a specific content or to all content of a certain type

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/permission/assign" 
```
```javascript
const url = new URL("http://localhost/railcontent/permission/assign");

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
            "source": "data.relationships.permission.data.id",
            "detail": "The permission field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required when none of content type are present."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.content_type",
            "detail": "The content type field is required when none of content are present."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/permission/assign`


<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

        
