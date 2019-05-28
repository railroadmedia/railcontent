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
                    <!-- START_c0f3be7f8a8582faf9eded5ca139e05e -->
## Start a content for the authenticated user

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/start" 
```
```javascript
const url = new URL("http://localhost/railcontent/start");

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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/start`


<!-- END_c0f3be7f8a8582faf9eded5ca139e05e -->

        
                    <!-- START_c771ec122eac231459ef2eeb003a51b6 -->
## Set content as complete for the authenticated user

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/complete" 
```
```javascript
const url = new URL("http://localhost/railcontent/complete");

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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/complete`


<!-- END_c771ec122eac231459ef2eeb003a51b6 -->

        
                    <!-- START_b2202db6547dcbe6b75e0cbc642af8de -->
## Reset content progress for authenticated user

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/reset" 
```
```javascript
const url = new URL("http://localhost/railcontent/reset");

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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/reset`


<!-- END_b2202db6547dcbe6b75e0cbc642af8de -->

        
                    <!-- START_0300c7a6d3d72c86c7cd80b0736a1e10 -->
## Save the progress on a content for the authenticated user

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/progress" 
```
```javascript
const url = new URL("http://localhost/railcontent/progress");

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
            "source": "data.relationships.content.data.id",
            "detail": "The content field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/progress`


<!-- END_0300c7a6d3d72c86c7cd80b0736a1e10 -->

        
