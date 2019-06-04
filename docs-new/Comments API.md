# Comments API

# JSON Endpoints


<!-- START_f625f9c6a130f4a7897d109f2ba98bc6 -->
## Create a new comment


### HTTP Request
    `PUT railcontent/comment`


### Permissions
    - Must be logged in
    - The content type should allow comments
    
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
[
    "        return [",
    "            'data.type' => 'required|in:comment',",
    "            'data.attributes.comment' => 'required|max:10024',",
    "            'data.relationships.content.data.type' => 'required|in:content',",
    "            'data.relationships.content9.data.id' => 'nullable|numeric|exists:' .",
    "                config('railcontent.table_prefix') .",
    "                'content' .",
    "                ',id',",
    "            'data.relationships.content.data.id' =>",
    "                ['nullable',",
    "                    'numeric',",
    "                    Rule::exists(",
    "                        config('railcontent.database_connection_name') . '.' . config('railcontent.table_prefix'). 'content', 'id'",
    "                    )->where(function ($query) {",
    "                        if (is_array(ContentRepository::$availableContentStatues)) {",
    "                            $query->whereIn('status', ContentRepository::$availableContentStatues);",
    "                        }",
    "                    })",
    "                ],",
    "        ];"
]
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
        "id": "3",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
            "temporary_display_name": "in",
            "user": "1",
            "created_on": "2019-06-04 13:45:32",
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




<!-- END_f625f9c6a130f4a7897d109f2ba98bc6 -->

<!-- START_26daf74246cc31035b3821e283f2c144 -->
## Update a comment


### HTTP Request
    `PATCH railcontent/comment/{id}`


