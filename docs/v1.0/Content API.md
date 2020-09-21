# Content API

# JSON Endpoints


<!-- START_d33050309856c95cc17d90bb91fbca9c -->
## railcontent/content

### HTTP Request
    `GET railcontent/content`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|statuses|    |All content must have one of these statuses. Default:published.|
|body|included_types|    |Contents with these types will be returned..|
|body|required_parent_ids|    |All contents must be a child of any of the passed in parent ids.|
|body|filter[required_fields]|    |All returned contents are required to have this field. Value format is: key;value;type (type is optional if its not declared all types will be included).|
|body|filter[included_fields]|    |All contents must be a child of any of the passed in parent ids..|
|body|filter[required_user_states]|    |All returned contents are required to have these states for the authenticated user. Value format is: state.|
|body|filter[included_user_states]|    |Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state but all included states after the first act inclusively. Value format is: state.|
|body|filter[required_user_playlists]|    |All returned contents are required to be inside these authenticated users playlists. Value format is: name.|
|body|filter[included_user_playlists]|    |Contents that are in any of the authenticated users playlists will be returned. The first included user playlist is the same as a required user playlist but all included playlist after the first act inclusively. Value format is: name.|
|body|slug_hierarchy|    ||
|body|sort|Default:newest|Can be any of the following: 'newest', ‘oldest’, ‘popularity’, ‘trending’, ‘relevance’ and 'slug'|
|body|page|    |Which page to load, will be {limit} long.By default:1.|
|body|limit|    |How many to load per page. By default:10.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
{
    "statuses": "['published']",
    "included_types": [],
    "required_parent_ids": [],
    "filter": {
        "required_fields": [],
        "included_fields": [],
        "required_user_states": [],
        "included_user_states": [],
        "required_user_playlists": [],
        "included_user_playlists": []
    },
    "slug_hierarchy": [],
    "sort": "newest",
    "page": 1,
    "limit": 10
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "content",
            "id": "3",
            "attributes": {
                "slug": "Rerum aut quod quo qui et in distinctio. Quia error adipisci ad sit iusto debitis rerum. Voluptatum et nihil ex non doloribus qui. Labore repellendus id minima qui.",
                "type": "course",
                "sort": "101576587",
                "status": "published",
                "brand": "brand",
                "language": "Vitae ut totam aut molestiae. Et reiciendis nam soluta voluptates quibusdam non sit molestias.",
                "user": "1",
                "publishedOn": {
                    "date": "2017-03-10 14:55:23.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2011-12-11 23:13:43.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2008-11-02 14:39:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Saepe et commodi ut aut. Exercitationem ut repellendus aspernatur. Consequatur provident ut quidem esse. Amet autem quidem tempore rerum quo. Hic maiores veritatis cupiditate sequi vero voluptas. Repudiandae eius autem facilis sit quia quaerat et.",
                "homeStaffPickRating": "803779682",
                "legacyId": 1568850342,
                "legacyWordpressPostId": 1283712995,
                "qnaVideo": "Non sit quisquam voluptatibus et suscipit qui ab. Fugiat impedit neque et voluptas consequatur quis enim rerum. Et accusamus voluptatem aut sed.",
                "style": "Quisquam voluptatem nesciunt aliquid ratione maxime sit omnis. Dolorum consequatur rerum nulla necessitatibus et est beatae. Nihil ipsum nostrum consectetur quas suscipit eos sit.",
                "title": "Fugiat quo tempora nulla tempora.",
                "xp": 2113320233,
                "album": "Architecto aliquam occaecati nisi alias commodi voluptatem. Beatae sunt nemo eius praesentium molestias saepe numquam. Laudantium non velit asperiores.",
                "artist": "Sit natus qui nihil. Quasi a maxime rerum quasi voluptas. Sit voluptatem deleniti voluptatem iste quia repudiandae. Est rerum et soluta sunt voluptate in.",
                "bpm": "Fugiat quia eum eius expedita quia placeat veniam animi. Mollitia non ut quia voluptatem. Fugiat nisi ea consequatur ut. Molestiae nostrum architecto eum qui accusamus hic error harum.",
                "cdTracks": "Delectus velit dicta sint facilis tenetur. Ipsum cumque sit cupiditate temporibus reprehenderit corporis est et. Ut eos quis quisquam totam minima eum quis repellendus.",
                "chordOrScale": "Tenetur perspiciatis qui amet omnis debitis. Non laudantium dolorem sit non magnam ipsum omnis. Error maiores molestiae cupiditate fugiat incidunt fuga delectus adipisci. Et iste hic explicabo sed.",
                "difficultyRange": "Et voluptatem fugiat suscipit sapiente. Ut nulla et quos facere est fugiat maiores. Accusantium autem dicta sed.",
                "episodeNumber": 856668108,
                "exerciseBookPages": "Dolores ratione commodi accusamus ipsam alias autem. Voluptas ad quia quos sunt. Id maxime ad necessitatibus sint quibusdam voluptatem.",
                "fastBpm": "Aut ea qui id ea iusto. Dicta eum rerum non excepturi sapiente corporis voluptatem. Facere nihil et vel. Suscipit laborum explicabo eius cupiditate est necessitatibus at.",
                "includesSong": false,
                "instructors": "Accusamus magni in velit id est earum. Sed id nostrum nemo qui aut ut error. Mollitia excepturi ducimus ea laborum quam et temporibus.",
                "liveEventStartTime": {
                    "date": "1995-10-29 06:33:46.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "2005-02-20 00:40:31.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Omnis nihil eveniet velit qui quia numquam inventore. Eum provident non omnis ducimus. Laboriosam et a sit voluptate sed vero eveniet iste. Qui sapiente esse deleniti nostrum labore quo sint. Enim est commodi est et quis et.",
                "liveStreamFeedType": "Natus ut sint alias. Blanditiis et provident assumenda voluptatibus et laboriosam. Ratione necessitatibus doloremque dolor impedit.",
                "name": "Rerum voluptatem officiis labore ut. Quae deleniti magni corporis architecto repudiandae nihil eum. Vitae blanditiis laboriosam velit at culpa quae.",
                "released": "Totam perspiciatis rerum magnam corrupti dolores laborum. Vel tempora voluptas sed inventore nulla impedit iusto. Tenetur sit eveniet ea praesentium illo quod magni.",
                "slowBpm": "Et dolores et nobis velit sed molestiae sed. Iste inventore occaecati unde qui. Quod et quas reiciendis omnis vel dolor.",
                "totalXp": "Officiis libero facere modi eius voluptatem ex repellendus. Et sit maiores ducimus voluptatem dolorem. In quidem et error quas aliquid eos. Expedita at beatae blanditiis quia nam ut.",
                "transcriberName": "Ullam aut cupiditate sapiente laboriosam aut eos rerum. Voluptatem dolores eaque architecto repudiandae nesciunt.",
                "week": 1768294809,
                "avatarUrl": "Exercitationem ut qui exercitationem similique quia ipsam nulla dicta. Blanditiis ea perspiciatis aut pariatur accusamus officiis quis. Et minima quia voluptates voluptatum doloremque maxime minima.",
                "lengthInSeconds": 1800506319,
                "soundsliceSlug": "Voluptatum ab provident placeat error. Alias ad quam id dolor magnam. Tempore eos dolorem accusantium reprehenderit necessitatibus reprehenderit. Non omnis dolorem autem et alias et autem.",
                "staffPickRating": 1354691758,
                "studentId": 78227527,
                "vimeoVideoId": "Nihil eos sit voluptas dolorem ut. Pariatur qui accusamus tempora deleniti suscipit dolores eius. Eveniet quis id laboriosam dolorum. Eaque quisquam modi quia doloremque voluptatem nobis velit atque.",
                "youtubeVideoId": "Voluptas doloremque repellendus dolor id. Aperiam eos accusamus et et. Voluptatibus ipsum veritatis sapiente ea ut aut architecto. Minus impedit exercitationem veritatis id. Suscipit accusamus dolorem autem nobis amet."
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
                "publishedOn": {
                    "date": "1987-05-25 11:13:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1971-05-28 07:02:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1985-09-02 03:40:00.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
                "homeStaffPickRating": "1530356095",
                "legacyId": 926698209,
                "legacyWordpressPostId": 69139045,
                "qnaVideo": "Deleniti minus et enim doloribus iste dolores est. Libero ea repellendus sed. Id dolore dolores consectetur. Nam harum eum reprehenderit natus a facilis laborum consectetur.",
                "style": "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
                "title": "Consectetur porro unde fuga animi modi.",
                "xp": 31718887,
                "album": "Et earum voluptates odio impedit dicta repudiandae ut. Magnam ipsum accusantium est officiis iste quia reiciendis. Autem facilis nihil molestiae sapiente nostrum sapiente commodi.",
                "artist": "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
                "bpm": "Aspernatur non in sint earum. Hic dignissimos odio unde voluptas tenetur est autem.",
                "cdTracks": "Autem modi qui dolorem quisquam quae in cupiditate. Aut vero qui ab adipisci voluptas vel qui quod. Amet accusamus quis ad ut sunt perferendis dolore. Id ut repellat saepe cumque. Sed velit nesciunt voluptas voluptatum.",
                "chordOrScale": "Ullam nobis illum illo. Voluptatem id voluptatem dolores tenetur est. Tempore sunt tenetur dolore. Voluptatem placeat dicta rerum a adipisci nobis iste. Ea amet architecto repellendus repellat molestias ullam dolorem.",
                "difficultyRange": "Veritatis suscipit fugiat ipsam excepturi officia voluptatem. Aut enim facere eius dignissimos neque quos. Possimus eius quasi laboriosam molestiae. Quia omnis aspernatur et praesentium.",
                "episodeNumber": 1304655407,
                "exerciseBookPages": "Est consequatur ipsa dolore. Tempore et et velit temporibus minus tempore. Voluptas et maiores ipsa earum. Voluptas quis libero asperiores quis distinctio ut autem.",
                "fastBpm": "Qui aut cupiditate ut laudantium. Est non est illum reprehenderit. Asperiores est modi consequatur impedit rerum autem. Necessitatibus non et vitae et rem corrupti.",
                "includesSong": true,
                "instructors": "Sit quidem sed eaque pariatur ea. Repellendus fugit ut totam occaecati quia. Quae dolorem ipsam repellendus rerum. Autem enim ex ullam laboriosam eveniet molestiae sit. Eum fugit ullam consectetur aut earum nostrum.",
                "liveEventStartTime": {
                    "date": "2017-02-07 22:31:21.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1983-02-12 16:50:18.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Laboriosam ipsum distinctio minima ut distinctio necessitatibus atque. Veniam facere error neque aliquam. Eligendi fugit eos blanditiis accusamus.",
                "liveStreamFeedType": "Minus omnis eos eligendi numquam voluptates. Nobis vitae quo et corporis enim porro. Ullam aut eligendi et fuga consequatur et delectus. Quod recusandae id et voluptas soluta hic. Possimus qui quasi at amet quis consequuntur. Quam unde non alias.",
                "name": "Sunt et et officia rem qui quos. Voluptatibus reprehenderit labore totam. Nostrum soluta minima impedit laudantium. Aut consequatur doloribus consequatur omnis.",
                "released": "Sint nemo voluptates repudiandae vel tenetur enim. Tempore dolor ducimus voluptas itaque provident. Non sed ex ut.",
                "slowBpm": "Tenetur rem aut maiores deserunt iusto. Iste vitae vitae natus nesciunt at vero. Est dolores praesentium enim pariatur a. Accusantium aut iure quisquam recusandae officia facilis.",
                "totalXp": "Est consectetur assumenda omnis nesciunt ratione ut ullam. Vitae voluptatum nihil non aliquam id. Id numquam odio non ullam reprehenderit quia aperiam.",
                "transcriberName": "Qui harum reiciendis ut harum. Omnis velit non nisi est voluptate possimus delectus. Earum quidem sit nam libero eum doloremque et.",
                "week": 487183727,
                "avatarUrl": "Reiciendis facilis at possimus. Suscipit est soluta asperiores corrupti maxime ut in mollitia. Voluptate ipsam qui maiores ratione suscipit hic ipsa. Suscipit qui laudantium reiciendis est sint consequatur similique.",
                "lengthInSeconds": 1458903902,
                "soundsliceSlug": "Facilis quo nisi delectus aliquam quia. Expedita nihil voluptas repellendus sit nisi provident pariatur commodi. Impedit qui sint aut placeat ea itaque. Dolor sit animi cum est inventore porro qui.",
                "staffPickRating": 889539890,
                "studentId": 269019524,
                "vimeoVideoId": "Tempore et temporibus fugiat odio laboriosam voluptas. Est provident modi distinctio est nihil non. Quia ad sunt animi dolores officia nobis. Id distinctio et nihil dolores. Corrupti sed quos molestiae rerum porro id ut. Non vel iusto et deleniti.",
                "youtubeVideoId": "Odit ipsa et et corrupti esse recusandae est. Odit rem qui nisi illum id ut. Voluptate est unde in voluptas rem tempore."
            },
            "relationships": {
                "data": {
                    "data": [
                        {
                            "type": "contentData",
                            "id": "1"
                        }
                    ]
                }
            }
        },
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Commodi accusamus expedita libero et. Incidunt aut dolorum nihil dolorum et. Est voluptate fugiat quidem.",
                "type": "course",
                "sort": "912536579",
                "status": "published",
                "brand": "brand",
                "language": "Beatae repellat omnis sint. Autem in ut quia aut. Laboriosam nihil dolore dolor earum adipisci tempora amet et.",
                "user": "1",
                "publishedOn": {
                    "date": "1984-12-23 11:55:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1979-03-22 15:18:29.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2005-06-29 21:30:28.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Nisi ut optio sunt consequuntur occaecati et. Molestiae et quas asperiores. Nisi nobis inventore distinctio velit quia repellat amet autem.",
                "homeStaffPickRating": "353834510",
                "legacyId": 987925246,
                "legacyWordpressPostId": 207893684,
                "qnaVideo": "Ut quae quam quia placeat omnis molestias numquam. Et earum fugiat enim consequuntur aut. Illum id laborum earum eum.",
                "style": "A quis corporis magnam consequatur. Quas culpa odit quisquam ratione eligendi autem odio. Fugit occaecati recusandae dolor ipsa quos.",
                "title": "Sit inventore quia voluptates.",
                "xp": 1139891474,
                "album": "Fugiat ut fuga aperiam totam quia commodi voluptas. Et quis aliquid tempora. Sequi quia magni architecto placeat. Sequi laboriosam quaerat est.",
                "artist": "Odio cumque quia ducimus explicabo impedit reprehenderit. Voluptates sed hic at omnis saepe ea rem. Iusto id impedit tempora consequatur accusamus consectetur et.",
                "bpm": "Corrupti incidunt ut sint placeat voluptatum. Ipsum aspernatur dolores eveniet culpa ut sunt aut qui. Vitae voluptatem rerum et distinctio aperiam quo facilis. Aut laboriosam voluptatum ex explicabo qui ea explicabo laboriosam.",
                "cdTracks": "Adipisci aut qui illo dolores. Ex alias est velit. Culpa labore tempore ducimus velit quia.",
                "chordOrScale": "Ex consequatur explicabo dignissimos. Eos vero et quia in cumque tempora. Corrupti officiis totam in in. Voluptas et sit modi animi facilis aut.",
                "difficultyRange": "Nostrum temporibus aut nulla. Deserunt sunt est ea et molestiae et. Animi et quod delectus reiciendis consectetur nam voluptatum quo.",
                "episodeNumber": 487967896,
                "exerciseBookPages": "Rem libero minus ratione et quae. Explicabo alias beatae aut eaque earum voluptatem magni quasi. Et ea esse incidunt dolore. Perspiciatis esse porro non quos impedit. Et aut quia dolorem consequuntur dolorem et.",
                "fastBpm": "Possimus est nihil aliquam quo quisquam. Molestiae maiores debitis illo consequuntur eum error. Doloribus est sequi ex reiciendis aut omnis.",
                "includesSong": false,
                "instructors": "Pariatur est voluptas neque fugiat. Deleniti rerum nostrum voluptas molestias debitis totam. Iure iure et qui repellat ea sed. Asperiores cupiditate fugit quam eum. Totam laboriosam quis voluptatem numquam odio sint rerum.",
                "liveEventStartTime": {
                    "date": "2003-05-05 18:37:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1994-01-08 08:05:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Enim placeat harum adipisci doloribus enim animi quam. Maiores voluptas et unde. Ea aspernatur impedit et eum.",
                "liveStreamFeedType": "Vel ut est et cupiditate asperiores est sunt amet. Vero minus ut dolore mollitia. Rem beatae modi voluptatem culpa quia. Labore sint voluptatem fugiat nihil itaque. Similique sit deleniti quo.",
                "name": "Asperiores ea eos nihil sed ullam. Omnis aspernatur voluptas illum et soluta. Et repudiandae error sunt aut id dolorem explicabo.",
                "released": "Incidunt et modi iste quia consectetur ullam. Molestiae saepe odio architecto omnis voluptas. Dignissimos animi et quia magni.",
                "slowBpm": "Sint soluta accusantium inventore velit et repellat. Rem recusandae beatae numquam. Id vel nisi et dolorem qui quia. Architecto sit expedita animi illum cum mollitia. Deleniti reprehenderit autem nihil voluptatem soluta deserunt doloribus iusto.",
                "totalXp": "Sed eos aliquid esse ipsum aut. Magni asperiores et voluptas distinctio cumque dolores distinctio. Voluptate vel repellat exercitationem velit quasi. Ut facilis ut dolores possimus doloribus placeat ipsam.",
                "transcriberName": "Quasi adipisci aut aut itaque. Mollitia ratione laudantium dolores dignissimos aut hic eum. Animi ipsum nesciunt porro voluptas vero. Laborum eos laudantium ipsam eum exercitationem.",
                "week": 1674024176,
                "avatarUrl": "Doloribus et alias ducimus. Repudiandae vitae blanditiis voluptas alias perspiciatis eligendi. Vel incidunt consequuntur et aperiam labore omnis ut.",
                "lengthInSeconds": 1340596336,
                "soundsliceSlug": "Qui sequi aut ut vel. Porro ut officiis dolorum id laboriosam repudiandae nihil id. Aliquam sed est corporis et consequatur consequatur. Ut doloremque corrupti voluptate fugiat doloremque.",
                "staffPickRating": 535529149,
                "studentId": 1959341206,
                "vimeoVideoId": "Nesciunt sunt amet quia qui quod ea ad. Velit sit expedita ut recusandae. Laudantium consequuntur sequi explicabo ut voluptatem sed quia. Deleniti sit accusantium quidem at aspernatur quia.",
                "youtubeVideoId": "Ut et architecto debitis sunt. Numquam amet ut eum autem sit quis. Quia impedit est quae odio. Beatae consectetur voluptatem animi voluptatum cum tenetur molestias."
            },
            "relationships": {
                "parent": {
                    "data": {
                        "type": "parent",
                        "id": "1"
                    }
                }
            }
        }
    ],
    "included": [
        {
            "type": "parent",
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
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "Nihil autem in dolorem dolorem repellendus. Id nam aut pariatur a recusandae. Quo numquam veritatis nesciunt soluta quia. Qui iure fugiat eveniet cum nihil. Corporis voluptas nam velit. Fuga voluptates error qui dolores.",
                "value": "Distinctio deleniti atque consequatur qui fuga. Qui voluptatem aut mollitia vel omnis corrupti esse. Autem itaque amet rerum accusantium.",
                "position": 1701478593
            }
        }
    ],
    "meta": {
        "filterOption": {
            "difficulty": [
                "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
                "Nisi ut optio sunt consequuntur occaecati et. Molestiae et quas asperiores. Nisi nobis inventore distinctio velit quia repellat amet autem.",
                "Saepe et commodi ut aut. Exercitationem ut repellendus aspernatur. Consequatur provident ut quidem esse. Amet autem quidem tempore rerum quo. Hic maiores veritatis cupiditate sequi vero voluptas. Repudiandae eius autem facilis sit quia quaerat et."
            ],
            "style": [
                "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
                "A quis corporis magnam consequatur. Quas culpa odit quisquam ratione eligendi autem odio. Fugit occaecati recusandae dolor ipsa quos.",
                "Quisquam voluptatem nesciunt aliquid ratione maxime sit omnis. Dolorum consequatur rerum nulla necessitatibus et est beatae. Nihil ipsum nostrum consectetur quas suscipit eos sit."
            ],
            "artist": [
                "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
                "Odio cumque quia ducimus explicabo impedit reprehenderit. Voluptates sed hic at omnis saepe ea rem. Iusto id impedit tempora consequatur accusamus consectetur et.",
                "Sit natus qui nihil. Quasi a maxime rerum quasi voluptas. Sit voluptatem deleniti voluptatem iste quia repudiandae. Est rerum et soluta sunt voluptate in."
            ]
        },
        "pagination": {
            "total": 3,
            "count": 3,
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
## Pull contents that are children of the specified content id


### HTTP Request
    `GET railcontent/content/parent/{parentId}`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/parent/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Commodi accusamus expedita libero et. Incidunt aut dolorum nihil dolorum et. Est voluptate fugiat quidem.",
                "type": "course",
                "sort": "912536579",
                "status": "published",
                "brand": "brand",
                "language": "Beatae repellat omnis sint. Autem in ut quia aut. Laboriosam nihil dolore dolor earum adipisci tempora amet et.",
                "user": "1",
                "publishedOn": {
                    "date": "1984-12-23 11:55:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1979-03-22 15:18:29.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2005-06-29 21:30:28.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Nisi ut optio sunt consequuntur occaecati et. Molestiae et quas asperiores. Nisi nobis inventore distinctio velit quia repellat amet autem.",
                "homeStaffPickRating": "353834510",
                "legacyId": 987925246,
                "legacyWordpressPostId": 207893684,
                "qnaVideo": "Ut quae quam quia placeat omnis molestias numquam. Et earum fugiat enim consequuntur aut. Illum id laborum earum eum.",
                "style": "A quis corporis magnam consequatur. Quas culpa odit quisquam ratione eligendi autem odio. Fugit occaecati recusandae dolor ipsa quos.",
                "title": "Sit inventore quia voluptates.",
                "xp": 1139891474,
                "album": "Fugiat ut fuga aperiam totam quia commodi voluptas. Et quis aliquid tempora. Sequi quia magni architecto placeat. Sequi laboriosam quaerat est.",
                "artist": "Odio cumque quia ducimus explicabo impedit reprehenderit. Voluptates sed hic at omnis saepe ea rem. Iusto id impedit tempora consequatur accusamus consectetur et.",
                "bpm": "Corrupti incidunt ut sint placeat voluptatum. Ipsum aspernatur dolores eveniet culpa ut sunt aut qui. Vitae voluptatem rerum et distinctio aperiam quo facilis. Aut laboriosam voluptatum ex explicabo qui ea explicabo laboriosam.",
                "cdTracks": "Adipisci aut qui illo dolores. Ex alias est velit. Culpa labore tempore ducimus velit quia.",
                "chordOrScale": "Ex consequatur explicabo dignissimos. Eos vero et quia in cumque tempora. Corrupti officiis totam in in. Voluptas et sit modi animi facilis aut.",
                "difficultyRange": "Nostrum temporibus aut nulla. Deserunt sunt est ea et molestiae et. Animi et quod delectus reiciendis consectetur nam voluptatum quo.",
                "episodeNumber": 487967896,
                "exerciseBookPages": "Rem libero minus ratione et quae. Explicabo alias beatae aut eaque earum voluptatem magni quasi. Et ea esse incidunt dolore. Perspiciatis esse porro non quos impedit. Et aut quia dolorem consequuntur dolorem et.",
                "fastBpm": "Possimus est nihil aliquam quo quisquam. Molestiae maiores debitis illo consequuntur eum error. Doloribus est sequi ex reiciendis aut omnis.",
                "includesSong": false,
                "instructors": "Pariatur est voluptas neque fugiat. Deleniti rerum nostrum voluptas molestias debitis totam. Iure iure et qui repellat ea sed. Asperiores cupiditate fugit quam eum. Totam laboriosam quis voluptatem numquam odio sint rerum.",
                "liveEventStartTime": {
                    "date": "2003-05-05 18:37:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1994-01-08 08:05:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Enim placeat harum adipisci doloribus enim animi quam. Maiores voluptas et unde. Ea aspernatur impedit et eum.",
                "liveStreamFeedType": "Vel ut est et cupiditate asperiores est sunt amet. Vero minus ut dolore mollitia. Rem beatae modi voluptatem culpa quia. Labore sint voluptatem fugiat nihil itaque. Similique sit deleniti quo.",
                "name": "Asperiores ea eos nihil sed ullam. Omnis aspernatur voluptas illum et soluta. Et repudiandae error sunt aut id dolorem explicabo.",
                "released": "Incidunt et modi iste quia consectetur ullam. Molestiae saepe odio architecto omnis voluptas. Dignissimos animi et quia magni.",
                "slowBpm": "Sint soluta accusantium inventore velit et repellat. Rem recusandae beatae numquam. Id vel nisi et dolorem qui quia. Architecto sit expedita animi illum cum mollitia. Deleniti reprehenderit autem nihil voluptatem soluta deserunt doloribus iusto.",
                "totalXp": "Sed eos aliquid esse ipsum aut. Magni asperiores et voluptas distinctio cumque dolores distinctio. Voluptate vel repellat exercitationem velit quasi. Ut facilis ut dolores possimus doloribus placeat ipsam.",
                "transcriberName": "Quasi adipisci aut aut itaque. Mollitia ratione laudantium dolores dignissimos aut hic eum. Animi ipsum nesciunt porro voluptas vero. Laborum eos laudantium ipsam eum exercitationem.",
                "week": 1674024176,
                "avatarUrl": "Doloribus et alias ducimus. Repudiandae vitae blanditiis voluptas alias perspiciatis eligendi. Vel incidunt consequuntur et aperiam labore omnis ut.",
                "lengthInSeconds": 1340596336,
                "soundsliceSlug": "Qui sequi aut ut vel. Porro ut officiis dolorum id laboriosam repudiandae nihil id. Aliquam sed est corporis et consequatur consequatur. Ut doloremque corrupti voluptate fugiat doloremque.",
                "staffPickRating": 535529149,
                "studentId": 1959341206,
                "vimeoVideoId": "Nesciunt sunt amet quia qui quod ea ad. Velit sit expedita ut recusandae. Laudantium consequuntur sequi explicabo ut voluptatem sed quia. Deleniti sit accusantium quidem at aspernatur quia.",
                "youtubeVideoId": "Ut et architecto debitis sunt. Numquam amet ut eum autem sit quis. Quia impedit est quae odio. Beatae consectetur voluptatem animi voluptatum cum tenetur molestias."
            },
            "relationships": {
                "parent": {
                    "data": {
                        "type": "parent",
                        "id": "1"
                    }
                }
            }
        }
    ],
    "included": [
        {
            "type": "parent",
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




<!-- END_5749008282f838b8688849041825f55a -->

<!-- START_e55b02d4c8dd5d9849bcb5ea9764baa7 -->
## Pull contents based on content ids.


### HTTP Request
    `GET railcontent/content/get-by-ids`


### Permissions
    - Must be logged in
    - Must have the pull.contents permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|ids|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/get-by-ids',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Commodi accusamus expedita libero et. Incidunt aut dolorum nihil dolorum et. Est voluptate fugiat quidem.",
                "type": "course",
                "sort": "912536579",
                "status": "published",
                "brand": "brand",
                "language": "Beatae repellat omnis sint. Autem in ut quia aut. Laboriosam nihil dolore dolor earum adipisci tempora amet et.",
                "user": "1",
                "publishedOn": {
                    "date": "1984-12-23 11:55:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1979-03-22 15:18:29.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2005-06-29 21:30:28.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Nisi ut optio sunt consequuntur occaecati et. Molestiae et quas asperiores. Nisi nobis inventore distinctio velit quia repellat amet autem.",
                "homeStaffPickRating": "353834510",
                "legacyId": 987925246,
                "legacyWordpressPostId": 207893684,
                "qnaVideo": "Ut quae quam quia placeat omnis molestias numquam. Et earum fugiat enim consequuntur aut. Illum id laborum earum eum.",
                "style": "A quis corporis magnam consequatur. Quas culpa odit quisquam ratione eligendi autem odio. Fugit occaecati recusandae dolor ipsa quos.",
                "title": "Sit inventore quia voluptates.",
                "xp": 1139891474,
                "album": "Fugiat ut fuga aperiam totam quia commodi voluptas. Et quis aliquid tempora. Sequi quia magni architecto placeat. Sequi laboriosam quaerat est.",
                "artist": "Odio cumque quia ducimus explicabo impedit reprehenderit. Voluptates sed hic at omnis saepe ea rem. Iusto id impedit tempora consequatur accusamus consectetur et.",
                "bpm": "Corrupti incidunt ut sint placeat voluptatum. Ipsum aspernatur dolores eveniet culpa ut sunt aut qui. Vitae voluptatem rerum et distinctio aperiam quo facilis. Aut laboriosam voluptatum ex explicabo qui ea explicabo laboriosam.",
                "cdTracks": "Adipisci aut qui illo dolores. Ex alias est velit. Culpa labore tempore ducimus velit quia.",
                "chordOrScale": "Ex consequatur explicabo dignissimos. Eos vero et quia in cumque tempora. Corrupti officiis totam in in. Voluptas et sit modi animi facilis aut.",
                "difficultyRange": "Nostrum temporibus aut nulla. Deserunt sunt est ea et molestiae et. Animi et quod delectus reiciendis consectetur nam voluptatum quo.",
                "episodeNumber": 487967896,
                "exerciseBookPages": "Rem libero minus ratione et quae. Explicabo alias beatae aut eaque earum voluptatem magni quasi. Et ea esse incidunt dolore. Perspiciatis esse porro non quos impedit. Et aut quia dolorem consequuntur dolorem et.",
                "fastBpm": "Possimus est nihil aliquam quo quisquam. Molestiae maiores debitis illo consequuntur eum error. Doloribus est sequi ex reiciendis aut omnis.",
                "includesSong": false,
                "instructors": "Pariatur est voluptas neque fugiat. Deleniti rerum nostrum voluptas molestias debitis totam. Iure iure et qui repellat ea sed. Asperiores cupiditate fugit quam eum. Totam laboriosam quis voluptatem numquam odio sint rerum.",
                "liveEventStartTime": {
                    "date": "2003-05-05 18:37:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1994-01-08 08:05:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Enim placeat harum adipisci doloribus enim animi quam. Maiores voluptas et unde. Ea aspernatur impedit et eum.",
                "liveStreamFeedType": "Vel ut est et cupiditate asperiores est sunt amet. Vero minus ut dolore mollitia. Rem beatae modi voluptatem culpa quia. Labore sint voluptatem fugiat nihil itaque. Similique sit deleniti quo.",
                "name": "Asperiores ea eos nihil sed ullam. Omnis aspernatur voluptas illum et soluta. Et repudiandae error sunt aut id dolorem explicabo.",
                "released": "Incidunt et modi iste quia consectetur ullam. Molestiae saepe odio architecto omnis voluptas. Dignissimos animi et quia magni.",
                "slowBpm": "Sint soluta accusantium inventore velit et repellat. Rem recusandae beatae numquam. Id vel nisi et dolorem qui quia. Architecto sit expedita animi illum cum mollitia. Deleniti reprehenderit autem nihil voluptatem soluta deserunt doloribus iusto.",
                "totalXp": "Sed eos aliquid esse ipsum aut. Magni asperiores et voluptas distinctio cumque dolores distinctio. Voluptate vel repellat exercitationem velit quasi. Ut facilis ut dolores possimus doloribus placeat ipsam.",
                "transcriberName": "Quasi adipisci aut aut itaque. Mollitia ratione laudantium dolores dignissimos aut hic eum. Animi ipsum nesciunt porro voluptas vero. Laborum eos laudantium ipsam eum exercitationem.",
                "week": 1674024176,
                "avatarUrl": "Doloribus et alias ducimus. Repudiandae vitae blanditiis voluptas alias perspiciatis eligendi. Vel incidunt consequuntur et aperiam labore omnis ut.",
                "lengthInSeconds": 1340596336,
                "soundsliceSlug": "Qui sequi aut ut vel. Porro ut officiis dolorum id laboriosam repudiandae nihil id. Aliquam sed est corporis et consequatur consequatur. Ut doloremque corrupti voluptate fugiat doloremque.",
                "staffPickRating": 535529149,
                "studentId": 1959341206,
                "vimeoVideoId": "Nesciunt sunt amet quia qui quod ea ad. Velit sit expedita ut recusandae. Laudantium consequuntur sequi explicabo ut voluptatem sed quia. Deleniti sit accusantium quidem at aspernatur quia.",
                "youtubeVideoId": "Ut et architecto debitis sunt. Numquam amet ut eum autem sit quis. Quia impedit est quae odio. Beatae consectetur voluptatem animi voluptatum cum tenetur molestias."
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
                "publishedOn": {
                    "date": "1987-05-25 11:13:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1971-05-28 07:02:57.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1985-09-02 03:40:00.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
                "homeStaffPickRating": "1530356095",
                "legacyId": 926698209,
                "legacyWordpressPostId": 69139045,
                "qnaVideo": "Deleniti minus et enim doloribus iste dolores est. Libero ea repellendus sed. Id dolore dolores consectetur. Nam harum eum reprehenderit natus a facilis laborum consectetur.",
                "style": "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
                "title": "Consectetur porro unde fuga animi modi.",
                "xp": 31718887,
                "album": "Et earum voluptates odio impedit dicta repudiandae ut. Magnam ipsum accusantium est officiis iste quia reiciendis. Autem facilis nihil molestiae sapiente nostrum sapiente commodi.",
                "artist": "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
                "bpm": "Aspernatur non in sint earum. Hic dignissimos odio unde voluptas tenetur est autem.",
                "cdTracks": "Autem modi qui dolorem quisquam quae in cupiditate. Aut vero qui ab adipisci voluptas vel qui quod. Amet accusamus quis ad ut sunt perferendis dolore. Id ut repellat saepe cumque. Sed velit nesciunt voluptas voluptatum.",
                "chordOrScale": "Ullam nobis illum illo. Voluptatem id voluptatem dolores tenetur est. Tempore sunt tenetur dolore. Voluptatem placeat dicta rerum a adipisci nobis iste. Ea amet architecto repellendus repellat molestias ullam dolorem.",
                "difficultyRange": "Veritatis suscipit fugiat ipsam excepturi officia voluptatem. Aut enim facere eius dignissimos neque quos. Possimus eius quasi laboriosam molestiae. Quia omnis aspernatur et praesentium.",
                "episodeNumber": 1304655407,
                "exerciseBookPages": "Est consequatur ipsa dolore. Tempore et et velit temporibus minus tempore. Voluptas et maiores ipsa earum. Voluptas quis libero asperiores quis distinctio ut autem.",
                "fastBpm": "Qui aut cupiditate ut laudantium. Est non est illum reprehenderit. Asperiores est modi consequatur impedit rerum autem. Necessitatibus non et vitae et rem corrupti.",
                "includesSong": true,
                "instructors": "Sit quidem sed eaque pariatur ea. Repellendus fugit ut totam occaecati quia. Quae dolorem ipsam repellendus rerum. Autem enim ex ullam laboriosam eveniet molestiae sit. Eum fugit ullam consectetur aut earum nostrum.",
                "liveEventStartTime": {
                    "date": "2017-02-07 22:31:21.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1983-02-12 16:50:18.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Laboriosam ipsum distinctio minima ut distinctio necessitatibus atque. Veniam facere error neque aliquam. Eligendi fugit eos blanditiis accusamus.",
                "liveStreamFeedType": "Minus omnis eos eligendi numquam voluptates. Nobis vitae quo et corporis enim porro. Ullam aut eligendi et fuga consequatur et delectus. Quod recusandae id et voluptas soluta hic. Possimus qui quasi at amet quis consequuntur. Quam unde non alias.",
                "name": "Sunt et et officia rem qui quos. Voluptatibus reprehenderit labore totam. Nostrum soluta minima impedit laudantium. Aut consequatur doloribus consequatur omnis.",
                "released": "Sint nemo voluptates repudiandae vel tenetur enim. Tempore dolor ducimus voluptas itaque provident. Non sed ex ut.",
                "slowBpm": "Tenetur rem aut maiores deserunt iusto. Iste vitae vitae natus nesciunt at vero. Est dolores praesentium enim pariatur a. Accusantium aut iure quisquam recusandae officia facilis.",
                "totalXp": "Est consectetur assumenda omnis nesciunt ratione ut ullam. Vitae voluptatum nihil non aliquam id. Id numquam odio non ullam reprehenderit quia aperiam.",
                "transcriberName": "Qui harum reiciendis ut harum. Omnis velit non nisi est voluptate possimus delectus. Earum quidem sit nam libero eum doloremque et.",
                "week": 487183727,
                "avatarUrl": "Reiciendis facilis at possimus. Suscipit est soluta asperiores corrupti maxime ut in mollitia. Voluptate ipsam qui maiores ratione suscipit hic ipsa. Suscipit qui laudantium reiciendis est sint consequatur similique.",
                "lengthInSeconds": 1458903902,
                "soundsliceSlug": "Facilis quo nisi delectus aliquam quia. Expedita nihil voluptas repellendus sit nisi provident pariatur commodi. Impedit qui sint aut placeat ea itaque. Dolor sit animi cum est inventore porro qui.",
                "staffPickRating": 889539890,
                "studentId": 269019524,
                "vimeoVideoId": "Tempore et temporibus fugiat odio laboriosam voluptas. Est provident modi distinctio est nihil non. Quia ad sunt animi dolores officia nobis. Id distinctio et nihil dolores. Corrupti sed quos molestiae rerum porro id ut. Non vel iusto et deleniti.",
                "youtubeVideoId": "Odit ipsa et et corrupti esse recusandae est. Odit rem qui nisi illum id ut. Voluptate est unde in voluptas rem tempore."
            },
            "relationships": {
                "data": {
                    "data": [
                        {
                            "type": "contentData",
                            "id": "1"
                        }
                    ]
                }
            }
        }
    ],
    "included": [
        {
            "type": "parent",
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
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "Nihil autem in dolorem dolorem repellendus. Id nam aut pariatur a recusandae. Quo numquam veritatis nesciunt soluta quia. Qui iure fugiat eveniet cum nihil. Corporis voluptas nam velit. Fuga voluptates error qui dolores.",
                "value": "Distinctio deleniti atque consequatur qui fuga. Qui voluptatem aut mollitia vel omnis corrupti esse. Autem itaque amet rerum accusantium.",
                "position": 1701478593
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

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
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
            "publishedOn": {
                "date": "1987-05-25 11:13:24.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "archivedOn": {
                "date": "1971-05-28 07:02:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "1985-09-02 03:40:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
            "homeStaffPickRating": "1530356095",
            "legacyId": 926698209,
            "legacyWordpressPostId": 69139045,
            "qnaVideo": "Deleniti minus et enim doloribus iste dolores est. Libero ea repellendus sed. Id dolore dolores consectetur. Nam harum eum reprehenderit natus a facilis laborum consectetur.",
            "style": "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
            "title": "Consectetur porro unde fuga animi modi.",
            "xp": 31718887,
            "album": "Et earum voluptates odio impedit dicta repudiandae ut. Magnam ipsum accusantium est officiis iste quia reiciendis. Autem facilis nihil molestiae sapiente nostrum sapiente commodi.",
            "artist": "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
            "bpm": "Aspernatur non in sint earum. Hic dignissimos odio unde voluptas tenetur est autem.",
            "cdTracks": "Autem modi qui dolorem quisquam quae in cupiditate. Aut vero qui ab adipisci voluptas vel qui quod. Amet accusamus quis ad ut sunt perferendis dolore. Id ut repellat saepe cumque. Sed velit nesciunt voluptas voluptatum.",
            "chordOrScale": "Ullam nobis illum illo. Voluptatem id voluptatem dolores tenetur est. Tempore sunt tenetur dolore. Voluptatem placeat dicta rerum a adipisci nobis iste. Ea amet architecto repellendus repellat molestias ullam dolorem.",
            "difficultyRange": "Veritatis suscipit fugiat ipsam excepturi officia voluptatem. Aut enim facere eius dignissimos neque quos. Possimus eius quasi laboriosam molestiae. Quia omnis aspernatur et praesentium.",
            "episodeNumber": 1304655407,
            "exerciseBookPages": "Est consequatur ipsa dolore. Tempore et et velit temporibus minus tempore. Voluptas et maiores ipsa earum. Voluptas quis libero asperiores quis distinctio ut autem.",
            "fastBpm": "Qui aut cupiditate ut laudantium. Est non est illum reprehenderit. Asperiores est modi consequatur impedit rerum autem. Necessitatibus non et vitae et rem corrupti.",
            "includesSong": true,
            "instructors": "Sit quidem sed eaque pariatur ea. Repellendus fugit ut totam occaecati quia. Quae dolorem ipsam repellendus rerum. Autem enim ex ullam laboriosam eveniet molestiae sit. Eum fugit ullam consectetur aut earum nostrum.",
            "liveEventStartTime": {
                "date": "2017-02-07 22:31:21.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1983-02-12 16:50:18.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Laboriosam ipsum distinctio minima ut distinctio necessitatibus atque. Veniam facere error neque aliquam. Eligendi fugit eos blanditiis accusamus.",
            "liveStreamFeedType": "Minus omnis eos eligendi numquam voluptates. Nobis vitae quo et corporis enim porro. Ullam aut eligendi et fuga consequatur et delectus. Quod recusandae id et voluptas soluta hic. Possimus qui quasi at amet quis consequuntur. Quam unde non alias.",
            "name": "Sunt et et officia rem qui quos. Voluptatibus reprehenderit labore totam. Nostrum soluta minima impedit laudantium. Aut consequatur doloribus consequatur omnis.",
            "released": "Sint nemo voluptates repudiandae vel tenetur enim. Tempore dolor ducimus voluptas itaque provident. Non sed ex ut.",
            "slowBpm": "Tenetur rem aut maiores deserunt iusto. Iste vitae vitae natus nesciunt at vero. Est dolores praesentium enim pariatur a. Accusantium aut iure quisquam recusandae officia facilis.",
            "totalXp": "Est consectetur assumenda omnis nesciunt ratione ut ullam. Vitae voluptatum nihil non aliquam id. Id numquam odio non ullam reprehenderit quia aperiam.",
            "transcriberName": "Qui harum reiciendis ut harum. Omnis velit non nisi est voluptate possimus delectus. Earum quidem sit nam libero eum doloremque et.",
            "week": 487183727,
            "avatarUrl": "Reiciendis facilis at possimus. Suscipit est soluta asperiores corrupti maxime ut in mollitia. Voluptate ipsam qui maiores ratione suscipit hic ipsa. Suscipit qui laudantium reiciendis est sint consequatur similique.",
            "lengthInSeconds": 1458903902,
            "soundsliceSlug": "Facilis quo nisi delectus aliquam quia. Expedita nihil voluptas repellendus sit nisi provident pariatur commodi. Impedit qui sint aut placeat ea itaque. Dolor sit animi cum est inventore porro qui.",
            "staffPickRating": 889539890,
            "studentId": 269019524,
            "vimeoVideoId": "Tempore et temporibus fugiat odio laboriosam voluptas. Est provident modi distinctio est nihil non. Quia ad sunt animi dolores officia nobis. Id distinctio et nihil dolores. Corrupti sed quos molestiae rerum porro id ut. Non vel iusto et deleniti.",
            "youtubeVideoId": "Odit ipsa et et corrupti esse recusandae est. Odit rem qui nisi illum id ut. Voluptate est unde in voluptas rem tempore."
        },
        "relationships": {
            "data": {
                "data": [
                    {
                        "type": "contentData",
                        "id": "1"
                    }
                ]
            }
        }
    },
    "included": [
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "Nihil autem in dolorem dolorem repellendus. Id nam aut pariatur a recusandae. Quo numquam veritatis nesciunt soluta quia. Qui iure fugiat eveniet cum nihil. Corporis voluptas nam velit. Fuga voluptates error qui dolores.",
                "value": "Distinctio deleniti atque consequatur qui fuga. Qui voluptatem aut mollitia vel omnis corrupti esse. Autem itaque amet rerum accusantium.",
                "position": 1701478593
            }
        }
    ]
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
        $this->validateContent($this);

        $this->setGeneralRules(
            [
                'data.type' => 'required|in:content',
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
                'data.attributes.slug' => 'max:255',
                'data.attributes.sort' => 'nullable|numeric',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.attributes.published_on' => 'nullable|date',
                'data.relationships.parent.data.type' => 'nullable|in:content',
                'data.relationships.user.data.type' => 'nullable|in:user',
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        return parent::rules();
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
{
    "data": {
        "type": "content",
        "attributes": {
            "slug": "01-getting-started",
            "type": "course",
            "status": "draft",
            "language": "en-US",
            "sort": 1,
            "published_on": "2019-05-21 21:20:10",
            "created_on": "2019-05-21 21:20:10",
            "archived_on": "2019-05-21 21:20:10",
            "fields": [],
            "brand": "brand"
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            },
            "user": {
                "data": {
                    "type": "user",
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

### Response Example (201):

```json
{
    "data": {
        "type": "content",
        "id": "4",
        "attributes": {
            "slug": "01-getting-started",
            "type": "course",
            "sort": "1",
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
                    "id": "4"
                }
            }
        }
    },
    "included": [
        {
            "type": "parent",
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
        },
        {
            "type": "parent",
            "id": "4",
            "attributes": {
                "child_position": 917213306
            },
            "relationships": {
                "parent": {
                    "data": {
                        "type": "parent",
                        "id": "1"
                    }
                }
            }
        }
    ]
}
```




<!-- END_041a3bcbff15a33078ad0fc39db6ceda -->

<!-- START_5828f7048c0cc2858373a9cf44c55e02 -->
## Update an existing content.


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
|body|data.attributes.language|    ||
|body|data.attributes.sort|    ||
|body|data.attributes.published_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
       $this->validateContent($this);

        //set the general validation rules
        $this->setGeneralRules(
            [
                'data.type' => 'required|in:content',
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
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        //get the validation rules
        return parent::rules();
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
{
    "data": {
        "type": "content",
        "attributes": {
            "slug": "02-getting-started",
            "type": "course",
            "status": "draft",
            "language": "en-EN",
            "sort": 1,
            "published_on": "2019-05-21 21:20:10",
            "archived_on": "2019-05-31 21:20:10",
            "fields": [],
            "brand": "brand"
        },
        "relationships": {
            "user": {
                "data": {
                    "type": "user",
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
        "type": "content",
        "id": "1",
        "attributes": {
            "slug": "02-getting-started",
            "type": "course",
            "sort": "1",
            "status": "draft",
            "brand": "brand",
            "language": "en-EN",
            "user": "1",
            "publishedOn": "2019-05-21 21:20:10",
            "archivedOn": {
                "date": "1971-05-28 07:02:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "1985-09-02 03:40:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Adipisci quidem doloribus possimus et voluptatem. Est exercitationem voluptatem occaecati consectetur.",
            "homeStaffPickRating": "1530356095",
            "legacyId": 926698209,
            "legacyWordpressPostId": 69139045,
            "qnaVideo": "Deleniti minus et enim doloribus iste dolores est. Libero ea repellendus sed. Id dolore dolores consectetur. Nam harum eum reprehenderit natus a facilis laborum consectetur.",
            "style": "Vel illum quos explicabo provident quo. Et sit qui et voluptas repellendus adipisci. Soluta omnis nihil voluptatem est.",
            "title": "Consectetur porro unde fuga animi modi.",
            "xp": 31718887,
            "album": "Et earum voluptates odio impedit dicta repudiandae ut. Magnam ipsum accusantium est officiis iste quia reiciendis. Autem facilis nihil molestiae sapiente nostrum sapiente commodi.",
            "artist": "Qui sunt vero quo voluptas sed reiciendis est repellendus. Est dignissimos ex fugiat perferendis dicta ad magni. Alias consequatur ut fuga expedita. Neque voluptatem eum voluptatem nostrum.",
            "bpm": "Aspernatur non in sint earum. Hic dignissimos odio unde voluptas tenetur est autem.",
            "cdTracks": "Autem modi qui dolorem quisquam quae in cupiditate. Aut vero qui ab adipisci voluptas vel qui quod. Amet accusamus quis ad ut sunt perferendis dolore. Id ut repellat saepe cumque. Sed velit nesciunt voluptas voluptatum.",
            "chordOrScale": "Ullam nobis illum illo. Voluptatem id voluptatem dolores tenetur est. Tempore sunt tenetur dolore. Voluptatem placeat dicta rerum a adipisci nobis iste. Ea amet architecto repellendus repellat molestias ullam dolorem.",
            "difficultyRange": "Veritatis suscipit fugiat ipsam excepturi officia voluptatem. Aut enim facere eius dignissimos neque quos. Possimus eius quasi laboriosam molestiae. Quia omnis aspernatur et praesentium.",
            "episodeNumber": 1304655407,
            "exerciseBookPages": "Est consequatur ipsa dolore. Tempore et et velit temporibus minus tempore. Voluptas et maiores ipsa earum. Voluptas quis libero asperiores quis distinctio ut autem.",
            "fastBpm": "Qui aut cupiditate ut laudantium. Est non est illum reprehenderit. Asperiores est modi consequatur impedit rerum autem. Necessitatibus non et vitae et rem corrupti.",
            "includesSong": true,
            "instructors": "Sit quidem sed eaque pariatur ea. Repellendus fugit ut totam occaecati quia. Quae dolorem ipsam repellendus rerum. Autem enim ex ullam laboriosam eveniet molestiae sit. Eum fugit ullam consectetur aut earum nostrum.",
            "liveEventStartTime": {
                "date": "2017-02-07 22:31:21.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1983-02-12 16:50:18.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Laboriosam ipsum distinctio minima ut distinctio necessitatibus atque. Veniam facere error neque aliquam. Eligendi fugit eos blanditiis accusamus.",
            "liveStreamFeedType": "Minus omnis eos eligendi numquam voluptates. Nobis vitae quo et corporis enim porro. Ullam aut eligendi et fuga consequatur et delectus. Quod recusandae id et voluptas soluta hic. Possimus qui quasi at amet quis consequuntur. Quam unde non alias.",
            "name": "Sunt et et officia rem qui quos. Voluptatibus reprehenderit labore totam. Nostrum soluta minima impedit laudantium. Aut consequatur doloribus consequatur omnis.",
            "released": "Sint nemo voluptates repudiandae vel tenetur enim. Tempore dolor ducimus voluptas itaque provident. Non sed ex ut.",
            "slowBpm": "Tenetur rem aut maiores deserunt iusto. Iste vitae vitae natus nesciunt at vero. Est dolores praesentium enim pariatur a. Accusantium aut iure quisquam recusandae officia facilis.",
            "totalXp": "Est consectetur assumenda omnis nesciunt ratione ut ullam. Vitae voluptatum nihil non aliquam id. Id numquam odio non ullam reprehenderit quia aperiam.",
            "transcriberName": "Qui harum reiciendis ut harum. Omnis velit non nisi est voluptate possimus delectus. Earum quidem sit nam libero eum doloremque et.",
            "week": 487183727,
            "avatarUrl": "Reiciendis facilis at possimus. Suscipit est soluta asperiores corrupti maxime ut in mollitia. Voluptate ipsam qui maiores ratione suscipit hic ipsa. Suscipit qui laudantium reiciendis est sint consequatur similique.",
            "lengthInSeconds": 1458903902,
            "soundsliceSlug": "Facilis quo nisi delectus aliquam quia. Expedita nihil voluptas repellendus sit nisi provident pariatur commodi. Impedit qui sint aut placeat ea itaque. Dolor sit animi cum est inventore porro qui.",
            "staffPickRating": 889539890,
            "studentId": 269019524,
            "vimeoVideoId": "Tempore et temporibus fugiat odio laboriosam voluptas. Est provident modi distinctio est nihil non. Quia ad sunt animi dolores officia nobis. Id distinctio et nihil dolores. Corrupti sed quos molestiae rerum porro id ut. Non vel iusto et deleniti.",
            "youtubeVideoId": "Odit ipsa et et corrupti esse recusandae est. Odit rem qui nisi illum id ut. Voluptate est unde in voluptas rem tempore."
        },
        "relationships": {
            "data": {
                "data": [
                    {
                        "type": "contentData",
                        "id": "2"
                    }
                ]
            },
            "parent": {
                "data": {
                    "type": "parent",
                    "id": "3"
                }
            }
        }
    },
    "included": [
        {
            "type": "parent",
            "id": "1",
            "attributes": {
                "slug": "02-getting-started",
                "type": "course",
                "sort": "1",
                "status": "draft",
                "brand": "brand",
                "language": "en-EN",
                "user": "1",
                "published_on": "2019-05-21 21:20:10",
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
        },
        {
            "type": "contentData",
            "id": "2",
            "attributes": {
                "key": "description",
                "value": "indsf fdgg  gfg",
                "position": 0
            }
        },
        {
            "type": "parent",
            "id": "3",
            "attributes": {
                "child_position": 917213305
            },
            "relationships": {
                "parent": {
                    "data": {
                        "type": "parent",
                        "id": "1"
                    }
                }
            }
        }
    ]
}
```




<!-- END_5828f7048c0cc2858373a9cf44c55e02 -->

<!-- START_cd36dc2623a54c340f0bc0db37986ba8 -->
## Soft delete existing content

If a content it's soft deleted the API will automatically filter it out from the pull request unless the status set on the pull requests explicitly state otherwise.


### HTTP Request
    `DELETE railcontent/soft/content/{id}`


### Permissions
    - Must be logged in
    - Must have the delete.content permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  |Content|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/soft/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_cd36dc2623a54c340f0bc0db37986ba8 -->

<!-- START_6db1e06526b714b35026eddcf5e1efb9 -->
## Delete an existing content and content related links.

The content related links are: links with the parent, content childrens, content fields, content datum, links with the permissions, content comments, replies and assignation and links with the playlists.


### HTTP Request
    `DELETE railcontent/content/{id}`


### Permissions
    - Must be logged in
    - Must have the delete.content permission
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|id|  yes  |Content that will be deleted.|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_6db1e06526b714b35026eddcf5e1efb9 -->

