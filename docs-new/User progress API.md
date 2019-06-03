# User progress API

# JSON Endpoints


<!-- START_c0f3be7f8a8582faf9eded5ca139e05e -->
## Start a content for the authenticated user


### HTTP Request
    `PUT railcontent/start`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'userContentProgress'.|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in content.|
|body|data.attributes.progress_percent|  yes  |Progress percent.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' =>'required|in:userContentProgress',",
    "            'data.relationships.content.data.type' =>'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/start',
{
    "data": {
        "type": "userContentProgress",
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        },
        "attributes": {
            "progress_percent": 10
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_c0f3be7f8a8582faf9eded5ca139e05e -->

<!-- START_c771ec122eac231459ef2eeb003a51b6 -->
## Set content as complete for the authenticated user


### HTTP Request
    `PUT railcontent/complete`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'userContentProgress'.|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in content.|
|body|data.attributes.progress_percent|  yes  |Progress percent.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' =>'required|in:userContentProgress',",
    "            'data.relationships.content.data.type' =>'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/complete',
{
    "data": {
        "type": "userContentProgress",
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        },
        "attributes": {
            "progress_percent": 10
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_c771ec122eac231459ef2eeb003a51b6 -->

<!-- START_b2202db6547dcbe6b75e0cbc642af8de -->
## Reset content progress for authenticated user


### HTTP Request
    `PUT railcontent/reset`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'userContentProgress'.|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in content.|
|body|data.attributes.progress_percent|  yes  |Progress percent.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' =>'required|in:userContentProgress',",
    "            'data.relationships.content.data.type' =>'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/reset',
{
    "data": {
        "type": "userContentProgress",
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        },
        "attributes": {
            "progress_percent": 10
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (201):

```json
{
    "data": true
}
```




<!-- END_b2202db6547dcbe6b75e0cbc642af8de -->

<!-- START_0300c7a6d3d72c86c7cd80b0736a1e10 -->
## Save the progress on a content for the authenticated user


### HTTP Request
    `PUT railcontent/progress`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'userContentProgress'.|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in content.|
|body|data.attributes.progress_percent|  yes  |Progress percent.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' =>'required|in:userContentProgress',",
    "            'data.relationships.content.data.type' =>'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/progress',
{
    "data": {
        "type": "userContentProgress",
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        },
        "attributes": {
            "progress_percent": 10
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (201):

```json
{
    "data": true
}
```




<!-- END_0300c7a6d3d72c86c7cd80b0736a1e10 -->

