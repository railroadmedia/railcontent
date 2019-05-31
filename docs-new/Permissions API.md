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

```bash
curl -X GET -G "http://localhost/railcontent/permission" 
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "permission",
            "id": "1",
            "attributes": {
                "name": "permission 1",
                "brand": "brand"
            }
        },
        {
            "type": "permission",
            "id": "2",
            "attributes": {
                "name": "permission 2",
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

```bash
curl -X PUT "http://localhost/railcontent/permission" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"permission","attributes":{"name":"Permission 1","brand":"veritatis"}}}'

```

### Response Example (200):

```json
{
    "data": {
        "type": "permission",
        "id": "2",
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

```bash
curl -X PATCH "http://localhost/railcontent/permission/dissociate" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentPermission","attributes":{"content_type":"course"},"relationships":{"permission":{"data":{"type":"permission","id":1}},"content":{"data":{"type":"content","id":1}}}}}'

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

```bash
curl -X PATCH "http://localhost/railcontent/permission/1" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"permission","attributes":{"name":"Permission 1","brand":"voluptatibus"}}}'

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

```bash
curl -X DELETE "http://localhost/railcontent/permission/1" 
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

```bash
curl -X PUT "http://localhost/railcontent/permission/assign" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentPermission","attributes":{"content_type":"course"},"relationships":{"permission":{"data":{"type":"permission","id":1}},"content":{"data":{"type":"content","id":1}}}}}'

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
                "name": "Placeat unde voluptatem dolores commodi veniam velit. Laudantium ducimus illum quisquam sit a animi praesentium voluptatem.",
                "brand": "brand"
            }
        },
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Consequatur corporis nulla aut et voluptatem molestiae veritatis voluptatem. Magni libero sed nihil quaerat illo autem et. Ea aperiam quibusdam molestiae ut error sed est dignissimos.",
                "type": "course",
                "sort": "994046483",
                "status": "published",
                "brand": "brand",
                "language": "Reiciendis ut consequuntur adipisci enim. Ex cumque qui voluptatum hic. Quo rem voluptatem beatae ut corrupti officia atque. Consectetur ipsa sunt voluptas quibusdam eveniet illo sit.",
                "user": "",
                "published_on": {
                    "date": "1986-05-15 17:00:35.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1993-06-03 18:08:11.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "1983-05-29 22:21:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ipsam cumque laudantium quos minima et inventore. Quo quisquam impedit nostrum hic qui sapiente et id. Eos animi aut eos culpa et. Id omnis error odit veniam eius.",
                "home_staff_pick_rating": "887788560",
                "legacy_id": 843444433,
                "legacy_wordpress_post_id": 479570189,
                "qna_video": "Atque et repudiandae necessitatibus sint qui alias. Sint et provident et ut architecto. Ut ea enim et voluptates maxime amet vero. Odit nihil quos accusantium quis rerum velit. Placeat voluptatem nulla reiciendis vitae.",
                "style": "Recusandae facilis eius eos repellendus iusto. Est et sint perferendis similique. Eos necessitatibus consequatur vel dolor possimus nam. Dolorem recusandae hic adipisci quia. Dolore dolorum adipisci harum repellat minus.",
                "title": "Illum libero dolores qui non inventore delectus.",
                "xp": 696270715,
                "album": "Itaque sequi qui dolor et. Culpa non quas blanditiis qui officiis quia non. Nesciunt temporibus et sed id. Qui qui assumenda distinctio odio unde eius. Et autem corrupti non omnis dolores est aut.",
                "artist": "Delectus incidunt est exercitationem dicta animi fugiat. Aut illum nobis ut voluptatem porro. Ea voluptate sint corrupti nostrum.",
                "bpm": "Rem enim commodi in labore est voluptatem. Alias eius molestiae quidem officiis deleniti excepturi cum. Velit labore saepe officia ipsum. Nesciunt perspiciatis non consectetur cumque soluta.",
                "cd_tracks": "Id repudiandae vero dicta accusamus ex nulla. Autem quia et eum eum culpa quo quae voluptatibus. Laborum quaerat et illum. Molestiae aut aut nam numquam veritatis facilis quas.",
                "chord_or_scale": "Voluptatum eum repellat eius quae sit sed alias. Sed quis qui suscipit et voluptatem. Perferendis debitis magni cupiditate ex. Voluptas qui dolorem doloremque sed id et odit. Placeat sunt fugit omnis non labore.",
                "difficulty_range": "Sunt dolore quo nisi repellendus temporibus. Sit excepturi accusantium id quasi est quidem quod. Dolorum minus omnis temporibus esse architecto. Voluptas rem unde est voluptas necessitatibus vel.",
                "episode_number": 1153315892,
                "exercise_book_pages": "Quia aperiam eius atque aperiam similique qui. Corporis aut eaque aut modi ea enim. Sapiente omnis aspernatur error.",
                "fast_bpm": "Quae autem qui porro voluptates dolore. Esse recusandae veritatis totam harum enim a et fuga. Iure laudantium voluptatem natus molestiae. Ut sed rerum dignissimos ullam dolor nam nobis. Perspiciatis tempore et delectus sit ut qui.",
                "includes_song": true,
                "instructors": "Eligendi autem veniam autem. Dolores itaque nostrum repellendus dicta et eius id.",
                "live_event_start_time": {
                    "date": "1988-06-30 08:45:51.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1978-05-24 17:33:40.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Error asperiores nesciunt assumenda porro exercitationem. Deleniti atque et voluptate id dolores porro. Libero modi aperiam modi voluptas sit. Numquam velit blanditiis modi et non nostrum. Doloribus et omnis in facilis.",
                "live_stream_feed_type": "Quas alias sunt quisquam eius rerum aspernatur saepe. Veritatis quas quos ut consequatur itaque doloremque nobis rerum. Sapiente natus fugit aut eum fuga modi.",
                "name": "Ex saepe maxime unde quo. Ea hic quidem velit. Doloremque dolorum qui consectetur eveniet tempore sed. Voluptatem quia aut unde laudantium natus nihil eos.",
                "released": "Ab perspiciatis ipsa sed dolorum aut nisi sint. Necessitatibus tenetur enim et qui illo. Impedit quis ut eveniet et est magnam.",
                "slow_bpm": "Tenetur doloribus autem nisi eveniet. Fuga quaerat est praesentium et. Dicta id qui iusto perferendis ut sit repellat. Assumenda eos repellat dolorem maxime id officia vel.",
                "total_xp": "Unde quam quia perferendis quibusdam distinctio dolorum. Est sed commodi possimus laboriosam. Architecto sint beatae et nisi voluptates.",
                "transcriber_name": "Voluptatibus sint id quia minima ipsa maxime. Error est consequatur et enim. Sint a aliquam unde et molestias mollitia numquam.",
                "week": 1803610393,
                "avatar_url": "Nam quisquam sed sapiente id nesciunt hic. Ratione quia aut voluptas et vel laborum esse. Doloremque amet deserunt qui velit. Unde sit autem aliquam optio. Sint fuga ut voluptatem sint incidunt autem.",
                "length_in_seconds": 305594635,
                "soundslice_slug": "Vel quis velit esse. Debitis aperiam est deleniti voluptatum sit. Quia consequatur cupiditate corporis assumenda reprehenderit est nisi quia. In dolores quidem temporibus doloremque illum dolorem.",
                "staff_pick_rating": 963992601,
                "student_id": 1679070401,
                "vimeo_video_id": "Beatae praesentium ut in distinctio numquam ipsum quam. Ea iusto sed aut pariatur. Consequuntur aperiam necessitatibus corporis dolor.",
                "youtube_video_id": "Eum qui sunt voluptates laboriosam voluptatem voluptas. Repudiandae dignissimos et cum assumenda iusto cum velit nulla. Aut doloribus cum nemo officia error voluptatem illum. Dolore corrupti quo ipsa assumenda dicta."
            }
        }
    ]
}
```




<!-- END_3fb971d9458d8f1bc2c8d99bfdcf36b0 -->

