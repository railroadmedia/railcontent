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
        return [
            'data.type' => 'required|in:comment',
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.content.data.type' => 'required|in:content',
            'data.relationships.content.data.id' => 'nullable|numeric|exists:' .
                config('railcontent.table_prefix') .
                'content' .
                ',id',
            'data.relationships.content.data.id' =>
                ['nullable',
                    'numeric',
                    Rule::exists(
                        config('railcontent.database_connection_name') . '.' . config('railcontent.table_prefix'). 'content', 'id'
                    )->where(function ($query) {
                        if (is_array(ContentRepository::$availableContentStatues)) {
                            $query->whereIn('status', ContentRepository::$availableContentStatues);
                        }
                    })
                ],
        ];
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
            "created_on": "2019-06-06 11:52:55",
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
        return [
            'data.type' => 'required|in:comment',
            'data.attributes.comment' => 'nullable|max:10024',
            'data.relationships.content.data.type' => 'in:content',
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
            'data.relationships.parent.data.type' => 'in:comment',
            'data.relationships.parent.data.id' => 'numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'comments' . ',id',
            'data.attributes.temporary_display_name' => 'filled'
        ];
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
            "temporary_display_name": "voluptates"
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
            "temporary_display_name": "Commodi ut sed porro sit consectetur ea veniam. Iusto ex in doloremque aut enim dolores. Harum necessitatibus explicabo quia illo laudantium officiis optio.",
            "user": "1",
            "created_on": {
                "date": "2005-03-28 04:48:49.000000",
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Blanditiis ut et similique reprehenderit facere veniam quisquam. Quasi est mollitia quod dolor. Natus suscipit aliquid voluptate et omnis est velit. Repudiandae enim est rerum. Sint a provident rerum quaerat. Ipsam vel molestiae recusandae temporibus.",
                "temporary_display_name": "Vel fugit et dolore delectus. Eaque velit sunt rerum consequatur. Hic incidunt id voluptas provident maiores aliquam.",
                "user": "1",
                "created_on": {
                    "date": "2012-10-09 09:22:39.000000",
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
        return [
            'data.type' => 'required|in:comment',
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.parent.data.type' => 'required|in:comment',
            'data.relationships.parent.data.id' => 'required|numeric|exists:' .
                config('railcontent.database_connection_name') .
                '.' .
                config('railcontent.table_prefix') .
                'comments' .
                ',id',
        ];
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
            "created_on": "2019-06-06 11:52:55",
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
                "created_on": "2019-06-06 11:52:55",
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
                "created_on": "2019-06-06 11:52:55",
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
        return [];
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
            "created_on": "2019-06-06 11:52:55"
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
        },
        {
            "type": "comment",
            "id": "2",
            "attributes": {
                "comment": "Blanditiis ut et similique reprehenderit facere veniam quisquam. Quasi est mollitia quod dolor. Natus suscipit aliquid voluptate et omnis est velit. Repudiandae enim est rerum. Sint a provident rerum quaerat. Ipsam vel molestiae recusandae temporibus.",
                "temporary_display_name": "Vel fugit et dolore delectus. Eaque velit sunt rerum consequatur. Hic incidunt id voluptas provident maiores aliquam.",
                "user": "1",
                "created_on": {
                    "date": "2012-10-09 09:22:39.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-06 11:52:55"
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
                "created_on": "2019-06-06 11:52:55",
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
                "temporary_display_name": "Commodi ut sed porro sit consectetur ea veniam. Iusto ex in doloremque aut enim dolores. Harum necessitatibus explicabo quia illo laudantium officiis optio.",
                "user": "1",
                "created_on": {
                    "date": "2005-03-28 04:48:49.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "deleted_at": "2019-06-06 11:52:55"
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
        return [];
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

