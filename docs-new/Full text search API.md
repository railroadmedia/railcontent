# Full text search API

# JSON Endpoints


<!-- START_8009b1b4a1fe14e999c1ed8b25cbcd76 -->
## Call the method from the service to pull the contents based on the criteria passed in request.

Return a Json paginated response with the contents


### HTTP Request
    `GET railcontent/search`


###Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Example request:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/search',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Example response (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_8009b1b4a1fe14e999c1ed8b25cbcd76 -->