### Permissions
    - Must be logged in to modify own comments
    - Must be logged in with an administrator account to modify other user comments
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|  yes  ||
|body|data.type|  yes  |Must be 'comment'.|
|body|data.attributes.comment|    |The text of the comment.|
|body|data.attributes.temporary_display_name|    ||
|body|data.relationships.content.data.type|    |Must be 'content'.|
|body|data.relationships.content.data.id|    |Must exists in contents.|
|body|data.relationships.parent.data.type|    |Must be 'comment'.|
|body|data.relationships.parent.data.id|    |Must exists in comments.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:comment',",
    "            'data.attributes.comment' => 'nullable|max:10024',",
    "            'data.relationships.content.data.type' => 'in:content',",
    "            'data.relationships.content.data.id' =>",
    "                ['numeric',",
    "                    Rule::exists(",
    "                        config('railcontent.database_connection_name') . '.' .",
    "                        config('railcontent.table_prefix'). 'content',",
    "                        'id'",
    "                    )->where(",
    "                        function ($query) {",
    "                            if (is_array(ContentRepository::$availableContentStatues)) {",
    "                                $query->whereIn('status', ContentRepository::$availableContentStatues);",
    "                            }",
    "                        }",
    "                    )",
    "                ],",
    "            'data.relationships.parent.data.type' => 'in:comment',",
    "            'data.relationships.parent.data.id' => 'numeric|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'comments' . ',id',",
    "            'data.attributes.temporary_display_name' => 'filled'",
    "        ];"
]
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
            "temporary_display_name": "quaerat"
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            },
            "parent": {
                "data": {
                    "type": "comment",
                    "id": 2
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

### Response Example (201):

```json
{
    "data": {
        "type": "comment",
        "id": "1",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
            "temporary_display_name": "Cum quis rerum nam temporibus. Cum quia ratione aut consequatur. Eaque et nisi soluta dicta illum error. Beatae eveniet ea commodi.",
            "user": "1",
            "created_on": {
                "date": "1994-04-26 19:15:01.000000",
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
            },
            "replies": {
                "data": [
                    {
                        "type": "comment",
                        "id": "2"
                    }
                ]
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Nihil aliquam mollitia dignissimos ipsa. Fuga et harum et quia. Magni nisi laborum et velit quis quos.",
                "temporary_display_name": "Qui ex hic veritatis iure ea quidem eaque. Saepe est consequatur assumenda voluptates natus quasi. Temporibus sunt cum similique dolorem est debitis ex nisi. Rerum et sint explicabo quia consequatur eligendi consequatur.",
                "user": "1",
                "created_on": {
                    "date": "1999-08-08 17:21:39.000000",
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
|query|comment_id|  yes  |//     * @response 204 { }|


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
null
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
[
    "        return [",
    "            'data.type' => 'required|in:comment',",
    "            'data.attributes.comment' => 'required|max:10024',",
    "            'data.relationships.parent.data.type' => 'required|in:comment',",
    "            'data.relationships.parent.data.id' => 'required|numeric|exists:' .",
    "                config('railcontent.database_connection_name') .",
    "                '.' .",
    "                config('railcontent.table_prefix') .",
    "                'comments' .",
    "                ',id',",
    "        ];"
]
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
        "id": "3",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim",
            "temporary_display_name": "",
            "user": "1",
            "created_on": "2019-06-04 13:45:32",
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
|query|content_type|    |string pull for the contents with given type|
|query|page|    |integer Default:1.|
|query|limit|    |integer Default:10.|
|query|sort|    |string Default:'-created_on'.|


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
            "id": "1",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
                "temporary_display_name": "Cum quis rerum nam temporibus. Cum quia ratione aut consequatur. Eaque et nisi soluta dicta illum error. Beatae eveniet ea commodi.",
                "user": "1",
                "created_on": {
                    "date": "1994-04-26 19:15:01.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32",
                "like_count": "0",
                "is_liked": false
            },
            "relationships": {
                "content": {
                    "data": {
                        "type": "content",
                        "id": "1"
                    }
                },
                "replies": {
                    "data": [
                        {
                            "type": "comment",
                            "id": "2"
                        },
                        {
                            "type": "comment",
                            "id": "3"
                        }
                    ]
                }
            }
        }
    ],
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Nihil aliquam mollitia dignissimos ipsa. Fuga et harum et quia. Magni nisi laborum et velit quis quos.",
                "temporary_display_name": "Qui ex hic veritatis iure ea quidem eaque. Saepe est consequatur assumenda voluptates natus quasi. Temporibus sunt cum similique dolorem est debitis ex nisi. Rerum et sint explicabo quia consequatur eligendi consequatur.",
                "user": "1",
                "created_on": {
                    "date": "1999-08-08 17:21:39.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32"
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
            "id": "3",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim",
                "temporary_display_name": "",
                "user": "1",
                "created_on": "2019-06-04 13:45:32",
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
    ],
    "meta": {
        "totalCommentsAndReplies": "2",
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/comment?page=1&limit=10&sort=-created_on",
        "first": "http:\/\/localhost\/railcontent\/comment?page=1&limit=10&sort=-created_on",
        "last": "http:\/\/localhost\/railcontent\/comment?page=1&limit=10&sort=-created_on"
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
|query|comment_id|    |integer required|
|body|limit|    |default:10|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
{
    "limit": 5
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
            "id": "1",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
                "temporary_display_name": "Cum quis rerum nam temporibus. Cum quia ratione aut consequatur. Eaque et nisi soluta dicta illum error. Beatae eveniet ea commodi.",
                "user": "1",
                "created_on": {
                    "date": "1994-04-26 19:15:01.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32",
                "like_count": "0",
                "is_liked": false
            },
            "relationships": {
                "content": {
                    "data": {
                        "type": "content",
                        "id": "1"
                    }
                },
                "replies": {
                    "data": [
                        {
                            "type": "comment",
                            "id": "2"
                        },
                        {
                            "type": "comment",
                            "id": "3"
                        }
                    ]
                }
            }
        }
    ],
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Nihil aliquam mollitia dignissimos ipsa. Fuga et harum et quia. Magni nisi laborum et velit quis quos.",
                "temporary_display_name": "Qui ex hic veritatis iure ea quidem eaque. Saepe est consequatur assumenda voluptates natus quasi. Temporibus sunt cum similique dolorem est debitis ex nisi. Rerum et sint explicabo quia consequatur eligendi consequatur.",
                "user": "1",
                "created_on": {
                    "date": "1999-08-08 17:21:39.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32"
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
            "id": "3",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim",
                "temporary_display_name": "",
                "user": "1",
                "created_on": "2019-06-04 13:45:32",
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
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 5,
            "current_page": 1,
            "total_pages": 1
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/comment\/1?comment_id=1&page=1",
        "first": "http:\/\/localhost\/railcontent\/comment\/1?comment_id=1&page=1",
        "last": "http:\/\/localhost\/railcontent\/comment\/1?comment_id=1&page=1"
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
|query|comment_id|  yes  |//     * @responseFile ../../../../../docs/commentLikeResponse.json|

### Validation Rules
```php
[
    "        return [];"
]
```

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
            "created_on": "2019-06-04 13:45:32"
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Nihil aliquam mollitia dignissimos ipsa. Fuga et harum et quia. Magni nisi laborum et velit quis quos.",
                "temporary_display_name": "Qui ex hic veritatis iure ea quidem eaque. Saepe est consequatur assumenda voluptates natus quasi. Temporibus sunt cum similique dolorem est debitis ex nisi. Rerum et sint explicabo quia consequatur eligendi consequatur.",
                "user": "1",
                "created_on": {
                    "date": "1999-08-08 17:21:39.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32"
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
            "id": "3",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim",
                "temporary_display_name": "",
                "user": "1",
                "created_on": "2019-06-04 13:45:32",
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
        {
            "type": "comment",
            "id": "1",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
                "temporary_display_name": "Cum quis rerum nam temporibus. Cum quia ratione aut consequatur. Eaque et nisi soluta dicta illum error. Beatae eveniet ea commodi.",
                "user": "1",
                "created_on": {
                    "date": "1994-04-26 19:15:01.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-04 13:45:32",
                "like_count": "0",
                "is_liked": false
            },
            "relationships": {
                "content": {
                    "data": {
                        "type": "content",
                        "id": "1"
                    }
                },
                "replies": {
                    "data": [
                        {
                            "type": "comment",
                            "id": "2"
                        },
                        {
                            "type": "comment",
                            "id": "3"
                        }
                    ]
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

### Validation Rules
```php
[
    "        return [];"
]
```

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

