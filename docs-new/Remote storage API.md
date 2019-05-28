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
                    <!-- START_339568376072f2f110420dc04236f894 -->
## railcontent/remote
> Example request:

```bash
curl -X PUT "http://localhost/railcontent/remote" 
```
```javascript
const url = new URL("http://localhost/railcontent/remote");

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

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`PUT railcontent/remote`


<!-- END_339568376072f2f110420dc04236f894 -->

        
