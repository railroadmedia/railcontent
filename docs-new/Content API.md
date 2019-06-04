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

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
    success: function(response) {},
    error: function(response) {}
});
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

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
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
                "slug": "Omnis mollitia facilis aut consectetur et. Nisi ipsum et aut natus. Dolor enim delectus rem ducimus consectetur architecto saepe.",
                "type": "course",
                "sort": "271935822",
                "status": "published",
                "brand": "brand",
                "language": "Et quia deleniti cupiditate dolorem quasi sit hic. Minus nihil id non recusandae rem. Optio nesciunt sapiente aliquid.",
                "user": "1",
                "publishedOn": {
                    "date": "1995-07-03 17:53:01.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2005-06-30 19:28:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1971-08-28 12:31:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "At illum repudiandae eum laboriosam sunt error. Numquam maxime accusantium voluptate et laudantium quia eligendi. Iure quasi ad aliquam. Praesentium soluta et minus maxime et. Voluptatem doloribus et inventore consequuntur quia. Iste enim quos aut.",
                "homeStaffPickRating": "368641094",
                "legacyId": 709242079,
                "legacyWordpressPostId": 1360271890,
                "qnaVideo": "Sapiente ipsum qui qui provident. Sed sit nihil consectetur veniam. Minus nesciunt provident quia dolorem maxime optio.",
                "style": "Rerum sunt perspiciatis sequi voluptatem inventore nisi reiciendis. Et quia rem ducimus. Beatae quo dolorum facere ducimus nobis.",
                "title": "Accusamus reprehenderit aspernatur vel laborum qui sunt magnam.",
                "xp": 1603984760,
                "album": "Itaque impedit neque ut dolorum et. Tenetur quidem ea deleniti enim explicabo corrupti eos iure. Eligendi voluptatem libero consectetur fuga reiciendis a fugit. Excepturi illum nemo praesentium asperiores voluptatem atque.",
                "artist": "Quam ut velit qui magnam. Et totam recusandae ab et esse quo. Ea recusandae fugiat accusantium illum sed. Est voluptatum odit ut.",
                "bpm": "Nisi quo unde et quae doloremque molestiae necessitatibus. Ut iusto vero eos fugiat omnis consequatur. Minus illum voluptates aut sit veritatis corrupti voluptatibus ipsum. Rem quia rerum ut officiis. Nulla optio voluptates sunt minima voluptatem aut.",
                "cdTracks": "Aut sint nostrum qui eum voluptatum. Eum ut dicta cupiditate et voluptatem. Maiores non sapiente ut officiis earum.",
                "chordOrScale": "Reprehenderit iste aut adipisci inventore in. Doloribus natus blanditiis sint amet assumenda dolorem ducimus. Beatae quae consequuntur dolores aut vero odit temporibus. Perspiciatis dicta explicabo voluptate sint ratione.",
                "difficultyRange": "Architecto aspernatur vel qui quas quibusdam omnis et. In id est voluptas ut dicta excepturi magnam. Iste magni neque laboriosam ducimus odio fugit necessitatibus.",
                "episodeNumber": 2022633409,
                "exerciseBookPages": "Aperiam quam quaerat et ut. Rerum ut laboriosam aspernatur occaecati. Ullam odio voluptate est. Ea enim unde sapiente ullam. Aut neque quia reiciendis et et.",
                "fastBpm": "Sequi maxime repellendus minus libero culpa. Id et fuga occaecati illo. Voluptas ut est quasi velit aut quos. Architecto aliquid pariatur iure placeat natus.",
                "includesSong": true,
                "instructors": "Ipsa eos commodi placeat. Ut tempore modi eaque nihil harum recusandae. Officia voluptatem sit illo blanditiis. Deserunt commodi harum molestias optio ex aperiam consequuntur. Nihil ut libero molestiae facere consequatur.",
                "liveEventStartTime": {
                    "date": "1975-03-18 15:22:52.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1994-12-20 08:57:46.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Aspernatur modi atque autem necessitatibus vel modi blanditiis. Ut autem ut qui reprehenderit. Nostrum omnis modi similique.",
                "liveStreamFeedType": "Adipisci aut ut eaque quo. Aliquid excepturi qui rerum. Nisi harum adipisci eum iste. Delectus voluptatem dolore soluta sint aut. Cumque optio dolorem deleniti error ullam. Magnam sit dolorem qui accusantium.",
                "name": "In ipsam ut aut sit et illum. Repudiandae qui neque sit et magnam. Optio nulla nihil sit asperiores aut sapiente.",
                "released": "Aut minima ad autem fugit eos. Ea aut earum ut ut minus accusamus. Nobis exercitationem nihil optio vitae. Delectus pariatur quia sed in quae. Voluptas ex sint vitae qui modi.",
                "slowBpm": "In labore quae et iste blanditiis. Corrupti ea veritatis quidem minus in. Dolor ea accusantium assumenda sit et sed non. Illo sed officiis sunt non. Vel eum hic alias rem delectus. Nihil consectetur rerum magni dicta in et.",
                "totalXp": "Suscipit exercitationem qui blanditiis aut distinctio dignissimos. Molestias deserunt aut quaerat aspernatur. In est nisi nisi pariatur quae. Debitis et qui est dolores impedit. Officiis similique nemo quas voluptatem voluptatem.",
                "transcriberName": "Quam impedit facilis natus magnam perferendis rerum. Molestiae velit quidem dolorem expedita doloremque eum. Quam enim aut inventore voluptatum alias explicabo qui aut.",
                "week": 916845408,
                "avatarUrl": "Earum harum et accusamus amet vitae ut id tempore. Omnis animi et iusto sint vero amet. Sequi nihil voluptatibus quam possimus asperiores ea tempora cum. Dolor et quisquam sequi ut consequuntur. Rerum eaque nemo autem aut.",
                "lengthInSeconds": 784434468,
                "soundsliceSlug": "Dolor sapiente et quasi incidunt. Repudiandae necessitatibus adipisci nesciunt quia nesciunt. Molestias temporibus expedita tempora consequuntur exercitationem sit sint beatae. Excepturi minus veritatis atque soluta recusandae.",
                "staffPickRating": 1199220288,
                "studentId": 1740849784,
                "vimeoVideoId": "Rerum molestiae rerum dignissimos. Esse velit aut porro a voluptatem qui. Quasi cumque quam ipsum autem et.",
                "youtubeVideoId": "Et vel reprehenderit unde voluptate dignissimos error ad. Veritatis cumque et sint omnis sapiente fugiat. Et temporibus et fugiat maiores."
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
                "publishedOn": {
                    "date": "1989-12-06 00:15:26.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1973-04-28 07:23:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1988-11-29 11:48:05.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
                "homeStaffPickRating": "211594015",
                "legacyId": 2029105382,
                "legacyWordpressPostId": 2110749050,
                "qnaVideo": "Quas ab repudiandae facere aut impedit aspernatur. Est hic dicta ut et quidem aliquid natus. Accusantium asperiores dolorem voluptas quas delectus natus voluptates. Explicabo error quae dolor et neque.",
                "style": "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
                "title": "Quasi qui modi ad dolores enim iusto est.",
                "xp": 465338215,
                "album": "Enim officia qui aspernatur amet magnam. Ut voluptate et soluta est soluta et eligendi. Aspernatur iusto molestiae perspiciatis veritatis optio. Quidem quas nesciunt ipsum vel. Omnis aut inventore rerum laborum sit.",
                "artist": "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
                "bpm": "Enim et voluptatem cupiditate. Facere iure id autem. Voluptas aut exercitationem deserunt neque voluptatem.",
                "cdTracks": "Molestias rerum doloribus sit aut quis quas. Aliquam beatae libero sed. Dolorum quia est aut fuga. Sint omnis id aut occaecati et et natus.",
                "chordOrScale": "Vitae ut ipsa aliquam impedit accusamus. Molestiae eos laudantium et eum tempore. Asperiores omnis libero natus earum inventore enim id. Eum ducimus libero repudiandae perferendis rerum labore ducimus.",
                "difficultyRange": "Consequuntur autem pariatur est et. Aspernatur sed ratione nesciunt. Quo porro eum quia ullam eum. Fugiat aut quaerat dolor maiores aut. Illo voluptatem ullam tempora voluptatem. Totam omnis ut molestias consequuntur.",
                "episodeNumber": 870317541,
                "exerciseBookPages": "Sed minima voluptatibus qui et ad voluptatem rerum. Nobis et impedit necessitatibus sit. Porro vel numquam laboriosam dicta quod. Porro accusamus nam rerum omnis alias quibusdam praesentium.",
                "fastBpm": "Cumque in molestiae ea dolore rerum facilis. Et iusto molestiae doloremque. Sint est quia dolor odio voluptatum ea unde. Doloribus autem voluptas et dignissimos eaque. Expedita aut vel a.",
                "includesSong": true,
                "instructors": "Sed eum fuga delectus ex. Esse explicabo pariatur quos a. Qui mollitia nisi molestiae dolores adipisci et aut totam. Ut sit sapiente laborum.",
                "liveEventStartTime": {
                    "date": "2012-10-01 00:06:20.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1972-08-02 00:32:19.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Adipisci est earum reiciendis et quia a. Dolore vel ducimus et occaecati iure sed vel sit. Et voluptatum ut doloribus sunt.",
                "liveStreamFeedType": "Assumenda soluta similique eligendi. Eos libero sequi assumenda. Tempora et sint adipisci voluptatem magni ex. Ullam nisi nobis tenetur beatae occaecati. Voluptate repudiandae animi minus sint debitis.",
                "name": "Nostrum nobis minus modi qui sit. Accusantium autem inventore possimus optio dolorum repellat reprehenderit. Consequuntur sed dignissimos voluptatum alias totam.",
                "released": "Rerum blanditiis optio ut eveniet aut. Vel quo fugiat soluta autem quasi eos quia. Quos provident iusto nostrum officiis deleniti harum.",
                "slowBpm": "Quidem sequi architecto mollitia natus. Ad sed nulla vitae dolores provident accusamus aliquam. Blanditiis officia qui voluptatem veritatis porro tenetur voluptate.",
                "totalXp": "Qui minus unde et nobis. Voluptatem sed veritatis non sit iusto. Exercitationem est doloremque rerum dolorem rerum laudantium rem. Sit ea porro cumque autem.",
                "transcriberName": "Enim enim consequatur ut optio. Mollitia fugit error qui quia dolor et sed vel. Nobis rerum nam est eaque aut.",
                "week": 1549229504,
                "avatarUrl": "Amet qui voluptas consequatur expedita facere aut nihil. Et sit autem laboriosam sunt beatae. Magni explicabo et eos nihil tenetur et et. Doloremque dolorum animi corrupti architecto.",
                "lengthInSeconds": 1889120521,
                "soundsliceSlug": "At rerum totam et et. Suscipit in quaerat velit sunt provident dolorem ducimus. Quae ea pariatur tempore odit in et.",
                "staffPickRating": 1882244654,
                "studentId": 1107745055,
                "vimeoVideoId": "Qui similique dolor doloremque rerum deserunt error velit nihil. Ut vel laboriosam dicta numquam nam ad assumenda exercitationem. Unde est voluptatibus error repudiandae eius id esse. Odio quibusdam labore sed maxime.",
                "youtubeVideoId": "Voluptas eaque ipsum in quod perferendis qui provident. Nemo minus quos minus deserunt delectus magnam. Ducimus impedit provident cupiditate dolorem. Nihil dolor deserunt nihil repellat. Ad assumenda nam molestiae qui."
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
                "slug": "Accusantium odit sit accusantium. Excepturi dolor quis reiciendis sapiente minima maxime nemo. Quisquam numquam qui odit labore. Eveniet aut qui laboriosam reprehenderit.",
                "type": "course",
                "sort": "1207045682",
                "status": "published",
                "brand": "brand",
                "language": "Aut velit repudiandae quia aliquid magni quos minima ut. Minus eligendi commodi tenetur accusantium ducimus quia. Reiciendis quasi et eius fugit aut quam. Sit quibusdam labore sint.",
                "user": "1",
                "publishedOn": {
                    "date": "1975-05-07 00:00:50.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2005-01-27 04:47:32.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1989-12-14 17:50:08.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Earum tempora placeat placeat sunt placeat magnam. Officiis repellat vero consequuntur velit. Facere magni repellat quisquam rerum quis. Tempore eligendi error sunt itaque et. Laudantium magnam recusandae eos minima amet odit.",
                "homeStaffPickRating": "651830587",
                "legacyId": 135314308,
                "legacyWordpressPostId": 136174500,
                "qnaVideo": "Fugit dolorum ducimus modi quis quis fugit quis. Accusantium nobis exercitationem nobis nisi quam ex unde. Ducimus est et qui. Ut quis qui vitae blanditiis eum.",
                "style": "Placeat sapiente enim sequi est qui quia non. Animi ratione sed eligendi id. Eos distinctio eos illum voluptatem. Doloribus illo sit dignissimos vel.",
                "title": "Quos distinctio ducimus at.",
                "xp": 1916995098,
                "album": "Dolor inventore eos est quo unde quae similique aperiam. Consequatur aut laudantium qui et incidunt. Amet officia et cumque illo et quia quia adipisci. Tempora reprehenderit necessitatibus eaque distinctio.",
                "artist": "Voluptas quia at ut perspiciatis. Iste ut quaerat nemo sed. Quam velit sint nisi dolores et. Cupiditate et qui aliquid dolorem consequatur.",
                "bpm": "Praesentium praesentium tenetur explicabo quasi. Minima velit rerum autem. Dolor quis doloremque quis aut nemo necessitatibus illum. Praesentium reprehenderit maxime harum commodi adipisci aut sunt.",
                "cdTracks": "Voluptatem sunt rerum placeat doloremque. Quibusdam et sunt asperiores. Ut velit est facere vero voluptatem ratione earum mollitia.",
                "chordOrScale": "Vero incidunt non voluptas pariatur aut. Odio quam fuga accusamus ducimus quis magnam consectetur. Iste non in perferendis esse sit eius odit.",
                "difficultyRange": "Omnis mollitia eos qui. Vitae aut voluptatem nemo nesciunt et. Optio dolore velit optio voluptas perferendis maiores doloribus.",
                "episodeNumber": 1443553567,
                "exerciseBookPages": "Sed nulla et a ab est doloremque ex. Recusandae officiis quis voluptatem id earum iusto. Qui pariatur vitae exercitationem aut maiores eveniet facere natus.",
                "fastBpm": "Provident tempora temporibus sit enim rem. Molestiae atque sit asperiores commodi. Quasi dolores aperiam libero sit numquam.",
                "includesSong": true,
                "instructors": "Magni maxime quam voluptas. Sunt fugit quasi deleniti sint amet omnis voluptas. Odio et est ducimus aut quisquam accusamus dolor quis. Dolor ex ratione aut enim provident.",
                "liveEventStartTime": {
                    "date": "2013-09-11 06:48:04.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1979-04-29 10:51:03.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Provident laboriosam labore est voluptate et qui minus. Perferendis corporis ipsum qui et. In esse sed quos accusamus. Aut voluptatum maiores aliquid sunt cupiditate blanditiis.",
                "liveStreamFeedType": "Ut aut sed aut. Consequatur tempora provident nihil ut. Fugit nihil cum officiis. Quis et laborum esse sit. Explicabo voluptatem tempora non deleniti autem. Nemo et beatae iste. Doloribus perspiciatis ut autem.",
                "name": "Et et molestiae placeat iure eum. Aliquid sed placeat at iste voluptatibus. Quo repellendus nisi distinctio.",
                "released": "Voluptas deserunt enim vero quam enim quasi veniam. Quia rerum eaque necessitatibus laudantium reprehenderit unde cupiditate. Magni sed porro molestiae eveniet.",
                "slowBpm": "Et est maiores illo consequatur beatae. Vitae maxime quaerat illum saepe ipsum. Harum omnis iure nihil cumque quas. Recusandae eum iste debitis et reiciendis sit. Fugiat dolores quo quod. Suscipit eos quis et minima qui est.",
                "totalXp": "Qui voluptatibus enim architecto est. Reiciendis iure corrupti vel beatae est. Aut delectus numquam ut ab suscipit. Sint et et illum deserunt ipsa.",
                "transcriberName": "Ullam sunt et dolorem commodi ipsam omnis sapiente totam. Ut sunt sed nihil sint beatae ut voluptas. In eos quis nihil voluptatem. Totam et in et reiciendis omnis ducimus.",
                "week": 1943046946,
                "avatarUrl": "Laboriosam tenetur porro harum totam odio numquam beatae. Modi commodi omnis exercitationem quasi dolorem ea. Alias expedita ut ut quo.",
                "lengthInSeconds": 251143756,
                "soundsliceSlug": "Nesciunt quia vero voluptas suscipit illo aliquam. Quae nostrum qui dolorem similique odio. Molestias natus aut velit sit nihil. Quis repellendus veritatis consequuntur mollitia.",
                "staffPickRating": 431525804,
                "studentId": 97158999,
                "vimeoVideoId": "Quia aut et quia harum quo. Pariatur aspernatur magni eos consequatur ea. Sequi dolorum eligendi nihil sed. Praesentium perspiciatis quasi incidunt aut iusto nisi. Nostrum praesentium dolores eos consectetur quis.",
                "youtubeVideoId": "Quidem eum sed accusamus sint voluptates sapiente sit saepe. Veritatis commodi dignissimos optio error dolore occaecati quibusdam. Voluptatem repellat nihil quisquam repellendus vitae neque eveniet."
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
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "In voluptas rerum iure at sunt et voluptatem et. Nesciunt est qui sit et. Quis vero aliquam temporibus inventore et aperiam. Maiores eaque illum iste sunt deserunt et.",
                "value": "Eligendi aut nisi et. Autem voluptatibus et autem sed accusamus facilis eligendi. Aut in veniam est. Et aut cum eaque laborum. Quo necessitatibus saepe odit nostrum sequi quae. Atque reprehenderit ut quo aut molestias.",
                "position": 1114424162
            }
        }
    ],
    "meta": {
        "filterOption": {
            "difficulty": [
                "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
                "Earum tempora placeat placeat sunt placeat magnam. Officiis repellat vero consequuntur velit. Facere magni repellat quisquam rerum quis. Tempore eligendi error sunt itaque et. Laudantium magnam recusandae eos minima amet odit.",
                "At illum repudiandae eum laboriosam sunt error. Numquam maxime accusantium voluptate et laudantium quia eligendi. Iure quasi ad aliquam. Praesentium soluta et minus maxime et. Voluptatem doloribus et inventore consequuntur quia. Iste enim quos aut."
            ],
            "style": [
                "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
                "Placeat sapiente enim sequi est qui quia non. Animi ratione sed eligendi id. Eos distinctio eos illum voluptatem. Doloribus illo sit dignissimos vel.",
                "Rerum sunt perspiciatis sequi voluptatem inventore nisi reiciendis. Et quia rem ducimus. Beatae quo dolorum facere ducimus nobis."
            ],
            "artist": [
                "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
                "Voluptas quia at ut perspiciatis. Iste ut quaerat nemo sed. Quam velit sint nisi dolores et. Cupiditate et qui aliquid dolorem consequatur.",
                "Quam ut velit qui magnam. Et totam recusandae ab et esse quo. Ea recusandae fugiat accusantium illum sed. Est voluptatum odit ut."
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
                "slug": "Accusantium odit sit accusantium. Excepturi dolor quis reiciendis sapiente minima maxime nemo. Quisquam numquam qui odit labore. Eveniet aut qui laboriosam reprehenderit.",
                "type": "course",
                "sort": "1207045682",
                "status": "published",
                "brand": "brand",
                "language": "Aut velit repudiandae quia aliquid magni quos minima ut. Minus eligendi commodi tenetur accusantium ducimus quia. Reiciendis quasi et eius fugit aut quam. Sit quibusdam labore sint.",
                "user": "1",
                "publishedOn": {
                    "date": "1975-05-07 00:00:50.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2005-01-27 04:47:32.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1989-12-14 17:50:08.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Earum tempora placeat placeat sunt placeat magnam. Officiis repellat vero consequuntur velit. Facere magni repellat quisquam rerum quis. Tempore eligendi error sunt itaque et. Laudantium magnam recusandae eos minima amet odit.",
                "homeStaffPickRating": "651830587",
                "legacyId": 135314308,
                "legacyWordpressPostId": 136174500,
                "qnaVideo": "Fugit dolorum ducimus modi quis quis fugit quis. Accusantium nobis exercitationem nobis nisi quam ex unde. Ducimus est et qui. Ut quis qui vitae blanditiis eum.",
                "style": "Placeat sapiente enim sequi est qui quia non. Animi ratione sed eligendi id. Eos distinctio eos illum voluptatem. Doloribus illo sit dignissimos vel.",
                "title": "Quos distinctio ducimus at.",
                "xp": 1916995098,
                "album": "Dolor inventore eos est quo unde quae similique aperiam. Consequatur aut laudantium qui et incidunt. Amet officia et cumque illo et quia quia adipisci. Tempora reprehenderit necessitatibus eaque distinctio.",
                "artist": "Voluptas quia at ut perspiciatis. Iste ut quaerat nemo sed. Quam velit sint nisi dolores et. Cupiditate et qui aliquid dolorem consequatur.",
                "bpm": "Praesentium praesentium tenetur explicabo quasi. Minima velit rerum autem. Dolor quis doloremque quis aut nemo necessitatibus illum. Praesentium reprehenderit maxime harum commodi adipisci aut sunt.",
                "cdTracks": "Voluptatem sunt rerum placeat doloremque. Quibusdam et sunt asperiores. Ut velit est facere vero voluptatem ratione earum mollitia.",
                "chordOrScale": "Vero incidunt non voluptas pariatur aut. Odio quam fuga accusamus ducimus quis magnam consectetur. Iste non in perferendis esse sit eius odit.",
                "difficultyRange": "Omnis mollitia eos qui. Vitae aut voluptatem nemo nesciunt et. Optio dolore velit optio voluptas perferendis maiores doloribus.",
                "episodeNumber": 1443553567,
                "exerciseBookPages": "Sed nulla et a ab est doloremque ex. Recusandae officiis quis voluptatem id earum iusto. Qui pariatur vitae exercitationem aut maiores eveniet facere natus.",
                "fastBpm": "Provident tempora temporibus sit enim rem. Molestiae atque sit asperiores commodi. Quasi dolores aperiam libero sit numquam.",
                "includesSong": true,
                "instructors": "Magni maxime quam voluptas. Sunt fugit quasi deleniti sint amet omnis voluptas. Odio et est ducimus aut quisquam accusamus dolor quis. Dolor ex ratione aut enim provident.",
                "liveEventStartTime": {
                    "date": "2013-09-11 06:48:04.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1979-04-29 10:51:03.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Provident laboriosam labore est voluptate et qui minus. Perferendis corporis ipsum qui et. In esse sed quos accusamus. Aut voluptatum maiores aliquid sunt cupiditate blanditiis.",
                "liveStreamFeedType": "Ut aut sed aut. Consequatur tempora provident nihil ut. Fugit nihil cum officiis. Quis et laborum esse sit. Explicabo voluptatem tempora non deleniti autem. Nemo et beatae iste. Doloribus perspiciatis ut autem.",
                "name": "Et et molestiae placeat iure eum. Aliquid sed placeat at iste voluptatibus. Quo repellendus nisi distinctio.",
                "released": "Voluptas deserunt enim vero quam enim quasi veniam. Quia rerum eaque necessitatibus laudantium reprehenderit unde cupiditate. Magni sed porro molestiae eveniet.",
                "slowBpm": "Et est maiores illo consequatur beatae. Vitae maxime quaerat illum saepe ipsum. Harum omnis iure nihil cumque quas. Recusandae eum iste debitis et reiciendis sit. Fugiat dolores quo quod. Suscipit eos quis et minima qui est.",
                "totalXp": "Qui voluptatibus enim architecto est. Reiciendis iure corrupti vel beatae est. Aut delectus numquam ut ab suscipit. Sint et et illum deserunt ipsa.",
                "transcriberName": "Ullam sunt et dolorem commodi ipsam omnis sapiente totam. Ut sunt sed nihil sint beatae ut voluptas. In eos quis nihil voluptatem. Totam et in et reiciendis omnis ducimus.",
                "week": 1943046946,
                "avatarUrl": "Laboriosam tenetur porro harum totam odio numquam beatae. Modi commodi omnis exercitationem quasi dolorem ea. Alias expedita ut ut quo.",
                "lengthInSeconds": 251143756,
                "soundsliceSlug": "Nesciunt quia vero voluptas suscipit illo aliquam. Quae nostrum qui dolorem similique odio. Molestias natus aut velit sit nihil. Quis repellendus veritatis consequuntur mollitia.",
                "staffPickRating": 431525804,
                "studentId": 97158999,
                "vimeoVideoId": "Quia aut et quia harum quo. Pariatur aspernatur magni eos consequatur ea. Sequi dolorum eligendi nihil sed. Praesentium perspiciatis quasi incidunt aut iusto nisi. Nostrum praesentium dolores eos consectetur quis.",
                "youtubeVideoId": "Quidem eum sed accusamus sint voluptates sapiente sit saepe. Veritatis commodi dignissimos optio error dolore occaecati quibusdam. Voluptatem repellat nihil quisquam repellendus vitae neque eveniet."
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
                "slug": "Accusantium odit sit accusantium. Excepturi dolor quis reiciendis sapiente minima maxime nemo. Quisquam numquam qui odit labore. Eveniet aut qui laboriosam reprehenderit.",
                "type": "course",
                "sort": "1207045682",
                "status": "published",
                "brand": "brand",
                "language": "Aut velit repudiandae quia aliquid magni quos minima ut. Minus eligendi commodi tenetur accusantium ducimus quia. Reiciendis quasi et eius fugit aut quam. Sit quibusdam labore sint.",
                "user": "1",
                "publishedOn": {
                    "date": "1975-05-07 00:00:50.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2005-01-27 04:47:32.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1989-12-14 17:50:08.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Earum tempora placeat placeat sunt placeat magnam. Officiis repellat vero consequuntur velit. Facere magni repellat quisquam rerum quis. Tempore eligendi error sunt itaque et. Laudantium magnam recusandae eos minima amet odit.",
                "homeStaffPickRating": "651830587",
                "legacyId": 135314308,
                "legacyWordpressPostId": 136174500,
                "qnaVideo": "Fugit dolorum ducimus modi quis quis fugit quis. Accusantium nobis exercitationem nobis nisi quam ex unde. Ducimus est et qui. Ut quis qui vitae blanditiis eum.",
                "style": "Placeat sapiente enim sequi est qui quia non. Animi ratione sed eligendi id. Eos distinctio eos illum voluptatem. Doloribus illo sit dignissimos vel.",
                "title": "Quos distinctio ducimus at.",
                "xp": 1916995098,
                "album": "Dolor inventore eos est quo unde quae similique aperiam. Consequatur aut laudantium qui et incidunt. Amet officia et cumque illo et quia quia adipisci. Tempora reprehenderit necessitatibus eaque distinctio.",
                "artist": "Voluptas quia at ut perspiciatis. Iste ut quaerat nemo sed. Quam velit sint nisi dolores et. Cupiditate et qui aliquid dolorem consequatur.",
                "bpm": "Praesentium praesentium tenetur explicabo quasi. Minima velit rerum autem. Dolor quis doloremque quis aut nemo necessitatibus illum. Praesentium reprehenderit maxime harum commodi adipisci aut sunt.",
                "cdTracks": "Voluptatem sunt rerum placeat doloremque. Quibusdam et sunt asperiores. Ut velit est facere vero voluptatem ratione earum mollitia.",
                "chordOrScale": "Vero incidunt non voluptas pariatur aut. Odio quam fuga accusamus ducimus quis magnam consectetur. Iste non in perferendis esse sit eius odit.",
                "difficultyRange": "Omnis mollitia eos qui. Vitae aut voluptatem nemo nesciunt et. Optio dolore velit optio voluptas perferendis maiores doloribus.",
                "episodeNumber": 1443553567,
                "exerciseBookPages": "Sed nulla et a ab est doloremque ex. Recusandae officiis quis voluptatem id earum iusto. Qui pariatur vitae exercitationem aut maiores eveniet facere natus.",
                "fastBpm": "Provident tempora temporibus sit enim rem. Molestiae atque sit asperiores commodi. Quasi dolores aperiam libero sit numquam.",
                "includesSong": true,
                "instructors": "Magni maxime quam voluptas. Sunt fugit quasi deleniti sint amet omnis voluptas. Odio et est ducimus aut quisquam accusamus dolor quis. Dolor ex ratione aut enim provident.",
                "liveEventStartTime": {
                    "date": "2013-09-11 06:48:04.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1979-04-29 10:51:03.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Provident laboriosam labore est voluptate et qui minus. Perferendis corporis ipsum qui et. In esse sed quos accusamus. Aut voluptatum maiores aliquid sunt cupiditate blanditiis.",
                "liveStreamFeedType": "Ut aut sed aut. Consequatur tempora provident nihil ut. Fugit nihil cum officiis. Quis et laborum esse sit. Explicabo voluptatem tempora non deleniti autem. Nemo et beatae iste. Doloribus perspiciatis ut autem.",
                "name": "Et et molestiae placeat iure eum. Aliquid sed placeat at iste voluptatibus. Quo repellendus nisi distinctio.",
                "released": "Voluptas deserunt enim vero quam enim quasi veniam. Quia rerum eaque necessitatibus laudantium reprehenderit unde cupiditate. Magni sed porro molestiae eveniet.",
                "slowBpm": "Et est maiores illo consequatur beatae. Vitae maxime quaerat illum saepe ipsum. Harum omnis iure nihil cumque quas. Recusandae eum iste debitis et reiciendis sit. Fugiat dolores quo quod. Suscipit eos quis et minima qui est.",
                "totalXp": "Qui voluptatibus enim architecto est. Reiciendis iure corrupti vel beatae est. Aut delectus numquam ut ab suscipit. Sint et et illum deserunt ipsa.",
                "transcriberName": "Ullam sunt et dolorem commodi ipsam omnis sapiente totam. Ut sunt sed nihil sint beatae ut voluptas. In eos quis nihil voluptatem. Totam et in et reiciendis omnis ducimus.",
                "week": 1943046946,
                "avatarUrl": "Laboriosam tenetur porro harum totam odio numquam beatae. Modi commodi omnis exercitationem quasi dolorem ea. Alias expedita ut ut quo.",
                "lengthInSeconds": 251143756,
                "soundsliceSlug": "Nesciunt quia vero voluptas suscipit illo aliquam. Quae nostrum qui dolorem similique odio. Molestias natus aut velit sit nihil. Quis repellendus veritatis consequuntur mollitia.",
                "staffPickRating": 431525804,
                "studentId": 97158999,
                "vimeoVideoId": "Quia aut et quia harum quo. Pariatur aspernatur magni eos consequatur ea. Sequi dolorum eligendi nihil sed. Praesentium perspiciatis quasi incidunt aut iusto nisi. Nostrum praesentium dolores eos consectetur quis.",
                "youtubeVideoId": "Quidem eum sed accusamus sint voluptates sapiente sit saepe. Veritatis commodi dignissimos optio error dolore occaecati quibusdam. Voluptatem repellat nihil quisquam repellendus vitae neque eveniet."
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
                "slug": "Hic odit ratione tenetur quam. Dolores qui cum consequatur enim natus fuga et illum. Impedit voluptates quis doloribus dolores expedita. Soluta sit ab tempore aut quis quidem eaque. Quaerat quam eius neque itaque fugiat iste.",
                "type": "course",
                "sort": "1846408275",
                "status": "published",
                "brand": "brand",
                "language": "Dolores commodi earum ut. Impedit rerum rerum ut officia. Sint nulla voluptatem ducimus beatae explicabo recusandae impedit.",
                "user": "1",
                "publishedOn": {
                    "date": "1989-12-06 00:15:26.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1973-04-28 07:23:07.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1988-11-29 11:48:05.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
                "homeStaffPickRating": "211594015",
                "legacyId": 2029105382,
                "legacyWordpressPostId": 2110749050,
                "qnaVideo": "Quas ab repudiandae facere aut impedit aspernatur. Est hic dicta ut et quidem aliquid natus. Accusantium asperiores dolorem voluptas quas delectus natus voluptates. Explicabo error quae dolor et neque.",
                "style": "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
                "title": "Quasi qui modi ad dolores enim iusto est.",
                "xp": 465338215,
                "album": "Enim officia qui aspernatur amet magnam. Ut voluptate et soluta est soluta et eligendi. Aspernatur iusto molestiae perspiciatis veritatis optio. Quidem quas nesciunt ipsum vel. Omnis aut inventore rerum laborum sit.",
                "artist": "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
                "bpm": "Enim et voluptatem cupiditate. Facere iure id autem. Voluptas aut exercitationem deserunt neque voluptatem.",
                "cdTracks": "Molestias rerum doloribus sit aut quis quas. Aliquam beatae libero sed. Dolorum quia est aut fuga. Sint omnis id aut occaecati et et natus.",
                "chordOrScale": "Vitae ut ipsa aliquam impedit accusamus. Molestiae eos laudantium et eum tempore. Asperiores omnis libero natus earum inventore enim id. Eum ducimus libero repudiandae perferendis rerum labore ducimus.",
                "difficultyRange": "Consequuntur autem pariatur est et. Aspernatur sed ratione nesciunt. Quo porro eum quia ullam eum. Fugiat aut quaerat dolor maiores aut. Illo voluptatem ullam tempora voluptatem. Totam omnis ut molestias consequuntur.",
                "episodeNumber": 870317541,
                "exerciseBookPages": "Sed minima voluptatibus qui et ad voluptatem rerum. Nobis et impedit necessitatibus sit. Porro vel numquam laboriosam dicta quod. Porro accusamus nam rerum omnis alias quibusdam praesentium.",
                "fastBpm": "Cumque in molestiae ea dolore rerum facilis. Et iusto molestiae doloremque. Sint est quia dolor odio voluptatum ea unde. Doloribus autem voluptas et dignissimos eaque. Expedita aut vel a.",
                "includesSong": true,
                "instructors": "Sed eum fuga delectus ex. Esse explicabo pariatur quos a. Qui mollitia nisi molestiae dolores adipisci et aut totam. Ut sit sapiente laborum.",
                "liveEventStartTime": {
                    "date": "2012-10-01 00:06:20.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1972-08-02 00:32:19.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Adipisci est earum reiciendis et quia a. Dolore vel ducimus et occaecati iure sed vel sit. Et voluptatum ut doloribus sunt.",
                "liveStreamFeedType": "Assumenda soluta similique eligendi. Eos libero sequi assumenda. Tempora et sint adipisci voluptatem magni ex. Ullam nisi nobis tenetur beatae occaecati. Voluptate repudiandae animi minus sint debitis.",
                "name": "Nostrum nobis minus modi qui sit. Accusantium autem inventore possimus optio dolorum repellat reprehenderit. Consequuntur sed dignissimos voluptatum alias totam.",
                "released": "Rerum blanditiis optio ut eveniet aut. Vel quo fugiat soluta autem quasi eos quia. Quos provident iusto nostrum officiis deleniti harum.",
                "slowBpm": "Quidem sequi architecto mollitia natus. Ad sed nulla vitae dolores provident accusamus aliquam. Blanditiis officia qui voluptatem veritatis porro tenetur voluptate.",
                "totalXp": "Qui minus unde et nobis. Voluptatem sed veritatis non sit iusto. Exercitationem est doloremque rerum dolorem rerum laudantium rem. Sit ea porro cumque autem.",
                "transcriberName": "Enim enim consequatur ut optio. Mollitia fugit error qui quia dolor et sed vel. Nobis rerum nam est eaque aut.",
                "week": 1549229504,
                "avatarUrl": "Amet qui voluptas consequatur expedita facere aut nihil. Et sit autem laboriosam sunt beatae. Magni explicabo et eos nihil tenetur et et. Doloremque dolorum animi corrupti architecto.",
                "lengthInSeconds": 1889120521,
                "soundsliceSlug": "At rerum totam et et. Suscipit in quaerat velit sunt provident dolorem ducimus. Quae ea pariatur tempore odit in et.",
                "staffPickRating": 1882244654,
                "studentId": 1107745055,
                "vimeoVideoId": "Qui similique dolor doloremque rerum deserunt error velit nihil. Ut vel laboriosam dicta numquam nam ad assumenda exercitationem. Unde est voluptatibus error repudiandae eius id esse. Odio quibusdam labore sed maxime.",
                "youtubeVideoId": "Voluptas eaque ipsum in quod perferendis qui provident. Nemo minus quos minus deserunt delectus magnam. Ducimus impedit provident cupiditate dolorem. Nihil dolor deserunt nihil repellat. Ad assumenda nam molestiae qui."
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
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "In voluptas rerum iure at sunt et voluptatem et. Nesciunt est qui sit et. Quis vero aliquam temporibus inventore et aperiam. Maiores eaque illum iste sunt deserunt et.",
                "value": "Eligendi aut nisi et. Autem voluptatibus et autem sed accusamus facilis eligendi. Aut in veniam est. Et aut cum eaque laborum. Quo necessitatibus saepe odit nostrum sequi quae. Atque reprehenderit ut quo aut molestias.",
                "position": 1114424162
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
            "slug": "Hic odit ratione tenetur quam. Dolores qui cum consequatur enim natus fuga et illum. Impedit voluptates quis doloribus dolores expedita. Soluta sit ab tempore aut quis quidem eaque. Quaerat quam eius neque itaque fugiat iste.",
            "type": "course",
            "sort": "1846408275",
            "status": "published",
            "brand": "brand",
            "language": "Dolores commodi earum ut. Impedit rerum rerum ut officia. Sint nulla voluptatem ducimus beatae explicabo recusandae impedit.",
            "user": "1",
            "publishedOn": {
                "date": "1989-12-06 00:15:26.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "archivedOn": {
                "date": "1973-04-28 07:23:07.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "1988-11-29 11:48:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
            "homeStaffPickRating": "211594015",
            "legacyId": 2029105382,
            "legacyWordpressPostId": 2110749050,
            "qnaVideo": "Quas ab repudiandae facere aut impedit aspernatur. Est hic dicta ut et quidem aliquid natus. Accusantium asperiores dolorem voluptas quas delectus natus voluptates. Explicabo error quae dolor et neque.",
            "style": "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
            "title": "Quasi qui modi ad dolores enim iusto est.",
            "xp": 465338215,
            "album": "Enim officia qui aspernatur amet magnam. Ut voluptate et soluta est soluta et eligendi. Aspernatur iusto molestiae perspiciatis veritatis optio. Quidem quas nesciunt ipsum vel. Omnis aut inventore rerum laborum sit.",
            "artist": "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
            "bpm": "Enim et voluptatem cupiditate. Facere iure id autem. Voluptas aut exercitationem deserunt neque voluptatem.",
            "cdTracks": "Molestias rerum doloribus sit aut quis quas. Aliquam beatae libero sed. Dolorum quia est aut fuga. Sint omnis id aut occaecati et et natus.",
            "chordOrScale": "Vitae ut ipsa aliquam impedit accusamus. Molestiae eos laudantium et eum tempore. Asperiores omnis libero natus earum inventore enim id. Eum ducimus libero repudiandae perferendis rerum labore ducimus.",
            "difficultyRange": "Consequuntur autem pariatur est et. Aspernatur sed ratione nesciunt. Quo porro eum quia ullam eum. Fugiat aut quaerat dolor maiores aut. Illo voluptatem ullam tempora voluptatem. Totam omnis ut molestias consequuntur.",
            "episodeNumber": 870317541,
            "exerciseBookPages": "Sed minima voluptatibus qui et ad voluptatem rerum. Nobis et impedit necessitatibus sit. Porro vel numquam laboriosam dicta quod. Porro accusamus nam rerum omnis alias quibusdam praesentium.",
            "fastBpm": "Cumque in molestiae ea dolore rerum facilis. Et iusto molestiae doloremque. Sint est quia dolor odio voluptatum ea unde. Doloribus autem voluptas et dignissimos eaque. Expedita aut vel a.",
            "includesSong": true,
            "instructors": "Sed eum fuga delectus ex. Esse explicabo pariatur quos a. Qui mollitia nisi molestiae dolores adipisci et aut totam. Ut sit sapiente laborum.",
            "liveEventStartTime": {
                "date": "2012-10-01 00:06:20.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1972-08-02 00:32:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Adipisci est earum reiciendis et quia a. Dolore vel ducimus et occaecati iure sed vel sit. Et voluptatum ut doloribus sunt.",
            "liveStreamFeedType": "Assumenda soluta similique eligendi. Eos libero sequi assumenda. Tempora et sint adipisci voluptatem magni ex. Ullam nisi nobis tenetur beatae occaecati. Voluptate repudiandae animi minus sint debitis.",
            "name": "Nostrum nobis minus modi qui sit. Accusantium autem inventore possimus optio dolorum repellat reprehenderit. Consequuntur sed dignissimos voluptatum alias totam.",
            "released": "Rerum blanditiis optio ut eveniet aut. Vel quo fugiat soluta autem quasi eos quia. Quos provident iusto nostrum officiis deleniti harum.",
            "slowBpm": "Quidem sequi architecto mollitia natus. Ad sed nulla vitae dolores provident accusamus aliquam. Blanditiis officia qui voluptatem veritatis porro tenetur voluptate.",
            "totalXp": "Qui minus unde et nobis. Voluptatem sed veritatis non sit iusto. Exercitationem est doloremque rerum dolorem rerum laudantium rem. Sit ea porro cumque autem.",
            "transcriberName": "Enim enim consequatur ut optio. Mollitia fugit error qui quia dolor et sed vel. Nobis rerum nam est eaque aut.",
            "week": 1549229504,
            "avatarUrl": "Amet qui voluptas consequatur expedita facere aut nihil. Et sit autem laboriosam sunt beatae. Magni explicabo et eos nihil tenetur et et. Doloremque dolorum animi corrupti architecto.",
            "lengthInSeconds": 1889120521,
            "soundsliceSlug": "At rerum totam et et. Suscipit in quaerat velit sunt provident dolorem ducimus. Quae ea pariatur tempore odit in et.",
            "staffPickRating": 1882244654,
            "studentId": 1107745055,
            "vimeoVideoId": "Qui similique dolor doloremque rerum deserunt error velit nihil. Ut vel laboriosam dicta numquam nam ad assumenda exercitationem. Unde est voluptatibus error repudiandae eius id esse. Odio quibusdam labore sed maxime.",
            "youtubeVideoId": "Voluptas eaque ipsum in quod perferendis qui provident. Nemo minus quos minus deserunt delectus magnam. Ducimus impedit provident cupiditate dolorem. Nihil dolor deserunt nihil repellat. Ad assumenda nam molestiae qui."
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
                "key": "In voluptas rerum iure at sunt et voluptatem et. Nesciunt est qui sit et. Quis vero aliquam temporibus inventore et aperiam. Maiores eaque illum iste sunt deserunt et.",
                "value": "Eligendi aut nisi et. Autem voluptatibus et autem sed accusamus facilis eligendi. Aut in veniam est. Et aut cum eaque laborum. Quo necessitatibus saepe odit nostrum sequi quae. Atque reprehenderit ut quo aut molestias.",
                "position": 1114424162
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
            "sort": 0,
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
                    "id": "2"
                }
            }
        }
    },
    "included": [
        {
            "type": "parent",
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
        },
        {
            "type": "parent",
            "id": "2",
            "attributes": {
                "child_position": 74958920
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
|body|data.attributes.language|    |* @bodyParam data.attributes.sort integer|
|body|data.attributes.published_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
[
    "       $this->validateContent($this);",
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
            "language": "consequuntur",
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
            "sort": "1846408275",
            "status": "draft",
            "brand": "brand",
            "language": "consequuntur",
            "user": "1",
            "publishedOn": "2019-05-21 21:20:10",
            "archivedOn": {
                "date": "1973-04-28 07:23:07.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "1988-11-29 11:48:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Atque et laboriosam et sint itaque. Tempora consequuntur esse tenetur. Et reprehenderit ut non. Eveniet qui ut quis omnis sint quis aspernatur et.",
            "homeStaffPickRating": "211594015",
            "legacyId": 2029105382,
            "legacyWordpressPostId": 2110749050,
            "qnaVideo": "Quas ab repudiandae facere aut impedit aspernatur. Est hic dicta ut et quidem aliquid natus. Accusantium asperiores dolorem voluptas quas delectus natus voluptates. Explicabo error quae dolor et neque.",
            "style": "Accusantium ratione dolores mollitia assumenda voluptates consequatur. Dignissimos dolorum impedit repudiandae fugit. Dignissimos facere amet aut dolores. Nesciunt totam consequatur itaque aut esse ipsum nihil.",
            "title": "Quasi qui modi ad dolores enim iusto est.",
            "xp": 465338215,
            "album": "Enim officia qui aspernatur amet magnam. Ut voluptate et soluta est soluta et eligendi. Aspernatur iusto molestiae perspiciatis veritatis optio. Quidem quas nesciunt ipsum vel. Omnis aut inventore rerum laborum sit.",
            "artist": "Et omnis ut impedit aut eveniet eos. Beatae magni voluptate maxime alias voluptatibus repellendus et. Qui qui doloribus soluta. Fuga magni laborum eligendi alias nihil. Quod quam veritatis debitis dolorem.",
            "bpm": "Enim et voluptatem cupiditate. Facere iure id autem. Voluptas aut exercitationem deserunt neque voluptatem.",
            "cdTracks": "Molestias rerum doloribus sit aut quis quas. Aliquam beatae libero sed. Dolorum quia est aut fuga. Sint omnis id aut occaecati et et natus.",
            "chordOrScale": "Vitae ut ipsa aliquam impedit accusamus. Molestiae eos laudantium et eum tempore. Asperiores omnis libero natus earum inventore enim id. Eum ducimus libero repudiandae perferendis rerum labore ducimus.",
            "difficultyRange": "Consequuntur autem pariatur est et. Aspernatur sed ratione nesciunt. Quo porro eum quia ullam eum. Fugiat aut quaerat dolor maiores aut. Illo voluptatem ullam tempora voluptatem. Totam omnis ut molestias consequuntur.",
            "episodeNumber": 870317541,
            "exerciseBookPages": "Sed minima voluptatibus qui et ad voluptatem rerum. Nobis et impedit necessitatibus sit. Porro vel numquam laboriosam dicta quod. Porro accusamus nam rerum omnis alias quibusdam praesentium.",
            "fastBpm": "Cumque in molestiae ea dolore rerum facilis. Et iusto molestiae doloremque. Sint est quia dolor odio voluptatum ea unde. Doloribus autem voluptas et dignissimos eaque. Expedita aut vel a.",
            "includesSong": true,
            "instructors": "Sed eum fuga delectus ex. Esse explicabo pariatur quos a. Qui mollitia nisi molestiae dolores adipisci et aut totam. Ut sit sapiente laborum.",
            "liveEventStartTime": {
                "date": "2012-10-01 00:06:20.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1972-08-02 00:32:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Adipisci est earum reiciendis et quia a. Dolore vel ducimus et occaecati iure sed vel sit. Et voluptatum ut doloribus sunt.",
            "liveStreamFeedType": "Assumenda soluta similique eligendi. Eos libero sequi assumenda. Tempora et sint adipisci voluptatem magni ex. Ullam nisi nobis tenetur beatae occaecati. Voluptate repudiandae animi minus sint debitis.",
            "name": "Nostrum nobis minus modi qui sit. Accusantium autem inventore possimus optio dolorum repellat reprehenderit. Consequuntur sed dignissimos voluptatum alias totam.",
            "released": "Rerum blanditiis optio ut eveniet aut. Vel quo fugiat soluta autem quasi eos quia. Quos provident iusto nostrum officiis deleniti harum.",
            "slowBpm": "Quidem sequi architecto mollitia natus. Ad sed nulla vitae dolores provident accusamus aliquam. Blanditiis officia qui voluptatem veritatis porro tenetur voluptate.",
            "totalXp": "Qui minus unde et nobis. Voluptatem sed veritatis non sit iusto. Exercitationem est doloremque rerum dolorem rerum laudantium rem. Sit ea porro cumque autem.",
            "transcriberName": "Enim enim consequatur ut optio. Mollitia fugit error qui quia dolor et sed vel. Nobis rerum nam est eaque aut.",
            "week": 1549229504,
            "avatarUrl": "Amet qui voluptas consequatur expedita facere aut nihil. Et sit autem laboriosam sunt beatae. Magni explicabo et eos nihil tenetur et et. Doloremque dolorum animi corrupti architecto.",
            "lengthInSeconds": 1889120521,
            "soundsliceSlug": "At rerum totam et et. Suscipit in quaerat velit sunt provident dolorem ducimus. Quae ea pariatur tempore odit in et.",
            "staffPickRating": 1882244654,
            "studentId": 1107745055,
            "vimeoVideoId": "Qui similique dolor doloremque rerum deserunt error velit nihil. Ut vel laboriosam dicta numquam nam ad assumenda exercitationem. Unde est voluptatibus error repudiandae eius id esse. Odio quibusdam labore sed maxime.",
            "youtubeVideoId": "Voluptas eaque ipsum in quod perferendis qui provident. Nemo minus quos minus deserunt delectus magnam. Ducimus impedit provident cupiditate dolorem. Nihil dolor deserunt nihil repellat. Ad assumenda nam molestiae qui."
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
                    "id": "2"
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
                "sort": "1846408275",
                "status": "draft",
                "brand": "brand",
                "language": "consequuntur",
                "user": "1",
                "published_on": "2019-05-21 21:20:10",
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
            "id": "2",
            "attributes": {
                "child_position": 74958920
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

