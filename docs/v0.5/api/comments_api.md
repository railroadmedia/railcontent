# Comments API

[Table Schema](../schema/table-schema.md#table-railcontent_comments)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ GET /*/comment }`

List comments.
### Permissions



### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|content_id|no| | |pull the comments for given content id
|body|user_id|no| | |pull user's comments
|body|content_type|no| | |pull the comments for the contents with given type

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment',
    data: {
        page: 1, 
        limit: 3,
        sort:'-created_on',
        content_id: 1
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{  
   "data":[  
      {  
         "type":"comment",
         "id":"4",
         "attributes":{  
            "comment":"Hic qui iste iure. Voluptatem eveniet quod debitis qui incidunt vel quaerat. Qui quas laboriosam harum molestias et. Aut voluptas sint ea debitis dignissimos voluptatibus voluptatem.",
            "temporary_display_name":"Quae consequatur ipsam commodi quam id reiciendis iusto eos. Fugiat vel placeat esse voluptatem. Doloremque ad corrupti veritatis rerum.",
            "user":"1",
            "created_on":"2019-05-24 13:32:56",
            "deleted_at":null,
            "like_count":"0",
            "is_liked":false
         },
         "relationships":{  
            "content":{  
               "data":{  
                  "type":"content",
                  "id":"1"
               }
            }
         }
      },
      {  
         "type":"comment",
         "id":"5",
         "attributes":{  
            "comment":"Adipisci deserunt vero autem quam. Earum molestiae ratione qui corporis. Ut quo repellendus voluptatem nemo sit velit. Vel culpa rerum ut nesciunt. Alias ratione aspernatur nemo eos et labore et. Placeat neque vitae incidunt enim et.",
            "temporary_display_name":"Delectus aperiam doloremque numquam est ex dolores quaerat. Praesentium nulla quae nulla. Nam tempore reprehenderit ut reprehenderit. Doloribus unde temporibus doloremque at qui.",
            "user":"1",
            "created_on":"2019-05-24 13:32:56",
            "deleted_at":null,
            "like_count":"0",
            "is_liked":false
         },
         "relationships":{  
            "content":{  
               "data":{  
                  "type":"content",
                  "id":"1"
               }
            }
         }
      },
      {  
         "type":"comment",
         "id":"6",
         "attributes":{  
            "comment":"Labore soluta laboriosam libero repellat repellendus autem et. Mollitia qui ut temporibus dignissimos ea. Iure ipsam itaque amet aut voluptates et dolorum.",
            "temporary_display_name":"Ipsam nulla et et qui et dolores pariatur minus. Quod laudantium nisi similique sit. Recusandae aut architecto ab iste modi est ipsum. Doloremque nihil velit qui ea iusto eveniet vel.",
            "user":"1",
            "created_on":"2019-05-24 13:32:56",
            "deleted_at":null,
            "like_count":"0",
            "is_liked":false
         },
         "relationships":{  
            "content":{  
               "data":{  
                  "type":"content",
                  "id":"1"
               }
            }
         }
      }
   ],
   "included":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Numquam et culpa ipsum praesentium iure ut sint. Earum sed nihil voluptate quidem fugit. Magni autem fuga natus aliquid eos.",
            "type":"course",
            "sort":"261982140",
            "status":"Ad doloremque consequuntur reprehenderit incidunt amet ratione beatae. Facilis vel et distinctio dolor veritatis. Error nam est rem beatae. Qui ipsam quis vero.",
            "brand":"brand",
            "language":"Possimus architecto expedita quidem sit voluptatem voluptas et. Provident asperiores omnis corrupti optio. Quasi assumenda ab minus est vitae velit nemo. Enim facilis necessitatibus est consequatur.",
            "user":"",
            "published_on":{  
               "date":"2008-10-07 19:44:02.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "archived_on":{  
               "date":"2017-06-25 22:49:30.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"1970-03-12 18:28:27.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Ut molestias reiciendis quis dolorum doloribus sint velit et. Totam repellendus rerum corporis eius. Ullam quod inventore ea in necessitatibus. Magnam eum sapiente sed et occaecati porro pariatur. Quas fugit quam sapiente dolores consectetur doloribus.",
            "home_staff_pick_rating":"2041163349",
            "legacy_id":392837722,
            "legacy_wordpress_post_id":1829620413,
            "qna_video":"Recusandae earum non maxime et. Sunt eum aut fugiat. Laboriosam ut iusto optio. Est qui et animi quasi sapiente. Optio quam minus placeat quidem aut. Quo nobis nisi excepturi enim. Voluptas eaque odit et adipisci perspiciatis perspiciatis.",
            "style":"Dicta debitis velit optio omnis ut. Fuga quidem qui et sunt dolorum dolores perspiciatis. Non voluptatem totam nisi perspiciatis.",
            "title":"Eum in neque sed alias.",
            "xp":1952089400,
            "album":"Et alias necessitatibus vero odit aut maiores vero autem. Architecto repudiandae vero quasi consequuntur. Et id architecto molestiae.",
            "artist":"Impedit corporis eaque itaque qui non temporibus. A molestiae omnis iusto. Nisi voluptates in illum ut fuga. Voluptas placeat labore et quos consequatur adipisci nemo.",
            "bpm":"Consequatur eos expedita amet architecto accusamus alias quo. Occaecati quisquam est dolores. Adipisci et laborum omnis saepe. Laborum nobis molestiae occaecati nesciunt corporis. Temporibus eaque ipsa necessitatibus.",
            "cd_tracks":"Aut reprehenderit eum dolores animi id molestiae ut. Odio aut dolores perferendis sapiente. Incidunt magnam porro ea enim. Officiis non voluptates animi velit modi voluptate.",
            "chord_or_scale":"Alias dolores beatae dolores libero ut. Atque sapiente ullam esse dolores expedita sunt. Sit ab ea debitis alias nihil hic beatae. Iusto officia natus perspiciatis at et.",
            "difficulty_range":"Similique quo ut ea dolorem in non. Commodi harum iure mollitia numquam aliquid. Ipsum inventore soluta aliquid libero voluptates explicabo fuga. Repudiandae et laudantium ut sapiente minus explicabo molestiae. Cumque quo deleniti explicabo ullam totam.",
            "episode_number":393297708,
            "exercise_book_pages":"Ipsum voluptates iusto deleniti tempore aut. Aliquid adipisci nemo fuga. Qui dicta vitae incidunt et aperiam autem. Molestias excepturi non fugiat accusantium officiis. Porro voluptates adipisci eos voluptatibus deleniti. Aut nisi eos ea.",
            "fast_bpm":"Reiciendis eaque saepe repudiandae. In aut ut ullam error nihil consequatur. Quasi quibusdam dolore et.",
            "includes_song":false,
            "instructors":"Ab libero rerum dolores officia commodi ipsa fugit. Et perspiciatis nesciunt mollitia autem quo quas iusto.",
            "live_event_start_time":{  
               "date":"1997-08-12 05:19:30.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1998-12-02 22:18:24.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Tempora hic maiores itaque dolores repudiandae nulla at et. Maxime consequatur eum maxime dolorum. Voluptatibus deleniti molestiae temporibus quisquam illo.",
            "live_stream_feed_type":"Enim soluta minus qui nisi. Ut error quo enim placeat quam. Qui natus est sit odio. Amet quae qui dolorem pariatur. Beatae accusantium totam est. Qui molestiae provident nesciunt quos sit. Voluptas eaque nesciunt facilis labore et.",
            "name":"Sunt similique impedit eum dignissimos ad. Expedita quisquam sit architecto id reprehenderit sint minima blanditiis. Et est ut est natus aut ipsum. Velit facilis nam aut earum inventore. Fuga dolore id ut iusto.",
            "released":"Dolor rerum ut consequatur nam rerum. Dolorem tempore voluptas est consequatur corrupti saepe et. Facilis sed eos minima enim aut voluptatum sed est.",
            "slow_bpm":"Blanditiis voluptas reiciendis eaque nesciunt. Quia magnam incidunt quos temporibus. Consectetur vero distinctio odio iste a aut. Itaque ipsum qui dicta dolores molestias facilis nisi. Rem qui quaerat sapiente porro explicabo eveniet.",
            "total_xp":"Sequi iusto autem saepe alias ut. Tenetur at tenetur nisi natus voluptatem ut repellat. Qui libero libero velit voluptas. Placeat quis qui sed numquam labore cupiditate aperiam.",
            "transcriber_name":"Error et corporis necessitatibus cum iure temporibus iste. Veniam eligendi harum fugit eum ea. Quae laborum harum consequatur optio. Eligendi quisquam occaecati velit autem. Non animi dicta possimus nulla vitae.",
            "week":1760588097,
            "avatar_url":"Aut natus voluptatem perspiciatis qui qui aut odit sed. Voluptatum necessitatibus eos est est sunt sed. Qui expedita autem inventore illo culpa aspernatur ea. Quia dolorum ut consectetur et sed necessitatibus.",
            "length_in_seconds":1027220570,
            "soundslice_slug":"Cum nostrum dolorum animi suscipit. Quia voluptas rem atque corrupti est. Enim ducimus veniam repellendus vitae quasi consequatur commodi. Quisquam voluptas unde iste laborum quod exercitationem alias.",
            "staff_pick_rating":1325955329,
            "student_id":382290232,
            "vimeo_video_id":"Maiores est sit ullam dolore quia. Debitis eligendi ratione mollitia at quaerat. Quisquam similique qui excepturi odit.",
            "youtube_video_id":"Hic et in numquam aut temporibus. Minima voluptas eaque modi praesentium qui. Dolorem libero ducimus laudantium illo. Deserunt id corrupti sed deserunt aut quis. Sequi fuga veniam sapiente tempore consequatur."
         }
      }
   ],
   "meta":{  
      "totalCommentsAndReplies":"14",
      "pagination":{  
         "total":14,
         "count":3,
         "per_page":3,
         "current_page":2,
         "total_pages":5
      }
   },
   "links":{  
      "self":"http:\/\/localhost\/railcontent\/comment?page=2&limit=3&content_id=1",
      "first":"http:\/\/localhost\/railcontent\/comment?page=1&limit=3&content_id=1",
      "prev":"http:\/\/localhost\/railcontent\/comment?page=1&limit=3&content_id=1",
      "next":"http:\/\/localhost\/railcontent\/comment?page=3&limit=3&content_id=1",
      "last":"http:\/\/localhost\/railcontent\/comment?page=5&limit=3&content_id=1"
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/comment }`

Create a new comment to a content.

### Permissions

- Must be logged in
- The content type should allow comments

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|yes||||
|body|data.attributes.temporary_display_name|no||||
|body|data.relationships.content.data.type|yes|must be 'content'|||
|body|data.relationships.content.data.id|yes||||



### Validation Rules

```php
[
    'data.attributes.comment' => 'required|max:10024',
    'data.relationships.content.data.id' =>
         [
         'required',
         'numeric',
         Rule::exists(
               config('railcontent.database_connection_name') . '.' . config('railcontent.table_prefix'). 'content', 'id')
               ->where(function ($query) {
                        if (is_array(ContentRepository::$availableContentStatues)) {
                            $query->whereIn('status', ContentRepository::$availableContentStatues);
                        }
                    })
                ],
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment',
    data: {
        type: "comment",
        attributes: {
              comment: "Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae. Aspernatur facilis et quia saepe nemo.",
              temporary_display_name: "in"   
        },
        relationships: {
            content:{
                data:{
                    type:'content',
                    id: 1,
                }
            }
        }
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{  
   "data":{  
      "type":"comment",
      "id":"1",
      "attributes":{  
         "comment":"Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae. Aspernatur facilis et quia saepe nemo.",
         "temporary_display_name":"in",
         "user":"1",
         "created_on":"2019-05-24 13:35:39",
         "deleted_at":null
      },
      "relationships":{  
         "content":{  
            "data":{  
               "type":"content",
               "id":"1"
            }
         }
      }
   },
   "included":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Perspiciatis asperiores reprehenderit ut dolores. Quia inventore doloribus sed neque. Voluptates quam fugiat eius consequatur.",
            "type":"course lesson",
            "sort":"2104679029",
            "status":"published",
            "brand":"brand",
            "language":"Velit accusamus ipsum atque et aut deleniti tenetur. Et placeat consequatur rerum enim. Error quisquam iste dignissimos nihil aperiam ipsum. Et animi est ut doloribus voluptas modi id voluptates.",
            "user":"",
            "published_on":{  
               "date":"1985-12-27 01:35:00.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "archived_on":{  
               "date":"1979-04-16 04:08:25.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"2002-11-05 04:37:59.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Consequatur pariatur ipsam sapiente architecto. Maxime corrupti consequuntur omnis velit temporibus possimus. Praesentium ducimus commodi numquam deserunt rerum eveniet. Ut dolores et accusamus fugit magnam possimus.",
            "home_staff_pick_rating":"163414824",
            "legacy_id":847371928,
            "legacy_wordpress_post_id":962480732,
            "qna_video":"Impedit et ut aliquam non ut. Maiores nesciunt quis laborum non nemo. Error omnis ab repellat. Voluptatum eos amet rerum maiores consequuntur expedita veniam voluptas.",
            "style":"Ipsa ipsum nihil inventore incidunt. Quisquam quo exercitationem officiis voluptas. Corrupti placeat nesciunt dolore veniam. Totam deserunt fuga consequuntur id.",
            "title":"Sapiente aperiam sunt et et ipsa quia voluptate.",
            "xp":217026949,
            "album":"Omnis ad molestias sint in neque. Omnis quos laboriosam minus sed odit. Velit modi itaque et incidunt quis corrupti officiis. Iusto suscipit culpa omnis repudiandae.",
            "artist":"Consequatur mollitia aut perferendis temporibus. Ut illo qui doloribus error quisquam.",
            "bpm":"Suscipit a qui odit tenetur ut praesentium eius. Fugiat illo est quod consequuntur et aut earum. Dolorum possimus totam ut. Vel tenetur cupiditate aut ab non blanditiis. Nesciunt soluta reprehenderit explicabo voluptate blanditiis rerum qui.",
            "cd_tracks":"Excepturi modi deleniti rem consequatur ab aut. Dolore aliquam deleniti et aliquam non voluptatem id ut. Debitis sit vel odio temporibus voluptatum. Iusto autem nesciunt quam accusantium eum.",
            "chord_or_scale":"Consequuntur quas ut quia iste. Quia facere voluptatem sequi quaerat inventore sit. Ratione eius cum at incidunt labore autem reiciendis. Autem sapiente placeat quasi. Error necessitatibus quia alias aspernatur qui.",
            "difficulty_range":"Tempore fugit maxime autem explicabo. Qui facere consequatur et voluptatum. Perferendis alias labore deserunt qui impedit. Magnam dolores facilis incidunt rerum.",
            "episode_number":1832443835,
            "exercise_book_pages":"Consequatur optio atque facere. Suscipit vero voluptate nihil iure eos alias. Ex necessitatibus sapiente odit distinctio omnis et ut. Aliquid nihil perferendis nobis et ea totam cumque. Blanditiis deleniti debitis et sint.",
            "fast_bpm":"Aspernatur sed laborum praesentium delectus dolores ex ex. Sint sapiente qui ad officiis ut. Vero iusto totam dolor enim molestiae rem. Pariatur distinctio quia expedita. Et nemo nobis culpa velit.",
            "includes_song":true,
            "instructors":"Saepe minima quod amet. Libero non in perspiciatis. Nulla sequi magnam placeat cum. Ut eveniet sunt inventore quis. Porro corporis nihil eaque officia. At et quis laborum fugiat quia. Accusamus accusamus hic iusto tenetur sit aut.",
            "live_event_start_time":{  
               "date":"2002-01-14 00:56:44.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1989-10-03 17:09:06.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Ut aspernatur accusantium deserunt ut. Quaerat dolor illo voluptas et laborum numquam quia. Corrupti tenetur molestiae ea et omnis. Iusto voluptas autem itaque eum. Est voluptatem suscipit et voluptates non ex.",
            "live_stream_feed_type":"Voluptate in soluta consequatur non fugit. Sed perferendis magni in consequuntur inventore consequatur. Eaque consequatur est enim est voluptatem sunt sit. Quia fugit eos molestiae doloribus. Molestias eius asperiores quis velit magni quis.",
            "name":"Tempora velit vel qui architecto. Facilis asperiores magni accusantium enim et. Aut sunt doloribus ipsa ut magni commodi adipisci magnam. Perferendis perferendis quo quas. Eos debitis et enim unde. Quia animi enim est dolorem. Et hic error sunt possimus.",
            "released":"Voluptas maiores dolores id non vel non aut et. Sit dolorem deleniti consequuntur harum. Excepturi rerum doloribus sunt consectetur commodi qui voluptatem provident.",
            "slow_bpm":"Voluptatem ratione autem impedit. Quaerat laudantium cupiditate velit est magni vitae dolore. Facilis voluptas autem illum doloremque. Magnam similique voluptatem voluptatem voluptatum eius sed omnis.",
            "total_xp":"Eum quisquam cum velit adipisci rerum. Assumenda ullam sint ut corporis. Omnis enim illum similique est saepe. Temporibus doloribus asperiores cumque dolore ut consequatur. Quos officia ex fugiat.",
            "transcriber_name":"Ex est consequatur natus maiores repellat aperiam commodi. Ipsam nostrum est ea aperiam quia. Laboriosam enim est ut blanditiis repudiandae.",
            "week":1258333752,
            "avatar_url":"Odio molestias voluptatem nemo ut perferendis neque. Nostrum voluptas animi dolores quas quis sapiente. Magnam magni praesentium et et aspernatur laboriosam. Tenetur reprehenderit omnis nulla aspernatur repellendus.",
            "length_in_seconds":512417812,
            "soundslice_slug":"Earum facilis voluptatem cupiditate vel autem totam suscipit. Ut et est blanditiis vero occaecati pariatur sed. Eos laborum sed velit. Ipsum est sequi culpa et praesentium et. Omnis vel quisquam et nemo.",
            "staff_pick_rating":714641248,
            "student_id":1720432450,
            "vimeo_video_id":"Quod harum ullam reprehenderit molestias. Incidunt facilis aut exercitationem dolore ea amet.",
            "youtube_video_id":"Sit maiores facilis aliquid facilis autem. Aut blanditiis et eaque id blanditiis. Molestiae qui minus sunt error architecto. Cum quia placeat sint et dolorem."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PATCH /*/comment/{ID} }`

Change comment.

### Permissions

- Must be logged in to modify own comments 
- Must be logged in with an administrator account to modify other user comments

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|no||||
|body|data.attributes.display_name|no||||
|body|data.relationships.parent.data.type|no|must be 'comment'|||
|body|data.relationships.parent.data.id|no||||
|body|data.relationships.content.data.type|no|must be 'content'|||
|body|data.relationships.content.data.id|no||||


### Validation Rules

```php
[
            'data.attributes.comment' => 'nullable|max:10024',
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
            'data.relationships.parent.data.id' => 'numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'comments' . ',id',
            'data.attributes.display_name' => 'filled'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment/1',
    type: 'patch', 
    data: {
        type: "comment",
        attributes: {
              comment: "new text"
        },
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{  
   "data":{  
      "type":"comment",
      "id":"1",
      "attributes":{  
         "comment":"new text",
         "temporary_display_name":"",
         "user":"1",
         "created_on":"2019-05-24 14:01:51",
         "deleted_at":null
      },
      "relationships":{  
         "content":{  
            "data":{  
               "type":"content",
               "id":"1"
            }
         }
      }
   },
   "included":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Id nesciunt sint fugit et id a. Eum totam veniam expedita veniam perspiciatis dolor praesentium. Eveniet aut sunt voluptatibus nam vel optio perferendis ex. Aperiam laudantium aut ea.",
            "type":"course lesson",
            "sort":"1601845261",
            "status":"Dolore sapiente ipsa vero sed aut. Tempore et et perspiciatis non. Esse natus laudantium unde. Velit minus quia quo temporibus asperiores aut.",
            "brand":"brand",
            "language":"Eos expedita quam a fugiat. Perspiciatis esse fuga tempora. Voluptates est ipsum quia odit quo. Et ut praesentium ab. In repellendus rerum nesciunt sunt laborum. Vel libero sunt qui.",
            "user":"",
            "published_on":{  
               "date":"2012-07-24 13:41:33.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "archived_on":{  
               "date":"1995-01-14 08:10:35.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"2016-08-14 08:27:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Hic sed optio accusantium quis. Itaque sit perspiciatis blanditiis aliquam natus saepe. Itaque ea quas ipsam sit ut autem ipsam hic. Unde voluptas eveniet nulla harum dolor iure illo. Sit aut ratione qui ut nam consequatur.",
            "home_staff_pick_rating":"354354823",
            "legacy_id":1291283554,
            "legacy_wordpress_post_id":500056452,
            "qna_video":"Eaque ipsam et eum mollitia corporis. Mollitia vitae iusto sunt. Sunt eveniet provident soluta. Minima incidunt culpa quia ducimus vel qui deleniti consequuntur. Cum adipisci aut optio maiores. Voluptatum tenetur ut sunt qui.",
            "style":"Et non consectetur et laboriosam. Aut quas molestias voluptatem neque. Assumenda molestias ducimus facilis consequatur magnam.",
            "title":"Necessitatibus consectetur sint perferendis.",
            "xp":231337879,
            "album":"Aut et minus ut adipisci harum at. Dolorem temporibus hic sed eos laboriosam. Corporis ut aut aliquid occaecati ut. Molestiae veritatis rerum alias dolor est aut tenetur.",
            "artist":"Fugit vitae ut delectus ex et. Magnam minima est ut eum reiciendis sed. Aut quaerat aut ut sint asperiores id vel. Quae voluptatem dolorem iure reprehenderit repellendus voluptatem distinctio quia.",
            "bpm":"Qui non autem qui. Eaque tenetur distinctio explicabo odit facilis quia placeat. Soluta explicabo porro molestiae ut. Exercitationem impedit quia corrupti nesciunt voluptatem.",
            "cd_tracks":"Cupiditate optio ipsam quo sit ut iure. Quis quidem aliquam voluptatem quia iste alias. Et facilis provident nesciunt aperiam. Accusantium ratione nihil illum.",
            "chord_or_scale":"Repellat qui veritatis non maxime. Ut illum sit perspiciatis impedit eligendi dolorem. Occaecati facilis distinctio eaque est et sed odit. Modi asperiores adipisci quia deleniti et inventore rerum.",
            "difficulty_range":"Minus est in numquam pariatur hic laboriosam iste ipsam. Facere enim aut molestias qui. Deserunt ab voluptatibus minus ut molestiae natus dolorum.",
            "episode_number":1811810902,
            "exercise_book_pages":"Et quam laboriosam consequuntur aperiam quia optio. Facere qui sed amet quos praesentium. Dolorum fugit sed nisi ea ducimus rerum quidem. Ea est sed minus magni quis veritatis.",
            "fast_bpm":"Harum quia dolores voluptate quo qui. Illo amet minima debitis enim est. Odio sunt ipsum unde in neque. Reiciendis suscipit animi et exercitationem aliquid ut. Voluptatem temporibus asperiores enim est quia rerum eos vitae.",
            "includes_song":true,
            "instructors":"Pariatur expedita id ratione qui consequuntur. Occaecati corporis aspernatur consectetur. Velit fugit eveniet ut ut. Modi dolores aut culpa optio tempora. Assumenda porro unde veritatis quam eaque.",
            "live_event_start_time":{  
               "date":"2017-06-16 15:48:22.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1987-02-18 08:30:32.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Eum vero eligendi voluptatum quisquam. Soluta ut sequi magni. Quasi laudantium aut officia quo architecto consequatur qui.",
            "live_stream_feed_type":"Laboriosam deserunt soluta nihil qui ipsam animi. Distinctio dolorum nostrum consequatur qui ab. Corporis ut ut dolorem et.",
            "name":"Quos earum possimus et. Velit est corrupti et sint perspiciatis quisquam cumque laborum. Et aut dolor earum ut itaque sunt exercitationem non. Delectus velit rerum sed quas. Cum facilis quas qui asperiores et.",
            "released":"Ut molestiae est esse dolor voluptate cum commodi officia. Nesciunt id est quasi qui modi iusto laborum quia. In perspiciatis asperiores aperiam magnam voluptatem ea. Modi et est iure architecto.",
            "slow_bpm":"Officia eum et aut quos et. Praesentium temporibus non corporis dolor sequi laudantium. Pariatur reprehenderit praesentium beatae sunt cumque. Sit provident autem enim soluta deserunt.",
            "total_xp":"Ducimus repudiandae ut ipsum qui. Sit aut ut officia officiis. Omnis perspiciatis rerum expedita eum ad.",
            "transcriber_name":"Explicabo et quibusdam consequatur consequatur voluptatem quibusdam. Temporibus ducimus beatae praesentium voluptatibus voluptates quisquam. Ipsum hic temporibus animi inventore tempora asperiores dicta.",
            "week":1644280667,
            "avatar_url":"Dolorum magni aut modi et libero occaecati. Quis mollitia modi eveniet ullam non blanditiis. Accusamus alias cum dicta eligendi. Dignissimos cum mollitia adipisci ut quisquam.",
            "length_in_seconds":1624846822,
            "soundslice_slug":"Et quia iste facilis officiis et dolores atque. Sit ratione reprehenderit eum nemo non. Impedit reiciendis aliquid eos harum.",
            "staff_pick_rating":317949317,
            "student_id":409226510,
            "vimeo_video_id":"Ea veniam tenetur quos aperiam unde dolores est laudantium. Non optio explicabo aspernatur provident. Et corrupti explicabo fugit est consequuntur ea maiores.",
            "youtube_video_id":"Omnis a id debitis id. Quam dolore dignissimos qui dolores assumenda soluta aut. Sunt et voluptatem beatae. Quo eaque debitis est enim aliquam qui."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/comment/{ID} }`

Delete comment or mark comment as deleted.


### Permissions

- Must be logged in to soft delete own comment (mark comment as deleted)
- Must be logged in with an administrator account to delete comment with all replies

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment/1',
    type: 'delete', 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```204 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->


### `{ PUT /*/comment/reply }`

Add a reply to a comment

### Permissions

- Must be logged in

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'comment'||
|body|data.attributes.comment|yes||||
|body|data.relationships.parent.data.type|yes|must be 'comment'|||
|body|data.relationships.parent.data.id|yes||||



### Validation Rules

```php
       [
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.parent.data.id' => 'required|numeric|exists:' .
                config('railcontent.database_connection_name') .
                '.' .
                config('railcontent.table_prefix'). 'comments' .
                ',id'
       ]
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/comment/reply',
    data: {
        type: "comment",
        attributes: {
              comment: "Et sequi dicta minima quo ipsum maxime est.",
        },
        relationships: {
            content:{
                data:{
                    type:'content',
                    id: 1,
                }
            },
            parent:{
                data:{
                    type:'comment',
                    id: 1,
                }
            }
        }
    }, 
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```200 OK```

```json
{  
   "data":{  
      "type":"comment",
      "id":"2",
      "attributes":{  
         "comment":"Et sequi dicta minima quo ipsum maxime est.",
         "temporary_display_name":"",
         "user":"1",
         "created_on":"2019-05-24 14:05:38",
         "deleted_at":null
      },
      "relationships":{  
         "content":{  
            "data":{  
               "type":"content",
               "id":"1"
            }
         }
      }
   },
   "included":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Rerum iure et velit aut. Perspiciatis eligendi et inventore officia nulla. Qui dicta alias assumenda delectus.",
            "type":"course",
            "sort":"1699529391",
            "status":"Beatae nulla et debitis doloribus ad. Expedita cum est placeat et. Quibusdam dolores veritatis doloribus aliquid expedita eum. Dolor illo odit doloremque ut dicta inventore doloremque et.",
            "brand":"brand",
            "language":"Modi voluptas consequuntur odit nesciunt laudantium. Sint officiis repellat libero veniam. Ex ut praesentium ad. Eaque officiis molestiae explicabo consequatur qui non aut.",
            "user":"",
            "published_on":{  
               "date":"1989-03-28 01:58:19.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "archived_on":{  
               "date":"2017-09-17 17:05:46.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"1979-01-26 17:12:27.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Quam ipsa et saepe ut possimus quos ullam earum. Voluptatem sequi autem quia corporis. Incidunt corporis voluptas mollitia quae deserunt fugit vel. At doloremque ut sunt sed esse. Qui et corporis magnam aut.",
            "home_staff_pick_rating":"365145684",
            "legacy_id":1021896248,
            "legacy_wordpress_post_id":846665701,
            "qna_video":"Deserunt quae eligendi molestias blanditiis esse qui. Eaque ab nesciunt consectetur qui ab. Non consequatur ipsam hic optio consequatur minus temporibus. Vel odio voluptas delectus possimus repellendus saepe perspiciatis.",
            "style":"Nihil est et enim ipsam id fugiat quia laudantium. Mollitia enim corporis qui itaque aliquid aut nulla. Tempore maxime nam eaque laboriosam dicta facere doloribus. Quos debitis odio est sit sapiente modi adipisci.",
            "title":"Eius deleniti nihil consequatur.",
            "xp":175830720,
            "album":"Consequatur rerum autem tenetur similique. Dolor velit hic sed eum nobis repellendus vero. Dignissimos autem consequuntur sunt itaque aut voluptas.",
            "artist":"Perferendis a eius velit aut ut et reiciendis sequi. Enim possimus esse nemo delectus laboriosam. Quam quasi perspiciatis aliquam.",
            "bpm":"Et ipsum impedit atque repellat deleniti. Nemo temporibus inventore consequuntur qui itaque nulla. Ducimus reprehenderit reiciendis corporis et velit sequi eaque.",
            "cd_tracks":"Reprehenderit voluptates et quo et amet. Quas dicta dolor eveniet est veritatis veritatis molestias. Minus est dolores consequuntur et est suscipit.",
            "chord_or_scale":"Laudantium ex corporis voluptas iusto debitis qui tempore. Et tempora ab omnis doloribus consequatur hic. Unde ut est aut non. Odio dolorem quos qui exercitationem praesentium ut nisi.",
            "difficulty_range":"Optio perferendis ut quidem officiis asperiores et nobis at. Est corporis aperiam autem. Magni et reiciendis tenetur est.",
            "episode_number":1038886161,
            "exercise_book_pages":"Excepturi consequatur provident dolor. Delectus quis vel amet. Inventore ab illo non est ut laboriosam iusto. Ipsum molestiae velit unde et ex voluptates. Rem molestiae consequatur quis nostrum vitae itaque.",
            "fast_bpm":"Culpa et rerum atque voluptatibus architecto omnis magnam. Nisi ullam eos mollitia unde. Quia neque consequuntur magnam velit qui vero voluptatem. Non cupiditate velit sunt vel provident.",
            "includes_song":true,
            "instructors":"Consequuntur ut aperiam voluptate. Eius occaecati laudantium possimus sed in expedita id. Placeat aliquam aut molestiae ad est nesciunt voluptas.",
            "live_event_start_time":{  
               "date":"1993-01-29 10:19:07.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1993-01-17 04:25:07.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Beatae eaque aperiam aut voluptatem est aut. Unde quia molestias qui quia dolorem voluptatem nihil. Non voluptatem sapiente sed ut officiis illum. Sint sed deserunt ducimus porro vel facere. Possimus omnis fuga qui illum laudantium.",
            "live_stream_feed_type":"Et natus voluptate quo. Et esse atque possimus aut deserunt sit voluptates. Eos quo dolorem possimus repellat vitae corrupti dolorem aut. Magni exercitationem sunt nisi fuga dignissimos earum.",
            "name":"Voluptatibus molestiae quam ut quidem est. Perspiciatis modi enim autem recusandae maxime. Vero nam fugit a dicta non voluptatibus.",
            "released":"Quis hic voluptatibus libero magnam consequatur. Quas sed quo ut illum voluptas. Sed optio quis sapiente. Iste rerum magnam saepe aspernatur autem cum et.",
            "slow_bpm":"Sunt nisi earum distinctio id officiis rerum ut. Et quo quia molestias esse sit tenetur veniam vel. Commodi ut quas vitae et mollitia explicabo aut ut. Laudantium perferendis itaque aut saepe nulla quisquam ut.",
            "total_xp":"Reiciendis perspiciatis soluta in id ut tempore. Minima cupiditate blanditiis vel nesciunt voluptatem. Est eius sequi expedita. Quibusdam error vel ipsam est. Provident ad nihil tempora asperiores aspernatur sed autem.",
            "transcriber_name":"Occaecati laborum rerum autem deleniti quis. Repudiandae ex et id tenetur dolorum sed. Nihil repudiandae possimus consequatur qui qui vel eveniet.",
            "week":353164236,
            "avatar_url":"Doloremque quis in repudiandae et delectus. Et enim voluptatibus consequatur provident quam tenetur. Quae impedit hic eaque et. Sit omnis libero harum dolorem officia dolores.",
            "length_in_seconds":1228194431,
            "soundslice_slug":"Expedita aliquid sed quod dolor ut repellat. Omnis labore consequatur soluta temporibus. Optio consequatur consequatur et quas ut minima. Recusandae ut repellat recusandae rerum quis repellat adipisci laborum.",
            "staff_pick_rating":603844421,
            "student_id":1050830956,
            "vimeo_video_id":"Ab modi rem ut culpa. Ipsum animi sed voluptatem accusantium iste ad. Sunt aut magnam totam fugit doloribus dolor quia sunt. Recusandae eos dolorem omnis autem.",
            "youtube_video_id":"Unde officia et qui quia similique reiciendis. Vitae ut eos incidunt et. Deleniti nobis vitae optio explicabo nulla qui."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ GET /*/comment/{ID} }`

List linked comments.
### Permissions



### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes| | |
|body|limit|no|10| |

### Request Example

```js   

```

### Response Example

```200 OK```

```json

```
<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/comment-like/{ID} }`

Like a comment.

### Permissions

- Must be logged in


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|comment id|yes||||


### Request Example

```js   

```

### Response Example

```200 OK```

```json

```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/comment-like/{ID} }`

Unlike a comment.

### Permissions

- Must be logged in


### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|comment id|yes||||


### Request Example

```js   

```

### Response Example

```200 OK```

```json

```