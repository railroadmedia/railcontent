# Comments API

# JSON Endpoints


<!-- START_f625f9c6a130f4a7897d109f2ba98bc6 -->
## Create a new comment

> Example request:

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

> Example response (200):

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

### HTTP Request
`PUT railcontent/comment`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'comment'. |
    data.attributes.comment | string |  required  | The text of the comment. |
    data.attributes.temporary_display_name | string |  optional  | Temporary display name for user.  |
    data.relationships.content.data.type | string |  required  | Must be 'content'. |
    data.relationships.content.data.id | integer |  required  | Must exists in contents. |

<!-- END_f625f9c6a130f4a7897d109f2ba98bc6 -->

<!-- START_26daf74246cc31035b3821e283f2c144 -->
## Update a comment

> Example request:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
{
    "data": {
        "type": "comment",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
            "temporary_display_name": "doloribus"
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

> Example response (200):

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

### HTTP Request
`PATCH railcontent/comment/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'comment'. |
    data.attributes.comment | string |  optional  | The text of the comment. |
    data.attributes.temporary_display_name | string |  optional  |  |
    data.relationships.content.data.type | string |  optional  | Must be 'content'. |
    data.relationships.content.data.id | integer |  optional  | Must exists in contents. |

<!-- END_26daf74246cc31035b3821e283f2c144 -->

<!-- START_121b2cd5d84d7140b7802b630daed743 -->
## Delete an existing comment

> Example request:

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

> Example response (204):

```json
[]
```
> Example response (403):

```json
{
    "message": "Delete failed, you can delete only your comments."
}
```
> Example response (404):

```json
{
    "message": "Delete failed, comment not found with id: 1"
}
```

### HTTP Request
`DELETE railcontent/comment/{id}`


<!-- END_121b2cd5d84d7140b7802b630daed743 -->

<!-- START_7ce1a818c2f016fa930880c23ef690f8 -->
## Create a reply

> Example request:

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

> Example response (200):

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

### HTTP Request
`PUT railcontent/comment/reply`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data.type | string |  required  | Must be 'comment'. |
    data.attributes.comment | string |  required  | The text of the reply. |
    data.relationships.parent.data.type | string |  required  | Must be 'comment'. |
    data.relationships.parent.data.id | integer |  required  | Must exists in comments. |

<!-- END_7ce1a818c2f016fa930880c23ef690f8 -->

<!-- START_c209c8d8b857438eb1c1eeda5a870ead -->
## List comments

Pull comments based on the criteria passed in request
     - content_id   => pull the comments for given content id
     - user_id      => pull user's comments
     - content_type => pull the comments for the contents with given type

> Example request:

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

> Example response (200):

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

### HTTP Request
`GET railcontent/comment`


<!-- END_c209c8d8b857438eb1c1eeda5a870ead -->

<!-- START_3beda97b8a46ab8885399051f413b5e1 -->
## List comments, the current page it&#039;s the page with the comment

> Example request:

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

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET railcontent/comment/{id}`


<!-- END_3beda97b8a46ab8885399051f413b5e1 -->

<!-- START_5a905c9e9e8df6e1c999d38d3ad1c599 -->
## Authenticated user like a comment.

> Example request:

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

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`PUT railcontent/comment-like/{id}`


<!-- END_5a905c9e9e8df6e1c999d38d3ad1c599 -->

<!-- START_f93a1974aa0b0e828f72446fa23d4419 -->
## Authenticated user dislike a comment.

> Example request:

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

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`DELETE railcontent/comment-like/{id}`


<!-- END_f93a1974aa0b0e828f72446fa23d4419 -->
