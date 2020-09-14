# Content datum API

[Table Schema](../schema/table-schema.md#table-railcontent_content_data)


# JSON Endpoints

### `{ PUT /*/content/datum }`

Create a new content data.

### Permissions

- Must be logged in
- Must have the 'create.content.data' permission to create

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'contentData'||
|body|data.attributes.key|yes||||
|body|data.attributes.value|yes||||
|body|data.attributes.position|no| | |The position of this datum relative to other datum with the same key under the same content id.|
|body|data.relationships.content.data.type|yes| |must be 'content'||
|body|data.relationships.content.data.id|yes||||


### Validation Rules

```php
[
    'data.attributes.key' => 'required|max:255',
    'data.attributes.position' => 'nullable|numeric|min:0',
    'data.relationships.content.data.id' => 'required|numeric|exists:' .
        config('railcontent.table_prefix') .
        'content' .
        ',id',
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/datum',
    data: {
        type: "contentData",
        attributes: {
              key: "description",
              value: "Dolores excepturi.",
              position:1,
        },
        relationships:{
            content:{
                data:{
                    type: "content",
                    id: 1
                }
            }
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
   "data":{  
      "type":"contentData",
      "id":"1",
      "attributes":{  
         "key":"description",
         "value":"Dolores excepturi.",
         "position":1
      }
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PATCH /*/content/datum/{ID} }`

Change content data.

### Permissions

- Must be logged in
- Must have the 'update.content.data' permission to update

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||
|body|data.type|yes| |must be 'contentData'||
|body|data.attributes.key|no||||
|body|data.attributes.value|no||||
|body|data.attributes.position|no||||


### Validation Rules

```php
[
    'data.attributes.key' => 'max:255',
    'data.attributes.position' => 'nullable|numeric|min:0'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/datum/1',
    type: 'patch', 
    data: {
            type: "contentData",
            attributes: {
                value: "new value"
        }, 
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{  
   "data":{  
      "type":"contentData",
      "id":"1",
      "attributes":{  
         "key":"description",
         "value":"new value",
         "position":1
      }
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/content/datum/{ID} }`

Delete content datum.


### Permissions

- Must be logged in
- Must have the 'delete.content.data' permission

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|permission id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/datum/1',
    type: 'delete', 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```204 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

