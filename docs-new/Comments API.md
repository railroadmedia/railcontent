# Comments API

# JSON Endpoints


<!-- START_f625f9c6a130f4a7897d109f2ba98bc6 -->
## Create a new comment


### HTTP Request
    `PUT railcontent/comment`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|  required  | |string|Must be 'comment'.|
|body|data.attributes.comment|  required  | |string|The text of the comment.|
|body|data.attributes.temporary_display_name|  optional  | |string|Temporary display name for user. |
|body|data.relationships.content.data.type|  required  | |string|Must be 'content'.|
|body|data.relationships.content.data.id|  required  | |integer|Must exists in contents.|

### Validation Rules
```php
{
    "data.attributes.comment": "required|max:10024",
    "data.relationships.content.data.id": [
        "required",
        "numeric",
        {}
    ]
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment',
{
    "data": {
        "type": "comment",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
            "temporary_display_name": "in"
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": "comment",
        "id": "1",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae. Aspernatur facilis et quia saepe nemo.",
            "temporary_display_name": "in",
            "user": "1",
            "created_on": "2019-05-24 13:35:39",
            "deleted_at": null
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": "1"
                }
            }
        }
    },
    "included": [
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Perspiciatis asperiores reprehenderit ut dolores. Quia inventore doloribus sed neque. Voluptates quam fugiat eius consequatur.",
                "type": "course lesson",
                "sort": "1",
                "status": "published",
                "brand": "brand",
                "language": "en-EN",
                "user": "",
                "published_on": "2002-12-27 01:35:00",
                "archived_on": null,
                "created_on": "2002-11-05 04:37:59.000000",
                "difficulty": "easy",
                "home_staff_pick_rating": "2",
                "legacy_id": 847371928,
                "legacy_wordpress_post_id": 962480732,
                "qna_video": null,
                "style": null,
                "title": "Sapiente aperiam sunt et et ipsa quia voluptate.",
                "xp": 15,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        }
    ]
}
```




<!-- END_f625f9c6a130f4a7897d109f2ba98bc6 -->

<!-- START_26daf74246cc31035b3821e283f2c144 -->
## Update a comment


### HTTP Request
    `PATCH railcontent/comment/{id}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|  required  | |string|Must be 'comment'.|
|body|data.attributes.comment|  optional  | |string|The text of the comment.|
|body|data.attributes.temporary_display_name|  optional  | |string||
|body|data.relationships.content.data.type|  optional  | |string|Must be 'content'.|
|body|data.relationships.content.data.id|  optional  | |integer|Must exists in contents.|

### Validation Rules
```php
{
    "data.attributes.comment": "nullable|max:10024",
    "data.relationships.content.data.id": [
        "numeric",
        {}
    ],
    "data.relationships.parent.data.id": "numeric|exists:testbench.railcontent_comments,id",
    "data.attributes.temporary_display_name": "filled"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
{
    "data": {
        "type": "comment",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
            "temporary_display_name": "praesentium"
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            }
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": "comment",
        "id": "1",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae. Aspernatur facilis et quia saepe nemo.",
            "temporary_display_name": "in",
            "user": "1",
            "created_on": "2019-05-24 13:35:39",
            "deleted_at": null
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": "1"
                }
            }
        }
    },
    "included": [
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Perspiciatis asperiores reprehenderit ut dolores. Quia inventore doloribus sed neque. Voluptates quam fugiat eius consequatur.",
                "type": "course lesson",
                "sort": "1",
                "status": "published",
                "brand": "brand",
                "language": "en-EN",
                "user": "",
                "published_on": "2002-12-27 01:35:00",
                "archived_on": null,
                "created_on": "2002-11-05 04:37:59.000000",
                "difficulty": "easy",
                "home_staff_pick_rating": "2",
                "legacy_id": 847371928,
                "legacy_wordpress_post_id": 962480732,
                "qna_video": null,
                "style": null,
                "title": "Sapiente aperiam sunt et et ipsa quia voluptate.",
                "xp": 15,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        }
    ]
}
```




<!-- END_26daf74246cc31035b3821e283f2c144 -->

<!-- START_121b2cd5d84d7140b7802b630daed743 -->
## Delete an existing comment


### HTTP Request
    `DELETE railcontent/comment/{id}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
