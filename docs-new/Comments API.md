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
            "created_on": "2019-06-03 14:09:42",
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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
            "temporary_display_name": "expedita"
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
            "temporary_display_name": "Enim blanditiis est ad velit voluptatem. Accusantium alias inventore nulla ipsam earum totam maxime. Qui adipisci incidunt voluptatem perspiciatis dolor ut.",
            "user": "1",
            "created_on": {
                "date": "1987-01-03 20:09:34.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "deleted_at": {
                "date": "2007-01-10 08:07:27.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Sit et aut non est dolorum maxime. Laboriosam expedita modi alias mollitia et soluta ratione numquam. Aspernatur voluptas voluptatum consequuntur commodi. Asperiores iusto unde earum in. Vel quos tempore voluptatem est pariatur.",
                "temporary_display_name": "Et modi non earum non laborum qui. Est quos libero mollitia excepturi. Consequatur explicabo quia nesciunt dolores. Et dolorem sunt sed aut est officiis accusantium.",
                "user": "1",
                "created_on": {
                    "date": "2019-03-12 18:26:43.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": {
                    "date": "1981-02-14 19:06:33.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                }
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
            "created_on": "2019-06-03 14:09:42",
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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

### Response Example (500):

```json
{
    "message": "Server Error"
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
    "limit": 6
}
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

