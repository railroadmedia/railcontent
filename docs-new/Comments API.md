# Comments API

# JSON Endpoints


<!-- START_f625f9c6a130f4a7897d109f2ba98bc6 -->
## Create a new comment


### HTTP Request
    `PUT railcontent/comment`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'comment'.|
|body|data.attributes.comment|  yes  |The text of the comment.|
|body|data.attributes.temporary_display_name|    |Temporary display name for user. |
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in contents.|

### Validation Rules
```php
{
    "data.type": "required|in:comment",
    "data.attributes.comment": "required|max:10024",
    "data.relationships.content.data.type": "required|in:content",
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
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|    |int required|
|body|data.type|  yes  |Must be 'comment'.|
|body|data.attributes.comment|    |The text of the comment.|
|body|data.attributes.temporary_display_name|    ||
|body|data.relationships.content.data.type|    |Must be 'content'.|
|body|data.relationships.content.data.id|    |Must exists in contents.|

### Validation Rules
```php
{
    "data.type": "required|in:comment",
    "data.attributes.comment": "nullable|max:10024",
    "data.relationships.content.data.type": "in:content",
    "data.relationships.content.data.id": [
        "numeric",
        {}
    ],
    "data.relationships.parent.data.type": "in:comment",
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
            "temporary_display_name": "doloremque"
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
    - authenticated users can delete their own comments
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
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
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'comment'.|
|body|data.attributes.comment|  yes  |The text of the reply.|
|body|data.relationships.parent.data.type|  yes  |Must be 'comment'.|
|body|data.relationships.parent.data.id|  yes  |Must exists in comments.|

### Validation Rules
```php
{
    "data.type": "required|in:comment",
    "data.attributes.comment": "required|max:10024",
    "data.relationships.parent.data.type": "required|in:comment",
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
            "comment": "Omnis doloremque reiciendis enim"
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


### HTTP Request
    `GET railcontent/comment`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|content_id|    |pull the comments for given content id|
|query|user_id|    |pull user's comments|
|query|content_type|    |pull for the contents with given type|
|query|page|    |default:1|
|query|limit|    |default:10|
|query|sort|    |default:'-created_on'|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "comment",
            "id": "7",
            "attributes": {
                "comment": "Maxime recusandae quam deserunt rerum rerum quia. Blanditiis est nesciunt quaerat eligendi. Iste beatae voluptas nam repellat quibusdam. Nisi praesentium dolorem magni eligendi ad. Reiciendis qui sed voluptatem quos et laborum porro.",
                "temporary_display_name": "Autem vel ratione impedit id itaque hic deleniti. Provident occaecati quaerat unde placeat atque. Autem aut cupiditate quam sint. Enim est omnis eos autem doloribus. Optio cumque iste laborum reiciendis vel occaecati aut.",
                "user": "2",
                "created_on": "2019-05-27 11:55:56",
                "deleted_at": null,
                "like_count": "0",
                "is_liked": false
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
        {
            "type": "comment",
            "id": "8",
            "attributes": {
                "comment": "Sed eveniet sed voluptatem reprehenderit vel repellat. Voluptatum consequatur et voluptate rerum iusto quam. Placeat optio sunt dolorem alias ea nihil totam.",
                "temporary_display_name": "Eligendi beatae laborum reiciendis aspernatur quam expedita repellendus impedit. Nesciunt et itaque nihil ut temporibus qui. Id dicta harum dolore.",
                "user": "2",
                "created_on": "2019-05-27 11:55:56",
                "deleted_at": null,
                "like_count": "0",
                "is_liked": false
            },
            "relationships": {
                "content": {
                    "data": {
                        "type": "content",
                        "id": "1"
                    }
                }
            }
        }
    ],
    "included": [
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Consectetur magni quisquam a possimus. Perspiciatis ut nobis quos aliquam adipisci. Qui tempore quia qui sit porro incidunt tempore. Suscipit excepturi facilis rerum ratione. Natus officia enim et nemo molestias cupiditate.",
                "type": "course lesson",
                "sort": "704415625",
                "status": "In et alias fuga voluptatem et. Velit maxime debitis unde praesentium dolore rem modi amet. Aut odio id dolor omnis dolores. Non iusto asperiores itaque perferendis. Ut ea aspernatur tempora quia nulla rerum iste.",
                "brand": "brand",
                "language": "Dolore dolores temporibus minima eius velit provident est in. Eveniet vel veritatis deleniti dolore sed et aut adipisci. Enim necessitatibus quia quaerat omnis beatae mollitia.",
                "user": "",
                "published_on": {
                    "date": "2012-10-04 18:18:18.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "2003-09-29 03:56:43.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2010-03-01 05:16:25.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Recusandae necessitatibus ducimus ullam excepturi sunt et placeat. Eaque at porro tempora praesentium facere. Eos eum nisi quam nam non earum dolores facilis.",
                "home_staff_pick_rating": "395300498",
                "legacy_id": 1609818683,
                "legacy_wordpress_post_id": 1321383709,
                "qna_video": "Optio et sapiente debitis. Aliquam qui ut qui. Et qui est laboriosam consequatur aliquid.",
                "style": "Sunt ex ullam voluptatem est. Saepe debitis rerum est perferendis saepe. Autem ut ad accusamus similique accusamus nihil. Optio dolore quasi adipisci et. Ut non vel culpa. Numquam rerum et quaerat labore. Officia molestiae error in neque aperiam.",
                "title": "Eum commodi totam ad numquam rem quasi enim.",
                "xp": 498024232,
                "album": "Aperiam nam pariatur quibusdam. Perspiciatis perferendis esse quisquam eum. Laboriosam ratione corrupti explicabo quo dolore dolor. Autem tempore dicta commodi iste praesentium vel.",
                "artist": "Ipsa quasi non ex aliquid earum. Dignissimos sed maiores architecto omnis et. Quos officia et alias nihil similique voluptas. Quia vitae nulla qui eos occaecati. Consequuntur quia vel nemo assumenda error. Quos est dolore aspernatur sapiente sit quo.",
                "bpm": "Dolor ratione sint facilis perferendis autem doloremque dolorem. Necessitatibus dolor odio sint suscipit neque at quae labore. Magni laborum voluptas quidem veritatis ratione dicta.",
                "cd_tracks": "In quia commodi voluptatem laboriosam aperiam. Qui aliquam quaerat occaecati voluptate laudantium. Officia deleniti modi est quo est aperiam vitae odit. Aut est vero veniam ratione doloremque dolorem. Quaerat nostrum dolorem autem nostrum natus ullam.",
                "chord_or_scale": "Nihil est dignissimos accusantium non aperiam blanditiis. Modi molestiae repellat distinctio quisquam. Laborum officia adipisci culpa tempora ea. Vel quasi corporis consequatur architecto. Occaecati velit maiores quas distinctio sunt nesciunt sint.",
                "difficulty_range": "Quidem voluptate molestiae accusamus sequi sed. Vel sit dolorem exercitationem ut. Consequatur omnis nihil dolorem magnam aut tempora. Aut et impedit ex vero.",
                "episode_number": 740686606,
                "exercise_book_pages": "Rem et ratione velit est velit. Rerum consequuntur iusto aperiam qui qui debitis ut qui. Alias doloribus enim assumenda qui laudantium occaecati aperiam. At id omnis eos laboriosam sint perspiciatis est.",
                "fast_bpm": "Molestiae et et eos debitis magnam expedita. Velit sint esse commodi ipsam. Voluptas rerum ducimus quod assumenda asperiores.",
                "includes_song": false,
                "instructors": "Qui odio sed voluptatem tempora incidunt consequatur. Deleniti ut sed modi provident rerum temporibus aliquid. Incidunt molestias corporis qui nesciunt labore.",
                "live_event_start_time": {
                    "date": "1989-04-18 06:32:48.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "2016-06-18 21:09:35.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Est vel amet quis consequatur deserunt. Sunt ut optio atque et. Est ducimus incidunt veritatis saepe in nostrum aut.",
                "live_stream_feed_type": "Quas maiores labore consequuntur. Vel quia at nesciunt esse. Consequuntur earum architecto optio ipsa id non ad. In eos eaque provident minus.",
                "name": "Quasi reiciendis provident qui consequatur quae fuga error. Est quia ut voluptates eos ipsa. Magni ipsa consectetur officia autem eius nobis magni.",
                "released": "Rerum voluptas inventore beatae quaerat qui molestias recusandae. Quo dolores animi architecto ut. Quos eveniet libero tenetur repudiandae porro voluptas. Nulla aliquid hic assumenda laudantium iusto.",
                "slow_bpm": "Nisi maxime harum assumenda beatae minus et maiores. Quia maxime incidunt quod soluta. Vero sapiente qui culpa recusandae voluptatum.",
                "total_xp": "Perferendis consequatur reprehenderit explicabo nihil veniam sit. Distinctio et voluptas aut ab alias rerum repellat. Dolorum tempora qui commodi iste est quasi iure.",
                "transcriber_name": "Aspernatur dolor quia modi quia. Omnis ullam vel nisi ut cum delectus illum.",
                "week": 135344764,
                "avatar_url": "Ea repellat qui qui molestias iure. Distinctio officiis excepturi unde est eos architecto. Eos perspiciatis officia sint qui aut. Quis odio odio quae qui nihil blanditiis et dolorem.",
                "length_in_seconds": 611338636,
                "soundslice_slug": "Illo est molestias est quaerat. Ab et porro cumque et quod et maxime ut. Ad labore magni tempore facere veniam est voluptatibus.",
                "staff_pick_rating": 132184639,
                "student_id": 884610992,
                "vimeo_video_id": "Tempore rerum quo repellendus. Dolores esse et animi deserunt. Ut non reprehenderit et perspiciatis labore cum.",
                "youtube_video_id": "Eos dolore quae deserunt. Sit deleniti deleniti numquam. Quaerat non possimus perspiciatis autem porro et. Ut accusamus aliquid eum. Et est et perspiciatis molestias consequuntur repellat. Quia omnis alias dolor doloremque sunt et tempore."
            }
        }
    ],
    "meta": {
        "pagination": {
            "total": 12,
            "count": 2,
            "per_page": 2,
            "current_page": 4,
            "total_pages": 6
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=4",
        "first": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=1",
        "prev": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=3",
        "next": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=5",
        "last": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=6"
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


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|  yes  ||
|body|limit|    ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
{
    "limit": "totam"
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "comment",
            "id": "7",
            "attributes": {
                "comment": "Maxime recusandae quam deserunt rerum rerum quia. Blanditiis est nesciunt quaerat eligendi. Iste beatae voluptas nam repellat quibusdam. Nisi praesentium dolorem magni eligendi ad. Reiciendis qui sed voluptatem quos et laborum porro.",
                "temporary_display_name": "Autem vel ratione impedit id itaque hic deleniti. Provident occaecati quaerat unde placeat atque. Autem aut cupiditate quam sint. Enim est omnis eos autem doloribus. Optio cumque iste laborum reiciendis vel occaecati aut.",
                "user": "2",
                "created_on": "2019-05-27 11:55:56",
                "deleted_at": null,
                "like_count": "0",
                "is_liked": false
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
        {
            "type": "comment",
            "id": "8",
            "attributes": {
                "comment": "Sed eveniet sed voluptatem reprehenderit vel repellat. Voluptatum consequatur et voluptate rerum iusto quam. Placeat optio sunt dolorem alias ea nihil totam.",
                "temporary_display_name": "Eligendi beatae laborum reiciendis aspernatur quam expedita repellendus impedit. Nesciunt et itaque nihil ut temporibus qui. Id dicta harum dolore.",
                "user": "2",
                "created_on": "2019-05-27 11:55:56",
                "deleted_at": null,
                "like_count": "0",
                "is_liked": false
            },
            "relationships": {
                "content": {
                    "data": {
                        "type": "content",
                        "id": "1"
                    }
                }
            }
        }
    ],
    "included": [
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Consectetur magni quisquam a possimus. Perspiciatis ut nobis quos aliquam adipisci. Qui tempore quia qui sit porro incidunt tempore. Suscipit excepturi facilis rerum ratione. Natus officia enim et nemo molestias cupiditate.",
                "type": "course lesson",
                "sort": "704415625",
                "status": "In et alias fuga voluptatem et. Velit maxime debitis unde praesentium dolore rem modi amet. Aut odio id dolor omnis dolores. Non iusto asperiores itaque perferendis. Ut ea aspernatur tempora quia nulla rerum iste.",
                "brand": "brand",
                "language": "Dolore dolores temporibus minima eius velit provident est in. Eveniet vel veritatis deleniti dolore sed et aut adipisci. Enim necessitatibus quia quaerat omnis beatae mollitia.",
                "user": "",
                "published_on": {
                    "date": "2012-10-04 18:18:18.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "2003-09-29 03:56:43.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2010-03-01 05:16:25.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Recusandae necessitatibus ducimus ullam excepturi sunt et placeat. Eaque at porro tempora praesentium facere. Eos eum nisi quam nam non earum dolores facilis.",
                "home_staff_pick_rating": "395300498",
                "legacy_id": 1609818683,
                "legacy_wordpress_post_id": 1321383709,
                "qna_video": "Optio et sapiente debitis. Aliquam qui ut qui. Et qui est laboriosam consequatur aliquid.",
                "style": "Sunt ex ullam voluptatem est. Saepe debitis rerum est perferendis saepe. Autem ut ad accusamus similique accusamus nihil. Optio dolore quasi adipisci et. Ut non vel culpa. Numquam rerum et quaerat labore. Officia molestiae error in neque aperiam.",
                "title": "Eum commodi totam ad numquam rem quasi enim.",
                "xp": 498024232,
                "album": "Aperiam nam pariatur quibusdam. Perspiciatis perferendis esse quisquam eum. Laboriosam ratione corrupti explicabo quo dolore dolor. Autem tempore dicta commodi iste praesentium vel.",
                "artist": "Ipsa quasi non ex aliquid earum. Dignissimos sed maiores architecto omnis et. Quos officia et alias nihil similique voluptas. Quia vitae nulla qui eos occaecati. Consequuntur quia vel nemo assumenda error. Quos est dolore aspernatur sapiente sit quo.",
                "bpm": "Dolor ratione sint facilis perferendis autem doloremque dolorem. Necessitatibus dolor odio sint suscipit neque at quae labore. Magni laborum voluptas quidem veritatis ratione dicta.",
                "cd_tracks": "In quia commodi voluptatem laboriosam aperiam. Qui aliquam quaerat occaecati voluptate laudantium. Officia deleniti modi est quo est aperiam vitae odit. Aut est vero veniam ratione doloremque dolorem. Quaerat nostrum dolorem autem nostrum natus ullam.",
                "chord_or_scale": "Nihil est dignissimos accusantium non aperiam blanditiis. Modi molestiae repellat distinctio quisquam. Laborum officia adipisci culpa tempora ea. Vel quasi corporis consequatur architecto. Occaecati velit maiores quas distinctio sunt nesciunt sint.",
                "difficulty_range": "Quidem voluptate molestiae accusamus sequi sed. Vel sit dolorem exercitationem ut. Consequatur omnis nihil dolorem magnam aut tempora. Aut et impedit ex vero.",
                "episode_number": 740686606,
                "exercise_book_pages": "Rem et ratione velit est velit. Rerum consequuntur iusto aperiam qui qui debitis ut qui. Alias doloribus enim assumenda qui laudantium occaecati aperiam. At id omnis eos laboriosam sint perspiciatis est.",
                "fast_bpm": "Molestiae et et eos debitis magnam expedita. Velit sint esse commodi ipsam. Voluptas rerum ducimus quod assumenda asperiores.",
                "includes_song": false,
                "instructors": "Qui odio sed voluptatem tempora incidunt consequatur. Deleniti ut sed modi provident rerum temporibus aliquid. Incidunt molestias corporis qui nesciunt labore.",
                "live_event_start_time": {
                    "date": "1989-04-18 06:32:48.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "2016-06-18 21:09:35.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Est vel amet quis consequatur deserunt. Sunt ut optio atque et. Est ducimus incidunt veritatis saepe in nostrum aut.",
                "live_stream_feed_type": "Quas maiores labore consequuntur. Vel quia at nesciunt esse. Consequuntur earum architecto optio ipsa id non ad. In eos eaque provident minus.",
                "name": "Quasi reiciendis provident qui consequatur quae fuga error. Est quia ut voluptates eos ipsa. Magni ipsa consectetur officia autem eius nobis magni.",
                "released": "Rerum voluptas inventore beatae quaerat qui molestias recusandae. Quo dolores animi architecto ut. Quos eveniet libero tenetur repudiandae porro voluptas. Nulla aliquid hic assumenda laudantium iusto.",
                "slow_bpm": "Nisi maxime harum assumenda beatae minus et maiores. Quia maxime incidunt quod soluta. Vero sapiente qui culpa recusandae voluptatum.",
                "total_xp": "Perferendis consequatur reprehenderit explicabo nihil veniam sit. Distinctio et voluptas aut ab alias rerum repellat. Dolorum tempora qui commodi iste est quasi iure.",
                "transcriber_name": "Aspernatur dolor quia modi quia. Omnis ullam vel nisi ut cum delectus illum.",
                "week": 135344764,
                "avatar_url": "Ea repellat qui qui molestias iure. Distinctio officiis excepturi unde est eos architecto. Eos perspiciatis officia sint qui aut. Quis odio odio quae qui nihil blanditiis et dolorem.",
                "length_in_seconds": 611338636,
                "soundslice_slug": "Illo est molestias est quaerat. Ab et porro cumque et quod et maxime ut. Ad labore magni tempore facere veniam est voluptatibus.",
                "staff_pick_rating": 132184639,
                "student_id": 884610992,
                "vimeo_video_id": "Tempore rerum quo repellendus. Dolores esse et animi deserunt. Ut non reprehenderit et perspiciatis labore cum.",
                "youtube_video_id": "Eos dolore quae deserunt. Sit deleniti deleniti numquam. Quaerat non possimus perspiciatis autem porro et. Ut accusamus aliquid eum. Et est et perspiciatis molestias consequuntur repellat. Quia omnis alias dolor doloremque sunt et tempore."
            }
        }
    ],
    "meta": {
        "pagination": {
            "total": 12,
            "count": 2,
            "per_page": 2,
            "current_page": 4,
            "total_pages": 6
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=4",
        "first": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=1",
        "prev": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=3",
        "next": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=5",
        "last": "http:\/\/localhost\/railcontent\/comment\/3?limit=2&page=6"
    }
}
```




<!-- END_3beda97b8a46ab8885399051f413b5e1 -->

<!-- START_5a905c9e9e8df6e1c999d38d3ad1c599 -->
## Authenticated user like a comment.


### HTTP Request
    `PUT railcontent/comment-like/{id}`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment-like/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": "commentlike",
        "id": "1",
        "attributes": {
            "user": "1",
            "created_on": "2019-05-29 12:06:37"
        },
        "relationships": {
            "comment": {
                "data": {
                    "type": "comment",
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
                "slug": "In sunt eum voluptas assumenda modi nulla. Et id id error odit repellendus. Impedit quibusdam debitis sed perspiciatis facere rerum excepturi. Deleniti ut molestiae sint qui. Dignissimos ut sint aliquid ducimus. Minima illum quas eos autem.",
                "type": "course",
                "sort": "1174885447",
                "status": "scheduled",
                "brand": "brand",
                "language": "Consequatur quo explicabo voluptatem ut similique tempora explicabo. Molestiae deleniti atque iste soluta eius repellat. Quia culpa necessitatibus modi et quas maxime id. Id eaque deleniti odit qui ea. Veritatis est voluptas sed nihil saepe.",
                "user": "",
                "published_on": {
                    "date": "1987-11-17 23:32:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "2005-03-31 13:06:50.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "1976-11-24 07:49:52.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Enim rerum commodi cumque corrupti voluptatem commodi similique a. Id quis labore molestiae illo. Occaecati impedit placeat consequuntur et neque nulla. Eum odio nemo dolor ducimus facilis quisquam et. Ea consectetur ut animi nam nihil.",
                "home_staff_pick_rating": "179108163",
                "legacy_id": 673951239,
                "legacy_wordpress_post_id": 1983195049,
                "qna_video": "Exercitationem dolorem architecto error quis incidunt rem ducimus. Quia vel consequuntur eum nobis laboriosam quia eos. Est et qui fugit harum tempora iure. Mollitia dolores doloremque iusto necessitatibus facere voluptatibus accusamus.",
                "style": "Ut dolore debitis ea optio error sunt dolorem. Molestias natus molestiae quia commodi. Reprehenderit dolore quo illum nemo ut ad. Rerum et et animi cumque adipisci. Mollitia voluptas corrupti recusandae. Provident culpa ad nesciunt praesentium.",
                "title": "Laborum quia aspernatur est ullam dolores.",
                "xp": 1085635816,
                "album": "Nostrum mollitia et quo doloribus iure aliquam velit. Nam voluptas sed quia illo. Reiciendis ut dolorem est occaecati sapiente molestias dolor. Labore distinctio aut eius odit recusandae nulla.",
                "artist": "Voluptatem beatae fugit in amet. Dolorum et provident qui officia aut ut neque. Error quia pariatur cupiditate qui enim.",
                "bpm": "Qui esse cumque et rerum. Voluptas ea molestiae voluptate necessitatibus omnis. Quia qui rem eum voluptates ratione. Enim est in dolores reprehenderit consequatur ipsa.",
                "cd_tracks": "Corporis tempora ea sint labore porro ab similique. Eaque animi sed rerum. Magnam eum quia voluptatem deleniti. Placeat qui tempore illum eos.",
                "chord_or_scale": "Corporis qui eos consectetur expedita facilis non officia. Sint eligendi corporis unde ipsum. Quod iusto rerum fugit qui omnis voluptatem ut.",
                "difficulty_range": "Vel id eligendi ex. Dignissimos incidunt enim doloribus saepe voluptatem maiores. Autem distinctio esse quo quos minima tenetur voluptatem. Consectetur non ea totam ut a nisi dignissimos.",
                "episode_number": 1977671088,
                "exercise_book_pages": "Accusamus dolorem explicabo dicta ducimus. Qui et dolorem sit sunt illum. Nostrum pariatur quasi non quisquam iure.",
                "fast_bpm": "Soluta fuga at ipsa. Quod quia deleniti sint vel id molestiae. Quibusdam sunt sint recusandae numquam.",
                "includes_song": true,
                "instructors": "Quos non odio a iure sunt. Blanditiis quasi et accusantium reiciendis qui. Sit maxime ducimus veniam autem. Aliquam laboriosam adipisci enim iusto laboriosam.",
                "live_event_start_time": {
                    "date": "2011-01-12 23:39:47.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1978-08-27 11:42:17.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Voluptatem sed enim mollitia voluptas officia dolorem odit. Eveniet ipsum quidem expedita eos omnis non et fugit. Qui ex vitae iste ea placeat similique soluta perferendis. Molestias sint tempora aut a ut.",
                "live_stream_feed_type": "Explicabo dolorum qui dolorum. Id nam vel enim. Harum sunt illum aliquam ullam velit quis. Vitae inventore sunt alias ipsum est.",
                "name": "Nisi at est assumenda consectetur. Voluptates tempora autem repudiandae enim facere cupiditate. Nesciunt quasi qui voluptas voluptas perspiciatis.",
                "released": "Ratione hic ipsa aperiam. Voluptatum ab tenetur tempora necessitatibus impedit earum. Quia quidem possimus ducimus dolores voluptate optio eum.",
                "slow_bpm": "Assumenda aut numquam qui quia molestiae tempora itaque. Exercitationem ipsa magni dolor nemo minima eius eaque. Repudiandae porro blanditiis est voluptas. Qui facere delectus deserunt aut sint eum. Quo eum voluptatem non sit quidem qui ut modi.",
                "total_xp": "Ipsa minima vel fuga quia ex voluptatem. Non ut necessitatibus et.",
                "transcriber_name": "Molestiae quia ut sed et reprehenderit autem. Quam ut non esse dolorem perspiciatis. Debitis rerum dolorem voluptas unde consequatur nesciunt in.",
                "week": 535038345,
                "avatar_url": "Est illum praesentium omnis non. Itaque perspiciatis atque beatae quisquam sed sapiente possimus. Nobis impedit molestiae voluptas dolores eum quod. Error sint quos molestias alias dignissimos placeat.",
                "length_in_seconds": 862032886,
                "soundslice_slug": "Laudantium voluptates earum tempora aut aspernatur. Autem corporis autem reiciendis unde error. Minus qui molestiae et doloribus sed. Recusandae cum sed aperiam quo voluptatem voluptatum. Qui tempore veniam culpa consequatur optio qui voluptas.",
                "staff_pick_rating": 1817049882,
                "student_id": 1859716395,
                "vimeo_video_id": "Tenetur aspernatur et fugiat vel ut ex dolorem. Sed debitis rerum ut atque omnis.",
                "youtube_video_id": "Ut dolores aliquid alias quidem officia. Minus velit molestiae eum aut. Velit totam accusantium est libero. Commodi quis mollitia ratione. Consectetur non doloremque vel quia. Quam ratione aut autem qui. Qui est culpa odio voluptatem."
            }
        },
        {
            "type": "comment",
            "id": "1",
            "attributes": {
                "comment": "Odit rerum quo maiores porro molestiae sit et. Rem assumenda deserunt facilis laborum est possimus qui suscipit. Dolore quasi harum omnis eveniet consequatur. Dolorem nihil incidunt accusantium ab id. Qui sequi et exercitationem illo.",
                "temporary_display_name": "Illum rem eos consequatur sunt et. Iure error et et quasi quia qui. Exercitationem maxime vel quisquam tempora repudiandae. Cumque non delectus temporibus.",
                "user": "2",
                "created_on": {
                    "date": "2006-02-11 10:50:13.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
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
        }
    ]
}
```




<!-- END_5a905c9e9e8df6e1c999d38d3ad1c599 -->

<!-- START_f93a1974aa0b0e828f72446fa23d4419 -->
## Authenticated user dislike a comment.


### HTTP Request
    `DELETE railcontent/comment-like/{id}`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment-like/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
[]
```




<!-- END_f93a1974aa0b0e828f72446fa23d4419 -->

