# Content Likes API

# JSON Endpoints


<!-- START_6bf34590090ea43f90bc0b8aca783f73 -->
## Fetch likes for content with pagination.


### HTTP Request
    `GET railcontent/content-like/{id}`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content-like/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [],
    "meta": {
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/content-like\/1?page=1",
        "first": "http:\/\/localhost\/railcontent\/content-like\/1?page=1",
        "last": "http:\/\/localhost\/railcontent\/content-like\/1?page=0"
    }
}
```




<!-- END_6bf34590090ea43f90bc0b8aca783f73 -->

<!-- START_c864f9442ee531ba11d7259fb511a17c -->
## Authenticated user like content.


### HTTP Request
    `PUT railcontent/content-like`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in contents.|

### Validation Rules
```php
[
    "        return [",
    "            'data.relationships.content.data.type' => 'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content-like',
{
    "data": {
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
        "type": "contentlike",
        "id": "1",
        "attributes": {
            "user": "1",
            "created_on": "2019-06-05 11:00:15"
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "published_on": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
            }
        }
    ]
}
```




<!-- END_c864f9442ee531ba11d7259fb511a17c -->

<!-- START_4f7915ff2544f600944155f3e2c529eb -->
## Authenticated user dislike content.


### HTTP Request
    `DELETE railcontent/content-like`


### Permissions
    - authenticated user
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in contents.|

### Validation Rules
```php
[
    "        return [",
    "            'data.relationships.content.data.type' => 'required|in:content',",
    "            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' . ',id'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content-like',
{
    "data": {
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
{}
```




<!-- END_4f7915ff2544f600944155f3e2c529eb -->

