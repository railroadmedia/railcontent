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
                "name": "Minus voluptatem repudiandae minus qui dolor eius sequi. Totam consequuntur non molestias alias iste. Quibusdam rem et harum sit ad. Sequi eligendi harum incidunt sint odit.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "Beatae qui ex ut quo. Sapiente nam consequatur velit tenetur rerum et est vel. Fugiat est adipisci iure tenetur inventore eveniet.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "3",
            "attributes": {
                "name": "Consequatur dolorem provident itaque consequatur. Et doloremque omnis in earum. Ex ab cum numquam ab laborum. Deserunt incidunt eligendi velit ea tempora vel molestias.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "4",
            "attributes": {
                "name": "Itaque dolores laudantium voluptatibus sed est expedita. Mollitia ea et vel voluptate. Eos odio velit possimus voluptatem dolorem.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "5",
            "attributes": {
                "name": "Enim minima perferendis nam inventore ut eos. Dolor est consequuntur sed veniam dolore. Eaque sit iste voluptatem molestias fugiat hic quae. Et praesentium fugiat eius earum facere.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "6",
            "attributes": {
                "name": "Voluptatem sit aut dolorem labore cum. Aspernatur a sapiente et culpa. Aut et voluptates natus nihil. Recusandae harum sit nobis veritatis.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "7",
            "attributes": {
                "name": "Eligendi enim aliquid et enim possimus molestiae nemo. Laborum libero ullam nihil. Provident quasi consectetur ullam ut. Ut praesentium nemo non sed dolor.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "8",
            "attributes": {
                "name": "Vero rem non natus veritatis aut beatae. Sunt corrupti qui et distinctio. Exercitationem tenetur qui enim laudantium. Ipsa laudantium dolores error minus aperiam eveniet numquam quas.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "9",
            "attributes": {
                "name": "Explicabo odit aliquam rerum expedita. Sed distinctio sunt nisi molestias. Explicabo ratione et autem dicta non ut labore odit. Sed adipisci nisi illum consequatur et ex quae. Sed quia eum nisi suscipit qui fuga eius. Est aut ab veritatis animi et.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "10",
            "attributes": {
                "name": "In sit rerum et possimus unde molestiae necessitatibus. Corrupti dolores et error quia. Corporis rerum quam tempora veniam molestias ipsum aut. Nisi velit nihil eius libero laboriosam quis. Quod consequatur eius quos accusamus molestias alias fugit.",
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
            "brand": "nulla"
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
        "id": "11",
        "attributes": {
            "name": "Permission 1",
            "brand": "nulla"
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
            "brand": "sit"
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
        "type": "permission",
        "id": "1",
        "attributes": {
            "name": "Permission 1",
            "brand": "sit"
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
            "content_type": ""
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
        "id": "2",
        "attributes": {
            "content_type": null,
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
                "name": "Minus voluptatem repudiandae minus qui dolor eius sequi. Totam consequuntur non molestias alias iste. Quibusdam rem et harum sit ad. Sequi eligendi harum incidunt sint odit.",
                "brand": "brand"
            }
        },
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




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