[]
```
### Response Example (403):

```json
{
    "message": "Delete failed, you can delete only your comments."
}
```
### Response Example (404):

```json
{
    "message": "Delete failed, comment not found with id: 1"
}
```




<!-- END_121b2cd5d84d7140b7802b630daed743 -->

<!-- START_7ce1a818c2f016fa930880c23ef690f8 -->
## Create a reply


### HTTP Request
    `PUT railcontent/comment/reply`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|  required  | |string|Must be 'comment'.|
|body|data.attributes.comment|  required  | |string|The text of the reply.|
|body|data.relationships.parent.data.type|  required  | |string|Must be 'comment'.|
|body|data.relationships.parent.data.id|  required  | |integer|Must exists in comments.|

### Validation Rules
```php
{
    "data.attributes.comment": "required|max:10024",
    "data.relationships.parent.data.id": "required|numeric|exists:testbench.railcontent_comments,id"
}
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/reply',
{
    "data": {
        "type": "comment",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae."
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "comment",
                    "id": 1
                }
            }
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": "comment",
        "id": "1",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae. Aspernatur facilis et quia saepe nemo.",
            "temporary_display_name": "in",
            "user": "1",
            "created_on": "2019-05-24 13:35:39",
            "deleted_at": null
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": "1"
                }
            }
        }
    },
    "included": [
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Perspiciatis asperiores reprehenderit ut dolores. Quia inventore doloribus sed neque. Voluptates quam fugiat eius consequatur.",
                "type": "course lesson",
                "sort": "1",
                "status": "published",
                "brand": "brand",
                "language": "en-EN",
                "user": "",
                "published_on": "2002-12-27 01:35:00",
                "archived_on": null,
                "created_on": "2002-11-05 04:37:59.000000",
                "difficulty": "easy",
                "home_staff_pick_rating": "2",
                "legacy_id": 847371928,
                "legacy_wordpress_post_id": 962480732,
                "qna_video": null,
                "style": null,
                "title": "Sapiente aperiam sunt et et ipsa quia voluptate.",
                "xp": 15,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        }
    ]
}
```




<!-- END_7ce1a818c2f016fa930880c23ef690f8 -->

<!-- START_c209c8d8b857438eb1c1eeda5a870ead -->
## List comments

Pull comments based on the criteria passed in request
     - content_id   => pull the comments for given content id
     - user_id      => pull user's comments
     - content_type => pull the comments for the contents with given type


### HTTP Request
    `GET railcontent/comment`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment',
[]
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [],
    "meta": {
        "totalCommentsAndReplies": "0",
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/comment?page=1",
        "first": "http:\/\/localhost\/railcontent\/comment?page=1",
        "last": "http:\/\/localhost\/railcontent\/comment?page=0"
    }
}
```




<!-- END_c209c8d8b857438eb1c1eeda5a870ead -->

<!-- START_3beda97b8a46ab8885399051f413b5e1 -->
## List comments, the current page it&#039;s the page with the comment


### HTTP Request
    `GET railcontent/comment/{id}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
[]
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




<!-- END_3beda97b8a46ab8885399051f413b5e1 -->

<!-- START_5a905c9e9e8df6e1c999d38d3ad1c599 -->
## Authenticated user like a comment.


### HTTP Request
    `PUT railcontent/comment-like/{id}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment-like/1',
[]
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




<!-- END_5a905c9e9e8df6e1c999d38d3ad1c599 -->

<!-- START_f93a1974aa0b0e828f72446fa23d4419 -->
## Authenticated user dislike a comment.


### HTTP Request
    `DELETE railcontent/comment-like/{id}`


### Permissions


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment-like/1',
[]
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




<!-- END_f93a1974aa0b0e828f72446fa23d4419 -->

