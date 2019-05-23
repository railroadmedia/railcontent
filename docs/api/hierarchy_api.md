# Content hierarchy API

[Table Schema](../schema/table-schema.md#table-railcontent_)



# JSON Endpoints



### `{ PUT /*/content/hierarchy }`

Create/update content hierarchy specifying parent id, child id and child position.

### Permissions

- Must be logged in
- Must have the 'create.content.hierarchy' permission

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes||must be 'contentHierarchy'||
|body|data.attributes.child_position|no| | |The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.|
|body|data.relationships.parent.data.type|yes| |must be 'content'||
|body|data.relationships.parent.data.id|yes||||
|body|data.relationships.child.data.type|yes| |must be 'content'||
|body|data.relationships.child.data.id|yes||||

### Validation Rules

```php
[
    'data.relationships.child.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'content' . ',id',
    'data.relationships.parent.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
        config('railcontent.table_prefix'). 'content'. ',id',
    'data.attributes.child_position' => 'nullable|numeric|min:0'
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/hierarchy',
    data: {
       type: "contentHierarchy",
       attributes: {
            child_position: 1
       },
       relationships: {
                   parent: {
                       data: {
                           type: "content",
                           id: 1
                       }
                   },
                   child: {
                       data: {
                           type: "content",
                           id: 3
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
      "type":"contentHierarchy",
      "id":"2",
      "attributes":{  
         "child_position":1
      },
      "relationships":{  
         "parent":{  
            "data":{  
               "type":"content",
               "id":"1"
            }
         },
         "child":{  
            "data":{  
               "type":"content",
               "id":"3"
            }
         }
      }
   },
   "included":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Modi molestias tempora vel atque rerum vel omnis. Natus enim ab natus atque aut ut. Explicabo dolorem eveniet doloribus. Omnis accusamus facere quo.",
            "type":"course",
            "sort":"262365374",
            "status":"published",
            "brand":"brand",
            "language":"Laudantium error ut nostrum. Ut veritatis assumenda non enim dicta voluptates. Et voluptate at rerum pariatur molestias voluptas.",
            "user":"",
            "published_on":"2019-05-23 13:08:08",
            "archived_on":{  
               "date":"2003-05-27 06:24:13.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"1981-01-22 10:12:11.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"5",
            "home_staff_pick_rating":"604670627",
            "legacy_id":1735026354,
            "legacy_wordpress_post_id":210884699,
            "qna_video":"Quod accusamus nemo culpa qui deserunt. Est quos aperiam dolor expedita incidunt consequatur incidunt architecto. Vero rem nam voluptatem quia. Et odit ex qui quibusdam dicta aspernatur. Quaerat et hic nesciunt.",
            "style":"Veniam vel dolorum iusto fuga. Perferendis error ratione culpa molestias ipsa praesentium molestiae. Ab ratione est suscipit magni sequi similique. Amet deserunt consectetur laudantium ab.",
            "title":"Laborum est veniam architecto.",
            "xp":791649067,
            "album":"Optio illo aut sit omnis recusandae. Laboriosam architecto quia voluptates at minus. Facilis et quod quod et quasi. Sint nostrum quam corporis non.",
            "artist":"Asperiores nobis eaque repellat reprehenderit accusamus ea nostrum. Enim aut dolore nulla ipsam.",
            "bpm":"Maxime deleniti voluptas ex nisi in. Est dolor autem dolorem labore. Porro non et quidem beatae. Laborum est sunt saepe non.",
            "cd_tracks":"Inventore accusantium dolorum illo nihil molestiae. Rerum consequatur qui earum voluptatem quaerat sit qui. Voluptate est distinctio exercitationem facere fuga deserunt.",
            "chord_or_scale":"Sed est commodi sint atque in nesciunt eius omnis. Omnis quo quod veritatis voluptas aut. Sapiente qui dolorem animi quas dolorem reiciendis. Placeat sequi exercitationem reiciendis.",
            "difficulty_range":"Voluptatibus quibusdam soluta quod dolore est maiores. Deserunt error laboriosam quae aliquam. Et sunt vero sit culpa pariatur unde at. Voluptas officia animi sed dolorum quia.",
            "episode_number":1391290734,
            "exercise_book_pages":"Velit autem soluta velit delectus. Ex quis suscipit ipsum culpa unde et temporibus. Id sit neque dolor. Fuga sed sit eveniet.",
            "fast_bpm":"Rerum vero velit omnis eum sed consectetur quia amet. Eius saepe excepturi eos. Eum eum unde doloribus totam rerum. Eum eveniet vel quod.",
            "includes_song":false,
            "instructors":"Nemo et optio in aut nam. Quod tenetur nemo consequatur repellendus eius mollitia. Quia fugiat dolores voluptatem labore. Enim sint error aliquid inventore autem. Reprehenderit nulla asperiores enim et vitae magni. Dolor est ut et iusto.",
            "live_event_start_time":{  
               "date":"1999-05-28 07:17:10.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1970-08-15 14:12:45.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Perferendis deleniti nesciunt sed dolore ab inventore. Quas vel et vero et. Fugiat vitae non et commodi fuga. Tempora inventore aliquid veniam asperiores veritatis quia. Alias facere nam cupiditate nam non.",
            "live_stream_feed_type":"Voluptatem odit sed deserunt numquam in. Et cum sit pariatur dolores.",
            "name":"Molestias fugiat neque ut adipisci nesciunt ut. Quia est vitae deserunt exercitationem laborum in. Voluptas aut voluptas quae. Nisi fuga nisi perspiciatis necessitatibus quos ea.",
            "released":"Enim autem sint sunt similique sed. Cupiditate voluptatem quia praesentium a. Nisi quisquam quo id voluptatem recusandae.",
            "slow_bpm":"Eum rerum in quisquam similique et architecto ducimus. Dolores sunt dolores ipsa vitae aliquid deleniti consequatur aut. Qui atque ut sunt non. Minus recusandae odio velit quos asperiores ducimus impedit.",
            "total_xp":"Quasi expedita sint aliquid. Velit inventore aliquam occaecati autem voluptatum quia beatae et. Sed voluptas architecto veritatis nulla modi eius tempora sunt. Dicta quo iure est numquam qui sint cum eligendi.",
            "transcriber_name":"Ea ab consequatur at harum quo repellat. Modi odit voluptas qui ipsum. Recusandae nemo autem similique excepturi et adipisci velit.",
            "week":741875519,
            "avatar_url":"Magnam ex dolor ea eaque repellat. Dolor delectus soluta fugiat nemo. Magni inventore perspiciatis ab sunt labore sint.",
            "length_in_seconds":892466360,
            "soundslice_slug":"Reprehenderit nesciunt ut maiores sit animi harum et. Reprehenderit eos animi temporibus laborum. Ducimus quia officia repellat et veniam. Qui est qui ea enim. Molestiae quae ex sunt quasi quaerat. Eos aperiam illo sed sint itaque.",
            "staff_pick_rating":272778147,
            "student_id":1726406914,
            "vimeo_video_id":"Cumque voluptatem magni iusto sapiente ea. Aut et at officia. Voluptate ea accusantium et et enim qui soluta. Non temporibus blanditiis odio qui.",
            "youtube_video_id":"Voluptatem veniam error enim placeat provident aliquid consequatur fuga. Vel ducimus error aliquam soluta sit nihil. Aut nemo molestiae reprehenderit est non omnis est eum. Ad ut dolores praesentium sit reprehenderit dignissimos voluptatem."
         }
      },
      {  
         "type":"content",
         "id":"3",
         "attributes":{  
            "slug":"Asperiores dicta sunt quia. Sit sint consectetur quisquam repellendus officia qui. Aspernatur reiciendis voluptatem ducimus laudantium.",
            "type":"course",
            "sort":"1805133843",
            "status":"published",
            "brand":"brand",
            "language":"Ratione facilis hic veniam qui reiciendis. Dolor aspernatur exercitationem perspiciatis repellendus eius sint beatae omnis. Molestias tempora qui pariatur soluta quia. Ut dolore blanditiis eveniet animi id esse nemo.",
            "user":"",
            "published_on":"2019-05-23 13:08:08",
            "archived_on":{  
               "date":"1980-08-23 08:09:32.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"1980-10-14 04:27:53.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"5",
            "home_staff_pick_rating":"1645056335",
            "legacy_id":993688459,
            "legacy_wordpress_post_id":1597587491,
            "qna_video":"Incidunt corporis cum dolorem quidem. Alias quibusdam ex nobis consequatur et autem. Cum saepe iure placeat animi qui veniam laborum. Et officiis consequatur sit accusantium ut repudiandae. Omnis neque ipsa quidem qui.",
            "style":"Aut nemo molestiae quia perspiciatis. Vitae architecto officia eligendi expedita facilis architecto. Sint in velit qui.",
            "title":"Provident vel et consequatur est sunt.",
            "xp":1055219036,
            "album":"Sed neque amet soluta aut molestiae tenetur eos blanditiis. Ut autem consectetur itaque inventore dolore. Quis culpa autem sit est sed consectetur corporis dolor.",
            "artist":"Aut ut omnis reprehenderit itaque. Voluptatem laboriosam officiis laudantium quam qui enim sit. Repellat debitis velit sit voluptatem placeat ipsum. Eum fugit sunt tenetur dolor voluptas. Quisquam nostrum veritatis repellat quisquam dolores est.",
            "bpm":"Fuga ducimus accusamus est sequi et ut ut. Debitis excepturi qui labore sunt. Totam iure omnis ad. Sapiente sequi dolorem recusandae et quam modi velit. Ullam et rem debitis aperiam facilis hic enim. Cum non veritatis sint sint reiciendis neque.",
            "cd_tracks":"Repellendus rerum omnis qui sed est odio non. Ipsam doloremque numquam quia commodi est id laborum sint. Et ipsum ad deleniti autem. Dignissimos enim sunt quibusdam fugit.",
            "chord_or_scale":"Ipsam esse laudantium beatae placeat quibusdam culpa. Laboriosam maiores iusto beatae. Rerum eos minima dolores maxime atque quo minima. Soluta et dolorem suscipit distinctio labore.",
            "difficulty_range":"Unde ducimus voluptatem debitis facilis consequatur aperiam nobis. Consequuntur harum vel beatae modi ut nam. Sint quisquam voluptatibus esse omnis.",
            "episode_number":898495830,
            "exercise_book_pages":"Soluta rerum sit ex itaque. Voluptatum dolores occaecati consequatur tempore voluptas perspiciatis sit. Ad officia libero saepe et laudantium.",
            "fast_bpm":"Dolores dolor iusto dolores repudiandae. Cumque consectetur est tempore tempora corrupti. Voluptatem nesciunt quidem at qui optio dolore. Tenetur nihil minima quia.",
            "includes_song":false,
            "instructors":"Impedit veniam consectetur error reprehenderit explicabo aut esse. Iusto veritatis molestiae voluptas est nesciunt ipsam. Tenetur tenetur veniam reprehenderit quos. Aperiam autem repudiandae eos unde.",
            "live_event_start_time":{  
               "date":"1993-07-20 18:06:56.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1980-11-05 19:19:35.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Repudiandae nam aut natus est. Consequatur omnis necessitatibus animi alias. Fuga voluptatem quia sint omnis et labore.",
            "live_stream_feed_type":"Aut qui molestias dolor consequatur nemo eligendi. Et officiis voluptate esse dolorum. Laudantium fugiat ut excepturi facilis quo.",
            "name":"Voluptas voluptatem accusantium qui iure repellat a quia. Nostrum voluptas id consectetur aliquam pariatur dolorem architecto. Quia voluptatem eveniet aperiam omnis expedita. Quod quaerat voluptas ullam sit odio aut velit.",
            "released":"Quo beatae architecto molestias commodi modi qui consequatur. Dolorem et accusamus fugiat et incidunt nesciunt. Eius vel nostrum odio qui optio cupiditate at.",
            "slow_bpm":"Nobis dignissimos rem labore veritatis soluta dolorem. Aperiam qui quia saepe earum fuga aut corporis. Officiis minima placeat voluptas dolores quisquam neque. Delectus ipsam dolorem sed vero est.",
            "total_xp":"Ab architecto ipsam tempora consectetur et sit beatae. Aperiam vitae est dolorem velit doloremque. Officiis labore voluptatem dolorem rerum eaque velit.",
            "transcriber_name":"Voluptates exercitationem id ut officiis quia quibusdam harum. Ea saepe excepturi aut consequatur quia. Non vel dignissimos non quam.",
            "week":1103256645,
            "avatar_url":"Ut quis velit non numquam vel temporibus cupiditate. Qui et in optio eaque beatae ut commodi. Quisquam fuga vero incidunt quod sed aut sint. Magnam qui doloribus aut ipsam enim eius.",
            "length_in_seconds":36782200,
            "soundslice_slug":"Aut consectetur id iste tempore omnis. Magnam odio excepturi dolore consequatur error. Id voluptatem nemo voluptatum similique.",
            "staff_pick_rating":59126717,
            "student_id":515157346,
            "vimeo_video_id":"Reprehenderit id sunt repellendus quibusdam aut rem ea. Quia a sed dolorum enim molestias vitae nihil voluptatum. Neque esse ullam ipsum non perspiciatis perferendis et. Voluptatibus dolor voluptatem non quaerat.",
            "youtube_video_id":"Iste labore alias molestiae iure voluptatibus. Quod sed vel voluptatem placeat ratione aut. Maiores culpa hic id qui alias qui. Fuga possimus et voluptatem animi expedita. Quae perferendis et voluptas ipsam. Tempora eum eius itaque fugiat ex facilis."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/content/hierarchy/{parentId}/{childId} }`

Delete the link between parent content and child content and reposition other children.

### Permissions

- Must be logged in
- Must have the 'delete.content.hierarchy' permission 

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|parent id|yes||||
|path|child id|yes||||


### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/hierarchy/1/2',
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

