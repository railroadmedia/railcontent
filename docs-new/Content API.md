# Content API

# JSON Endpoints


<!-- START_61bfda18a7d18e87c48fe08c708c8abe -->
## railcontent/content

### HTTP Request
    `OPTIONS railcontent/content`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X OPTIONS "http://localhost/railcontent/content" 
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_61bfda18a7d18e87c48fe08c708c8abe -->

<!-- START_d33050309856c95cc17d90bb91fbca9c -->
## railcontent/content

### HTTP Request
    `GET railcontent/content`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X GET -G "http://localhost/railcontent/content" 
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Doloribus qui quas sed. Eum ipsum nobis laboriosam dolor. Odio voluptatibus earum neque qui ducimus eveniet nesciunt. Sunt iste ratione aut assumenda.",
                "type": "course",
                "sort": "1529606777",
                "status": "published",
                "brand": "brand",
                "language": "Est et repellat velit illo eaque fugiat quia. Distinctio ullam sed labore sed voluptas. Quia dicta impedit quam ipsam. Dolor totam molestiae nihil ut vero sapiente. Eveniet cum sit qui explicabo. Doloribus voluptates minus qui maxime eligendi.",
                "user": "",
                "publishedOn": {
                    "date": "1991-02-01 15:42:56.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1985-01-28 00:58:20.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2019-04-06 23:51:00.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Amet sed dolorem laudantium cum praesentium. Ea ut saepe ut dolores possimus eveniet. Quo aut sunt vitae molestiae qui. Expedita repellendus inventore itaque minima ut nesciunt odio. Hic cumque quia blanditiis dolore nemo odio eligendi.",
                "homeStaffPickRating": "323632117",
                "legacyId": 1729857357,
                "legacyWordpressPostId": 413728246,
                "qnaVideo": "Officia ut corrupti nihil dolor minus quaerat eaque. Rem id consequatur sint error esse doloremque. Eveniet officiis itaque id qui aut laudantium. Veniam aliquam ducimus ut et est aut rerum.",
                "style": "Ab rerum reiciendis sunt et consequatur officia laborum. Dolore eos consequatur sint error. Quibusdam et enim animi corrupti nobis non earum. Quia repudiandae cumque perferendis qui occaecati eos expedita.",
                "title": "Vero non sit explicabo dolor.",
                "xp": 457521649,
                "album": "Ea qui aspernatur maxime occaecati dicta sit. Voluptatem et harum earum ducimus velit. Reiciendis beatae sint qui harum earum consectetur.",
                "artist": "Soluta soluta quo corporis rem quidem. Placeat tempore necessitatibus est et et ad. Modi itaque doloribus consequatur sint ut quas nostrum. Fugit hic inventore illum excepturi autem et.",
                "bpm": "Adipisci accusantium porro libero officia alias iusto. Quasi omnis adipisci ab. Recusandae omnis quo sed voluptatem fugit eveniet facere molestias.",
                "cdTracks": "Dicta facilis ipsum beatae aut pariatur. Laboriosam voluptas vel voluptas consequatur. Facilis soluta quos quia sapiente in incidunt.",
                "chordOrScale": "Qui ipsa ipsa saepe iusto mollitia suscipit id. Dicta quia dolore sunt voluptatibus. Saepe et et ullam ut aliquam. Id vitae minus deserunt nihil. Ad aut sint aut ut at fugiat.",
                "difficultyRange": "Maiores dolores laborum totam alias. Corrupti quis explicabo nobis ut qui saepe. Dicta voluptatem eum esse est. Consectetur voluptatem facilis consequatur aperiam. Mollitia amet et pariatur repellendus est voluptatem est.",
                "episodeNumber": 737683938,
                "exerciseBookPages": "Voluptas pariatur qui culpa vel tempora aliquam modi. Esse consectetur mollitia voluptatem ut. Eius perspiciatis quia repudiandae numquam. Sequi suscipit quia expedita iste.",
                "fastBpm": "Ut quia et molestiae eos labore et. Tenetur corrupti eius magni ducimus excepturi doloremque. Voluptatibus excepturi et est molestiae fugit non.",
                "includesSong": true,
                "instructors": "Dolor id omnis consectetur ratione et. Rem molestiae laudantium dignissimos magnam. Deleniti nemo fugit sunt itaque. Iste excepturi earum sit et eos. Eum et ad vitae voluptatum illum aut quo fugit. Debitis non error dolores labore.",
                "liveEventStartTime": {
                    "date": "2013-12-16 19:12:13.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1977-02-02 02:45:08.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Placeat est illo voluptatem laboriosam. Vel sed eum magnam dicta praesentium. Distinctio ut cum sunt excepturi accusantium aut. Quisquam eos consequatur ut.",
                "liveStreamFeedType": "Quidem in esse eos architecto et eum. Repellendus cupiditate nihil eligendi quisquam quaerat soluta. Reiciendis eveniet explicabo ullam quibusdam sunt neque porro.",
                "name": "In quos quidem officia sunt. Quis voluptates qui ea quia quia voluptatem aut vitae. Totam rem commodi consequatur neque possimus sint. Nisi sit sapiente perferendis sed cupiditate sed cumque tempora.",
                "released": "Dolores et eos nulla eaque tenetur repudiandae. Veniam corrupti tenetur aliquid mollitia delectus earum. Vel id tenetur occaecati quae doloremque. Dolorum et non in sunt. Aut praesentium recusandae magnam impedit minus libero.",
                "slowBpm": "Aperiam consectetur tempora quos iure autem fuga molestiae possimus. Qui amet reprehenderit qui enim alias. Delectus dolor sit eum necessitatibus. Eligendi id est aliquam facilis non.",
                "totalXp": "Impedit sunt voluptas et eligendi officiis sit. Rerum voluptatum iste qui accusamus vel ad maiores qui. Sit distinctio nulla qui voluptates dolores aut est. Repellendus quia enim explicabo odit beatae optio odio.",
                "transcriberName": "Nisi natus omnis doloribus cum earum soluta. Dolorum rerum eum explicabo velit id et vel totam. Soluta facilis cupiditate totam.",
                "week": 894916847,
                "avatarUrl": "Similique ut possimus deleniti quo. Totam nemo modi provident quia consectetur. Eum itaque necessitatibus sapiente voluptatem. Excepturi delectus fuga laborum.",
                "lengthInSeconds": 339378534,
                "soundsliceSlug": "Modi possimus similique voluptatum eum in quibusdam fugiat rem. Aut porro ut sequi ab. Ullam id tenetur beatae atque nemo eos magni. Quidem eos ducimus veritatis quae odio expedita nihil eligendi. Quo sint laborum dolores velit iste nihil dolore.",
                "staffPickRating": 555601622,
                "studentId": 704383940,
                "vimeoVideoId": "Rem velit non voluptatibus dolor qui eum. Eaque alias laudantium voluptas neque in facere officiis. Voluptas est fugit et consequatur veniam qui.",
                "youtubeVideoId": "Eos dolores aut soluta asperiores neque. Pariatur nobis nulla ut eaque quam similique vel. Id itaque laudantium reprehenderit sint repellendus omnis. Inventore sequi et non quod cum temporibus quis."
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
                "publishedOn": {
                    "date": "1986-05-15 17:00:35.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1993-06-03 18:08:11.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1983-05-29 22:21:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ipsam cumque laudantium quos minima et inventore. Quo quisquam impedit nostrum hic qui sapiente et id. Eos animi aut eos culpa et. Id omnis error odit veniam eius.",
                "homeStaffPickRating": "887788560",
                "legacyId": 843444433,
                "legacyWordpressPostId": 479570189,
                "qnaVideo": "Atque et repudiandae necessitatibus sint qui alias. Sint et provident et ut architecto. Ut ea enim et voluptates maxime amet vero. Odit nihil quos accusantium quis rerum velit. Placeat voluptatem nulla reiciendis vitae.",
                "style": "Recusandae facilis eius eos repellendus iusto. Est et sint perferendis similique. Eos necessitatibus consequatur vel dolor possimus nam. Dolorem recusandae hic adipisci quia. Dolore dolorum adipisci harum repellat minus.",
                "title": "Illum libero dolores qui non inventore delectus.",
                "xp": 696270715,
                "album": "Itaque sequi qui dolor et. Culpa non quas blanditiis qui officiis quia non. Nesciunt temporibus et sed id. Qui qui assumenda distinctio odio unde eius. Et autem corrupti non omnis dolores est aut.",
                "artist": "Delectus incidunt est exercitationem dicta animi fugiat. Aut illum nobis ut voluptatem porro. Ea voluptate sint corrupti nostrum.",
                "bpm": "Rem enim commodi in labore est voluptatem. Alias eius molestiae quidem officiis deleniti excepturi cum. Velit labore saepe officia ipsum. Nesciunt perspiciatis non consectetur cumque soluta.",
                "cdTracks": "Id repudiandae vero dicta accusamus ex nulla. Autem quia et eum eum culpa quo quae voluptatibus. Laborum quaerat et illum. Molestiae aut aut nam numquam veritatis facilis quas.",
                "chordOrScale": "Voluptatum eum repellat eius quae sit sed alias. Sed quis qui suscipit et voluptatem. Perferendis debitis magni cupiditate ex. Voluptas qui dolorem doloremque sed id et odit. Placeat sunt fugit omnis non labore.",
                "difficultyRange": "Sunt dolore quo nisi repellendus temporibus. Sit excepturi accusantium id quasi est quidem quod. Dolorum minus omnis temporibus esse architecto. Voluptas rem unde est voluptas necessitatibus vel.",
                "episodeNumber": 1153315892,
                "exerciseBookPages": "Quia aperiam eius atque aperiam similique qui. Corporis aut eaque aut modi ea enim. Sapiente omnis aspernatur error.",
                "fastBpm": "Quae autem qui porro voluptates dolore. Esse recusandae veritatis totam harum enim a et fuga. Iure laudantium voluptatem natus molestiae. Ut sed rerum dignissimos ullam dolor nam nobis. Perspiciatis tempore et delectus sit ut qui.",
                "includesSong": true,
                "instructors": "Eligendi autem veniam autem. Dolores itaque nostrum repellendus dicta et eius id.",
                "liveEventStartTime": {
                    "date": "1988-06-30 08:45:51.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1978-05-24 17:33:40.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Error asperiores nesciunt assumenda porro exercitationem. Deleniti atque et voluptate id dolores porro. Libero modi aperiam modi voluptas sit. Numquam velit blanditiis modi et non nostrum. Doloribus et omnis in facilis.",
                "liveStreamFeedType": "Quas alias sunt quisquam eius rerum aspernatur saepe. Veritatis quas quos ut consequatur itaque doloremque nobis rerum. Sapiente natus fugit aut eum fuga modi.",
                "name": "Ex saepe maxime unde quo. Ea hic quidem velit. Doloremque dolorum qui consectetur eveniet tempore sed. Voluptatem quia aut unde laudantium natus nihil eos.",
                "released": "Ab perspiciatis ipsa sed dolorum aut nisi sint. Necessitatibus tenetur enim et qui illo. Impedit quis ut eveniet et est magnam.",
                "slowBpm": "Tenetur doloribus autem nisi eveniet. Fuga quaerat est praesentium et. Dicta id qui iusto perferendis ut sit repellat. Assumenda eos repellat dolorem maxime id officia vel.",
                "totalXp": "Unde quam quia perferendis quibusdam distinctio dolorum. Est sed commodi possimus laboriosam. Architecto sint beatae et nisi voluptates.",
                "transcriberName": "Voluptatibus sint id quia minima ipsa maxime. Error est consequatur et enim. Sint a aliquam unde et molestias mollitia numquam.",
                "week": 1803610393,
                "avatarUrl": "Nam quisquam sed sapiente id nesciunt hic. Ratione quia aut voluptas et vel laborum esse. Doloremque amet deserunt qui velit. Unde sit autem aliquam optio. Sint fuga ut voluptatem sint incidunt autem.",
                "lengthInSeconds": 305594635,
                "soundsliceSlug": "Vel quis velit esse. Debitis aperiam est deleniti voluptatum sit. Quia consequatur cupiditate corporis assumenda reprehenderit est nisi quia. In dolores quidem temporibus doloremque illum dolorem.",
                "staffPickRating": 963992601,
                "studentId": 1679070401,
                "vimeoVideoId": "Beatae praesentium ut in distinctio numquam ipsum quam. Ea iusto sed aut pariatur. Consequuntur aperiam necessitatibus corporis dolor.",
                "youtubeVideoId": "Eum qui sunt voluptates laboriosam voluptatem voluptas. Repudiandae dignissimos et cum assumenda iusto cum velit nulla. Aut doloribus cum nemo officia error voluptatem illum. Dolore corrupti quo ipsa assumenda dicta."
            }
        }
    ],
    "meta": {
        "filterOption": {
            "difficulty": [
                "Ipsam cumque laudantium quos minima et inventore. Quo quisquam impedit nostrum hic qui sapiente et id. Eos animi aut eos culpa et. Id omnis error odit veniam eius.",
                "Amet sed dolorem laudantium cum praesentium. Ea ut saepe ut dolores possimus eveniet. Quo aut sunt vitae molestiae qui. Expedita repellendus inventore itaque minima ut nesciunt odio. Hic cumque quia blanditiis dolore nemo odio eligendi."
            ],
            "style": [
                "Recusandae facilis eius eos repellendus iusto. Est et sint perferendis similique. Eos necessitatibus consequatur vel dolor possimus nam. Dolorem recusandae hic adipisci quia. Dolore dolorum adipisci harum repellat minus.",
                "Ab rerum reiciendis sunt et consequatur officia laborum. Dolore eos consequatur sint error. Quibusdam et enim animi corrupti nobis non earum. Quia repudiandae cumque perferendis qui occaecati eos expedita."
            ],
            "artist": [
                "Delectus incidunt est exercitationem dicta animi fugiat. Aut illum nobis ut voluptatem porro. Ea voluptate sint corrupti nostrum.",
                "Soluta soluta quo corporis rem quidem. Placeat tempore necessitatibus est et et ad. Modi itaque doloribus consequatur sint ut quas nostrum. Fugit hic inventore illum excepturi autem et."
            ]
        },
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/content?page=1",
        "first": "http:\/\/localhost\/railcontent\/content?page=1",
        "last": "http:\/\/localhost\/railcontent\/content?page=1"
    }
}
```




<!-- END_d33050309856c95cc17d90bb91fbca9c -->

<!-- START_5749008282f838b8688849041825f55a -->
## Pull the children contents for the parent id


### HTTP Request
    `GET railcontent/content/parent/{parentId}`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X GET -G "http://localhost/railcontent/content/parent/1" 
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "slug": null,
            "type": null,
            "sort": 0,
            "status": null,
            "brand": null,
            "language": null,
            "user": "",
            "publishedOn": null,
            "archivedOn": null,
            "createdOn": null,
            "difficulty": null,
            "homeStaffPickRating": null,
            "legacyId": null,
            "legacyWordpressPostId": null,
            "qnaVideo": null,
            "style": null,
            "title": null,
            "xp": null,
            "album": null,
            "artist": null,
            "bpm": null,
            "cdTracks": null,
            "chordOrScale": null,
            "difficultyRange": null,
            "episodeNumber": null,
            "exerciseBookPages": null,
            "fastBpm": null,
            "includesSong": false,
            "instructors": null,
            "liveEventStartTime": null,
            "liveEventEndTime": null,
            "liveEventYoutubeId": null,
            "liveStreamFeedType": null,
            "name": null,
            "released": null,
            "slowBpm": null,
            "totalXp": null,
            "transcriberName": null,
            "week": null,
            "avatarUrl": null,
            "lengthInSeconds": null,
            "soundsliceSlug": null,
            "staffPickRating": null,
            "studentId": null,
            "vimeoVideoId": null,
            "youtubeVideoId": null
        }
    }
}
```




