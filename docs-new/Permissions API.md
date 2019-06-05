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
                "name": "At minus consequuntur cumque ducimus. Molestiae qui ipsum fugiat cumque expedita. Cum facere assumenda quia repudiandae doloremque. Delectus eum eveniet quis reprehenderit necessitatibus suscipit.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "Necessitatibus quam sit deleniti qui. Consequatur omnis dolores eius sunt quis doloremque.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "3",
            "attributes": {
                "name": "Ut dicta velit debitis voluptatum facilis eos maiores. Quis reiciendis in quia fugit excepturi. Nemo soluta quos rerum aperiam.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "4",
            "attributes": {
                "name": "Aspernatur provident asperiores est. Accusantium sint ut et molestiae ad. Minima iste sapiente qui explicabo at nihil. Vel inventore eveniet voluptatem rerum ratione ut et ipsam. Culpa ipsum rerum et.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "5",
            "attributes": {
                "name": "Iste quis quibusdam porro neque ut expedita dicta quibusdam. Voluptas tempora voluptatem explicabo. Qui sed exercitationem voluptatem odio error explicabo et. Nam earum repellendus alias architecto eligendi voluptatem non est.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "6",
            "attributes": {
                "name": "Excepturi sed ipsum nihil. Omnis itaque nihil asperiores aut asperiores. Itaque voluptas omnis quo sed nam. Possimus deserunt sunt cupiditate et et libero et maiores. Itaque qui eum nostrum commodi illum maiores quis. Iste molestiae est quo aut.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "7",
            "attributes": {
                "name": "A sint aut illum maiores aspernatur. Esse aut nam voluptatibus. Deleniti delectus et deserunt recusandae. Molestiae sit omnis corporis sed. Tempora aut error optio ipsam et deleniti magni.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "8",
            "attributes": {
                "name": "Et ex qui sit non. Nobis quaerat neque quam hic pariatur voluptatem sed rerum. Expedita cupiditate dolorum rerum corrupti ut fugiat accusantium.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "9",
            "attributes": {
                "name": "Maxime ea recusandae enim dicta. Ex debitis perspiciatis porro eum magni id incidunt. Similique est delectus porro illum aut corrupti. Officia iusto facere voluptatem dignissimos a consequatur autem veritatis. Laborum id et ut reiciendis aut.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "10",
            "attributes": {
                "name": "Perferendis rerum similique aut itaque. Et mollitia ipsam ut. Quasi totam natus necessitatibus quia et rerum.",
                "brand": "brand"
            }
        }
    ]
}
```




<!-- END_82b005afd78be37707ededcd4afc2d84 -->

<!-- START_00fbbab029caab0b24691443083c1788 -->
## Create a new permission


### HTTP Request
    `PUT railcontent/permission`


### Permissions
    - Must be logged in
    - Must have the create.permission permission to create
    
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
            "brand": "provident"
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
            "brand": "provident"
        }
    }
}
```




<!-- END_00fbbab029caab0b24691443083c1788 -->

<!-- START_4342e3c5e05a771e85749f018f936e97 -->
## Dissociate permissions from a specific content or all content of a certain type


### HTTP Request
    `PATCH railcontent/permission/dissociate`


### Permissions
    - Must be logged in
    - Must have the disociate.permissions permission
    
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
## Change permission name or the brand where the permission it&#039;s available.


### HTTP Request
    `PATCH railcontent/permission/{permissionId}`


### Permissions
    - Must be logged in
    - Must have the update.permission permission to update
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  ||
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
            "brand": "alias"
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
            "brand": "alias"
        }
    }
}
```




<!-- END_d4001b71581880f49c6f7083414bd750 -->

<!-- START_dc1d30ff5a5c1478fb8b60e51a1d35e7 -->
## Delete an existing permission and all the links with contents


### HTTP Request
    `DELETE railcontent/permission/{permissionId}`


### Permissions
    - Must be logged in
    - Must have the delete.permission permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  ||


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
## Assign permission to a specific content or to all content of certain type.


### HTTP Request
    `PUT railcontent/permission/assign`


### Permissions
    - Must be logged in
    - Must have the assign.permission permission to assign
    
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
                    "id": 2
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
                    "id": "2"
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
            "id": "2",
            "attributes": {
                "name": "Necessitatibus quam sit deleniti qui. Consequatur omnis dolores eius sunt quis doloremque.",
                "brand": "brand"
            }
        },
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




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

