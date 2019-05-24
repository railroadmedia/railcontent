# User progress on contents API

[Table Schema](../schema/table-schema.md#table-railcontent_user_content_progress)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ PUT /*/start }`

Start authenticated user progress on content. 

### Permissions

- Must be logged in

### Request Parameters



|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'userContentProgress'||
|body|data.relationships.content.data.type|yes| |must be 'content'||
|body|data.relationships.content.data.id|yes||||


### Validation Rules

```php
[
    'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
              config('railcontent.table_prefix'). 'content' . ',id'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/start',
    data: {
        type: "userContentProgress",
        relationships:{
            content:{
                data:{
                    type: "content",
                    id: 1
                }
            },
        }
    },        
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{
    "data": true
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/progress }`

Save the progress on a content for the authenticated user. 

### Permissions

- Must be logged in


### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'userContentProgress'||
|body|data.attributes.progress_percent|yes||||
|body|data.relationships.content.data.type|yes| |must be 'content'||
|body|data.relationships.content.data.id|yes||||


### Validation Rules

```php
[
    'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
              config('railcontent.table_prefix'). 'content' . ',id'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/progress',
    data: {
        type: "userContentProgress",
        attributes: {
            progress_percent: 20
        },
        relationships:{
            content:{
                data:{
                    type: "content",
                    id: 1
                }
            },
        }
    },        
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{
    "data": true
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/reset }`

Delete the content progress for the authenticated user.

### Permissions

- Must be logged in


### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'userContentProgress'||
|body|data.relationships.content.data.type|yes| |must be 'content'||
|body|data.relationships.content.data.id|yes||||


### Validation Rules

```php
[
    'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
              config('railcontent.table_prefix'). 'content' . ',id'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/reset',
    data: {
        type: "userContentProgress",
        relationships:{
            content:{
                data:{
                    type: "content",
                    id: 1
                }
            },
        }
    },        
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{
    "data": true
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/complete }`

Set content as complete for the authenticated user. 

### Permissions

- Must be logged in


### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'userContentProgress'||
|body|data.relationships.content.data.type|yes| |must be 'content'||
|body|data.relationships.content.data.id|yes||||


### Validation Rules

```php
[
    'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
              config('railcontent.table_prefix'). 'content' . ',id'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/complete',
    data: {
        type: "userContentProgress",
        relationships:{
            content:{
                data:{
                    type: "content",
                    id: 1
                }
            },
        }
    },        
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{
    "data": true
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->
