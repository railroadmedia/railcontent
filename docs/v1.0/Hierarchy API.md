# Hierarchy API

# JSON Endpoints


<!-- START_f6d838bb700192d56d216ae84700c66d -->
## Create/update a content hierarchy.


### HTTP Request
    `PUT railcontent/content/hierarchy`


### Permissions
    - Must be logged in
    - Must have the create.content.hierarchy permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentHierarchy'.|
|body|data.attributes.child_position|    |The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.|
|body|data.relationships.parent.data.type|    |Must be 'content'.|
|body|data.relationships.parent.data.id|    |Must exists in contents.|
|body|data.relationships.child.data.type|    |Must be 'content'.|
|body|data.relationships.child.data.id|    |Must exists in contents.|

### Validation Rules
```php
        $this->setGeneralRules(
            [
                'data.type' => 'required|in:contentHierarchy',
                'data.relationships.child.data.type' => 'required|in:content',
                'data.relationships.child.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content' . ',id',
                'data.relationships.parent.data.type' => 'required|in:content',
                'data.relationships.parent.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content'. ',id',
                'data.attributes.child_position' => 'nullable|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

        $this->validateContent($this);

        return parent::rules();
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/hierarchy',
{
    "data": {
        "type": "contentHierarchy",
        "attributes": {
            "child_position": 9
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            },
            "child": {
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
        "type": "contentHierarchy",
        "id": "2",
        "attributes": {
            "child_position": 917213305
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "content",
                    "id": "1"
                }
            },
            "child": {
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




<!-- END_f6d838bb700192d56d216ae84700c66d -->

<!-- START_522506d0e5c355eb192c83407b0da522 -->
## Delete the link between parent content and child content and reposition other children.


### HTTP Request
    `DELETE railcontent/content/hierarchy/{parentId}/{childId}`


### Permissions
    - Must be logged in
    - Must have the delete.content.hierarchy permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|parentId|  yes  ||
|query|childId|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/hierarchy/1/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_522506d0e5c355eb192c83407b0da522 -->

