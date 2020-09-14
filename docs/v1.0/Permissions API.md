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
                "name": "Perspiciatis amet quas maxime ut id omnis. Vel necessitatibus unde suscipit eos voluptatum. Deserunt commodi error eaque et. Est delectus atque repellendus et. Dolor rerum quia quis vel corrupti nisi consequuntur nihil.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "Deleniti sit quaerat delectus qui. Et nulla dolorem omnis vitae dolores optio. Molestias voluptas dicta et amet expedita ab molestiae eum. Fugit dolores sint ipsum. Incidunt quia fuga et.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "3",
            "attributes": {
                "name": "Accusantium rerum illo ab sit veritatis. Ipsa velit blanditiis a autem distinctio officia sit. Eius ad et molestiae sed a veritatis. Exercitationem vel et praesentium nihil eius ut enim.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "4",
            "attributes": {
                "name": "Doloremque harum praesentium nihil nulla numquam. Quasi sit in quidem voluptate et. Iusto incidunt ut ratione. Fugit similique non quas dolorem. Libero qui sit consequatur vel tenetur qui.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "5",
            "attributes": {
                "name": "Fuga vero quod est est. Doloribus est et illum adipisci. Aut omnis commodi rem exercitationem qui dolor eum. Quas quos in et et rem. Doloribus blanditiis iste non explicabo omnis nostrum explicabo voluptas.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "6",
            "attributes": {
                "name": "Et aliquam modi libero magnam aut. Ipsam voluptatem qui consequatur. Deserunt occaecati libero similique pariatur molestiae. Tempora dolores et nobis voluptas iusto ea quidem.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "7",
            "attributes": {
                "name": "Blanditiis enim consequatur quod sapiente vel quas vitae. Ab nisi laborum rerum dolores repudiandae. Officiis suscipit autem deserunt dolore laboriosam.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "8",
            "attributes": {
                "name": "Magni voluptatum voluptas quo et voluptate. Expedita mollitia culpa exercitationem non. Voluptatibus soluta tempora doloremque asperiores est autem.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "9",
            "attributes": {
                "name": "Sit id quos quia sequi. Ut quidem voluptas adipisci non impedit. Vel est sit quo ea. Eum eaque iure hic placeat sint sit quas ea. Voluptate unde cum provident voluptas consequuntur facilis nobis. Natus et deserunt sint in.",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "10",
            "attributes": {
                "name": "Accusantium veniam ratione natus aperiam laboriosam. Est itaque natus voluptas esse. Provident dolores voluptas porro labore voluptas natus.",
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
        return [
            'data.type' => 'required|in:permission',
            'data.attributes.name' => 'required|max:255',
        ];
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
            "brand": "ipsum"
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
            "brand": "ipsum"
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
        return [
            'data.type' => 'required|in:contentPermission',
            'data.relationships.permission.data.type' => 'required|in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',
            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',id',
            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',type'
        ];
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
        return [
            'data.type' => 'required|in:permission',
            'data.attributes.name' => 'required|max:255',
        ];
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
            "brand": "dicta"
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
            "brand": "dicta"
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
        return [
            'data.type' => 'required|in:contentPermission',
            'data.relationships.permission.data.type' => 'required|in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',
            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',id',
            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',type'
        ];
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
                "name": "Deleniti sit quaerat delectus qui. Et nulla dolorem omnis vitae dolores optio. Molestias voluptas dicta et amet expedita ab molestiae eum. Fugit dolores sint ipsum. Incidunt quia fuga et.",
                "brand": "brand"
            }
        },
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




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

