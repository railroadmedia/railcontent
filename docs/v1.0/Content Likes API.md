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
        return [
            'data.relationships.content.data.type' => 'required|in:content',
            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' . ',id'
        ];
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
            "created_on": "2019-06-06 11:52:55"
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
                "slug": "Quasi in eius quidem et. Est modi minus dolorem ut. Vel et magni reprehenderit occaecati esse dolores et. Sint doloremque non rerum et facere neque. Odio deleniti ut cupiditate eum eos temporibus alias. Natus aut est sint quia occaecati inventore quo.",
                "type": "course",
                "sort": "515430578",
                "status": "published",
                "brand": "brand",
                "language": "Id sed a reiciendis a debitis cumque aliquam. Et rerum harum voluptatem. Ut dolorem delectus voluptatibus incidunt sapiente sed perferendis. Iste necessitatibus dicta autem cumque reprehenderit distinctio.",
                "user": "1",
                "published_on": {
                    "date": "1987-05-25 11:13:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-05-28 07:02:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "1985-09-02 03:40:00.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
                "home_staff_pick_rating": "1530356095",
                "legacy_id": 926698209,
                "legacy_wordpress_post_id": 69139045,
                "qna_video": "Deleniti minus et enim doloribus iste dolores est. Libero ea repellendus sed. Id dolore dolores consectetur. Nam harum eum reprehenderit natus a facilis laborum consectetur.",
                "style": "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
                "title": "Consectetur porro unde fuga animi modi.",
                "xp": 31718887,
                "album": "Et earum voluptates odio impedit dicta repudiandae ut. Magnam ipsum accusantium est officiis iste quia reiciendis. Autem facilis nihil molestiae sapiente nostrum sapiente commodi.",
                "artist": "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
                "bpm": "Aspernatur non in sint earum. Hic dignissimos odio unde voluptas tenetur est autem.",
                "cd_tracks": "Autem modi qui dolorem quisquam quae in cupiditate. Aut vero qui ab adipisci voluptas vel qui quod. Amet accusamus quis ad ut sunt perferendis dolore. Id ut repellat saepe cumque. Sed velit nesciunt voluptas voluptatum.",
                "chord_or_scale": "Ullam nobis illum illo. Voluptatem id voluptatem dolores tenetur est. Tempore sunt tenetur dolore. Voluptatem placeat dicta rerum a adipisci nobis iste. Ea amet architecto repellendus repellat molestias ullam dolorem.",
                "difficulty_range": "Veritatis suscipit fugiat ipsam excepturi officia voluptatem. Aut enim facere eius dignissimos neque quos. Possimus eius quasi laboriosam molestiae. Quia omnis aspernatur et praesentium.",
                "episode_number": 1304655407,
                "exercise_book_pages": "Est consequatur ipsa dolore. Tempore et et velit temporibus minus tempore. Voluptas et maiores ipsa earum. Voluptas quis libero asperiores quis distinctio ut autem.",
                "fast_bpm": "Qui aut cupiditate ut laudantium. Est non est illum reprehenderit. Asperiores est modi consequatur impedit rerum autem. Necessitatibus non et vitae et rem corrupti.",
                "includes_song": true,
                "instructors": "Sit quidem sed eaque pariatur ea. Repellendus fugit ut totam occaecati quia. Quae dolorem ipsam repellendus rerum. Autem enim ex ullam laboriosam eveniet molestiae sit. Eum fugit ullam consectetur aut earum nostrum.",
                "live_event_start_time": {
                    "date": "2017-02-07 22:31:21.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1983-02-12 16:50:18.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Laboriosam ipsum distinctio minima ut distinctio necessitatibus atque. Veniam facere error neque aliquam. Eligendi fugit eos blanditiis accusamus.",
                "live_stream_feed_type": "Minus omnis eos eligendi numquam voluptates. Nobis vitae quo et corporis enim porro. Ullam aut eligendi et fuga consequatur et delectus. Quod recusandae id et voluptas soluta hic. Possimus qui quasi at amet quis consequuntur. Quam unde non alias.",
                "name": "Sunt et et officia rem qui quos. Voluptatibus reprehenderit labore totam. Nostrum soluta minima impedit laudantium. Aut consequatur doloribus consequatur omnis.",
                "released": "Sint nemo voluptates repudiandae vel tenetur enim. Tempore dolor ducimus voluptas itaque provident. Non sed ex ut.",
                "slow_bpm": "Tenetur rem aut maiores deserunt iusto. Iste vitae vitae natus nesciunt at vero. Est dolores praesentium enim pariatur a. Accusantium aut iure quisquam recusandae officia facilis.",
                "total_xp": "Est consectetur assumenda omnis nesciunt ratione ut ullam. Vitae voluptatum nihil non aliquam id. Id numquam odio non ullam reprehenderit quia aperiam.",
                "transcriber_name": "Qui harum reiciendis ut harum. Omnis velit non nisi est voluptate possimus delectus. Earum quidem sit nam libero eum doloremque et.",
                "week": 487183727,
                "avatar_url": "Reiciendis facilis at possimus. Suscipit est soluta asperiores corrupti maxime ut in mollitia. Voluptate ipsam qui maiores ratione suscipit hic ipsa. Suscipit qui laudantium reiciendis est sint consequatur similique.",
                "length_in_seconds": 1458903902,
                "soundslice_slug": "Facilis quo nisi delectus aliquam quia. Expedita nihil voluptas repellendus sit nisi provident pariatur commodi. Impedit qui sint aut placeat ea itaque. Dolor sit animi cum est inventore porro qui.",
                "staff_pick_rating": 889539890,
                "student_id": 269019524,
                "vimeo_video_id": "Tempore et temporibus fugiat odio laboriosam voluptas. Est provident modi distinctio est nihil non. Quia ad sunt animi dolores officia nobis. Id distinctio et nihil dolores. Corrupti sed quos molestiae rerum porro id ut. Non vel iusto et deleniti.",
                "youtube_video_id": "Odit ipsa et et corrupti esse recusandae est. Odit rem qui nisi illum id ut. Voluptate est unde in voluptas rem tempore."
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
        return [
            'data.relationships.content.data.type' => 'required|in:content',
            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' . ',id'
        ];
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

