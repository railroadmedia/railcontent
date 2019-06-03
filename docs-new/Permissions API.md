# Permissions API

# JSON Endpoints


<!-- START_82b005afd78be37707ededcd4afc2d84 -->
## railcontent/permission

### HTTP Request
    `GET railcontent/permission`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "permission",
            "id": "1",
            "attributes": {
                "name": "Ratione illo deserunt eos ducimus beatae esse. Velit qui neque eveniet dolores blanditiis voluptatem. Iste dolor delectus eos in dolorem consequatur.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "Rerum dolores omnis voluptate exercitationem. Provident labore suscipit eum possimus. Voluptatibus voluptas est est qui. Dolor in nisi voluptas omnis cupiditate qui voluptas beatae.",
                "brand": "brand"
            }
        }
    ]
}
```




<!-- END_82b005afd78be37707ededcd4afc2d84 -->

<!-- START_00fbbab029caab0b24691443083c1788 -->
## Create a new permission and return it in JSON API format


### HTTP Request
    `PUT railcontent/permission`


### Permissions
    - create.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|    |Must be 'permission'.|
|body|data.attributes.name|    |Permission name.|
|body|data.attributes.brand|    |brand|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:permission',",
    "            'data.attributes.name' => 'required|max:255',",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission',
{
    "data": {
        "type": "permission",
        "attributes": {
            "name": "Permission 1",
            "brand": "id"
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
        "type": "permission",
        "id": "3",
        "attributes": {
            "name": "Permission 1",
            "brand": "brand"
        }
    }
}
```




<!-- END_00fbbab029caab0b24691443083c1788 -->

<!-- START_4342e3c5e05a771e85749f018f936e97 -->
## Dissociate (&quot;unattach&quot;) permissions from a specific content or all content of a certain type


### HTTP Request
    `PATCH railcontent/permission/dissociate`


### Permissions
    - disociate.permissions required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentPermission'.|
|body|data.attributes.content_type|    |Required without content.|
|body|data.relationships.permission.data.type|  yes  |Must be 'permission'.|
|body|data.relationships.permission.data.id|  yes  |Must exists in permission.|
|body|data.relationships.content.data.type|    |Required without content_type.  Must be 'content'.|
|body|data.relationships.content.data.id|    |Required without content_type. Must exists in content.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:contentPermission',",
    "            'data.relationships.permission.data.type' => 'required|in:permission',",
    "            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'permissions' . ',id',",
    "            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',",
    "            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',id',",
    "            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',type'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/dissociate',
{
    "data": {
        "type": "contentPermission",
        "attributes": {
            "content_type": "course"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 1
                }
            },
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




<!-- END_4342e3c5e05a771e85749f018f936e97 -->

<!-- START_d4001b71581880f49c6f7083414bd750 -->
## Update a permission if exist and return it in JSON API format


### HTTP Request
    `PATCH railcontent/permission/{permissionId}`


### Permissions
    - update.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|    |Must be 'permission'.|
|body|data.attributes.name|    |Permission name.|
|body|data.attributes.brand|    |brand|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:permission',",
    "            'data.attributes.name' => 'required|max:255',",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
{
    "data": {
        "type": "permission",
        "attributes": {
            "name": "Permission 1",
            "brand": "quia"
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
        "type": null,
        "id": "",
        "attributes": {
            "name": null,
            "brand": null
        }
    }
}
```




<!-- END_d4001b71581880f49c6f7083414bd750 -->

<!-- START_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->
## Delete a permission if exist and it&#039;s not linked with content id or content type


### HTTP Request
    `DELETE railcontent/permission/{permissionId}`


### Permissions
    - delete.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->

<!-- START_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->
## Attach permission to a specific content or to all content of a certain type


### HTTP Request
    `PUT railcontent/permission/assign`


### Permissions
    - assign.permission required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentPermission'.|
|body|data.attributes.content_type|    |Required without content.|
|body|data.relationships.permission.data.type|    |Must be 'permission'.|
|body|data.relationships.permission.data.id|    |Must exists in permission.|
|body|data.relationships.content.data.type|    |Required without content_type.  Must be 'content'.|
|body|data.relationships.content.data.id|    |Required without content_type. Must exists in content.|

### Validation Rules
```php
[
    "        return [",
    "            'data.type' => 'required|in:contentPermission',",
    "            'data.relationships.permission.data.type' => 'required|in:permission',",
    "            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'permissions' . ',id',",
    "            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',",
    "            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',id',",
    "            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .",
    "                config('railcontent.database_connection_name') . '.' .",
    "                config('railcontent.table_prefix'). 'content' .",
    "                ',type'",
    "        ];"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/permission/assign',
{
    "data": {
        "type": "contentPermission",
        "attributes": {
            "content_type": "course"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": 1
                }
            },
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
        "type": "contentPermission",
        "id": "1",
        "attributes": {
            "content_type": "course",
            "brand": "brand"
        },
        "relationships": {
            "permission": {
                "data": {
                    "type": "permission",
                    "id": "1"
                }
            },
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
            "type": "permission",
            "id": "1",
            "attributes": {
                "name": "Ratione illo deserunt eos ducimus beatae esse. Velit qui neque eveniet dolores blanditiis voluptatem. Iste dolor delectus eos in dolorem consequatur.",
                "brand": "brand"
            }
        },
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




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

