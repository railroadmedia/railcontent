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
                    <!-- START_8009b1b4a1fe14e999c1ed8b25cbcd76 -->
## Call the method from the service to pull the contents based on the criteria passed in request.

Return a Json paginated response with the contents

> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/search" 
```
```javascript
const url = new URL("http://localhost/railcontent/search");

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

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET railcontent/search`


<!-- END_8009b1b4a1fe14e999c1ed8b25cbcd76 -->

        
