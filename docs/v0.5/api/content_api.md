# Content API

[Table Schema](../schema/table-schema.md#table-railcontent_content)

The column names should be used as the keys for requests.

# JSON Endpoints

### `{ GET /*/content }`

Filter contents.

### Permissions

- Must be logged in
- Must have the 'pull.contents' permission

### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|query|statuses|no|'published'| |All content must have one of these statuses.|
|query|included_types|no| | |Contents with these types will be returned.|
|query|required_parent_ids|no| | |All contents must be a child of any of the passed in parent ids.|
|query|filter[required_fields]|no| | |All returned contents are required to have this field. Value format is: key;value;type (type is optional if its not declared all types will be included)|
|query|filter[included_fields]|no| | |All contents must be a child of any of the passed in parent ids.|
|query|filter[required_user_states]|no| | |All returned contents are required to have these states for the authenticated user. Value format is: state|
|query|filter[included_user_states]|no| | |Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state but all included states after the first act inclusively. Value format is: state.|
|query|filter[required_user_playlists]|no| | |All returned contents are required to be inside these authenticated users playlists. Value format is: name.|
|query|filter[included_user_playlists]|no| | |Contents that are in any of the authenticated users playlists will be returned. The first included user playlist is the same as a required user playlist but all included playlist after the first act inclusively. Value format is: name|
|query|slug_hierarchy|no| | ||



### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content',
    data: {
        page: 1, 
        limit: 3,
        sort:'-created_on',
        included_types: ['course'],
        statuses: ['published'],
        required_parent_ids:[],
        filter: [required_fields: ['difficulty,1']]
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
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Dolore fugiat et laboriosam repudiandae est animi impedit. Aliquam et nulla dolorum et. Est libero eum est iusto ratione praesentium officia. Aliquid vero ut in rerum. Ipsam corporis quam rem non.",
            "type":"course",
            "sort":"1082583123",
            "status":"published",
            "brand":"brand",
            "language":"Omnis omnis expedita qui quisquam porro consequatur. Illo sit voluptatum minus et. Culpa saepe alias sint sint. Voluptatem eos voluptatem dolorem laboriosam eum quae. Odit qui temporibus officia vel amet.",
            "user":"",
            "publishedOn":"2019-05-24 11:01:10",
            "archivedOn":{  
               "date":"1999-03-12 08:06:24.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1982-09-04 06:13:36.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"1",
            "homeStaffPickRating":"1234840534",
            "legacyId":1161358000,
            "legacyWordpressPostId":1480177397,
            "qnaVideo":"Cum illo quibusdam qui eos non atque assumenda. Ducimus ut voluptatem et velit nisi totam doloremque. Quidem voluptatum sit asperiores eos debitis.",
            "style":"Est sed repellendus officiis dolores sit molestiae. Nihil consequatur est assumenda. Voluptate voluptatibus et rem vitae. Dolor eveniet ut corporis sapiente alias.",
            "title":"Qui iste labore a omnis.",
            "xp":513030679,
            "album":"Ullam officia iste saepe vero a autem omnis voluptate. Non consequatur sunt nisi accusantium. Sapiente a modi quisquam voluptatem et ea officia.",
            "artist":"Facilis mollitia et porro odio. Magnam non quis voluptate ut aut harum. Non praesentium minima sit dolores ducimus ullam.",
            "bpm":"Rerum accusamus nulla ex a. Molestias totam qui mollitia eligendi est id error. Qui dolore voluptatibus nesciunt illo.",
            "cdTracks":"Eius sint velit natus animi praesentium rerum. Atque labore officiis sed omnis voluptates rem eos. Magni odio fugit qui eaque.",
            "chordOrScale":"Explicabo consectetur tempore sint sint ut. Ex ea architecto illum et rerum voluptas assumenda. Explicabo qui quia laudantium consequatur voluptatem.",
            "difficultyRange":"Odio perferendis laborum recusandae temporibus dolores illum. Ut id consequatur eos saepe rem et incidunt. Error sit dolores saepe numquam accusamus.",
            "episodeNumber":98829223,
            "exerciseBookPages":"Similique aut et eaque. Suscipit architecto harum eum velit et magni. Ea ea consectetur ut vero exercitationem. Distinctio adipisci repellendus nam explicabo sunt sequi.",
            "fastBpm":"Vel harum quis dolores reiciendis. At dolorum quae omnis et non praesentium et. Pariatur tempora aut pariatur omnis eius. In error cum reiciendis.",
            "includesSong":false,
            "instructors":"Ipsa voluptas dolorum ut hic delectus sapiente. Ipsam accusamus rerum aperiam. Corrupti minima quia beatae atque exercitationem aut impedit. Cupiditate voluptas veritatis nisi.",
            "liveEventStartTime":{  
               "date":"1987-10-22 03:37:16.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1986-07-05 03:33:14.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Occaecati ducimus aliquid molestiae maiores aperiam eveniet. Sed officia cupiditate assumenda temporibus beatae. Labore labore praesentium dolores similique ea.",
            "liveStreamFeedType":"Minus consequatur velit et tempore. Earum quidem ipsam quia. Odio reprehenderit earum possimus aut commodi. Repellendus quisquam autem earum.",
            "name":"Ut vero omnis debitis pariatur consequatur aperiam. Sunt pariatur deserunt officiis odit animi. Eveniet sequi a deserunt aut quaerat. Aut expedita tempore facilis quibusdam.",
            "released":"Similique cupiditate quo dolorem beatae id soluta esse. Id dolore illo aperiam. Explicabo optio modi optio sed dolores. Odit voluptatem possimus exercitationem est quia. Ullam aliquam est quae.",
            "slowBpm":"Perspiciatis eaque qui doloremque et ut pariatur quo. Nihil repellat sequi eius omnis et ea qui. Qui eos est sit labore. Sit ut enim et ea sunt.",
            "totalXp":"Molestias nesciunt ut tempore voluptate alias. Dicta est impedit reiciendis omnis. Asperiores et et omnis in. Consectetur nulla deserunt maiores laudantium laborum facere rerum.",
            "transcriberName":"Et ea dolor sint ea tenetur. Dolor consectetur nostrum unde quis magni aliquid. Quo quos deserunt ipsum beatae expedita.",
            "week":1099812317,
            "avatarUrl":"Est quidem nemo et praesentium. Aut et recusandae eveniet maiores porro. Voluptatibus id itaque quia non porro.",
            "lengthInSeconds":301499629,
            "soundsliceSlug":"Velit aliquid soluta incidunt fugiat. Necessitatibus et quos et et officia est hic. Debitis consequatur quia error veritatis. Nemo aliquam saepe odit dolor ut quibusdam eligendi.",
            "staffPickRating":116448978,
            "studentId":776460139,
            "vimeoVideoId":"Et vel at consequatur ullam provident vel aut. Repellendus qui dolor veniam et. Consectetur rem praesentium nostrum accusantium omnis ut quisquam. Libero animi corrupti ipsam. Quos sit sit deserunt suscipit.",
            "youtubeVideoId":"Iure voluptatem voluptate et veritatis. Adipisci aut explicabo qui. Molestias sapiente nemo quidem. Aut nulla maxime quae sunt earum autem. Odio quia aut qui sit. Odit est ex voluptatum aut eos amet ipsam. Ipsa deserunt sit sint omnis amet in."
         }
      },
      {  
         "type":"content",
         "id":"2",
         "attributes":{  
            "slug":"Explicabo quia ut rerum dolore. Voluptatem dolore ab est dolore recusandae dicta praesentium. Explicabo natus eligendi qui et maiores deleniti voluptatum.",
            "type":"course",
            "sort":"617428739",
            "status":"published",
            "brand":"brand",
            "language":"Qui et eum et quas aut aspernatur blanditiis. Alias assumenda quisquam officiis quae et. Fugit sed aspernatur aut harum.",
            "user":"",
            "publishedOn":"2019-05-24 11:01:10",
            "archivedOn":{  
               "date":"2003-09-01 14:51:20.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"2015-03-24 19:24:38.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"1",
            "homeStaffPickRating":"729261302",
            "legacyId":978573837,
            "legacyWordpressPostId":1971238498,
            "qnaVideo":"Illum debitis ut perferendis in aperiam quia quo. Repellendus voluptas in nostrum neque dignissimos officiis eum.",
            "style":"Veniam veritatis quisquam minima. Sint officia temporibus eaque est est at. Facilis est libero omnis eos. Dolorem debitis nihil est autem. Rerum architecto atque sint suscipit corrupti cupiditate voluptatem. Ipsa atque minima ab deserunt aliquam ut sunt.",
            "title":"Corrupti temporibus aut officiis.",
            "xp":2098646421,
            "album":"Porro quo neque saepe. Dolorem rem ab impedit ut. Animi facere qui at eos rerum voluptatem. Odio consectetur officia id minus ipsum maxime minus explicabo. Quae in iusto et sint pariatur perspiciatis perferendis. Velit et saepe dolor minus.",
            "artist":"Sint molestias cupiditate perferendis vel omnis ut ut. Assumenda rem et maxime. Quia omnis et facere autem dignissimos quae aliquid.",
            "bpm":"Laudantium temporibus quia aperiam architecto ut dolorum. Ea architecto fugiat earum minus error iusto voluptatem sit. Porro repellat delectus veniam voluptate. Culpa et odit consequatur et quis. Ea qui dolorem veniam consectetur.",
            "cdTracks":"Nostrum consectetur molestiae itaque aliquid delectus tenetur corporis. Voluptas ut incidunt vel. Omnis beatae rem doloremque quia voluptas nisi aut in. Saepe saepe consequatur necessitatibus quisquam facilis iusto deleniti voluptatem.",
            "chordOrScale":"Maiores mollitia aut necessitatibus aut. Rerum repellat modi dignissimos nam. Veritatis mollitia eligendi consequuntur perferendis voluptatem tempora enim.",
            "difficultyRange":"Eligendi quis et impedit rerum optio ut voluptatem. Cupiditate quasi hic dolorem quasi voluptas. Id eaque cupiditate quae nulla mollitia. Aliquid repudiandae nihil illo ipsum earum quos voluptas non.",
            "episodeNumber":798669350,
            "exerciseBookPages":"Pariatur voluptatem dolorem aut alias. Facilis enim aut omnis mollitia consequuntur sint. Et officiis unde error eius pariatur. Possimus possimus assumenda quasi ex dolores qui. Facilis sequi et ex tempore aut nihil.",
            "fastBpm":"Sed fugit aliquid ratione est iure nihil optio. Culpa est voluptas sunt. Ratione nostrum vel dolores sint hic modi quis. Eligendi rerum consequatur rem et. Accusamus libero consequatur dolores. Ut tenetur necessitatibus sed explicabo et vel et.",
            "includesSong":true,
            "instructors":"A voluptatibus tempora reprehenderit dolores. Aut suscipit impedit quibusdam ut non asperiores molestiae. Hic dolores magni ut. Ipsa autem ab neque in veniam ratione.",
            "liveEventStartTime":{  
               "date":"1980-12-30 09:43:59.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1991-07-18 09:47:52.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Ipsum aut reiciendis est molestias vel dolores. Cum aut doloremque voluptas rem ut culpa. Earum ut excepturi quis adipisci rem deserunt fugit. Est aut distinctio et ut.",
            "liveStreamFeedType":"Quidem autem eaque similique adipisci tenetur dolore dolorem. Ad consequatur deserunt nostrum ea eaque assumenda. Qui doloribus similique quasi aperiam voluptas. Vel beatae et qui illum voluptates quasi.",
            "name":"Magni ut aut quod repellendus deleniti. Sunt ut omnis magni et earum quibusdam. Sint dolorum et nostrum. Deleniti ipsum totam inventore aut nam sint.",
            "released":"Voluptatum facilis et unde dolorem. Labore consequuntur qui ullam corporis aliquid placeat et ratione. Et dolorum quia ipsa. Iste ducimus eos quae qui.",
            "slowBpm":"Dolores culpa aut facilis harum voluptas autem et aperiam. Quibusdam est qui quam. Nisi aperiam rerum est facere aperiam rerum. Vel velit eligendi repellat iure est dolorum quae. Est laborum et quasi natus est ut quas. Omnis dolorem saepe et quia illum.",
            "totalXp":"Deleniti dolorem quia qui quasi eaque asperiores. Ut cupiditate dignissimos voluptatem quasi sed odio aliquam dolorum. Quas facilis cupiditate rem ea provident dolores earum.",
            "transcriberName":"Odit ea debitis qui officia ad sint. Commodi quaerat rem sit. Quis doloremque sed enim similique. Est ut error rem amet. Dolor culpa eos vel veritatis inventore. Ad aut non nisi consequatur molestias non. Repudiandae ut enim natus dolores voluptate.",
            "week":31894214,
            "avatarUrl":"Eaque itaque a id ducimus sit. Doloremque molestiae sequi et et eligendi. Occaecati eveniet voluptas rerum libero beatae.",
            "lengthInSeconds":831648152,
            "soundsliceSlug":"Mollitia saepe debitis debitis earum beatae consequuntur animi. Amet velit quasi officiis qui molestiae quis voluptas. Et ab qui molestiae sint et. Ratione nihil ad ipsam adipisci est ea.",
            "staffPickRating":1947308115,
            "studentId":1220639563,
            "vimeoVideoId":"Laboriosam distinctio ut possimus voluptate. Harum ipsa repudiandae est et. Quam nemo ad nihil temporibus repudiandae eum ut aut. Deleniti et omnis voluptatem exercitationem.",
            "youtubeVideoId":"Iste ipsa perferendis tempora delectus consequatur voluptatem. Omnis placeat iure ipsa. Repudiandae molestias dolor itaque similique. Ad quod cum optio totam laborum."
         }
      },
      {  
         "type":"content",
         "id":"3",
         "attributes":{  
            "slug":"Aperiam et eos aut. Dolores debitis totam facere saepe modi sed. Voluptas voluptas corporis corporis voluptas nihil quisquam sed. Aut repellat ipsum sapiente. Inventore debitis voluptatem velit consequatur sint sint voluptatem et.",
            "type":"course",
            "sort":"810378186",
            "status":"published",
            "brand":"brand",
            "language":"Nostrum asperiores aliquam illo et adipisci. Vero ut excepturi praesentium occaecati rem est. Impedit animi totam harum quia laborum quod. Ratione animi omnis mollitia placeat nemo consequuntur cupiditate.",
            "user":"",
            "publishedOn":"2019-05-24 11:01:10",
            "archivedOn":{  
               "date":"2015-12-14 15:14:17.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1991-07-15 04:47:11.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"1",
            "homeStaffPickRating":"330509771",
            "legacyId":252781819,
            "legacyWordpressPostId":734592647,
            "qnaVideo":"Repudiandae non exercitationem iure natus. Qui qui fuga assumenda id dolorem earum. Consequuntur illo ut ut totam. Sequi neque natus voluptatem alias voluptatem harum.",
            "style":"Possimus ut quas perspiciatis dolor expedita voluptas repellat quis. Doloremque qui atque amet assumenda est blanditiis possimus. Impedit aut aut et et aspernatur non dolore.",
            "title":"Aut facilis ipsum ipsam illo sed totam.",
            "xp":1986238075,
            "album":"Perferendis assumenda aperiam commodi sed maiores eos. Et quisquam quia laboriosam quis. Maxime reiciendis quia corrupti est consequuntur. Quod quod omnis quisquam qui. Suscipit nihil magnam modi soluta. Beatae veniam aliquid nulla molestias reiciendis.",
            "artist":"Incidunt laborum rerum officiis veritatis. At optio modi ut et facere qui natus. Qui cum repudiandae in optio nobis aspernatur dolore numquam.",
            "bpm":"Et sint ut minima quasi et corporis. Eum nostrum placeat consectetur perferendis sequi. Omnis id quidem quia qui quibusdam inventore tempore.",
            "cdTracks":"Sit ut atque et nobis et sequi dolorem corporis. Iure dolor eveniet accusantium tempore id quo. Assumenda ea commodi molestiae illum earum nam perspiciatis autem. Dolorem vero quas id. Consequatur inventore ut odio omnis ut quod.",
            "chordOrScale":"Voluptas consequatur et laboriosam aut. A minus necessitatibus voluptatem cum. Odit molestiae nulla repudiandae voluptatibus. Nesciunt et quis non et.",
            "difficultyRange":"Et ut deserunt aut qui unde. Qui est eos ut quisquam officiis delectus a. Aut nulla ea reprehenderit non.",
            "episodeNumber":1772800337,
            "exerciseBookPages":"Id voluptatem repellat assumenda ut architecto sed quasi. Dicta saepe rem nisi impedit eum sunt similique. Quos molestiae qui temporibus omnis.",
            "fastBpm":"Repudiandae dolor omnis voluptas rerum cum molestiae. Natus et dolores ex architecto. Ut eos amet consequatur. Adipisci laudantium nemo id aut. Quos corporis mollitia provident voluptates et id. Praesentium similique voluptas quis id omnis.",
            "includesSong":true,
            "instructors":"Eum quos et quam ea. Consequatur occaecati rerum repellat est. Voluptatem perferendis velit et voluptas ab cupiditate dolorem.",
            "liveEventStartTime":{  
               "date":"1973-06-01 22:29:57.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"2014-08-18 10:14:07.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Ratione possimus magnam ut iure id id laborum. Porro nemo debitis earum neque nihil sit architecto. Iste et ex qui aut occaecati blanditiis velit repellat.",
            "liveStreamFeedType":"Quas dolores vitae et enim reiciendis. Placeat accusamus eveniet error aliquam. Itaque unde atque quia delectus. Laudantium fugiat pariatur tenetur voluptas laboriosam dolorem porro.",
            "name":"Nam est illum laudantium reiciendis. Facere ut assumenda voluptatem placeat qui. Asperiores veritatis vel vero porro. Veniam eaque harum quia excepturi exercitationem enim pariatur.",
            "released":"Maiores voluptates ab et cupiditate. Ut ratione at excepturi explicabo minus enim. Quam autem totam sint cumque et voluptates.",
            "slowBpm":"Eius repudiandae possimus aut. Corrupti voluptatibus corrupti dicta. Quia sapiente molestiae quibusdam dolor eum atque nostrum. Placeat et ut consequatur eum. Dolorum neque est neque. Ipsa quaerat omnis ratione quis omnis et aut.",
            "totalXp":"Occaecati in dolorum quaerat quas. Id esse porro dolor enim beatae consequatur fugit. Maxime ipsa voluptatem eos. Iure laudantium blanditiis vitae beatae aut.",
            "transcriberName":"Ea occaecati praesentium aut voluptas. Dolor voluptatibus accusamus dolores dolorem eligendi facere perferendis magni. Maxime qui qui hic quos asperiores.",
            "week":1792582387,
            "avatarUrl":"Dolorem ut quod et officia. Assumenda dicta voluptatem numquam praesentium sint consequatur neque.",
            "lengthInSeconds":712039477,
            "soundsliceSlug":"Amet id dolorem id et. Eum provident est sunt quos tempora in et accusamus. Quis provident accusantium velit nam tenetur expedita totam.",
            "staffPickRating":1983994349,
            "studentId":628606868,
            "vimeoVideoId":"Eveniet aspernatur harum cupiditate qui. Animi error est quod. Eius sit tenetur magni est unde vel. Possimus optio vel veritatis reiciendis fuga.",
            "youtubeVideoId":"Nihil iste assumenda minus voluptate est eligendi. Ut reiciendis cum veniam temporibus quisquam labore excepturi consectetur. Animi velit doloremque fuga in at."
         }
      },
      {  
         "type":"content",
         "id":"4",
         "attributes":{  
            "slug":"Sapiente aut commodi eos et porro corporis aut. Eaque eos mollitia quo non ut. Nisi cumque eos sed quo doloremque. Maxime error error blanditiis error earum optio et.",
            "type":"course",
            "sort":"504741013",
            "status":"published",
            "brand":"brand",
            "language":"Cumque officia mollitia ipsam quam illo beatae repudiandae. Quo ducimus ab qui necessitatibus dicta aliquid. Earum optio consequuntur laboriosam ducimus. Et est illum voluptatum corrupti. Error at explicabo quidem quae repudiandae quaerat reiciendis.",
            "user":"",
            "publishedOn":"2019-05-24 11:01:10",
            "archivedOn":{  
               "date":"1980-05-31 10:10:47.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1983-01-04 17:39:03.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"1",
            "homeStaffPickRating":"962264093",
            "legacyId":2143429998,
            "legacyWordpressPostId":1683970630,
            "qnaVideo":"Exercitationem sit officia molestiae sed quaerat commodi. Accusantium consequuntur blanditiis nihil magnam corporis. Repellendus perspiciatis repudiandae est dolor ipsa dolore deserunt ipsa.",
            "style":"Accusantium et voluptas soluta doloribus aut et. Ut natus et quia et placeat. Voluptate aliquam totam eum. Architecto quis ipsa hic animi corrupti occaecati dolor rerum.",
            "title":"Aliquam libero nisi velit non porro praesentium beatae.",
            "xp":658031834,
            "album":"Qui similique tenetur consequatur necessitatibus earum quia molestiae. Aut et voluptas sint eos animi culpa. Excepturi libero porro libero sequi culpa est. Pariatur occaecati iure asperiores quia.",
            "artist":"Sint et molestiae ea debitis voluptatem at. Aliquam occaecati qui nihil deserunt. Velit non adipisci fuga illum non deleniti. Quia placeat tenetur earum nam.",
            "bpm":"Rerum esse maxime ipsa fuga in repudiandae quos. Ea ut quasi sequi vel enim similique odit. Labore omnis tempore architecto non.",
            "cdTracks":"Nihil rerum repellendus dolorum doloremque adipisci ipsum. Doloribus eligendi possimus necessitatibus perspiciatis rerum rerum magni. Repellat dolorum dignissimos et rerum reiciendis voluptas cum. Ullam repellendus ex sunt.",
            "chordOrScale":"Laudantium excepturi nobis quis praesentium voluptas. Porro vel mollitia et placeat alias in quasi eius. Saepe quas aut enim. Vero id qui occaecati sint esse.",
            "difficultyRange":"Consequatur sed aut cupiditate recusandae provident itaque. Recusandae ad et vel molestias. Repellendus impedit quo minus quis ipsam autem atque. Deserunt voluptates nam dolorem consequuntur sit et.",
            "episodeNumber":1016644155,
            "exerciseBookPages":"Sed earum est et sed laboriosam laborum. Doloribus vero odit ipsum qui alias sunt voluptates. Harum beatae eveniet amet repellendus recusandae tempora veniam repudiandae. Expedita ipsa maiores cumque maxime dignissimos quos.",
            "fastBpm":"Quaerat ut nesciunt fugit. Quasi nostrum neque dolore. Vel consectetur aut sunt ipsam omnis quo quisquam. Ut reprehenderit numquam quas voluptatem provident aut quia.",
            "includesSong":false,
            "instructors":"Voluptatem voluptatibus laborum deserunt possimus doloribus voluptates velit. Aliquam libero voluptatem libero autem ut. Aliquid natus quis et eum incidunt sint ab.",
            "liveEventStartTime":{  
               "date":"1985-09-25 00:31:13.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1972-02-06 11:41:30.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Aliquam dolorem dolores ut perferendis minima et. Similique nam optio iure ea debitis blanditiis. Quod harum accusantium et sit et. Aut aut vero eveniet vel facere temporibus blanditiis excepturi. Iusto temporibus officia nulla qui vel ipsam iste.",
            "liveStreamFeedType":"Et voluptate fugiat dolorem similique eum perspiciatis ullam. Dolores labore assumenda voluptatem mollitia aspernatur. Repellendus quia a voluptatem consequatur.",
            "name":"Temporibus eaque aut quibusdam praesentium sint. Eaque non officiis aspernatur qui vel. Voluptatum distinctio voluptatem debitis.",
            "released":"Excepturi sint totam quisquam aut tempore. Explicabo similique vitae excepturi similique aut. Perferendis quia tenetur earum. Mollitia cumque sed amet aut. Et quo voluptatem quia minus inventore ducimus expedita.",
            "slowBpm":"Quam ipsum at vitae omnis pariatur. Nobis officia est commodi hic est est et unde. Ducimus officia odit aperiam voluptatem sit ex. Quod cupiditate nihil id dolore necessitatibus ducimus odit vitae.",
            "totalXp":"Et beatae expedita distinctio occaecati est quibusdam sunt. Tempore numquam voluptatum sit quia voluptatum. Illo voluptatum ipsa voluptatibus dolorem ipsa accusamus perferendis. Qui aut corrupti molestias omnis.",
            "transcriberName":"Suscipit eveniet sunt est odit. Itaque placeat maxime repellendus. Repellat quis id repudiandae voluptatum quia neque debitis. Rem rerum corporis laborum. Et dolor hic atque architecto quisquam. Exercitationem ut eos voluptates esse.",
            "week":1517924908,
            "avatarUrl":"Voluptas ut reprehenderit velit excepturi maxime. Aperiam qui architecto repudiandae a quidem labore. Et et sunt necessitatibus ut maxime dicta dolore aut. Temporibus quia suscipit rerum quas minus officiis exercitationem.",
            "lengthInSeconds":1124317227,
            "soundsliceSlug":"Mollitia corporis ut dignissimos voluptate. Ut nihil ut ratione fugit eius occaecati numquam ut. Delectus ut blanditiis inventore et. Accusantium aliquam ipsa perspiciatis eaque. Repellendus aut laudantium et laborum.",
            "staffPickRating":760390714,
            "studentId":1113104244,
            "vimeoVideoId":"Totam nihil ducimus nesciunt ex. Ipsum ut assumenda ut.",
            "youtubeVideoId":"Molestiae aliquid ea voluptas corrupti dolor nesciunt et. Illum ad ipsam rerum eos. Laboriosam aliquid aliquam nulla inventore alias."
         }
      },
      {  
         "type":"content",
         "id":"5",
         "attributes":{  
            "slug":"Pariatur magnam eligendi labore omnis odit sapiente cum. Architecto nemo exercitationem enim tempora fugiat. Est unde ut quo dicta blanditiis eligendi.",
            "type":"course",
            "sort":"654438852",
            "status":"published",
            "brand":"brand",
            "language":"Veniam ut fuga animi occaecati mollitia error. Nihil quo deleniti quo maiores vitae maxime. Autem deleniti beatae est et nostrum. Aut quibusdam voluptatem commodi velit. Commodi vel qui placeat ex.",
            "user":"",
            "publishedOn":"2019-05-24 11:01:10",
            "archivedOn":{  
               "date":"2006-03-10 06:47:13.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"2014-05-22 22:49:59.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"1",
            "homeStaffPickRating":"787022755",
            "legacyId":1238941489,
            "legacyWordpressPostId":168594183,
            "qnaVideo":"Praesentium eligendi sapiente illum. Consequatur numquam nesciunt sit maiores hic adipisci perferendis ut. Et voluptas maxime culpa. Voluptate qui ab quisquam nemo sed.",
            "style":"Id distinctio quod reiciendis enim aut earum non. Nam necessitatibus expedita vel natus ad optio. Architecto ea enim corporis. Aut explicabo nostrum sit vel quia.",
            "title":"Quia ducimus doloremque modi excepturi ratione autem quaerat.",
            "xp":1313095306,
            "album":"Voluptatem officia quasi ut. Qui aut voluptatem nesciunt odit. Nesciunt dicta et velit odio ullam. Quidem magnam nostrum sapiente qui ut quas.",
            "artist":"Praesentium quia est laudantium similique veritatis est voluptas. Tenetur sit et totam accusamus eveniet maxime. Aut animi quia consequatur blanditiis quam.",
            "bpm":"Dicta perferendis aut tempore fugit qui et. Odit inventore rerum dolore id. Nemo fugiat quaerat doloremque nemo.",
            "cdTracks":"Ipsam sit soluta autem commodi ipsum veniam officiis. Cupiditate expedita voluptas possimus minima. Eum eum dolores mollitia assumenda. Iure et vero laudantium et impedit eos.",
            "chordOrScale":"Et minima est beatae reprehenderit sapiente aperiam quia. Hic magnam aspernatur asperiores minus voluptatum alias voluptatem. Numquam quia veniam aliquam numquam consequatur. Temporibus omnis facilis repudiandae corrupti sunt.",
            "difficultyRange":"Voluptatem ab et quae autem. Voluptas labore voluptas ad magnam deleniti unde. Vel error et at. Doloribus at expedita illo sit qui alias amet.",
            "episodeNumber":1608766531,
            "exerciseBookPages":"Et voluptas dolor deserunt non ut cum numquam iste. Sit est et repellendus quia. Voluptatem unde modi et consequuntur adipisci libero soluta. Non sit excepturi maxime in corrupti qui.",
            "fastBpm":"Eum qui incidunt sit dolore quis aliquam error. Voluptatum eum officiis ullam. Consequatur quisquam optio odio eos nihil eum.",
            "includesSong":false,
            "instructors":"Quas eum sunt et sit quas maiores quas. Blanditiis quis doloremque placeat corporis fuga omnis aperiam voluptatem. Sed cumque dolores velit et. Asperiores numquam autem explicabo ipsam.",
            "liveEventStartTime":{  
               "date":"1992-03-18 10:46:02.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1999-05-27 04:35:10.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Alias eos quia quis optio facere ullam ducimus veritatis. Eos quia est sequi voluptatem voluptas. Corporis quidem et repellendus inventore accusamus voluptas. Quibusdam distinctio et sed a porro itaque.",
            "liveStreamFeedType":"Magnam eligendi laborum sequi facere. Maiores alias magni quia enim perspiciatis eos qui. Veniam consequatur eius dolore aliquam ipsum suscipit. Aliquam vel ullam culpa earum aliquam sit.",
            "name":"Molestiae ut id nemo sit voluptate voluptas laboriosam. Aliquid ea accusamus non ex dolore temporibus debitis. Officiis iusto nostrum illum asperiores velit qui ut quas. Dolorum vitae necessitatibus laborum accusamus.",
            "released":"Ut quas est excepturi fugit sed. Quam quia hic delectus ut. Architecto totam in ea quam voluptas voluptas quis odit. Asperiores natus magni voluptatem reiciendis corporis et.",
            "slowBpm":"Qui voluptatum hic aut harum. Error animi sint non voluptatibus. Quis unde quia aut quisquam.",
            "totalXp":"Dolores praesentium laboriosam reprehenderit ea sint. In autem soluta tempora unde ratione enim. Sunt incidunt explicabo asperiores delectus aut non aut. Perferendis necessitatibus amet voluptatum molestias vitae. Molestiae eum dignissimos ullam sed.",
            "transcriberName":"Id nihil rem molestiae cumque laudantium nihil dolorum qui. Ut impedit quod molestias maiores corporis quia. Aut illum quam quam hic id saepe debitis. Hic et rerum consectetur dolor enim sed ipsam tempore.",
            "week":150235606,
            "avatarUrl":"Iusto excepturi velit perspiciatis molestiae unde quos. Deleniti atque nemo laboriosam voluptates facere. Possimus libero debitis quidem aliquam consequatur laboriosam ut. Id et iure magni et similique consequatur.",
            "lengthInSeconds":1432096936,
            "soundsliceSlug":"Aut ut et temporibus voluptatum. Aut sint sed cumque quia. Temporibus magni qui mollitia alias et laboriosam itaque. Culpa culpa laudantium consequuntur non ut ipsam placeat.",
            "staffPickRating":575556891,
            "studentId":251840401,
            "vimeoVideoId":"Ut provident eum cupiditate quidem. Molestiae qui ab ipsum neque nihil in omnis. Voluptates non nihil veritatis perspiciatis earum nemo earum.",
            "youtubeVideoId":"Iure harum quaerat vel eum. Aut dignissimos enim eaque facere. Doloribus ex beatae recusandae aut. Repellat optio aut quis autem beatae pariatur vel."
         }
      }
   ],
   "meta":{  
      "filterOption":{  
         "difficulty":[  
            "1"
         ],
         "style":[  
            "Est sed repellendus officiis dolores sit molestiae. Nihil consequatur est assumenda. Voluptate voluptatibus et rem vitae. Dolor eveniet ut corporis sapiente alias.",
            "Veniam veritatis quisquam minima. Sint officia temporibus eaque est est at. Facilis est libero omnis eos. Dolorem debitis nihil est autem. Rerum architecto atque sint suscipit corrupti cupiditate voluptatem. Ipsa atque minima ab deserunt aliquam ut sunt.",
            "Possimus ut quas perspiciatis dolor expedita voluptas repellat quis. Doloremque qui atque amet assumenda est blanditiis possimus. Impedit aut aut et et aspernatur non dolore.",
            "Accusantium et voluptas soluta doloribus aut et. Ut natus et quia et placeat. Voluptate aliquam totam eum. Architecto quis ipsa hic animi corrupti occaecati dolor rerum.",
            "Id distinctio quod reiciendis enim aut earum non. Nam necessitatibus expedita vel natus ad optio. Architecto ea enim corporis. Aut explicabo nostrum sit vel quia."
         ],
         "artist":[  
            "Facilis mollitia et porro odio. Magnam non quis voluptate ut aut harum. Non praesentium minima sit dolores ducimus ullam.",
            "Sint molestias cupiditate perferendis vel omnis ut ut. Assumenda rem et maxime. Quia omnis et facere autem dignissimos quae aliquid.",
            "Incidunt laborum rerum officiis veritatis. At optio modi ut et facere qui natus. Qui cum repudiandae in optio nobis aspernatur dolore numquam.",
            "Sint et molestiae ea debitis voluptatem at. Aliquam occaecati qui nihil deserunt. Velit non adipisci fuga illum non deleniti. Quia placeat tenetur earum nam.",
            "Praesentium quia est laudantium similique veritatis est voluptas. Tenetur sit et totam accusamus eveniet maxime. Aut animi quia consequatur blanditiis quam."
         ]
      },
      "pagination":{  
         "total":5,
         "count":5,
         "per_page":10,
         "current_page":1,
         "total_pages":1
      }
   },
   "links":{  
      "self":"http:\/\/localhost\/railcontent\/content?page=1&limit=10&sort=id&included_types%5B0%5D=course&required_fields%5B0%5D=difficulty%2C1",
      "first":"http:\/\/localhost\/railcontent\/content?page=1&limit=10&sort=id&included_types%5B0%5D=course&required_fields%5B0%5D=difficulty%2C1",
      "last":"http:\/\/localhost\/railcontent\/content?page=1&limit=10&sort=id&included_types%5B0%5D=course&required_fields%5B0%5D=difficulty%2C1"
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ GET /*/content/{ID} }`

Pull content based on content id.

### Permissions

- Must be logged in
- Must have the 'pull.contents' permission

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||


### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{  
   "data":{  
      "type":"content",
      "id":"1",
      "attributes":{  
         "slug":"Perferendis explicabo aliquam et expedita sed perspiciatis cumque. Ut itaque repellat culpa dolores. Mollitia nemo non et vitae sit. Explicabo voluptas facere esse mollitia.",
         "type":"course",
         "sort":"1267108653",
         "status":"published",
         "brand":"brand",
         "language":"Asperiores aut voluptatibus natus sapiente temporibus dignissimos. Aut sint natus dolorem et suscipit. Accusamus culpa aliquid quam autem est ab. Sunt vel debitis sit et quis.",
         "user":"",
         "publishedOn":{  
            "date":"1976-09-15 09:46:10.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "archivedOn":{  
            "date":"1984-05-31 15:17:37.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "createdOn":{  
            "date":"1981-04-13 22:56:05.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "difficulty":"1",
         "homeStaffPickRating":"69401688",
         "legacyId":345913780,
         "legacyWordpressPostId":1948909903,
         "qnaVideo":"Ipsa placeat officiis aut architecto ut sed ipsa. Qui voluptas cumque voluptatibus enim eveniet quod. Suscipit facilis aut adipisci numquam quas consequatur ut eveniet. Qui modi cupiditate quibusdam quibusdam qui. Tempora enim praesentium repellat.",
         "style":"Qui commodi molestias doloribus harum quam ipsum illo. Recusandae sapiente incidunt id aliquid. Aut assumenda sunt adipisci.",
         "title":"Illum sed itaque omnis est laboriosam esse.",
         "xp":1198258392,
         "album":"Quae dolores omnis vitae qui magni. Quaerat reiciendis fuga porro aut. Ab enim dignissimos repudiandae molestiae. Enim quos qui natus debitis eum expedita non.",
         "artist":"Molestiae eos esse vel beatae. Reiciendis laboriosam provident enim sint. Dolorem soluta tempora vitae ut est. Voluptates earum suscipit aut.",
         "bpm":"Dolores est consequatur quis est et esse. Porro et voluptas voluptas et laudantium praesentium. Neque doloribus quam et. Sit amet sunt minus assumenda non qui cupiditate dicta. Suscipit deleniti culpa est. Doloremque laboriosam sit dolorem magni.",
         "cdTracks":"Sunt praesentium nihil laborum ex impedit commodi eos et. Sit qui animi perspiciatis quas. Laboriosam cum voluptates non voluptas eligendi consequuntur sit. Rerum et eaque reiciendis dignissimos.",
         "chordOrScale":"Unde temporibus provident minima fugit debitis voluptatem perferendis quisquam. Aspernatur perspiciatis non est et provident laudantium. Temporibus vel placeat est qui voluptates rerum. Corrupti minima eum magni vero.",
         "difficultyRange":"Quibusdam recusandae in culpa explicabo illo. Qui iure fugiat ut recusandae unde at rem deleniti. Porro et reiciendis saepe distinctio deserunt. Dolore blanditiis reiciendis ea.",
         "episodeNumber":1819889664,
         "exerciseBookPages":"Nesciunt animi non qui voluptatum vel. Consequatur aut laudantium ipsa sint sunt consequuntur neque. Deleniti vel qui earum non quasi dolorem perspiciatis. Cumque laborum numquam beatae hic vel. Magni quo deleniti magni molestiae.",
         "fastBpm":"Aut nihil doloribus laboriosam. Rem esse et et. Qui soluta officia quam. Vero assumenda eos qui modi possimus. Enim aperiam omnis error et omnis. Sequi necessitatibus qui exercitationem error.",
         "includesSong":false,
         "instructors":"Cum laborum natus amet optio. Possimus velit reiciendis et aliquid consequatur harum perferendis earum. Placeat iusto et debitis voluptatibus. Quo doloribus dolor magnam tenetur.",
         "liveEventStartTime":{  
            "date":"2018-07-26 11:39:39.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "liveEventEndTime":{  
            "date":"2002-05-11 16:00:22.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "liveEventYoutubeId":"Tempore sint dolor odio incidunt. Libero error sed repudiandae hic. Qui modi eaque recusandae voluptatibus sequi. Accusantium magni animi officiis esse aspernatur dolores ut. Quasi assumenda soluta culpa voluptas. Fugiat est sint amet.",
         "liveStreamFeedType":"Quia non voluptatem maiores. Illo sunt autem quis voluptatem sed soluta. Doloremque placeat nisi veritatis deserunt nulla ratione.",
         "name":"Optio hic modi repudiandae error totam sequi excepturi. Assumenda maxime sit explicabo accusantium. Maiores officia cum suscipit laboriosam. Aut quis esse nesciunt assumenda rem.",
         "released":"Consequatur sint exercitationem qui qui ipsa quae. Dolorum tenetur ad quasi sapiente. Autem id sed quas necessitatibus sed. Optio aut ut ab dolore dolores fuga.",
         "slowBpm":"Animi corporis ipsam quis numquam totam quam. Ea impedit asperiores eius. Blanditiis occaecati consequatur explicabo eos eum cupiditate quidem ut. Et cupiditate quia tempora laboriosam.",
         "totalXp":"Fuga voluptatem id sed non voluptatem et ex quis. Est ad aut quae sunt aut. Unde harum incidunt officiis autem odio. Nisi et ducimus est quia sint dolor exercitationem voluptatibus. Eum consectetur veniam aut molestias libero beatae.",
         "transcriberName":"Atque voluptatem voluptatem incidunt ipsa. Quisquam alias quos quia dolores occaecati debitis atque. Iusto illo doloribus optio quisquam.",
         "week":347593682,
         "avatarUrl":"Quo animi ut rerum repellat dolorem veniam aut. Est exercitationem et neque consequatur quam est. Fugiat sunt id reprehenderit nisi adipisci qui. Aut et corporis ea unde praesentium reiciendis.",
         "lengthInSeconds":1956569228,
         "soundsliceSlug":"Dolor dolorem sed repellendus sit itaque temporibus. Voluptatibus ut laboriosam voluptas deleniti. Accusantium corrupti est recusandae. Deserunt eum numquam enim ad in.",
         "staffPickRating":556220407,
         "studentId":1399159370,
         "vimeoVideoId":"Quidem et qui sunt qui nostrum debitis. Consequatur in rerum quam fugiat praesentium in quos. Qui est et eligendi. Eaque et quod earum dolores. Iusto et ex et aliquid suscipit quia.",
         "youtubeVideoId":"Adipisci culpa magnam expedita delectus voluptatum exercitationem laborum ipsa. Voluptates voluptatem libero magnam consequatur quia. Alias quod animi aut odit dolor."
      },
      "relationships":{  
         "data":{  
            "data":[  
               {  
                  "type":"contentData",
                  "id":"1"
               },
               {  
                  "type":"contentData",
                  "id":"2"
               }
            ]
         },
         "instructor":{  
            "data":{  
               "type":"instructor",
               "id":"1"
            }
         },
         "topic":{  
            "data":[  
               {  
                  "type":"topic",
                  "id":"1"
               }
            ]
         }
      }
   },
   "included":[  
      {  
         "type":"instructor",
         "id":"2",
         "attributes":{  
            "slug":"Tressa Skiles",
            "type":"instructor",
            "sort":"1681671787",
            "status":"published",
            "brand":"brand",
            "language":"Atque quod accusamus qui. Reiciendis quia ipsam quibusdam magnam nihil mollitia. Dicta dolor quaerat quos expedita reprehenderit nisi. Nobis pariatur sit ut voluptatem. Occaecati ipsum nobis nobis impedit debitis maiores. Et et qui sequi nihil omnis.",
            "user":"",
            "published_on":{  
               "date":"2003-03-13 04:20:15.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "archived_on":{  
               "date":"1997-04-13 22:35:08.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"1989-08-06 17:38:50.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Magni quo vitae sequi laborum assumenda eos. Praesentium qui ea tenetur. Dolores perspiciatis facilis et nesciunt ratione voluptates. Nemo nisi dolorem iste modi. Dicta non quam quia magnam illo et dolore.",
            "home_staff_pick_rating":"506323542",
            "legacy_id":865648380,
            "legacy_wordpress_post_id":219553443,
            "qna_video":"Ut eius blanditiis sed neque omnis. Enim officia pariatur sit error.",
            "style":"Debitis porro voluptatum et quia tempore incidunt et ut. Debitis non et minus repellat nesciunt eos. Aut sed nihil fugiat sapiente eum temporibus. Adipisci aut et quis accusantium.",
            "title":"Id ut blanditiis temporibus voluptatem omnis est.",
            "xp":540902024,
            "album":"Culpa impedit sint nobis consequatur. Quia ut optio tempora est error quidem nemo. Rerum magnam officia id qui nulla accusamus incidunt. Vel illo quos animi.",
            "artist":"Quo facere earum perspiciatis suscipit quasi ratione sed. Consectetur dolores illo nihil accusamus et cum voluptas enim. Consectetur dolor dolores commodi cumque earum culpa corrupti.",
            "bpm":"Libero architecto explicabo quos voluptatibus. Assumenda vel eum ipsum magnam qui. Omnis illo voluptatum et ad eum magnam repellat. Optio molestias debitis explicabo.",
            "cd_tracks":"Deleniti explicabo veritatis incidunt ea. Officia similique natus esse minima velit velit veritatis dolor. Quaerat voluptatem recusandae cum ut.",
            "chord_or_scale":"Eaque dolor veniam molestiae. Sapiente voluptate sint quis a molestias ipsum libero voluptatem. Suscipit consequuntur necessitatibus fuga iure labore. Ea voluptas aut dolore consectetur quae.",
            "difficulty_range":"Debitis sequi expedita esse. Dolorem voluptatem et voluptas vel id unde est. Quidem omnis similique nesciunt cumque. Atque qui nisi numquam minus quasi.",
            "episode_number":1326186067,
            "exercise_book_pages":"Laborum alias ea fugiat quis et. Voluptatem quia qui fugiat deserunt amet cumque consequuntur. Fugiat eaque et dolores rerum beatae sint. Et qui eos inventore. Ea ullam similique dignissimos non consequatur omnis doloribus.",
            "fast_bpm":"Dolores sit distinctio eaque nisi magnam neque consequuntur in. Dolor perferendis dolorum eos beatae quo rerum aliquam. Aspernatur eius sit placeat natus molestiae eum dolores.",
            "includes_song":false,
            "instructors":"Consequuntur dolorum animi autem. Eius consequatur aut repellendus. Itaque laudantium doloribus beatae nihil id non cumque. Quae nam molestiae eum. Rerum sit dicta eaque modi. Excepturi et assumenda ut. Eos dolores voluptatem ex cum cum eaque dolores et.",
            "live_event_start_time":{  
               "date":"2004-02-20 07:56:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"1977-05-21 02:13:44.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Similique beatae voluptate ut quia. Laudantium reprehenderit iusto non hic quis dolor harum. Temporibus suscipit non vel placeat. Hic autem suscipit sit qui.",
            "live_stream_feed_type":"Nostrum doloribus culpa et deserunt temporibus quod. Velit vero quas blanditiis qui vel recusandae. Qui officiis est mollitia quis ex incidunt aut. Laboriosam omnis qui sunt quisquam voluptas sunt.",
            "name":"Labore labore et commodi quis non. Sit corrupti natus porro exercitationem ut hic. Mollitia voluptatem corporis ad ducimus.",
            "released":"Perferendis et placeat ut. Rerum harum laudantium aliquam officiis quia rerum amet. Eum omnis et deserunt sit quis voluptatem similique. Voluptas in quibusdam fuga reprehenderit.",
            "slow_bpm":"Aut sit est est. Nobis nulla illum incidunt omnis sunt. Illum distinctio repudiandae dignissimos et quaerat officia molestiae. Mollitia optio ipsam veritatis et et.",
            "total_xp":"Est nobis sequi veniam omnis soluta nam accusamus. Nihil debitis aut occaecati perferendis. Laboriosam ab sapiente eveniet similique distinctio consequuntur eaque. Iure blanditiis soluta qui nesciunt voluptatem.",
            "transcriber_name":"Quos magnam officiis asperiores aut nesciunt ut praesentium. Est veniam rerum velit reiciendis aut. Veniam nobis repudiandae blanditiis nihil amet corrupti. Fugiat eum sed possimus dolor. Magnam ex vel placeat dolorem ea beatae.",
            "week":1867691732,
            "avatar_url":"Tempora quaerat recusandae consequatur impedit autem laudantium. Tempore nobis maxime est repellendus voluptas ipsa facere. Labore distinctio minus quia id in.",
            "length_in_seconds":824982091,
            "soundslice_slug":"Nulla quas facere quidem porro quas ut in vel. Magni ut dolores illo sequi. Nemo odit repudiandae culpa facilis aliquam debitis. Repellendus laboriosam itaque maxime suscipit.",
            "staff_pick_rating":98285281,
            "student_id":859155631,
            "vimeo_video_id":"Ipsa est modi officiis quia. Commodi labore odio necessitatibus adipisci. Quos ipsa recusandae error illum eius nam dolor nesciunt. Voluptates dolorum ut vero culpa.",
            "youtube_video_id":"Exercitationem fugiat dignissimos ut inventore. Iste quis ex veritatis placeat voluptates quo distinctio. Modi quis rerum pariatur doloribus nobis. Ipsa recusandae expedita accusantium."
         }
      },
      {  
         "type":"contentData",
         "id":"1",
         "attributes":{  
            "key":"iste",
            "value":"Fugit aut at ut doloribus qui pariatur corrupti. Voluptas nisi saepe adipisci qui. Tempora et est non porro dolore qui cumque qui. Consequatur a repellat nihil voluptas alias.",
            "position":1
         }
      },
      {  
         "type":"contentData",
         "id":"2",
         "attributes":{  
            "key":"dignissimos",
            "value":"Sed ut id nostrum tempora dolor a nihil. Eaque quo consequatur qui molestiae ad. Vel autem autem totam rerum expedita aut placeat.",
            "position":2
         }
      },
      {  
         "type":"instructor",
         "id":"1",
         "attributes":{  
            "position":1251207455
         },
         "relationships":{  
            "instructor":{  
               "data":{  
                  "type":"instructor",
                  "id":"2"
               }
            }
         }
      },
      {  
         "type":"topic",
         "id":"1",
         "attributes":{  
            "topic":"odio",
            "position":1
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ GET /*/content/parent/{parentId}  }`

Pull contents that are children of the specified content id.

### Permissions

- Must be logged in
- Must have the 'pull.contents' permission

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes| | | parent id|



### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/parent/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{  
   "data":[  
      {  
         "type":"content",
         "id":"2",
         "attributes":{  
            "slug":"Esse dignissimos incidunt blanditiis repellat. Earum debitis occaecati corrupti eos voluptatem harum doloremque. Sit et voluptates hic magni ipsum porro. Repellendus et aut minus enim natus qui.",
            "type":"Reprehenderit ipsum rerum id voluptatem facilis. Molestiae aut architecto non sit cumque. Aut deleniti aliquid consequuntur qui. Recusandae aut in veniam dolor saepe autem.",
            "sort":"411606305",
            "status":"published",
            "brand":"brand",
            "language":"Molestiae nam consectetur sapiente quae rerum ex. Tempore omnis ab consequatur temporibus ipsa itaque vitae. Velit aut accusantium excepturi dolor quas ut quo mollitia. Aut assumenda maxime consequatur eos voluptas.",
            "user":"",
            "publishedOn":"2019-05-24 11:42:49",
            "archivedOn":{  
               "date":"1984-03-16 05:11:52.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1972-09-03 22:45:38.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Dolor et est ut odio. Error perferendis fugit aspernatur voluptatem. Porro sunt deleniti sapiente placeat dicta perspiciatis. Aperiam necessitatibus nesciunt cupiditate totam.",
            "homeStaffPickRating":"1526017420",
            "legacyId":138218553,
            "legacyWordpressPostId":1608774623,
            "qnaVideo":"Enim ad non ut dolorem doloribus dolorem nemo. Ea et necessitatibus qui cum. Excepturi placeat explicabo non consequatur voluptatum nihil sed. Itaque culpa in consequatur nemo et voluptatem possimus at.",
            "style":"Voluptate quia recusandae deleniti magni velit. At officiis fugit asperiores ipsa consequatur reiciendis repudiandae. Rerum quas quam asperiores et aliquam. Commodi non hic enim commodi aut recusandae exercitationem.",
            "title":"Fugiat hic non sapiente blanditiis omnis.",
            "xp":940263227,
            "album":"Et at perferendis pariatur sit quo voluptate illo. Tempora ea deleniti laboriosam et aut. Non quae minus doloremque quisquam. Blanditiis rerum provident laudantium facilis.",
            "artist":"Laborum recusandae est tempora velit nostrum. Quos libero similique dolor suscipit. Nam harum adipisci laboriosam odit omnis.",
            "bpm":"Ipsam voluptatem molestiae exercitationem molestiae animi ut. Vero ipsam facere possimus nulla. Voluptas ratione quis fugiat dicta et. Quaerat laborum ut itaque ea voluptas sequi et quaerat. Ut rerum repudiandae nihil nisi voluptatem ab iusto.",
            "cdTracks":"Et reprehenderit eligendi quam adipisci molestiae blanditiis facere et. Dignissimos voluptas repudiandae tempora. Consequatur ad enim sit autem facere voluptatem officiis. Labore non nam non tempore maiores accusantium.",
            "chordOrScale":"Architecto sit illum et corporis nihil enim officiis. Qui voluptas totam temporibus ex enim inventore sequi itaque. Labore omnis velit quam accusamus optio alias. Magni cupiditate nulla et adipisci alias alias.",
            "difficultyRange":"Sapiente quis tempore blanditiis molestiae quidem sed aut sunt. Omnis vitae quia libero dolor vel vero. Est necessitatibus aut ullam. Esse qui ratione aut est voluptas.",
            "episodeNumber":1979954215,
            "exerciseBookPages":"Minus eum aperiam temporibus perferendis dolore. Consectetur quod architecto ut aperiam rerum odit quibusdam.",
            "fastBpm":"Quibusdam nisi neque dolores quidem eum. Consequatur voluptatem consequatur numquam repudiandae nemo sit officiis. Totam deserunt minus nulla ut quae rerum accusantium. Aut repellendus illo nihil sit.",
            "includesSong":true,
            "instructors":"Ut occaecati omnis architecto harum. Qui possimus ullam voluptates et animi id. Sunt quisquam sed illo inventore rem blanditiis. Fuga aut voluptatem sit voluptatibus aliquam.",
            "liveEventStartTime":{  
               "date":"2005-06-15 01:20:45.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1989-07-14 04:01:46.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Molestiae consequuntur sit sed quis saepe. In cupiditate minima impedit fuga. Voluptates minima error sint quasi quam expedita magni.",
            "liveStreamFeedType":"Enim incidunt sed porro saepe esse assumenda officia. Et ut dolores voluptatem quod dolor molestiae molestiae. Eveniet omnis non ut quis porro enim sequi.",
            "name":"Maxime rerum et autem deserunt. Saepe nulla quia eos accusamus voluptate sapiente nisi. Ut maiores sequi cumque accusamus voluptatem quia qui.",
            "released":"Rerum inventore laboriosam cumque nihil. Accusamus similique illum ut quae ullam vel. Est voluptatem reiciendis rerum. Soluta autem nulla quo aliquid rerum quos et. Ipsum possimus non fuga qui quaerat voluptate.",
            "slowBpm":"Culpa a tenetur ut delectus accusantium dolores aperiam. Ut consequuntur magnam eum amet et quod. Ut voluptates nemo quam et id rem.",
            "totalXp":"Explicabo ducimus est qui dicta. Officia non minima in nam. Sit eos repellendus in enim voluptas quis voluptate. Cupiditate ut est aliquid autem.",
            "transcriberName":"Ab nobis adipisci repellat debitis est. Amet voluptatem illo ut eum cupiditate repellat sint molestiae. Quasi non distinctio quod error.",
            "week":601806524,
            "avatarUrl":"Optio quasi ut velit eaque dolor. Dolor et inventore numquam accusantium placeat assumenda. Debitis eum enim vel tenetur nisi ipsam. Doloremque fuga est eveniet dolores voluptatem iure.",
            "lengthInSeconds":56090371,
            "soundsliceSlug":"Et eos iure eum aut ut reprehenderit autem. Velit autem dolor asperiores voluptatibus quod et eos.",
            "staffPickRating":1685190475,
            "studentId":1905694382,
            "vimeoVideoId":"Eos labore vitae necessitatibus ex. Nesciunt voluptatem ut voluptas vel magnam consequuntur. Exercitationem est omnis voluptatem qui asperiores.",
            "youtubeVideoId":"Minus praesentium maxime voluptatem voluptas animi non. Nihil velit error quos dolores. Quo eum occaecati non sit hic ad officia."
         },
         "relationships":{  
            "parent":{  
               "data":{  
                  "type":"parent",
                  "id":"1"
               }
            }
         }
      }
   ],
   "included":[  
      {  
         "type":"parent",
         "id":"1",
         "attributes":{  
            "slug":"Officiis ducimus consequatur excepturi omnis. Quae exercitationem eveniet repellendus et in laborum.",
            "type":"Earum impedit voluptatibus amet vitae facere. Tenetur qui qui quos quia voluptatem ut et. Repellat quos perferendis nobis iusto. Atque esse accusamus ab qui facere perferendis ullam.",
            "sort":"1051653035",
            "status":"published",
            "brand":"brand",
            "language":"Atque consequatur eum labore non. Est pariatur eius unde veritatis vitae accusamus ut. Possimus qui aut ducimus consequatur est quia. Magnam magni quam eaque repellendus sed et.",
            "user":"",
            "published_on":"2019-05-24 11:42:49",
            "archived_on":{  
               "date":"1980-02-05 19:40:30.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "created_on":{  
               "date":"2000-06-13 09:52:40.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Voluptate velit voluptatem nam voluptatem. Aliquam voluptas qui velit vitae ipsam quibusdam. Consequatur esse aspernatur consequatur fugit. Autem enim et sit dolor et temporibus voluptatem id.",
            "home_staff_pick_rating":"1242401690",
            "legacy_id":412832964,
            "legacy_wordpress_post_id":1742179056,
            "qna_video":"Nihil amet porro placeat est qui nemo tempore. Voluptatibus quam blanditiis aliquid. Recusandae corporis temporibus quod. Ea sint adipisci facere non mollitia.",
            "style":"Nostrum sunt voluptatum non similique quis. Est voluptatem omnis beatae minima aut doloribus repellendus. Maiores alias et delectus ut culpa ratione. Rem perferendis debitis sed deleniti minima rem dolor possimus.",
            "title":"Est autem repudiandae ab.",
            "xp":2111722670,
            "album":"Expedita ut assumenda exercitationem ut cupiditate. Aut qui id sit culpa quod ut perspiciatis et. Hic expedita suscipit praesentium beatae dolorum molestiae. Dolorem vel voluptatem quo fuga ex amet consequatur.",
            "artist":"Similique consequatur doloribus nihil sunt. Fugiat consequatur non qui quaerat hic. Similique omnis voluptatem magnam dicta modi.",
            "bpm":"Cum sed dignissimos dolorem amet voluptatibus exercitationem. Ipsum quo maiores odit odit nostrum nam sed. Dicta numquam sed fugit eveniet voluptate est. Ducimus earum temporibus quod eos saepe iste unde dolorem.",
            "cd_tracks":"Aut eum cum quibusdam doloremque. Quidem ad ut suscipit tenetur temporibus a ipsam. Eum et et veniam minima. Vel ut harum est optio maiores cum dolorem.",
            "chord_or_scale":"Natus harum quia in commodi. Debitis voluptates voluptate ab reiciendis sed. Provident voluptate quis omnis.",
            "difficulty_range":"Asperiores non ut praesentium veritatis. Magnam quia non temporibus deserunt consequatur voluptates. Dolorum iure praesentium ipsam cum.",
            "episode_number":45218443,
            "exercise_book_pages":"Iste soluta sed dolorem nihil id nesciunt. Aut optio laboriosam et repudiandae maiores aut aut. Nobis expedita voluptates nesciunt molestiae ad est ipsum. Sint consequatur a eveniet reiciendis magnam sunt. Dignissimos natus non voluptatem.",
            "fast_bpm":"Culpa sed veritatis voluptates sunt. Dolor consequatur aliquid velit aperiam totam veritatis recusandae. Non quia nihil quo dignissimos sed architecto dignissimos. Laborum officia voluptate corrupti vel.",
            "includes_song":true,
            "instructors":"Veniam quo et commodi qui. Maxime expedita ipsum nobis molestiae sit. Laudantium dolor eveniet ducimus harum. Sit dolor sed numquam aspernatur.",
            "live_event_start_time":{  
               "date":"1976-01-25 17:35:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_end_time":{  
               "date":"2005-01-02 20:43:32.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "live_event_youtube_id":"Eum perferendis quis ad rerum. Consequatur voluptatum est fugiat nihil harum possimus voluptas. Id eum recusandae et. Ullam nemo excepturi id quis quibusdam.",
            "live_stream_feed_type":"Natus sunt accusamus repellendus qui sunt sint modi aliquid. Dolores in aperiam quos earum id itaque. Dicta debitis omnis possimus laboriosam ut quisquam. Consequuntur cum ullam quos voluptas quia modi.",
            "name":"Sapiente voluptatem ut nam dolores quasi voluptates. Eligendi distinctio omnis excepturi alias eius non est vel. Asperiores tempora eius et fuga pariatur. Blanditiis et inventore eligendi doloribus.",
            "released":"Voluptatem rerum corporis iure harum sunt libero. Numquam quia placeat aut facilis ullam nostrum blanditiis. Aut quia est id quia laborum officia. Tempora consequatur veniam recusandae dolorem porro molestiae.",
            "slow_bpm":"Quaerat dolorem explicabo excepturi. Sit facilis in debitis. Accusantium dolore laboriosam laboriosam enim est assumenda aut. Ab a quidem sit et voluptates. Non consequatur et magni et.",
            "total_xp":"In distinctio quasi nemo. Dolorem sit est enim repellendus error. Ducimus modi corrupti rem est nostrum iste.",
            "transcriber_name":"Enim illum animi qui impedit. Iure ipsam doloremque non culpa aut. Deserunt quasi officia officiis ut. Quae est iste consequuntur et nisi sint. Consequatur nulla est voluptatem. Voluptatem voluptatibus numquam mollitia dolorem.",
            "week":1269968859,
            "avatar_url":"Quam alias est veritatis earum. Fugiat cum vel sint sed vel perferendis in. Qui doloremque est debitis non delectus. Numquam odit praesentium ipsum.",
            "length_in_seconds":708938024,
            "soundslice_slug":"Consequuntur et blanditiis iusto facilis ullam. Maiores aspernatur ipsam autem perspiciatis quia aperiam. Voluptas eius amet et ut.",
            "staff_pick_rating":198878918,
            "student_id":728757990,
            "vimeo_video_id":"Qui vel vitae tenetur consequatur labore voluptatem. Velit voluptatibus ipsum unde qui numquam reiciendis vel. Odio facere eos provident quam. Rerum fugiat sapiente cum repellendus nulla. Ea itaque quis enim voluptatum sit. Et qui et qui.",
            "youtube_video_id":"Suscipit magni temporibus eius iste. Optio quis dolorum distinctio ut voluptas sit aut consequatur. Autem sed voluptatem minima praesentium."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ GET /*/content/get-by-ids }`

Pull contents based on content ids.

### Permissions

- Must be logged in
- Must have the 'pull.contents' permission

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|query|ids|yes| | |A comma separated string of the ids you want to pull.|



### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/get-by-ids',
    data: {
            ids: "2,1", 
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
         "type":"content",
         "id":"2",
         "attributes":{  
            "slug":"Deleniti quasi molestiae dolores a sit sed nulla qui. Voluptas illum maiores error veritatis suscipit expedita sunt. Asperiores qui sit qui tempora voluptates. Voluptas quasi exercitationem rerum voluptatem eum voluptas necessitatibus.",
            "type":"Possimus ut et perspiciatis qui. Ipsam nihil reiciendis iste cum voluptatem eum. Repudiandae dolorem ducimus deleniti quia minus exercitationem. Accusantium sequi et excepturi sit ea voluptas.",
            "sort":"389731482",
            "status":"published",
            "brand":"brand",
            "language":"Nam amet et labore laborum explicabo ratione. Itaque quibusdam vero dolor itaque illum et. Officia autem et totam modi. Odio dignissimos ipsa vero explicabo. Officia sed et consequatur nesciunt. Dignissimos eos consectetur in aperiam quas.",
            "user":"",
            "publishedOn":"2019-05-24 11:45:15",
            "archivedOn":{  
               "date":"1975-12-29 07:36:57.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1998-02-27 09:39:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Ea quo nostrum nulla officia enim vel. Totam et et nam molestiae error aspernatur quas ut. Qui omnis sunt ut porro id fugit.",
            "homeStaffPickRating":"812174056",
            "legacyId":681759468,
            "legacyWordpressPostId":245412981,
            "qnaVideo":"Sit aspernatur ipsa eveniet eaque voluptatibus facere voluptatem. Vitae saepe quia necessitatibus soluta. Quo accusamus voluptas omnis quis quod rerum aspernatur. Maxime magni nostrum cupiditate sed officia.",
            "style":"Hic incidunt quia voluptatem quam ullam. Adipisci nihil occaecati ea illo harum aliquam est dolores. Eos similique ad illum molestiae est tenetur.",
            "title":"Fugiat sed similique quia ipsam.",
            "xp":30435817,
            "album":"Suscipit deserunt a ut rem et. Et officiis eius dolores ad ut sunt eos. Recusandae et animi eaque quo. Inventore quo maiores ut in ipsam id iste. Est ducimus ut dolorum et voluptatem. Expedita laborum cumque eaque aut.",
            "artist":"Sit vel amet veritatis autem dolorem quos voluptatum. Cumque voluptatem recusandae similique qui. Voluptas ea saepe minima itaque nobis. Quasi ratione cupiditate ex eos est iure.",
            "bpm":"Voluptatum voluptatem ut velit saepe incidunt. Distinctio rerum maiores saepe nihil repellendus. Est eaque dolorum harum laborum nihil. Necessitatibus quae aut adipisci exercitationem repellat.",
            "cdTracks":"Nesciunt porro dolorum ipsum quisquam. Consequuntur dicta quam eos et enim. Quae eaque accusamus aut et autem vel.",
            "chordOrScale":"Dolorem laborum est voluptatibus a aperiam dolores ratione. Nihil repudiandae nesciunt aut voluptatem ex itaque itaque illo. Sequi voluptatem quia consequatur in qui.",
            "difficultyRange":"Placeat doloribus pariatur ducimus qui qui error. Ut laborum neque velit vitae fugit blanditiis voluptatibus. Recusandae soluta est illo eligendi aut aliquam. Et rerum dolorem ducimus rerum adipisci. Et dolores voluptatum consequatur ratione dolore quod.",
            "episodeNumber":371170420,
            "exerciseBookPages":"Et consequatur aut omnis veniam a eos a veniam. Est eos enim tenetur mollitia magni possimus. Omnis animi recusandae voluptatum doloribus.",
            "fastBpm":"Modi non nostrum et sint expedita eos maiores. Illum nemo cupiditate odio. Laudantium tempora suscipit ipsum. Est voluptatem et minus enim. Ducimus harum aut tempore. Qui at voluptatem assumenda placeat nesciunt perspiciatis.",
            "includesSong":true,
            "instructors":"Neque occaecati quam sed est ut reiciendis culpa. Hic enim eum perferendis repellendus ad. Amet dolores alias dolor minus et dolorum recusandae. Veniam quod ut culpa. Quibusdam natus quo nulla consequatur explicabo fuga.",
            "liveEventStartTime":{  
               "date":"1981-12-09 17:31:26.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1975-04-21 03:18:55.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Et dolorem placeat in ea quam laudantium. Corporis atque repudiandae quisquam dolorum.",
            "liveStreamFeedType":"Qui ut quos id sed iste repellat ad. Delectus sunt qui nostrum exercitationem. Et ea accusamus fuga saepe.",
            "name":"Praesentium id exercitationem nisi. Non dolore blanditiis magni itaque fuga. Quo dolores non ex minima quibusdam ducimus. Facere quos accusamus qui. Quod nemo quia qui magnam dolores ut. Ea ut dicta debitis quis quaerat.",
            "released":"Est illo dolorum eum. Cumque eum praesentium ut mollitia culpa. Est eaque omnis est occaecati nulla. Esse atque sequi eaque eos fuga aut alias. Et sunt similique aperiam.",
            "slowBpm":"Harum eos ipsam quaerat dolorem non repudiandae in. Autem beatae optio modi dolorem dolores unde rerum. Eligendi et nobis soluta ratione officia corporis iusto.",
            "totalXp":"Aliquam est corporis consequatur ipsam recusandae. Illum similique nemo adipisci. Odio voluptas sapiente fugit amet sed maxime. Asperiores impedit unde eos totam distinctio soluta magnam architecto.",
            "transcriberName":"Necessitatibus aut rem possimus et ipsa iure. Et dicta tenetur sed possimus quis consectetur ab. Quasi eum ea et praesentium accusantium. Fugiat quibusdam voluptatem voluptates ut possimus soluta ipsa.",
            "week":254726865,
            "avatarUrl":"Voluptatem voluptatibus provident quam. Omnis eveniet fugit voluptas tempora. Voluptatem voluptas eos voluptate dolorem totam. Repellendus praesentium deleniti consequatur nihil. Quia minima reiciendis quibusdam.",
            "lengthInSeconds":599283658,
            "soundsliceSlug":"Aut nostrum in dicta beatae reprehenderit cumque. Et vero magnam aliquam rerum aspernatur magni. Quia ipsam libero et excepturi beatae assumenda ipsa consequuntur. Dolore quasi et natus alias nobis.",
            "staffPickRating":1117733264,
            "studentId":1542335530,
            "vimeoVideoId":"Omnis ipsam placeat sequi magnam. Dolorum tempore amet autem voluptas. Est aut et voluptatem delectus explicabo et minima. Similique quas dolores possimus. Consequatur officia et quia nulla ut.",
            "youtubeVideoId":"Dolores dolor quis nam molestias sunt. Recusandae officiis qui sed ullam voluptatum qui velit. Ut et qui illum ullam voluptatem sit excepturi. Iste fugiat minima rerum eveniet nobis. Debitis voluptate in aut et quae. Cumque voluptas itaque ut vitae quis."
         }
      },
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Molestiae praesentium unde cupiditate non sed. Consequatur et ut dolorem facere. Et ex dolores ad at assumenda.",
            "type":"Dolores voluptatem a beatae. Molestias deleniti ab reprehenderit quidem. Error vel alias quis perferendis nam. Ullam quia hic quia voluptatem. Aut iure dolores non in commodi. Ab asperiores cum autem non. Eum ut sunt est aut omnis corrupti eaque.",
            "sort":"183308216",
            "status":"published",
            "brand":"brand",
            "language":"Rerum ratione illo modi aut. Ut ipsum reprehenderit sed ullam numquam. Sapiente sed est aut et. Eos in sed sint.",
            "user":"",
            "publishedOn":"2019-05-24 11:45:15",
            "archivedOn":{  
               "date":"1972-12-31 13:23:45.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1971-07-15 00:21:49.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Perferendis esse aspernatur autem nisi. Quasi eaque et sint eum. Molestiae possimus sapiente qui in. Iste reprehenderit iusto veniam suscipit eaque. Exercitationem repellendus ut voluptates non. Totam unde inventore nostrum illo.",
            "homeStaffPickRating":"355963337",
            "legacyId":850096205,
            "legacyWordpressPostId":148656076,
            "qnaVideo":"Culpa illo nisi corrupti repudiandae facilis sequi. Labore perspiciatis sit itaque sit totam blanditiis minus. Reprehenderit praesentium ullam natus perspiciatis voluptatum provident dolor.",
            "style":"Aliquid hic assumenda quidem aperiam error molestias. Incidunt et quia neque quo esse sed est. Vero suscipit deleniti quibusdam vero recusandae est facere ut.",
            "title":"Delectus eveniet vero modi.",
            "xp":2075495204,
            "album":"Reiciendis odit voluptates fuga aut eum rem. Dolorem nulla qui illum. Rem tempore eaque ex dolores ut.",
            "artist":"Hic qui ad ea natus. Cupiditate culpa omnis voluptatum quaerat modi. Eum itaque velit totam et consequatur quis molestias. Ex vitae recusandae veniam dicta corrupti. Illo esse nobis repellat dolorum quia quae quam.",
            "bpm":"Itaque fugit fuga temporibus vitae dolorem illum voluptatem. Cumque porro odio nihil tenetur modi voluptatem. Omnis non culpa illum nisi non iste dicta.",
            "cdTracks":"Similique vel eum numquam et. Asperiores tempore alias optio harum quis et sed. Explicabo aut vitae iusto.",
            "chordOrScale":"Maxime ipsa exercitationem expedita. Ex rerum veritatis vel ut sint laborum dolorum veritatis. Suscipit laudantium voluptatum odio cum esse ab. Accusamus asperiores qui quo. Non et ab voluptates non consequatur nihil accusantium vero.",
            "difficultyRange":"Veniam doloremque tempore itaque commodi dolores est. Aliquam cum iusto expedita totam et. At dolor ut sunt molestias nostrum ut quis tenetur. Facere quo modi tenetur earum quis voluptatem.",
            "episodeNumber":517158748,
            "exerciseBookPages":"Quod ipsa sequi natus culpa nemo id ducimus. Minus rem at id praesentium fugiat pariatur qui. Et perferendis et laboriosam sit optio. Quaerat perspiciatis voluptatem ipsa odio. Et vel tenetur vero qui. Et reiciendis accusamus temporibus quis alias enim.",
            "fastBpm":"Blanditiis optio molestias libero nesciunt amet provident aut. Consectetur velit cumque minus voluptas. Quia maxime odio porro sit provident velit ex.",
            "includesSong":false,
            "instructors":"Voluptas sequi non veritatis reiciendis maiores cupiditate in. Saepe omnis animi delectus ex hic eius. Sit asperiores temporibus est repellat.",
            "liveEventStartTime":{  
               "date":"1972-06-16 11:41:38.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1977-09-13 07:29:56.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Et eum quo impedit nostrum facere ea. Est sed harum qui non. Aut qui incidunt quo molestias distinctio quos aliquid. Laborum iure voluptatem libero. Laudantium et in eos facilis qui laudantium. Nostrum commodi nihil ut animi dolorum mollitia sint.",
            "liveStreamFeedType":"Nostrum dolor ipsa voluptatem qui quod aspernatur blanditiis. Atque eveniet non commodi. Molestiae quia velit aut qui. Qui perspiciatis dolore nemo minus sed totam. Corrupti fugiat laboriosam qui qui ratione rerum excepturi.",
            "name":"Ab dolores ratione et voluptatem suscipit. Deserunt est officia rerum qui incidunt. Nemo quis aperiam et eius quaerat quasi omnis.",
            "released":"Aut aut ipsa consequatur ex aut. Cupiditate fugit velit dolor dolore. Sed autem voluptatibus quas et sequi sit. Magni cumque quos nisi dolores tempora quia aut. Voluptas iste quaerat natus deleniti delectus est asperiores aspernatur.",
            "slowBpm":"Consequatur sit ipsam eius ab ipsam. Et ab voluptas sed illo dolor et eum. Eum natus commodi sunt minus ipsa commodi. Consequatur exercitationem non veniam.",
            "totalXp":"Nihil soluta magni odit ut nesciunt. Nemo neque aut et incidunt aut. Corporis blanditiis omnis magnam incidunt iste cum voluptatem. Impedit rerum et ab magni optio non.",
            "transcriberName":"Aspernatur vel quibusdam repellendus aut vero molestias et blanditiis. Odio quo labore ea voluptas illo ad consequatur. Sint veniam ea voluptatem. Dolor mollitia aliquam laboriosam ut ex.",
            "week":988108704,
            "avatarUrl":"Quo eum reiciendis maxime nesciunt architecto libero. Ipsa sit nobis dolor voluptas est eos molestiae. Dolorem nam aut ipsam quis vero ea perferendis. Itaque et iste placeat est quia et. Id et sapiente pariatur consectetur sint sint.",
            "lengthInSeconds":1311951271,
            "soundsliceSlug":"Repellat saepe exercitationem eos voluptatibus quod non recusandae. Sit et enim eum molestiae velit. Quia deleniti numquam quam porro. Pariatur veniam rerum dolorum deserunt rerum.",
            "staffPickRating":2065491305,
            "studentId":517184122,
            "vimeoVideoId":"Asperiores velit ea quo aut. Odit nulla vitae rerum voluptatem consequuntur. Sint iusto aut et est. Sequi facere quia suscipit. Doloribus excepturi debitis occaecati qui ad. Temporibus ut aliquid exercitationem non.",
            "youtubeVideoId":"Earum corporis velit quis ipsum qui eos. Harum rerum ullam veritatis est minus. Excepturi aliquam praesentium voluptas vero est qui voluptate. Qui iure voluptatibus molestiae rerum sit atque."
         }
      }
   ]
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PUT /*/content }`

Create a new content.

### Permissions

- Must be logged in
- Must have the 'create.content' permission to create

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|body|data.type|yes| |must be 'content'||
|body|data.attributes.slug|no||||
|body|data.attributes.type|yes||||
|body|data.attributes.status|yes||||
|body|data.attributes.language|no|en-US|||
|body|data.attributes.sort|no||||
|body|data.attributes.published_on|no||||
|body|data.attributes.created_on|no||||
|body|data.attributes.archived_on|no||||
|body|data.attributes.fields|no||||
|body|data.attributes.brand|no|Default brand from config file|||
|body|data.relationships.parent.data.type|no| |must be 'content'||
|body|data.relationships.parent.data.id|no||||
|body|data.relationships.user.data.type|no| |must be 'user'||
|body|data.relationships.user.data.id|no||||


### Validation Rules

```php
[
    'data.attributes.status' => 'max:64|required|in:' . implode(
        ',',
        [
            ContentService::STATUS_DRAFT,
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_ARCHIVED,
            ContentService::STATUS_SCHEDULED,
            ContentService::STATUS_DELETED,
        ]
     ),
     'data.attributes.type' => 'required|max:64',
     'data.attributes.sort' => 'nullable|numeric',
     'data.attributes.position' => 'nullable|numeric|min:0',
     'data.attributes.published_on' => 'nullable|date',
];
```

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content',
    data: {
        type: "content",
        attributes: {
            slug: "explicabo",
            status: "draft",
            type: "course",
            published_on : "2019-05-28 12:01:42"
        }
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
      "type":"content",
      "id":"4",
      "attributes":{  
         "slug":"explicabo",
         "type":"course",
         "sort":0,
         "status":"draft",
         "brand":"brand",
         "language":"en-US",
         "user":"",
         "publishedOn":"2019-05-28 12:10:21",
         "archivedOn":null,
         "createdOn":"2019-05-24 12:10:21",
         "difficulty":null,
         "homeStaffPickRating":null,
         "legacyId":null,
         "legacyWordpressPostId":null,
         "qnaVideo":null,
         "style":null,
         "title":null,
         "xp":null,
         "album":null,
         "artist":null,
         "bpm":null,
         "cdTracks":null,
         "chordOrScale":null,
         "difficultyRange":null,
         "episodeNumber":null,
         "exerciseBookPages":null,
         "fastBpm":null,
         "includesSong":false,
         "instructors":null,
         "liveEventStartTime":null,
         "liveEventEndTime":null,
         "liveEventYoutubeId":null,
         "liveStreamFeedType":null,
         "name":null,
         "released":null,
         "slowBpm":null,
         "totalXp":null,
         "transcriberName":null,
         "week":null,
         "avatarUrl":null,
         "lengthInSeconds":null,
         "soundsliceSlug":null,
         "staffPickRating":null,
         "studentId":null,
         "vimeoVideoId":null,
         "youtubeVideoId":null
      }
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ PATCH /*/content/{ID} }`

Update an existing content.

### Permissions

- Must be logged in
- Must have the 'update.content' permission to update

### Request Parameters


|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes| | | |
|body|data.type|yes| |must be 'content'||
|body|data.attributes.slug|no||||
|body|data.attributes.type|no||||
|body|data.attributes.status|no||||
|body|data.attributes.language|no|en-US|||
|body|data.attributes.sort|no||||
|body|data.attributes.published_on|no||||
|body|data.attributes.created_on|no||||
|body|data.attributes.archived_on|no||||
|body|data.attributes.fields|no||||
|body|data.attributes.brand|no| |||
|body|data.relationships.user.data.type|no| |must be 'user'||
|body|data.relationships.user.data.id|no||||


### Validation Rules

```php
[
    'data.attributes.status' => 'max:64|in:' .
        implode(
        ',',
        [
            ContentService::STATUS_DRAFT,
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_ARCHIVED,
            ContentService::STATUS_SCHEDULED,
            ContentService::STATUS_DELETED,
        ]
        ),
    'data.attributes.type' => 'max:64',
    'data.attributes.sort' => 'nullable|numeric',
    'data.attributes.position' => 'nullable|numeric|min:0',
    'data.attributes.published_on' => 'nullable|date'
];
```

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/1',
    type: 'patch', 
    data: {
        type: "content",
        attributes: {
              slug: "new slug",
              status: "published",
              published_on: "2019-05-24 12:30:53"
        },
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
      "type":"content",
      "id":"1",
      "attributes":{  
         "slug":"new slug",
         "type":"course",
         "sort":"556027152",
         "status":"published",
         "brand":"brand",
         "language":"Placeat sunt aliquam consectetur. Reiciendis est assumenda error ratione. Deleniti odit mollitia neque.",
         "user":"",
         "publishedOn":"2019-05-24 12:30:53",
         "archivedOn":null,
         "createdOn":"2019-05-22 10:30:00",
         "difficulty":"A nisi laborum ea. Repudiandae optio modi illo quaerat dolorem placeat consequatur. Dolorum est consectetur ut eum quae inventore laborum harum.",
         "homeStaffPickRating":"1309158337",
         "legacyId":833508340,
         "legacyWordpressPostId":2073014707,
         "qnaVideo":"Et hic eaque non nemo. Qui repellendus hic veritatis rerum. Ut expedita qui sed. Quam qui maxime ut eius inventore vel natus. Voluptatibus sequi aut ullam repellat libero.",
         "style":"Beatae consequatur necessitatibus non. Quis excepturi accusamus quia. Necessitatibus itaque at ea et nihil quia.",
         "title":"Asperiores nihil reiciendis voluptas ipsum nisi.",
         "xp":396349821,
         "album":"Nobis et minima id quia aut nobis mollitia quisquam. Consectetur consequatur nam sed architecto a voluptatem aut. Voluptatem voluptatum suscipit occaecati est.",
         "artist":"Commodi eligendi ipsa deleniti et. Eaque dolores et adipisci voluptatum similique amet voluptatibus. Repellendus modi quibusdam autem. Quia laudantium autem eum deserunt cumque.",
         "bpm":"Quo non beatae asperiores iusto. Deleniti atque harum omnis sit sint pariatur. Impedit voluptatem mollitia alias possimus quis iste harum.",
         "cdTracks":"Ab expedita qui ipsa quaerat illum maxime commodi. Eius nam maiores esse. Dolores optio quidem eaque velit voluptate. Eum dolores ea dolorem eum itaque sit.",
         "chordOrScale":"Dolores est corporis totam omnis dolorem sunt. Mollitia dolorum ratione vel. Eveniet velit et non omnis dicta sequi. Ipsum alias nemo soluta cumque non autem quae. Facilis necessitatibus ex dignissimos omnis ut nostrum.",
         "difficultyRange":"Et illo adipisci autem qui nobis. Omnis atque accusantium explicabo aut provident quae. Perspiciatis aut sit harum sunt dignissimos error minima. Placeat nulla eos maiores mollitia iste quaerat necessitatibus.",
         "episodeNumber":974596366,
         "exerciseBookPages":"Impedit numquam hic nam id reprehenderit odio modi. Iste sed libero exercitationem error praesentium sint. Corrupti magnam et adipisci occaecati at. Pariatur molestias aliquid non quos animi.",
         "fastBpm":"Rerum quisquam et quia at reprehenderit maxime porro. Temporibus ea ut ut ut asperiores id ut. Voluptatibus voluptatem numquam et qui.",
         "includesSong":true,
         "instructors":"Neque repellendus dolores recusandae tempora a natus error. Rem quia quod nemo ducimus accusantium itaque earum inventore. Id odio tenetur quod non id. Laboriosam quia magnam ducimus mollitia.",
         "liveEventStartTime":{  
            "date":"1972-09-26 18:27:00.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "liveEventEndTime":{  
            "date":"1983-12-26 00:31:50.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "liveEventYoutubeId":"Mollitia officia sunt alias aut. Pariatur saepe ab impedit maxime. Corrupti magnam veritatis repellendus deserunt distinctio consequatur. Ut eaque in quod nesciunt ea.",
         "liveStreamFeedType":"Non labore ut delectus mollitia aut fuga necessitatibus. Rem quidem fugiat itaque omnis voluptates blanditiis praesentium. Dignissimos velit sequi animi cupiditate quo aspernatur porro. Modi maiores et quasi dolor non harum aspernatur.",
         "name":"Optio consequuntur et est sed sint. Tempore necessitatibus culpa quas porro a ex. Voluptatem numquam est eos commodi. Illum voluptas debitis consequuntur et. Totam repudiandae minima atque nam ut optio voluptas cupiditate.",
         "released":"Officiis deserunt magni omnis sed reprehenderit esse. Voluptatibus itaque rem accusantium mollitia ut eum mollitia. Id et voluptatibus laboriosam dolorum aut sint ut. Ut sit voluptatem ut alias eius quia deleniti deserunt.",
         "slowBpm":"Consequatur voluptatum numquam enim vitae qui. Voluptates deleniti consequuntur qui voluptas neque. Aperiam nobis doloribus laborum eligendi numquam. Harum illum aut aliquid ullam nobis repellendus.",
         "totalXp":"Sapiente odit debitis voluptate ratione. Itaque facere ex et qui. Rerum ratione vel distinctio earum vel molestiae. Amet repellendus velit laborum architecto vel. Ducimus illo maxime laudantium repellat dolor in.",
         "transcriberName":"Dolore molestiae suscipit consectetur rerum sed quidem earum. Blanditiis rerum ipsa vel ipsam voluptas. Nemo velit quis maxime molestias dolorum sunt minus. Doloremque cupiditate quo nisi voluptatem quasi corrupti.",
         "week":1837509630,
         "avatarUrl":"Non illo beatae iste soluta sit dicta. Occaecati sint asperiores a natus qui omnis sit. Cumque a quasi omnis inventore.",
         "lengthInSeconds":558705343,
         "soundsliceSlug":"Earum laudantium soluta illo eos sed. Id consequatur sed delectus consequuntur voluptatem. Mollitia repellendus ut in aspernatur sint velit minima. Dignissimos et sit est.",
         "staffPickRating":1798097529,
         "studentId":1737974843,
         "vimeoVideoId":"Dolorem exercitationem ad sit. Sint laboriosam iusto tempora vel repellendus facilis.",
         "youtubeVideoId":"Et animi adipisci est voluptas vel. Quia itaque ipsum rerum aut quam eos. Quae sed ullam nulla. Aut consequatur et et quis ea voluptates id. Consectetur labore est sint eaque. Nulla et aut qui et ut est aut."
      }
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/content/{ID} }`

Delete an existing content and content related links.

The content related links are: links with the parent, content childrens, content fields, content datum, links with the permissions, content comments, replies and assignation and links with the playlists.


### Permissions

- Must be logged in
- Must have the 'delete.content' permission

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/content/1',
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

<!--- -------------------------------------------------------------------------------------------------------------- -->

### `{ DELETE /*/soft/content/{ID} }`

The contents are never actually deleted out of the database, it's only mark as deleted: the status it's set as deleted.

If a content it's soft deleted the API will automatically filter it out from the pull request unless the status set on the pull requests explicitly state otherwise.

### Permissions

- Must be logged in
- Must have the 'delete.content' permission

### Request Parameters

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|path|id|yes||||

### Request Example

```js   
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/soft/content/1',
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

### `{ GET /*/search }`

Full text search in contents.

### Permissions


### Request Parameters

[Paginated](request_pagination_parameters.md) | [Ordered](request_ordering_parameters.md)

|Type|Key|Required|Default|Options|Notes|
|----|---|--------|-------|-------|-----|
|query|term|yes| | | Serch criteria|
|query|included_types|no| | |Contents with these types will be returned.|
|query|statuses|no|'published' | |All content must have one of these statuses.|
|query|sort|no|'-score' | |Defaults to descending order; to switch to ascending order remove the minus sign (-). Can be any of the following: score or content_published_on|
|query|brand|no| | |Contents from the brand will be returned.|

### Request Example

```js
$.ajax({
    url: 'https://www.domain.com' +
        '/railcontent/search',
    data:{
         page: 1, 
         limit: 3,
         term: "omnis",
    },
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example

```201 OK```

```json
{  
   "data":[  
      {  
         "type":"content",
         "id":"1",
         "attributes":{  
            "slug":"Eum provident voluptatem ab eos. Nam voluptatem est voluptates eum quisquam nihil. Expedita ea sunt omnis dolor et aut. Voluptas animi eos necessitatibus similique nisi excepturi vel.",
            "type":"courses",
            "sort":"827547162",
            "status":"published",
            "brand":"brand",
            "language":"Hic assumenda quia sunt ex ut minima culpa. Sint quasi architecto ut explicabo. Veniam voluptatem aliquid possimus inventore. Est soluta dolore cumque.",
            "user":"",
            "publishedOn":"2019-05-24 13:20:33",
            "archivedOn":{  
               "date":"1976-09-27 22:19:09.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"2004-09-30 13:10:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Ut est sed reprehenderit architecto aut corrupti. Ad temporibus rem eum hic temporibus odit est. Aut et dignissimos qui. Sed quae ut quis porro.",
            "homeStaffPickRating":"2099219331",
            "legacyId":543175769,
            "legacyWordpressPostId":140874296,
            "qnaVideo":"Adipisci consectetur quo molestiae aut consequuntur debitis. Ut amet ipsa neque sed. Quia quas hic vel nobis earum voluptate. Quibusdam quae et deleniti veniam aut dignissimos modi. Adipisci quis libero quidem ducimus et explicabo.",
            "style":"Molestias dolorum fuga sunt et eligendi sit. Rem incidunt voluptatem corporis magni et. Qui eum ex quos nihil delectus neque qui.",
            "title":"omnis",
            "xp":114662750,
            "album":"Minima et tempore doloribus voluptatibus suscipit. Quidem id quis et id suscipit. Accusamus vel reprehenderit commodi fugiat. Tempore corporis deleniti voluptatum qui.",
            "artist":"Dolores similique sapiente aut hic dolores. Sit repellendus quis repellat culpa. Non et dolorem consequuntur possimus officiis similique et. Accusantium eos dolorum doloremque ea eveniet. Quis vero deserunt non ipsam.",
            "bpm":"Sed nihil similique ex in rem ut quo et. Quis sit voluptatibus qui at excepturi.",
            "cdTracks":"Minima suscipit neque consequuntur hic repellat officiis. Enim ut quis fugit quam repellendus placeat. Esse omnis ex fugiat rerum sunt laudantium molestiae. Et quia tempora velit.",
            "chordOrScale":"Ea qui dolor illum qui. Modi quo et qui voluptatem dolores et reiciendis. Iste dicta animi rerum possimus aut excepturi. Ea necessitatibus quasi accusamus quia. Temporibus perspiciatis maxime est. Aut aut in ullam dolores est dolorem.",
            "difficultyRange":"Quia aut qui ullam vel. Eos rerum similique maiores et sit recusandae voluptates adipisci. Incidunt sapiente sint rem perspiciatis quaerat voluptatibus. Minima hic magnam ut odit commodi.",
            "episodeNumber":210511292,
            "exerciseBookPages":"Harum aperiam ea nam qui rerum. Ad repudiandae necessitatibus aut aperiam dolores quibusdam quaerat exercitationem. Tempore autem beatae autem in. Ut eum nostrum est quos excepturi quia accusantium.",
            "fastBpm":"Animi quod odit soluta. Similique dolor pariatur voluptatem qui velit voluptas. Voluptate a nobis odit dolor quia aut quam. Sapiente accusantium eius nam dicta.",
            "includesSong":true,
            "instructors":"Quis minima rerum suscipit dolorem aliquam. Voluptas facere et debitis veniam. Incidunt odio expedita inventore nisi facere quis. Aliquid ea dolorem distinctio ut.",
            "liveEventStartTime":{  
               "date":"1972-08-31 14:43:58.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1972-08-16 20:04:38.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Aut ipsam mollitia sit voluptate earum eos. Eveniet natus rerum voluptas placeat sunt. Dicta qui quia quia. Maiores incidunt quia culpa et molestiae. Aliquid labore ratione quia sed delectus beatae. Alias eveniet reprehenderit minima dicta.",
            "liveStreamFeedType":"Ut ullam consectetur quia quia quae laboriosam quasi. Dignissimos magni perferendis velit culpa beatae. Aliquid ut est commodi consequatur. Autem aut qui rerum voluptas.",
            "name":"Ipsum quia similique voluptates neque et et. Illum ut corporis qui aspernatur maxime eos. Tenetur consectetur rem est est.",
            "released":"Nesciunt doloremque omnis veritatis. Sed ipsam repellat ullam ut. Consequatur ab consequatur fuga saepe quis pariatur nam rerum. Provident quas voluptatem et. Nobis vitae commodi voluptatum necessitatibus. Ut non quo velit eum doloribus minus.",
            "slowBpm":"Occaecati a quis aut quaerat. Libero tempore ut hic recusandae nemo voluptatem. Eligendi et et quos laudantium non. Neque repellendus harum quae fugit maiores debitis qui. Libero minus reprehenderit rerum.",
            "totalXp":"Laudantium rerum eos voluptate eligendi expedita. Iusto sit aspernatur et et ipsa. Minima voluptas illo dolor ut. Quia omnis aspernatur in tempore modi. Veniam non voluptatum commodi. Illum sed reprehenderit voluptas nulla autem.",
            "transcriberName":"Voluptatem id dolor consequatur recusandae ut beatae eum. Et qui odit molestias impedit culpa ut. Et et iure et.",
            "week":362290866,
            "avatarUrl":"Temporibus et ipsum reiciendis a sed non voluptas. Voluptas enim minus excepturi quisquam. Numquam at hic eius.",
            "lengthInSeconds":1727804194,
            "soundsliceSlug":"Atque eius cupiditate laboriosam. Molestiae voluptas ut sunt reiciendis magni quas sunt. Laboriosam earum qui eos. Ut voluptas et hic provident sint. Tempore quia rerum id delectus.",
            "staffPickRating":952601736,
            "studentId":150672785,
            "vimeoVideoId":"Corrupti necessitatibus temporibus totam sed sit ipsam nesciunt aut. Eligendi aspernatur quia in debitis sed distinctio. Autem et adipisci voluptas est repellat ipsam et laudantium.",
            "youtubeVideoId":"Voluptatem provident et asperiores placeat. Ab doloribus sit sed cupiditate omnis et. In omnis id reiciendis quas porro repellendus. Fugit vitae laudantium recusandae sed quia. Eum ut dicta deleniti est."
         },
         "relationships":{  
            "topic":{  
               "data":[  
                  {  
                     "type":"topic",
                     "id":"1"
                  }
               ]
            }
         }
      },
      {  
         "type":"content",
         "id":"2",
         "attributes":{  
            "slug":"Cumque voluptas omnis asperiores. Voluptatem ut minima maxime. Est quia corrupti numquam. Dignissimos aliquid quaerat a. Quaerat doloribus at et ducimus iusto explicabo nulla.",
            "type":"courses",
            "sort":"166949884",
            "status":"published",
            "brand":"brand",
            "language":"Vel sed quia magni voluptates placeat voluptatem aperiam. Totam est numquam vel quia facilis. Omnis numquam vel reiciendis blanditiis temporibus similique. Aliquid et nemo id optio quasi doloribus atque. Sunt saepe veritatis itaque.",
            "user":"",
            "publishedOn":"2019-05-24 13:20:33",
            "archivedOn":{  
               "date":"1986-06-01 07:22:28.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"1997-01-09 06:10:01.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Nobis natus nihil quasi quo laudantium ut voluptatem. Eos dignissimos et hic accusantium cupiditate earum inventore.",
            "homeStaffPickRating":"1530422357",
            "legacyId":169821854,
            "legacyWordpressPostId":906817410,
            "qnaVideo":"Sit cum autem fuga est. Ut nisi modi mollitia consequatur quae animi quidem. Expedita saepe accusamus cum ut eaque iure optio. Quis aut deserunt eum rem.",
            "style":"Eligendi vel et explicabo est laboriosam in voluptas perferendis. Iure illum voluptas eos vitae saepe reiciendis et.",
            "title":"eos",
            "xp":489874712,
            "album":"Vel minima consequuntur aut dignissimos. Dolores ut velit molestias sit dolorum. Vero molestiae sunt autem dolorem in. Quo perspiciatis ut consequatur qui. Ut est quisquam unde ipsa sapiente praesentium.",
            "artist":"Fugit sit et tempora eveniet dolores inventore aliquam ad. Minus qui dignissimos non quam qui voluptas. Sapiente nisi nesciunt dolore dolore non. Minus quia quos aperiam at odio voluptatum commodi.",
            "bpm":"Labore error ut perferendis in ut doloribus voluptatem. Consequatur distinctio aliquam occaecati nisi tempora. Explicabo velit vel voluptates iure inventore.",
            "cdTracks":"Voluptas neque autem voluptas quod optio deleniti illum. Ipsa dolores occaecati dignissimos eos modi. Dolore ex assumenda at maxime vel enim.",
            "chordOrScale":"Et enim praesentium distinctio provident. Modi molestiae sint quia necessitatibus est eligendi id. Veritatis nulla ducimus eos ab. Adipisci ea et omnis mollitia rerum.",
            "difficultyRange":"Ad sit in enim aut et magni. Maiores quia corporis minus odio sed quam. Enim et illo et qui sit iusto dignissimos.",
            "episodeNumber":136720409,
            "exerciseBookPages":"Et nemo repellat ducimus velit. Rem tenetur sapiente necessitatibus dignissimos aut. Soluta totam numquam quidem libero earum cum. Nobis quibusdam numquam ex eum rerum vel aspernatur sunt. Totam incidunt ut aliquid rem perferendis non.",
            "fastBpm":"Enim laborum nisi eos voluptatem dolorem. Optio quam rerum aperiam aut voluptate voluptas itaque necessitatibus. Nemo est veritatis error cum voluptatibus.",
            "includesSong":false,
            "instructors":"Repellendus vel minima maxime aut maiores. Dolorum qui consequuntur qui. Voluptas eos non ab earum. Magnam numquam reprehenderit qui libero eius explicabo iusto explicabo. Aut qui ex consequatur perspiciatis. Voluptatem voluptatum tempore aut velit.",
            "liveEventStartTime":{  
               "date":"1975-06-12 18:56:00.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1975-06-23 16:54:35.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Ut odit delectus qui qui cupiditate soluta. Explicabo adipisci quos ut commodi ut occaecati exercitationem. Ut unde dolores eligendi ad sed neque repudiandae aperiam. Veritatis expedita provident enim suscipit non ea amet debitis.",
            "liveStreamFeedType":"Ipsa ipsam officiis adipisci sunt. Quia consequatur laboriosam ipsa ut perferendis. Rerum maiores quia quod laboriosam blanditiis. Veniam fuga beatae atque necessitatibus commodi.",
            "name":"Velit rerum et non adipisci repellendus velit. Ut ipsa est doloremque facilis architecto. Libero blanditiis pariatur eos nobis at nemo aut amet.",
            "released":"Ullam nostrum error iusto ut suscipit. Quas suscipit omnis iure tenetur quo. Perspiciatis quod dolores molestiae. Ut repellat quia et vel vero voluptatem. Autem et eius ducimus quia ab maxime voluptatem. Cum omnis ut illum rerum dolor. Hic error sint et.",
            "slowBpm":"Ratione dignissimos pariatur sit aut earum esse quis expedita. Laboriosam debitis totam ducimus voluptatem nemo corporis eum. Tenetur sit ducimus voluptas amet nulla dolorem quaerat.",
            "totalXp":"Deserunt iste quo neque id eligendi quia blanditiis nobis. Architecto enim dolores sint nesciunt libero magnam nulla. In doloribus expedita voluptas omnis quae repellendus. Illum eligendi velit quas dolorem quisquam. Ut ut impedit harum sint magni.",
            "transcriberName":"Totam est id rerum voluptas repellendus consequuntur. Quia earum impedit nihil et ullam illum. Rerum quasi hic vitae amet voluptatem et. Ut voluptatem ut aut.",
            "week":1528482609,
            "avatarUrl":"Beatae vero ullam aut ut maiores delectus distinctio. Consequatur sed neque quo recusandae quis. Provident sit sed sint voluptas.",
            "lengthInSeconds":175422594,
            "soundsliceSlug":"Asperiores neque autem dolorum porro eligendi omnis. Cupiditate reprehenderit veniam iure. Excepturi facilis molestiae eos aut aut ipsum et. Qui corporis nemo et ut. Et quibusdam esse rerum nesciunt iure et ex libero. Ab in sunt harum debitis ea.",
            "staffPickRating":499821113,
            "studentId":250610864,
            "vimeoVideoId":"Adipisci et saepe numquam vel. Consequatur architecto quam nam necessitatibus sed dignissimos. Commodi tempore quo at doloremque error sunt. Odio nam adipisci id rem.",
            "youtubeVideoId":"Quia consequatur et error necessitatibus dolor numquam possimus. Ipsa voluptate incidunt aspernatur quis. Ut voluptas suscipit ut odio reiciendis itaque molestias. Repellendus qui occaecati a vel nisi amet. Magnam commodi repellendus doloremque quas quo."
         },
         "relationships":{  
            "topic":{  
               "data":[  
                  {  
                     "type":"topic",
                     "id":"16"
                  }
               ]
            }
         }
      },
      {  
         "type":"content",
         "id":"6",
         "attributes":{  
            "slug":"Sint omnis saepe nobis facilis qui. Vero nihil consequatur quaerat earum quos voluptas facere et. Eligendi placeat laborum vero.",
            "type":"courses",
            "sort":"600782785",
            "status":"published",
            "brand":"brand",
            "language":"Commodi natus sequi est omnis. Placeat perspiciatis cupiditate sequi quae. Quod commodi veniam non dolores est aliquam sunt autem. Commodi vero quibusdam omnis.",
            "user":"",
            "publishedOn":"2019-05-24 13:20:33",
            "archivedOn":{  
               "date":"1990-12-09 06:56:57.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "createdOn":{  
               "date":"2003-05-07 18:03:52.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "difficulty":"Id et ut sit corrupti unde vel. Ut id magnam nisi ut adipisci veritatis. Corporis neque ut id eos qui. Minima incidunt ut id voluptatem odit. Possimus neque culpa minus.",
            "homeStaffPickRating":"1469858124",
            "legacyId":601000299,
            "legacyWordpressPostId":520956279,
            "qnaVideo":"Nihil aut unde sed dolor placeat totam. Reiciendis consequuntur ipsum aliquid beatae. Amet impedit ducimus molestias praesentium nemo voluptas. Non voluptatum sapiente est soluta dolor sit maxime.",
            "style":"Assumenda aut sed voluptas optio tempore nisi. Animi nihil sed delectus non. Dicta et distinctio illo consectetur ea et vel. Ullam impedit doloribus quis illo eos molestiae aut. Architecto adipisci dolorem officia.",
            "title":"autem",
            "xp":855544089,
            "album":"Possimus libero eaque magni corporis repudiandae ea voluptatum. Voluptates pariatur quisquam perspiciatis corrupti alias. Suscipit est ipsum et perferendis adipisci quo repudiandae.",
            "artist":"Fuga at sed aliquam est corporis. Consequatur sit vitae voluptatem veritatis. Omnis voluptas enim consequatur temporibus ad necessitatibus. Voluptatibus itaque cupiditate voluptatem in tenetur et voluptatem. Quas et labore dicta velit.",
            "bpm":"Et hic ea reprehenderit nisi dolore. Animi est dolores omnis quo. Et ut saepe molestiae corrupti maxime labore ut magni. Laborum ut dicta debitis est. Quidem repellendus maxime cupiditate fuga et.",
            "cdTracks":"Fuga qui alias nisi officiis earum facilis nisi. Pariatur voluptatem et qui et blanditiis. Sit placeat sint voluptatem sint quasi et iusto.",
            "chordOrScale":"Eos nisi unde sed libero. Harum est autem inventore velit sapiente nihil possimus. Ipsa officia non et sint dolore ut eum. Est magnam ut et ut qui.",
            "difficultyRange":"Impedit rem est doloribus quis enim. Aspernatur quibusdam totam magni quibusdam soluta ipsum et. Fugiat sit voluptatem vitae. Error quis iste pariatur quis at.",
            "episodeNumber":1996719150,
            "exerciseBookPages":"Molestiae nemo nostrum vel error laborum recusandae. Fuga possimus quia impedit sunt. Porro necessitatibus provident nihil aspernatur. Saepe autem debitis itaque nulla laboriosam itaque.",
            "fastBpm":"Eos totam nihil et maxime sint. Recusandae iusto accusantium ex reiciendis omnis enim quibusdam. Eaque et enim aut sed porro ea. Odit ea vel fuga.",
            "includesSong":true,
            "instructors":"Dignissimos corporis voluptatem et deserunt et nam sed. Soluta velit corporis cupiditate consequatur minima totam. Debitis qui consectetur dolor eum commodi quis. Veniam quia ipsa vel sunt rerum.",
            "liveEventStartTime":{  
               "date":"1990-01-08 06:38:19.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventEndTime":{  
               "date":"1992-09-30 05:20:58.000000",
               "timezone_type":3,
               "timezone":"UTC"
            },
            "liveEventYoutubeId":"Repudiandae soluta ab ratione dolore. Repellendus eaque excepturi laboriosam. Voluptatem et quas eveniet natus ratione quia vero. Accusamus fugiat molestiae ut temporibus iure aliquid.",
            "liveStreamFeedType":"Fugiat et quia nostrum nulla. Impedit illo aspernatur labore ut. Ut enim quia quo voluptatem sit delectus. Quaerat dolorem doloribus cupiditate incidunt alias tenetur.",
            "name":"Expedita consequatur suscipit cum voluptates. Et aut ullam qui amet corporis unde eos. Ad nihil quidem quo iure maiores. Est quae eligendi unde possimus sapiente. Molestiae quis corrupti nulla libero.",
            "released":"Temporibus incidunt ipsa aspernatur quidem placeat dolor. Necessitatibus expedita voluptatum odio repellat doloremque rerum. Dignissimos iste et porro. Est enim itaque sit soluta vero facilis soluta.",
            "slowBpm":"Ipsa non quibusdam sed est nostrum ducimus inventore. Reprehenderit libero amet aut. Qui aut et consequuntur accusamus ea similique tenetur. Praesentium dignissimos perspiciatis ipsa quos. Magnam minus illum dolorum.",
            "totalXp":"Libero exercitationem fuga dolorem sunt recusandae quia. Voluptatem quisquam rerum qui. Corporis quisquam non eum quia. Culpa asperiores dolores aut voluptas quod.",
            "transcriberName":"Corporis sint sunt dolorem quidem quaerat nam. Numquam impedit nobis architecto adipisci. Aut aut quod eveniet dolor id non facilis.",
            "week":1727272093,
            "avatarUrl":"Quia labore esse doloribus optio molestias. Aut est amet voluptate et fugit qui commodi. Voluptate molestias est asperiores velit id aliquam aut suscipit. Quisquam officiis repellat repudiandae qui voluptates quidem.",
            "lengthInSeconds":240332045,
            "soundsliceSlug":"Sed cum consequatur fugit voluptatem velit voluptas porro. Numquam sint aut deserunt quas ut. Illo iusto qui reiciendis amet dolore.",
            "staffPickRating":1396102370,
            "studentId":712639093,
            "vimeoVideoId":"Aut blanditiis qui minus inventore veritatis aut. In quis sequi et totam quis. Consequatur omnis veniam vero quae. Atque non minima doloribus illum.",
            "youtubeVideoId":"Tenetur ducimus illum commodi fuga error vero. Esse provident quia expedita voluptatem impedit dolor tempora. Voluptatem non quae doloribus cum rerum aliquid id rerum."
         }
      }
   ],
   "included":[  
      {  
         "type":"topic",
         "id":"1",
         "attributes":{  
            "topic":"eveniet",
            "position":1928900234
         }
      },
      {  
         "type":"topic",
         "id":"16",
         "attributes":{  
            "topic":"voluptatem",
            "position":1143624144
         }
      }
   ],
   "meta":{  
      "pagination":{  
         "total":5,
         "count":3,
         "per_page":3,
         "current_page":1,
         "total_pages":2
      }
   },
   "links":{  
      "self":"http:\/\/localhost\/railcontent\/search?page=1&limit=3&term=omnis",
      "first":"http:\/\/localhost\/railcontent\/search?page=1&limit=3&term=omnis",
      "next":"http:\/\/localhost\/railcontent\/search?page=2&limit=3&term=omnis",
      "last":"http:\/\/localhost\/railcontent\/search?page=2&limit=3&term=omnis"
   }
}
```

<!--- -------------------------------------------------------------------------------------------------------------- -->
