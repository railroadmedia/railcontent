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
            "created_on": "2019-06-05 11:00:15",
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
            "temporary_display_name": "autem"
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
            "temporary_display_name": "Consectetur cumque quibusdam est esse non impedit. Corrupti enim assumenda sunt voluptatum sit quos aut qui. Aut et odio sunt ipsam repellat. Iusto dolorem velit est rerum quis.",
            "user": "1",
            "created_on": {
                "date": "1976-07-27 10:11:57.000000",
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Quo et distinctio repudiandae dolores non facilis minima. Sed aut ipsa molestiae neque voluptatem incidunt nemo. Enim et officia et ut corporis blanditiis iure. Quia ut aperiam voluptatem veniam corrupti. Eos magni eveniet voluptas vero.",
                "temporary_display_name": "Ratione dolor fuga labore praesentium voluptatum laborum. Praesentium unde porro et impedit sunt. Consequatur et enim quia in. Dolor magnam nisi voluptatem.",
                "user": "1",
                "created_on": {
                    "date": "1978-07-27 01:55:11.000000",
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
        "id": "4",
        "attributes": {
            "comment": "Omnis doloremque reiciendis enim",
            "temporary_display_name": "",
            "user": "1",
            "created_on": "2019-06-05 11:00:15",
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




<!-- END_7ce1a818c2f016fa930880c23ef690f8 -->

<!-- START_c209c8d8b857438eb1c1eeda5a870ead -->
## List comments


### HTTP Request
    `GET railcontent/comment`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|content_id|    |the comments for given content id|
|body|user_id|    |user's comments|
|body|content_type|    |pull for the contents with given type|
|body|page|    |Which page to load, will be {limit} long.By default:1.|
|body|limit|    |How many to load per page. By default:10.|
|body|sort|    |Default:'-created_on'.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment',
{
    "content_id": "",
    "user_id": "",
    "content_type": "",
    "page": 1,
    "limit": 10,
    "sort": "-created_on"
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
            "id": "3",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
                "temporary_display_name": "in",
                "user": "1",
                "created_on": "2019-06-05 11:00:15",
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
        "self": "http:\/\/localhost\/railcontent\/comment?page=1",
        "first": "http:\/\/localhost\/railcontent\/comment?page=1",
        "last": "http:\/\/localhost\/railcontent\/comment?page=1"
    }
}
```




<!-- END_c209c8d8b857438eb1c1eeda5a870ead -->

<!-- START_3beda97b8a46ab8885399051f413b5e1 -->
## List linked comments, the current page it&#039;s the page with the comment


### HTTP Request
    `GET railcontent/comment/{id}`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|comment_id|    |integer required|
|body|limit|    |How many to load per page. By default:10|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/comment/1',
{
    "limit": 10
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
            "id": "3",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.",
                "temporary_display_name": "in",
                "user": "1",
                "created_on": "2019-06-05 11:00:15",
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
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
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
            "created_on": "2019-06-05 11:00:15"
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Quo et distinctio repudiandae dolores non facilis minima. Sed aut ipsa molestiae neque voluptatem incidunt nemo. Enim et officia et ut corporis blanditiis iure. Quia ut aperiam voluptatem veniam corrupti. Eos magni eveniet voluptas vero.",
                "temporary_display_name": "Ratione dolor fuga labore praesentium voluptatum laborum. Praesentium unde porro et impedit sunt. Consequatur et enim quia in. Dolor magnam nisi voluptatem.",
                "user": "1",
                "created_on": {
                    "date": "1978-07-27 01:55:11.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-05 11:00:15"
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
            "id": "4",
            "attributes": {
                "comment": "Omnis doloremque reiciendis enim",
                "temporary_display_name": "",
                "user": "1",
                "created_on": "2019-06-05 11:00:15",
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
                "temporary_display_name": "Consectetur cumque quibusdam est esse non impedit. Corrupti enim assumenda sunt voluptatum sit quos aut qui. Aut et odio sunt ipsam repellat. Iusto dolorem velit est rerum quis.",
                "user": "1",
                "created_on": {
                    "date": "1976-07-27 10:11:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-05 11:00:15"
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
                            "id": "4"
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

