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
            "created_on": "2019-06-04 13:45:32"
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
                "slug": "Hic odit ratione tenetur quam. Dolores qui cum consequatur enim natus fuga et illum. Impedit voluptates quis doloribus dolores expedita. Soluta sit ab tempore aut quis quidem eaque. Quaerat quam eius neque itaque fugiat iste.",
                "type": "course",
                "sort": "1846408275",
                "status": "published",
                "brand": "brand",
                "language": "Dolores commodi earum ut. Impedit rerum rerum ut officia. Sint nulla voluptatem ducimus beatae explicabo recusandae impedit.",
                "user": "1",
                "published_on": {
                    "date": "1989-12-06 00:15:26.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1973-04-28 07:23:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "1988-11-29 11:48:05.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
                "home_staff_pick_rating": "211594015",
                "legacy_id": 2029105382,
                "legacy_wordpress_post_id": 2110749050,
                "qna_video": "Quas ab repudiandae facere aut impedit aspernatur. Est hic dicta ut et quidem aliquid natus. Accusantium asperiores dolorem voluptas quas delectus natus voluptates. Explicabo error quae dolor et neque.",
                "style": "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
                "title": "Quasi qui modi ad dolores enim iusto est.",
                "xp": 465338215,
                "album": "Enim officia qui aspernatur amet magnam. Ut voluptate et soluta est soluta et eligendi. Aspernatur iusto molestiae perspiciatis veritatis optio. Quidem quas nesciunt ipsum vel. Omnis aut inventore rerum laborum sit.",
                "artist": "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
                "bpm": "Enim et voluptatem cupiditate. Facere iure id autem. Voluptas aut exercitationem deserunt neque voluptatem.",
                "cd_tracks": "Molestias rerum doloribus sit aut quis quas. Aliquam beatae libero sed. Dolorum quia est aut fuga. Sint omnis id aut occaecati et et natus.",
                "chord_or_scale": "Vitae ut ipsa aliquam impedit accusamus. Molestiae eos laudantium et eum tempore. Asperiores omnis libero natus earum inventore enim id. Eum ducimus libero repudiandae perferendis rerum labore ducimus.",
                "difficulty_range": "Consequuntur autem pariatur est et. Aspernatur sed ratione nesciunt. Quo porro eum quia ullam eum. Fugiat aut quaerat dolor maiores aut. Illo voluptatem ullam tempora voluptatem. Totam omnis ut molestias consequuntur.",
                "episode_number": 870317541,
                "exercise_book_pages": "Sed minima voluptatibus qui et ad voluptatem rerum. Nobis et impedit necessitatibus sit. Porro vel numquam laboriosam dicta quod. Porro accusamus nam rerum omnis alias quibusdam praesentium.",
                "fast_bpm": "Cumque in molestiae ea dolore rerum facilis. Et iusto molestiae doloremque. Sint est quia dolor odio voluptatum ea unde. Doloribus autem voluptas et dignissimos eaque. Expedita aut vel a.",
                "includes_song": true,
                "instructors": "Sed eum fuga delectus ex. Esse explicabo pariatur quos a. Qui mollitia nisi molestiae dolores adipisci et aut totam. Ut sit sapiente laborum.",
                "live_event_start_time": {
                    "date": "2012-10-01 00:06:20.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1972-08-02 00:32:19.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Adipisci est earum reiciendis et quia a. Dolore vel ducimus et occaecati iure sed vel sit. Et voluptatum ut doloribus sunt.",
                "live_stream_feed_type": "Assumenda soluta similique eligendi. Eos libero sequi assumenda. Tempora et sint adipisci voluptatem magni ex. Ullam nisi nobis tenetur beatae occaecati. Voluptate repudiandae animi minus sint debitis.",
                "name": "Nostrum nobis minus modi qui sit. Accusantium autem inventore possimus optio dolorum repellat reprehenderit. Consequuntur sed dignissimos voluptatum alias totam.",
                "released": "Rerum blanditiis optio ut eveniet aut. Vel quo fugiat soluta autem quasi eos quia. Quos provident iusto nostrum officiis deleniti harum.",
                "slow_bpm": "Quidem sequi architecto mollitia natus. Ad sed nulla vitae dolores provident accusamus aliquam. Blanditiis officia qui voluptatem veritatis porro tenetur voluptate.",
                "total_xp": "Qui minus unde et nobis. Voluptatem sed veritatis non sit iusto. Exercitationem est doloremque rerum dolorem rerum laudantium rem. Sit ea porro cumque autem.",
                "transcriber_name": "Enim enim consequatur ut optio. Mollitia fugit error qui quia dolor et sed vel. Nobis rerum nam est eaque aut.",
                "week": 1549229504,
                "avatar_url": "Amet qui voluptas consequatur expedita facere aut nihil. Et sit autem laboriosam sunt beatae. Magni explicabo et eos nihil tenetur et et. Doloremque dolorum animi corrupti architecto.",
                "length_in_seconds": 1889120521,
                "soundslice_slug": "At rerum totam et et. Suscipit in quaerat velit sunt provident dolorem ducimus. Quae ea pariatur tempore odit in et.",
                "staff_pick_rating": 1882244654,
                "student_id": 1107745055,
                "vimeo_video_id": "Qui similique dolor doloremque rerum deserunt error velit nihil. Ut vel laboriosam dicta numquam nam ad assumenda exercitationem. Unde est voluptatibus error repudiandae eius id esse. Odio quibusdam labore sed maxime.",
                "youtube_video_id": "Voluptas eaque ipsum in quod perferendis qui provident. Nemo minus quos minus deserunt delectus magnam. Ducimus impedit provident cupiditate dolorem. Nihil dolor deserunt nihil repellat. Ad assumenda nam molestiae qui."
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

