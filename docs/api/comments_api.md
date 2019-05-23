# Comments API

[Table Schema](../schema/table-schema.md#table-railcontent_comments)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ GET /*/comment }`

List comments.
### Permissions



### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|content_id|no| | |pull the comments for given content id
|body|user_id|no| | |pull user's comments
|body|content_type|no| | |pull the comments for the contents with given type

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment',
    data: {
        page: 1, 
        limit: 3,
        sort:'-created_on'
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{
    "data":[
      {
            "type":"comment",
            "id":"1",
            "attributes":{
                "comment":"Est minima ea placeat enim ea aut libero magni. Expedita eveniet reprehenderit quos deleniti.",
                "temporary_display_name": "vitae",
                "user":"2",
                "created_on":"1990-12-17 10:50:56.000000",
                "deleted_at": null,
                "like_count": 0,
                "is_liked": false
            }
      },
      {
 "type":"comment",
            "id":"1",
            "attributes":{
                "comment":"Est minima ea placeat enim ea aut libero magni. Expedita eveniet reprehenderit quos deleniti.",
                "temporary_display_name": "vitae",
                "user":"2",
                "created_on":"1990-12-17 10:50:56.000000",
                "deleted_at": null,
                "like_count": 0,
                "is_liked": false
            }
      }
    ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/comment }`

Create a new comment to a content.

### Permissions

- Must be logged in
- The content type should allow comments

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|yes||||
|body|data.attributes.temporary_display_name|no||||
body|data.relationships.content.data.type|yes|must be 'content'|||
|body|data.relationships.content.data.id|yes||||



### Validation Rules

```php
[
    'data.attributes.comment' => 'required|max:10024',
    'data.relationships.content.data.id' =>
         [
         'required',
         'numeric',
         Rule::exists(
               config('railcontent.database_connection_name') . '.' . config('railcontent.table_prefix'). 'content', 'id')
               ->where(function ($query) {
                        if (is_array(ContentRepository::$availableContentStatues)) {
                            $query->whereIn('status', ContentRepository::$availableContentStatues);
                        }
                    })
                ],
];
```

### Request Example

```js

```

### Response Example

```201 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PATCH /*/comment/{ID} }`

Change comment.

### Permissions

- Must be logged in to modify own comments 
- Must be logged in with an administrator account to modify other user comments

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|no||||
|body|data.attributes.display_name|no||||
body|data.relationships.parent.data.type|no|must be 'comment'|||
|body|data.relationships.parent.data.id|no||||
body|data.relationships.content.data.type|no|must be 'content'|||
|body|data.relationships.content.data.id|no||||


### Validation Rules

```php
[
            'data.attributes.comment' => 'nullable|max:10024',
            'data.relationships.content.data.id' =>
                ['numeric',
                    Rule::exists(
                        config('railcontent.database_connection_name') . '.' .
                        config('railcontent.table_prefix'). 'content',
                        'id'
                    )->where(
                        function ($query) {
                            if (is_array(ContentRepository::$availableContentStatues)) {
                                $query->whereIn('status', ContentRepository::$availableContentStatues);
                            }
                        }
                    )
                ],
            'data.relationships.parent.data.id' => 'numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'comments' . ',id',
            'data.attributes.display_name' => 'filled'
];
```

### Request Example

```js   

```

### Response Example

```201 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/comment/{ID} }`

Delete comment or mark comment as deleted.


### Permissions

- Must be logged in to soft delete own comment (mark comment as deleted)
- Must be logged in with an administrator account to delete comment with all replies

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment/1',
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


### `{ PUT /*/comment/reply }`

Assign permission to a specific content or to all content of certain type.

### Permissions

- Must be logged in
- Must have the 'assign.permission' permission to assign

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|yes||||
|body|data.relationships.parent.data.type|yes|must be 'comment'|||
|body|data.relationships.parent.data.id|yes||||



### Validation Rules

```php
       [
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.parent.data.id' => 'required|numeric|exists:' .
                config('railcontent.database_connection_name') .
                '.' .
                config('railcontent.table_prefix'). 'comments' .
                ',id'
       ]
```

### Request Example

```js   

```

### Response Example

```200 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ GET /*/comment/{ID} }`

List linked comments.
### Permissions



### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes| | |
|body|limit|no|10| |

### Request Example

```js   

```

### Response Example

```200 OK```

```json

```
<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/comment-like/{ID} }`

Like a comment.

### Permissions

- Must be logged in


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|comment id|yes||||


### Request Example

```js   

```

### Response Example

```200 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/comment-like/{ID} }`

Unlike a comment.

### Permissions

- Must be logged in


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|comment id|yes||||


### Request Example

```js   

```

### Response Example

```200 OK```

```json

```