<!-- END_5749008282f838b8688849041825f55a -->

<!-- START_e55b02d4c8dd5d9849bcb5ea9764baa7 -->
## Pull the contents based on ids


### HTTP Request
    `GET railcontent/content/get-by-ids`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X GET -G "http://localhost/railcontent/content/get-by-ids" 
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": null,
            "id": "",
            "attributes": {
                "slug": null,
                "type": null,
                "sort": 0,
                "status": null,
                "brand": null,
                "language": null,
                "user": "",
                "publishedOn": null,
                "archivedOn": null,
                "createdOn": null,
                "difficulty": null,
                "homeStaffPickRating": null,
                "legacyId": null,
                "legacyWordpressPostId": null,
                "qnaVideo": null,
                "style": null,
                "title": null,
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        },
        {
            "type": null,
            "id": "",
            "attributes": {
                "slug": null,
                "type": null,
                "sort": 0,
                "status": null,
                "brand": null,
                "language": null,
                "user": "",
                "publishedOn": null,
                "archivedOn": null,
                "createdOn": null,
                "difficulty": null,
                "homeStaffPickRating": null,
                "legacyId": null,
                "legacyWordpressPostId": null,
                "qnaVideo": null,
                "style": null,
                "title": null,
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        }
    ]
}
```




<!-- END_e55b02d4c8dd5d9849bcb5ea9764baa7 -->

<!-- START_590f05a5a1b2df09a96398373df36802 -->
## railcontent/content/{id}

### HTTP Request
    `GET railcontent/content/{id}`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  ||


### Request Example:

```bash
curl -X GET -G "http://localhost/railcontent/content/1" 
```

### Response Example (200):

```json
{
    "data": {
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
            "publishedOn": {
                "date": "1986-05-15 17:00:35.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "archivedOn": {
                "date": "1993-06-03 18:08:11.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "1983-05-29 22:21:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Ipsam cumque laudantium quos minima et inventore. Quo quisquam impedit nostrum hic qui sapiente et id. Eos animi aut eos culpa et. Id omnis error odit veniam eius.",
            "homeStaffPickRating": "887788560",
            "legacyId": 843444433,
            "legacyWordpressPostId": 479570189,
            "qnaVideo": "Atque et repudiandae necessitatibus sint qui alias. Sint et provident et ut architecto. Ut ea enim et voluptates maxime amet vero. Odit nihil quos accusantium quis rerum velit. Placeat voluptatem nulla reiciendis vitae.",
            "style": "Recusandae facilis eius eos repellendus iusto. Est et sint perferendis similique. Eos necessitatibus consequatur vel dolor possimus nam. Dolorem recusandae hic adipisci quia. Dolore dolorum adipisci harum repellat minus.",
            "title": "Illum libero dolores qui non inventore delectus.",
            "xp": 696270715,
            "album": "Itaque sequi qui dolor et. Culpa non quas blanditiis qui officiis quia non. Nesciunt temporibus et sed id. Qui qui assumenda distinctio odio unde eius. Et autem corrupti non omnis dolores est aut.",
            "artist": "Delectus incidunt est exercitationem dicta animi fugiat. Aut illum nobis ut voluptatem porro. Ea voluptate sint corrupti nostrum.",
            "bpm": "Rem enim commodi in labore est voluptatem. Alias eius molestiae quidem officiis deleniti excepturi cum. Velit labore saepe officia ipsum. Nesciunt perspiciatis non consectetur cumque soluta.",
            "cdTracks": "Id repudiandae vero dicta accusamus ex nulla. Autem quia et eum eum culpa quo quae voluptatibus. Laborum quaerat et illum. Molestiae aut aut nam numquam veritatis facilis quas.",
            "chordOrScale": "Voluptatum eum repellat eius quae sit sed alias. Sed quis qui suscipit et voluptatem. Perferendis debitis magni cupiditate ex. Voluptas qui dolorem doloremque sed id et odit. Placeat sunt fugit omnis non labore.",
            "difficultyRange": "Sunt dolore quo nisi repellendus temporibus. Sit excepturi accusantium id quasi est quidem quod. Dolorum minus omnis temporibus esse architecto. Voluptas rem unde est voluptas necessitatibus vel.",
            "episodeNumber": 1153315892,
            "exerciseBookPages": "Quia aperiam eius atque aperiam similique qui. Corporis aut eaque aut modi ea enim. Sapiente omnis aspernatur error.",
            "fastBpm": "Quae autem qui porro voluptates dolore. Esse recusandae veritatis totam harum enim a et fuga. Iure laudantium voluptatem natus molestiae. Ut sed rerum dignissimos ullam dolor nam nobis. Perspiciatis tempore et delectus sit ut qui.",
            "includesSong": true,
            "instructors": "Eligendi autem veniam autem. Dolores itaque nostrum repellendus dicta et eius id.",
            "liveEventStartTime": {
                "date": "1988-06-30 08:45:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1978-05-24 17:33:40.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Error asperiores nesciunt assumenda porro exercitationem. Deleniti atque et voluptate id dolores porro. Libero modi aperiam modi voluptas sit. Numquam velit blanditiis modi et non nostrum. Doloribus et omnis in facilis.",
            "liveStreamFeedType": "Quas alias sunt quisquam eius rerum aspernatur saepe. Veritatis quas quos ut consequatur itaque doloremque nobis rerum. Sapiente natus fugit aut eum fuga modi.",
            "name": "Ex saepe maxime unde quo. Ea hic quidem velit. Doloremque dolorum qui consectetur eveniet tempore sed. Voluptatem quia aut unde laudantium natus nihil eos.",
            "released": "Ab perspiciatis ipsa sed dolorum aut nisi sint. Necessitatibus tenetur enim et qui illo. Impedit quis ut eveniet et est magnam.",
            "slowBpm": "Tenetur doloribus autem nisi eveniet. Fuga quaerat est praesentium et. Dicta id qui iusto perferendis ut sit repellat. Assumenda eos repellat dolorem maxime id officia vel.",
            "totalXp": "Unde quam quia perferendis quibusdam distinctio dolorum. Est sed commodi possimus laboriosam. Architecto sint beatae et nisi voluptates.",
            "transcriberName": "Voluptatibus sint id quia minima ipsa maxime. Error est consequatur et enim. Sint a aliquam unde et molestias mollitia numquam.",
            "week": 1803610393,
            "avatarUrl": "Nam quisquam sed sapiente id nesciunt hic. Ratione quia aut voluptas et vel laborum esse. Doloremque amet deserunt qui velit. Unde sit autem aliquam optio. Sint fuga ut voluptatem sint incidunt autem.",
            "lengthInSeconds": 305594635,
            "soundsliceSlug": "Vel quis velit esse. Debitis aperiam est deleniti voluptatum sit. Quia consequatur cupiditate corporis assumenda reprehenderit est nisi quia. In dolores quidem temporibus doloremque illum dolorem.",
            "staffPickRating": 963992601,
            "studentId": 1679070401,
            "vimeoVideoId": "Beatae praesentium ut in distinctio numquam ipsum quam. Ea iusto sed aut pariatur. Consequuntur aperiam necessitatibus corporis dolor.",
            "youtubeVideoId": "Eum qui sunt voluptates laboriosam voluptatem voluptas. Repudiandae dignissimos et cum assumenda iusto cum velit nulla. Aut doloribus cum nemo officia error voluptatem illum. Dolore corrupti quo ipsa assumenda dicta."
        }
    }
}
```




<!-- END_590f05a5a1b2df09a96398373df36802 -->

<!-- START_041a3bcbff15a33078ad0fc39db6ceda -->
## Create a new content


### HTTP Request
    `PUT railcontent/content`


### Permissions
    - Must be logged in
    - Must have the create.content permission to create
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'content'.|
|body|data.attributes.slug|    ||
|body|data.attributes.type|  yes  ||
|body|data.attributes.status|  yes  ||
|body|data.attributes.language|    |default:'en-US'.|
|body|data.attributes.sort|    ||
|body|data.attributes.published_on|    ||
|body|data.attributes.created_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.parent.data.type|    |Must be 'content'.|
|body|data.relationships.parent.data.id|    |Must exists in contents.|
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:content',",
    "                'data.attributes.status' => 'max:64|required|in:' . implode(",
    "                        ',',",
    "                        [",
    "                            ContentService::STATUS_DRAFT,",
    "                            ContentService::STATUS_PUBLISHED,",
    "                            ContentService::STATUS_ARCHIVED,",
    "                            ContentService::STATUS_SCHEDULED,",
    "                            ContentService::STATUS_DELETED,",
    "                        ]",
    "                    ),",
    "                'data.attributes.type' => 'required|max:64',",
    "                'data.attributes.slug' => 'max:255',",
    "                'data.attributes.sort' => 'nullable|numeric',",
    "                'data.attributes.position' => 'nullable|numeric|min:0',",
    "                'data.attributes.published_on' => 'nullable|date',",
    "                'data.relationships.parent.data.type' => 'nullable|in:content',",
    "                'data.relationships.user.data.type' => 'nullable|in:user',",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules based on content type and brand",
    "        $this->setCustomRules($this);",
    "",
    "        return parent::rules();"
]
```

### Request Example:

```bash
curl -X PUT "http://localhost/railcontent/content" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"content","attributes":{"slug":"01-getting-started","type":"course","status":"draft","language":"en-US","sort":0,"published_on":"2019-05-21 21:20:10","created_on":"2019-05-21 21:20:10","archived_on":"2019-05-21 21:20:10","fields":[],"brand":"brand"},"relationships":{"parent":{"data":{"type":"content","id":1}},"user":{"data":{"type":"user","id":1}}}}}'

```

### Response Example (201):

```json
{
    "data": {
        "type": "content",
        "id": "3",
        "attributes": {
            "slug": "01-getting-started",
            "type": "course",
            "sort": "0",
            "status": "draft",
            "brand": "brand",
            "language": "en-US",
            "user": "1",
            "publishedOn": "2019-05-21 21:20:10",
            "archivedOn": "2019-05-21 21:20:10",
            "createdOn": "2019-05-21 21:20:10",
            "difficulty": null,
            "homeStaffPickRating": null,
            "legacyId": null,
            "legacyWordpressPostId": null,
            "qnaVideo": null,
            "style": null,
            "title": null,
            "xp": null,
            "album": null,
            "artist": null,
            "bpm": null,
            "cdTracks": null,
            "chordOrScale": null,
            "difficultyRange": null,
            "episodeNumber": null,
            "exerciseBookPages": null,
            "fastBpm": null,
            "includesSong": false,
            "instructors": null,
            "liveEventStartTime": null,
            "liveEventEndTime": null,
            "liveEventYoutubeId": null,
            "liveStreamFeedType": null,
            "name": null,
            "released": null,
            "slowBpm": null,
            "totalXp": null,
            "transcriberName": null,
            "week": null,
            "avatarUrl": null,
            "lengthInSeconds": null,
            "soundsliceSlug": null,
            "staffPickRating": null,
            "studentId": null,
            "vimeoVideoId": null,
            "youtubeVideoId": null
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "parent",
                    "id": "1"
                }
            }
        }
    },
    "included": [
        {
            "type": "parent",
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




<!-- END_041a3bcbff15a33078ad0fc39db6ceda -->

<!-- START_5828f7048c0cc2858373a9cf44c55e02 -->
## Update a content based on content id and return it in JSON format


### HTTP Request
    `PATCH railcontent/content/{contentId}`


### Permissions
    - Must be logged in
    - Must have the update.content permission to update
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|content_id|  yes  ||
|body|data.type|  yes  |Must be 'content'.|
|body|data.attributes.slug|    ||
|body|data.attributes.type|    ||
|body|data.attributes.status|    ||
|body|data.attributes.language|    |en-US|
|body|data.attributes.sort|    ||
|body|data.attributes.published_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        \/\/set the general validation rules",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:content',",
    "                'data.attributes.status' => 'max:64|in:' .",
    "                    implode(",
    "                        ',',",
    "                        [",
    "                            ContentService::STATUS_DRAFT,",
    "                            ContentService::STATUS_PUBLISHED,",
    "                            ContentService::STATUS_ARCHIVED,",
    "                            ContentService::STATUS_SCHEDULED,",
    "                            ContentService::STATUS_DELETED,",
    "                        ]",
    "                    ),",
    "                'data.attributes.type' => 'max:64',",
    "                'data.attributes.sort' => 'nullable|numeric',",
    "                'data.attributes.position' => 'nullable|numeric|min:0',",
    "                'data.attributes.published_on' => 'nullable|date'",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules based on content type and brand",
    "        $this->setCustomRules($this);",
    "",
    "        \/\/get the validation rules",
    "        return parent::rules();"
]
```

### Request Example:

```bash
curl -X PATCH "http://localhost/railcontent/content/1" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"content","attributes":{"slug":"01-getting-started","type":"course","status":"draft","language":"nam","sort":0,"published_on":"null","archived_on":"in","fields":"","brand":"brand"},"relationships":{"user":{"data":{"type":"user","id":1}}}}}'

```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_5828f7048c0cc2858373a9cf44c55e02 -->

<!-- START_6db1e06526b714b35026eddcf5e1efb9 -->
## Call the delete method if the content exist


### HTTP Request
    `DELETE railcontent/content/{id}`


### Permissions
    - delete.content required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X DELETE "http://localhost/railcontent/content/1" 
```

### Response Example (204):

```json
null
```




<!-- END_6db1e06526b714b35026eddcf5e1efb9 -->

<!-- START_cd36dc2623a54c340f0bc0db37986ba8 -->
## Call the soft delete method if the content exist


### HTTP Request
    `DELETE railcontent/soft/content/{id}`


### Permissions
    - delete.content required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```bash
curl -X DELETE "http://localhost/railcontent/soft/content/1" 
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_cd36dc2623a54c340f0bc0db37986ba8 -->

