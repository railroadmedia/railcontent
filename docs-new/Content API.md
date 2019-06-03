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
            "id": "4",
            "attributes": {
                "slug": "Dolor molestias consequatur voluptas tempora reprehenderit. Molestias deleniti sed assumenda iste. Nihil tempora molestiae itaque ut asperiores.",
                "type": "course",
                "sort": "509421908",
                "status": "published",
                "brand": "brand",
                "language": "Enim iure itaque deleniti ab aliquid dolores ratione porro. Asperiores praesentium assumenda delectus quos omnis corrupti. Voluptas ipsum officia alias et.",
                "user": "",
                "publishedOn": {
                    "date": "2013-10-12 18:59:20.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1997-11-03 06:53:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2000-02-05 02:08:52.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Culpa soluta dolore minima praesentium temporibus. Esse nobis nesciunt officia vero et. Fuga quae maiores accusantium voluptatum id. Voluptas voluptatem neque corporis et. Sed temporibus non sint occaecati omnis.",
                "homeStaffPickRating": "772029369",
                "legacyId": 1142044789,
                "legacyWordpressPostId": 932272950,
                "qnaVideo": "Dolor magnam culpa eveniet illum suscipit. Quidem magni explicabo est iste.",
                "style": "Possimus aliquam atque vel blanditiis praesentium est quod rerum. Itaque quia aut reprehenderit qui eveniet. Reprehenderit laudantium voluptas cum placeat eum. Ab quia et eum dolor. Laborum velit rerum voluptatem voluptates dolorem quaerat.",
                "title": "Excepturi reiciendis fugit nam voluptates dolor.",
                "xp": 567717117,
                "album": "Omnis fugiat et quaerat. Reprehenderit qui illo odio porro veritatis. Libero eum libero quia. Ullam voluptates molestias deleniti nam repellat.",
                "artist": "Odio sunt nam eum sint sit. Consequatur minima voluptatibus blanditiis natus. Dolores deserunt quaerat in et.",
                "bpm": "Culpa et non fuga quos amet et. Sint qui numquam nam minus a quis. Fugit dolores ea ullam rerum ad totam.",
                "cdTracks": "Delectus fugit aut reiciendis ut numquam. Dolorem corrupti sed debitis ipsa. Quae quis ipsum nihil inventore. Ipsa inventore corrupti tenetur ipsa quaerat tempora qui.",
                "chordOrScale": "Quis consectetur illum voluptate eaque. Fugit aut porro debitis assumenda quasi vel nisi. Eum ea et aliquid.",
                "difficultyRange": "Eius et eaque et at. Amet quas esse labore ex ea. Autem cum debitis quibusdam ipsam dolorem officiis. Aut nam ea delectus vitae. In aut et beatae distinctio nihil. At et et voluptatem pariatur sapiente rerum autem.",
                "episodeNumber": 451788368,
                "exerciseBookPages": "Qui magnam autem non nihil autem et. Id sint numquam deserunt autem quis doloribus autem quia. Quidem et minima odio suscipit qui. Cum non laboriosam dolores voluptatum vero ipsa.",
                "fastBpm": "Beatae officiis laborum voluptatem at debitis dolorum doloremque vero. Eius dolorem rerum modi repellendus commodi. Error sequi quia veritatis vel ipsam. Et laboriosam non dolore officia alias. Et inventore distinctio eveniet reprehenderit et dolor.",
                "includesSong": false,
                "instructors": "Sapiente nulla eos voluptate sapiente laboriosam perspiciatis. Corrupti vero nostrum fugiat velit est molestias deserunt. Aliquam reiciendis voluptas assumenda ducimus et et rerum. Culpa porro unde vel deserunt deserunt quo placeat.",
                "liveEventStartTime": {
                    "date": "1980-02-29 05:54:33.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1993-05-09 06:05:55.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quia eos ratione est commodi dolorem quis error. Ut et qui voluptas ratione accusamus vel. Et voluptas qui quod officia alias. Rerum aut in et. Nihil et magnam voluptatem quod. Id ducimus sed unde dolores delectus. Illum magnam est vero.",
                "liveStreamFeedType": "Accusamus vitae aliquid ratione qui quo. Aut aut illum non facilis repudiandae nam. Libero cupiditate voluptatum voluptatibus tempora voluptatum culpa asperiores. Delectus in error necessitatibus laboriosam cumque. Voluptates qui est impedit numquam.",
                "name": "Ea aut accusantium nostrum ut. Mollitia eum rem eaque porro. Est ut eum at voluptatem dolorem. Itaque et et minima rerum ex vel iusto. Et iure facere nulla aperiam aliquam atque nisi veritatis. Soluta et laboriosam qui delectus quasi et.",
                "released": "Rerum voluptatem hic qui rerum in blanditiis. Praesentium cupiditate sed aut maiores dolor saepe. Veniam eos unde fugit eos eos ab. Voluptatem dolorem maiores nam quidem placeat quo. Nam tempora quos aspernatur iusto voluptates itaque.",
                "slowBpm": "Voluptatum tempora quod nemo. Sed voluptas voluptatem laudantium sint harum omnis necessitatibus maxime. Incidunt quia libero at sint voluptas.",
                "totalXp": "Qui cupiditate fuga aperiam. Ratione quos explicabo nihil. Voluptatem voluptatem repudiandae dolorum qui ipsam ut. Et doloremque ipsam explicabo quisquam accusantium quidem est. Quas provident sed dicta voluptas. Aut minus quia architecto in.",
                "transcriberName": "Porro et labore ipsam odit. Id voluptas deleniti id quis possimus consequuntur. Id voluptas magni reprehenderit occaecati. Nesciunt voluptatibus fuga sit aut possimus dolor est.",
                "week": 999559334,
                "avatarUrl": "Voluptas omnis odio quae vitae. Aliquam dignissimos velit dolores laboriosam voluptatem sint. Possimus praesentium tempore sit sed exercitationem quia est.",
                "lengthInSeconds": 2142404432,
                "soundsliceSlug": "Totam dignissimos rerum qui corrupti et quaerat ratione. Omnis iusto saepe rerum praesentium officiis soluta aut.",
                "staffPickRating": 1384260520,
                "studentId": 729757405,
                "vimeoVideoId": "At tenetur blanditiis corporis qui dolorem delectus quo ea. Corrupti porro provident rerum alias. Sit reprehenderit tempora assumenda dolorem assumenda ipsa. Eum voluptate at dicta occaecati quae.",
                "youtubeVideoId": "Officiis corporis qui unde voluptatem. Et nam vero unde sed. Eum neque quibusdam quia velit sequi sed animi nihil. Necessitatibus eligendi aut expedita explicabo rerum eos est."
            }
        },
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Nostrum soluta doloremque hic maxime molestiae. Dignissimos consectetur qui velit maxime. Fuga voluptatem error sunt quia beatae.",
                "type": "course",
                "sort": "1831419982",
                "status": "published",
                "brand": "brand",
                "language": "Iure aut repellendus odio. Est iste impedit cum saepe quaerat. Reiciendis sit iusto optio ut aliquam. Ut rem aut quo neque asperiores magnam quia.",
                "user": "",
                "publishedOn": {
                    "date": "1995-03-28 03:23:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1999-08-06 22:18:46.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1977-05-15 00:25:02.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Quo nihil asperiores cumque consequatur quisquam. Quia ipsam ut modi eius. Inventore deserunt aspernatur vel ad cum veniam. Neque laboriosam voluptates sunt suscipit cupiditate.",
                "homeStaffPickRating": "160658269",
                "legacyId": 1204692758,
                "legacyWordpressPostId": 1224128971,
                "qnaVideo": "Eius tempora blanditiis ab nostrum quaerat sint. Nostrum temporibus perspiciatis ea vero qui culpa fugiat. Cum exercitationem asperiores perspiciatis consequuntur.",
                "style": "Voluptas incidunt cum ut nihil distinctio rerum. Iusto eaque fugiat non beatae dolor deleniti sed voluptatibus. Sunt aut qui fugit voluptas odit.",
                "title": "Veniam aut dolore eligendi occaecati nemo.",
                "xp": 1661250859,
                "album": "Vero quidem rerum consectetur impedit sit alias. Iusto sit autem ut quia eveniet. Quod et laboriosam aut autem totam doloribus facere et. Sit ullam possimus impedit suscipit expedita in deserunt. Pariatur beatae praesentium sequi fugiat.",
                "artist": "Tenetur est excepturi explicabo quaerat aut ipsam. Ut incidunt est dolorem eaque. Dolor veniam dicta quam in nemo ea temporibus.",
                "bpm": "Optio quo officiis accusantium hic. Rerum est velit itaque fugit voluptatem et. Cupiditate qui quia quasi ipsam omnis.",
                "cdTracks": "In nam quis qui et. Numquam dolores consequuntur id odit quidem porro. Sed maiores nihil quam sunt.",
                "chordOrScale": "Omnis iure ipsam inventore omnis assumenda cum in mollitia. Nulla fugiat in ut sint. Reiciendis quam dolorem sit. Quia perspiciatis molestiae sunt ea et unde delectus.",
                "difficultyRange": "Blanditiis et est voluptas itaque. Est illum quo eius cumque. Impedit rerum voluptas eos quibusdam quae recusandae itaque. Quis voluptatem quia porro quae dignissimos. Ea tempora et dolorem nostrum debitis dicta.",
                "episodeNumber": 732680203,
                "exerciseBookPages": "Facere delectus nisi voluptatibus. Error saepe autem quam sunt sapiente. Corrupti quam aut nihil nesciunt quae similique consequuntur. Aut est nostrum rem culpa quae corporis velit. Tempora in et ab ea dignissimos ex.",
                "fastBpm": "Provident molestiae maiores non adipisci quam soluta. Molestias quia autem dolorem numquam. Sed ut adipisci animi cumque delectus aperiam doloremque. Mollitia qui a repellat fugit molestiae.",
                "includesSong": true,
                "instructors": "Eos blanditiis tenetur sit repudiandae facere quo minus. Molestias eos sit quis libero. Ut velit libero aut est officia eius amet.",
                "liveEventStartTime": {
                    "date": "1976-08-08 21:48:38.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1997-11-24 15:47:22.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quisquam sit velit nisi beatae expedita. Quae dolorem saepe sapiente voluptate voluptate. Consequatur rerum tenetur dolorum quo. Ipsam tempore libero consequatur. Similique et vel velit quia vitae.",
                "liveStreamFeedType": "Laudantium sapiente ad in amet velit illum est fugit. Vel inventore voluptates dignissimos minima. Necessitatibus sunt in et quo qui. Libero nobis animi qui sed qui.",
                "name": "Est ut unde maiores repellendus in provident voluptatem. Id nostrum molestias alias similique. Enim harum ut minima incidunt quas. In a beatae excepturi aliquam libero iusto.",
                "released": "Optio voluptates non est totam aut. Ex distinctio ut quaerat aliquam excepturi quod voluptatem maxime. Ut quidem unde dolores quas. Qui ut occaecati minus architecto distinctio.",
                "slowBpm": "Reprehenderit mollitia enim dolores enim. Non non maiores repudiandae id laudantium voluptate. Velit tenetur optio hic dolores.",
                "totalXp": "Harum enim ea sint magni. Officiis dignissimos iste praesentium nihil. Est inventore error deserunt pariatur.",
                "transcriberName": "Nihil dolores quisquam exercitationem inventore. Pariatur odit incidunt vel sit eos tempora sed. Consequuntur libero facilis quis pariatur. Est quod velit repellat laboriosam vitae culpa.",
                "week": 133167258,
                "avatarUrl": "Voluptatem aliquam cumque suscipit hic voluptatum dolores. Deleniti voluptas dolorum cupiditate saepe itaque occaecati. Aut doloremque similique nemo minus temporibus vitae. Alias ex fugiat pariatur repellat sit vero aut.",
                "lengthInSeconds": 736692929,
                "soundsliceSlug": "Vel et possimus quo totam aut ipsam repudiandae. Eius repudiandae ducimus voluptatem eaque accusantium aut est. Dolorum possimus enim quaerat rerum voluptatibus iusto sunt.",
                "staffPickRating": 760484338,
                "studentId": 1890752025,
                "vimeoVideoId": "Ipsa quibusdam molestiae et ab incidunt laborum rerum. Nostrum quaerat voluptatem quibusdam ut eligendi veniam id beatae.",
                "youtubeVideoId": "Et veritatis consequatur natus aut nostrum. Quis nulla autem a velit voluptatem. Eos commodi vel fuga velit ut. Consequatur molestiae tempore quia voluptas vitae ut ducimus ipsam. Aut velit et consequatur provident quia."
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
            "id": "3",
            "attributes": {
                "slug": "Et cumque et sequi odit iste. Totam laudantium veniam earum repellendus non velit. Et assumenda ab qui asperiores nemo harum. Tenetur ut sit non.",
                "type": "course",
                "sort": "2102190462",
                "status": "published",
                "brand": "brand",
                "language": "Consequuntur dolore sapiente dolores asperiores. Ullam dolorem quo blanditiis assumenda voluptatum sint alias. Aut voluptas quo voluptate. Sunt accusantium corrupti dolor consequuntur in odit quo laboriosam.",
                "user": "",
                "publishedOn": {
                    "date": "1981-09-29 16:56:08.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1999-05-19 03:58:51.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1997-06-24 03:02:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Id ipsa consequatur doloremque quia incidunt non illo iste. Vel sapiente ea consequatur harum velit. Incidunt facere vel quo. Aut molestiae praesentium molestiae autem.",
                "homeStaffPickRating": "1839044182",
                "legacyId": 1582339862,
                "legacyWordpressPostId": 1739208662,
                "qnaVideo": "Id pariatur rerum omnis in velit est quos doloremque. Amet sit et beatae sed. Culpa ut voluptatibus repellendus perferendis ex.",
                "style": "Sit ratione odit praesentium assumenda fugiat ut. Et aut et omnis amet tenetur enim. Repudiandae fugit velit in non. Qui repellat velit quas reiciendis. Et et perspiciatis exercitationem ipsam et. Repudiandae qui expedita quia et dolorem quis.",
                "title": "Quos porro nobis dolorem aliquid harum sapiente.",
                "xp": 18334872,
                "album": "Unde eos occaecati ut omnis nihil. Eos est aspernatur tempora porro. Dolores est et architecto aut omnis. Rem qui nam et iure voluptas nobis inventore.",
                "artist": "Aut consequuntur ad quisquam commodi incidunt error. Enim sed iste culpa dolores expedita harum accusantium. Molestiae voluptas libero laborum deleniti eligendi. Consequatur dolore molestiae qui a iusto hic.",
                "bpm": "Ratione vel nam id eos esse. Fugit explicabo earum velit enim. Cupiditate deleniti consectetur dignissimos sit. Natus aut qui nobis ut. Vel cum non et. Amet consequuntur harum repellat cumque magni eum. Vero et delectus enim fugiat qui.",
                "cdTracks": "Ullam et minus aut illo qui iusto. Non sunt et libero repudiandae odio ullam aut. Ab libero veniam iste est mollitia molestias veritatis quam. Ut alias similique sint consequatur saepe. Officiis sunt aliquid ipsam. Esse et quam expedita quis.",
                "chordOrScale": "Dignissimos quia itaque veritatis aut laborum soluta. Ut id sed odit ut eius nam. A et voluptas qui dolorem est. Sed sunt culpa autem necessitatibus ut quos deleniti.",
                "difficultyRange": "Non eligendi aut quam totam. Et amet est ratione quidem voluptate eos impedit. Odio enim doloremque quaerat totam doloribus. Tempore consequatur eaque magni in officiis laboriosam.",
                "episodeNumber": 519673162,
                "exerciseBookPages": "Rerum et nihil nemo aliquid nemo beatae nam. Molestias dolor blanditiis eligendi culpa aut quam. Nesciunt aliquid vitae hic est ea eum enim. Mollitia nesciunt porro sit labore. Quas omnis labore odit quod ut nisi impedit illum.",
                "fastBpm": "Officiis doloribus sint laudantium omnis exercitationem quaerat. Aut officia voluptates nemo suscipit deleniti ipsam fuga. Deserunt beatae aut reprehenderit maxime modi consequatur possimus laborum.",
                "includesSong": true,
                "instructors": "Incidunt magni porro optio vel eos placeat. Quam in laboriosam quia reiciendis ipsum. Vel vel repellat numquam esse inventore nulla. Ipsa in sed nihil.",
                "liveEventStartTime": {
                    "date": "2003-07-20 06:50:09.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1991-10-26 20:11:29.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Sint quia qui ut mollitia distinctio. Rerum qui est ut delectus repellendus.",
                "liveStreamFeedType": "Iste id eos debitis molestiae voluptas id. Officiis architecto sit non labore. Sunt sunt est hic.",
                "name": "Enim mollitia non ut eos explicabo ratione. Sunt eveniet fugiat impedit cum velit. Et sint iure aspernatur error architecto harum. Ab doloremque veniam consequatur hic fugiat deleniti.",
                "released": "Ut veritatis animi sunt pariatur rerum minus ducimus. Sit ipsa beatae id saepe fugit ad blanditiis. Atque voluptas excepturi non incidunt vel et.",
                "slowBpm": "Sint officia voluptatibus sit doloremque nihil ex. Similique odit dolorem beatae ea odio nemo. Quos qui vel quis molestiae vel. Expedita ut fuga et sed.",
                "totalXp": "Nostrum eveniet est nostrum debitis corporis animi architecto. Totam esse possimus est et error et. Sed quibusdam libero et repellendus accusantium sed velit.",
                "transcriberName": "Sed vitae autem soluta ab laudantium accusantium perferendis. Quo nisi inventore qui facere odit. Architecto sed ab impedit mollitia doloremque quis asperiores.",
                "week": 80041868,
                "avatarUrl": "Consectetur quo molestias consequatur aut. Quod qui nihil quam sequi numquam earum. Dolorem corporis temporibus quia placeat et.",
                "lengthInSeconds": 1433130888,
                "soundsliceSlug": "Ipsum et fugit explicabo sed vero magnam. Officiis repellendus numquam quas aspernatur dolores sunt voluptas sed.",
                "staffPickRating": 762003355,
                "studentId": 207590424,
                "vimeoVideoId": "Mollitia accusamus rerum optio vel dolorem. Quam magni explicabo necessitatibus. Libero assumenda debitis in delectus vel. Dolore voluptas ea nam numquam aspernatur qui voluptates.",
                "youtubeVideoId": "Est facilis corrupti et et. Ratione quibusdam veniam saepe enim quo. Non eum ut ipsa eveniet optio ipsum."
            }
        },
        {
            "type": "content",
            "id": "1",
            "attributes": {
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "publishedOn": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "homeStaffPickRating": "108695283",
                "legacyId": 1237496537,
                "legacyWordpressPostId": 1342890876,
                "qnaVideo": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cdTracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chordOrScale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficultyRange": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episodeNumber": 589344364,
                "exerciseBookPages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fastBpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includesSong": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "liveEventStartTime": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "liveStreamFeedType": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slowBpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "totalXp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriberName": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatarUrl": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "lengthInSeconds": 1959409962,
                "soundsliceSlug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staffPickRating": 685598152,
                "studentId": 1019916057,
                "vimeoVideoId": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtubeVideoId": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        }
    ],
    "included": [
        {
            "type": "parent",
            "id": "1",
            "attributes": {
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        }
    ],
    "meta": {
        "filterOption": {
            "difficulty": [
                "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "Quo nihil asperiores cumque consequatur quisquam. Quia ipsam ut modi eius. Inventore deserunt aspernatur vel ad cum veniam. Neque laboriosam voluptates sunt suscipit cupiditate.",
                "Id ipsa consequatur doloremque quia incidunt non illo iste. Vel sapiente ea consequatur harum velit. Incidunt facere vel quo. Aut molestiae praesentium molestiae autem.",
                "Culpa soluta dolore minima praesentium temporibus. Esse nobis nesciunt officia vero et. Fuga quae maiores accusantium voluptatum id. Voluptas voluptatem neque corporis et. Sed temporibus non sint occaecati omnis."
            ],
            "style": [
                "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "Voluptas incidunt cum ut nihil distinctio rerum. Iusto eaque fugiat non beatae dolor deleniti sed voluptatibus. Sunt aut qui fugit voluptas odit.",
                "Sit ratione odit praesentium assumenda fugiat ut. Et aut et omnis amet tenetur enim. Repudiandae fugit velit in non. Qui repellat velit quas reiciendis. Et et perspiciatis exercitationem ipsam et. Repudiandae qui expedita quia et dolorem quis.",
                "Possimus aliquam atque vel blanditiis praesentium est quod rerum. Itaque quia aut reprehenderit qui eveniet. Reprehenderit laudantium voluptas cum placeat eum. Ab quia et eum dolor. Laborum velit rerum voluptatem voluptates dolorem quaerat."
            ],
            "artist": [
                "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "Tenetur est excepturi explicabo quaerat aut ipsam. Ut incidunt est dolorem eaque. Dolor veniam dicta quam in nemo ea temporibus.",
                "Aut consequuntur ad quisquam commodi incidunt error. Enim sed iste culpa dolores expedita harum accusantium. Molestiae voluptas libero laborum deleniti eligendi. Consequatur dolore molestiae qui a iusto hic.",
                "Odio sunt nam eum sint sit. Consequatur minima voluptatibus blanditiis natus. Dolores deserunt quaerat in et."
            ]
        },
        "pagination": {
            "total": 4,
            "count": 4,
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
                "slug": "Nostrum soluta doloremque hic maxime molestiae. Dignissimos consectetur qui velit maxime. Fuga voluptatem error sunt quia beatae.",
                "type": "course",
                "sort": "1831419982",
                "status": "published",
                "brand": "brand",
                "language": "Iure aut repellendus odio. Est iste impedit cum saepe quaerat. Reiciendis sit iusto optio ut aliquam. Ut rem aut quo neque asperiores magnam quia.",
                "user": "",
                "publishedOn": {
                    "date": "1995-03-28 03:23:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1999-08-06 22:18:46.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1977-05-15 00:25:02.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Quo nihil asperiores cumque consequatur quisquam. Quia ipsam ut modi eius. Inventore deserunt aspernatur vel ad cum veniam. Neque laboriosam voluptates sunt suscipit cupiditate.",
                "homeStaffPickRating": "160658269",
                "legacyId": 1204692758,
                "legacyWordpressPostId": 1224128971,
                "qnaVideo": "Eius tempora blanditiis ab nostrum quaerat sint. Nostrum temporibus perspiciatis ea vero qui culpa fugiat. Cum exercitationem asperiores perspiciatis consequuntur.",
                "style": "Voluptas incidunt cum ut nihil distinctio rerum. Iusto eaque fugiat non beatae dolor deleniti sed voluptatibus. Sunt aut qui fugit voluptas odit.",
                "title": "Veniam aut dolore eligendi occaecati nemo.",
                "xp": 1661250859,
                "album": "Vero quidem rerum consectetur impedit sit alias. Iusto sit autem ut quia eveniet. Quod et laboriosam aut autem totam doloribus facere et. Sit ullam possimus impedit suscipit expedita in deserunt. Pariatur beatae praesentium sequi fugiat.",
                "artist": "Tenetur est excepturi explicabo quaerat aut ipsam. Ut incidunt est dolorem eaque. Dolor veniam dicta quam in nemo ea temporibus.",
                "bpm": "Optio quo officiis accusantium hic. Rerum est velit itaque fugit voluptatem et. Cupiditate qui quia quasi ipsam omnis.",
                "cdTracks": "In nam quis qui et. Numquam dolores consequuntur id odit quidem porro. Sed maiores nihil quam sunt.",
                "chordOrScale": "Omnis iure ipsam inventore omnis assumenda cum in mollitia. Nulla fugiat in ut sint. Reiciendis quam dolorem sit. Quia perspiciatis molestiae sunt ea et unde delectus.",
                "difficultyRange": "Blanditiis et est voluptas itaque. Est illum quo eius cumque. Impedit rerum voluptas eos quibusdam quae recusandae itaque. Quis voluptatem quia porro quae dignissimos. Ea tempora et dolorem nostrum debitis dicta.",
                "episodeNumber": 732680203,
                "exerciseBookPages": "Facere delectus nisi voluptatibus. Error saepe autem quam sunt sapiente. Corrupti quam aut nihil nesciunt quae similique consequuntur. Aut est nostrum rem culpa quae corporis velit. Tempora in et ab ea dignissimos ex.",
                "fastBpm": "Provident molestiae maiores non adipisci quam soluta. Molestias quia autem dolorem numquam. Sed ut adipisci animi cumque delectus aperiam doloremque. Mollitia qui a repellat fugit molestiae.",
                "includesSong": true,
                "instructors": "Eos blanditiis tenetur sit repudiandae facere quo minus. Molestias eos sit quis libero. Ut velit libero aut est officia eius amet.",
                "liveEventStartTime": {
                    "date": "1976-08-08 21:48:38.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1997-11-24 15:47:22.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quisquam sit velit nisi beatae expedita. Quae dolorem saepe sapiente voluptate voluptate. Consequatur rerum tenetur dolorum quo. Ipsam tempore libero consequatur. Similique et vel velit quia vitae.",
                "liveStreamFeedType": "Laudantium sapiente ad in amet velit illum est fugit. Vel inventore voluptates dignissimos minima. Necessitatibus sunt in et quo qui. Libero nobis animi qui sed qui.",
                "name": "Est ut unde maiores repellendus in provident voluptatem. Id nostrum molestias alias similique. Enim harum ut minima incidunt quas. In a beatae excepturi aliquam libero iusto.",
                "released": "Optio voluptates non est totam aut. Ex distinctio ut quaerat aliquam excepturi quod voluptatem maxime. Ut quidem unde dolores quas. Qui ut occaecati minus architecto distinctio.",
                "slowBpm": "Reprehenderit mollitia enim dolores enim. Non non maiores repudiandae id laudantium voluptate. Velit tenetur optio hic dolores.",
                "totalXp": "Harum enim ea sint magni. Officiis dignissimos iste praesentium nihil. Est inventore error deserunt pariatur.",
                "transcriberName": "Nihil dolores quisquam exercitationem inventore. Pariatur odit incidunt vel sit eos tempora sed. Consequuntur libero facilis quis pariatur. Est quod velit repellat laboriosam vitae culpa.",
                "week": 133167258,
                "avatarUrl": "Voluptatem aliquam cumque suscipit hic voluptatum dolores. Deleniti voluptas dolorum cupiditate saepe itaque occaecati. Aut doloremque similique nemo minus temporibus vitae. Alias ex fugiat pariatur repellat sit vero aut.",
                "lengthInSeconds": 736692929,
                "soundsliceSlug": "Vel et possimus quo totam aut ipsam repudiandae. Eius repudiandae ducimus voluptatem eaque accusantium aut est. Dolorum possimus enim quaerat rerum voluptatibus iusto sunt.",
                "staffPickRating": 760484338,
                "studentId": 1890752025,
                "vimeoVideoId": "Ipsa quibusdam molestiae et ab incidunt laborum rerum. Nostrum quaerat voluptatem quibusdam ut eligendi veniam id beatae.",
                "youtubeVideoId": "Et veritatis consequatur natus aut nostrum. Quis nulla autem a velit voluptatem. Eos commodi vel fuga velit ut. Consequatur molestiae tempore quia voluptas vitae ut ducimus ipsam. Aut velit et consequatur provident quia."
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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
                "slug": "Nostrum soluta doloremque hic maxime molestiae. Dignissimos consectetur qui velit maxime. Fuga voluptatem error sunt quia beatae.",
                "type": "course",
                "sort": "1831419982",
                "status": "published",
                "brand": "brand",
                "language": "Iure aut repellendus odio. Est iste impedit cum saepe quaerat. Reiciendis sit iusto optio ut aliquam. Ut rem aut quo neque asperiores magnam quia.",
                "user": "",
                "publishedOn": {
                    "date": "1995-03-28 03:23:15.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1999-08-06 22:18:46.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1977-05-15 00:25:02.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Quo nihil asperiores cumque consequatur quisquam. Quia ipsam ut modi eius. Inventore deserunt aspernatur vel ad cum veniam. Neque laboriosam voluptates sunt suscipit cupiditate.",
                "homeStaffPickRating": "160658269",
                "legacyId": 1204692758,
                "legacyWordpressPostId": 1224128971,
                "qnaVideo": "Eius tempora blanditiis ab nostrum quaerat sint. Nostrum temporibus perspiciatis ea vero qui culpa fugiat. Cum exercitationem asperiores perspiciatis consequuntur.",
                "style": "Voluptas incidunt cum ut nihil distinctio rerum. Iusto eaque fugiat non beatae dolor deleniti sed voluptatibus. Sunt aut qui fugit voluptas odit.",
                "title": "Veniam aut dolore eligendi occaecati nemo.",
                "xp": 1661250859,
                "album": "Vero quidem rerum consectetur impedit sit alias. Iusto sit autem ut quia eveniet. Quod et laboriosam aut autem totam doloribus facere et. Sit ullam possimus impedit suscipit expedita in deserunt. Pariatur beatae praesentium sequi fugiat.",
                "artist": "Tenetur est excepturi explicabo quaerat aut ipsam. Ut incidunt est dolorem eaque. Dolor veniam dicta quam in nemo ea temporibus.",
                "bpm": "Optio quo officiis accusantium hic. Rerum est velit itaque fugit voluptatem et. Cupiditate qui quia quasi ipsam omnis.",
                "cdTracks": "In nam quis qui et. Numquam dolores consequuntur id odit quidem porro. Sed maiores nihil quam sunt.",
                "chordOrScale": "Omnis iure ipsam inventore omnis assumenda cum in mollitia. Nulla fugiat in ut sint. Reiciendis quam dolorem sit. Quia perspiciatis molestiae sunt ea et unde delectus.",
                "difficultyRange": "Blanditiis et est voluptas itaque. Est illum quo eius cumque. Impedit rerum voluptas eos quibusdam quae recusandae itaque. Quis voluptatem quia porro quae dignissimos. Ea tempora et dolorem nostrum debitis dicta.",
                "episodeNumber": 732680203,
                "exerciseBookPages": "Facere delectus nisi voluptatibus. Error saepe autem quam sunt sapiente. Corrupti quam aut nihil nesciunt quae similique consequuntur. Aut est nostrum rem culpa quae corporis velit. Tempora in et ab ea dignissimos ex.",
                "fastBpm": "Provident molestiae maiores non adipisci quam soluta. Molestias quia autem dolorem numquam. Sed ut adipisci animi cumque delectus aperiam doloremque. Mollitia qui a repellat fugit molestiae.",
                "includesSong": true,
                "instructors": "Eos blanditiis tenetur sit repudiandae facere quo minus. Molestias eos sit quis libero. Ut velit libero aut est officia eius amet.",
                "liveEventStartTime": {
                    "date": "1976-08-08 21:48:38.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1997-11-24 15:47:22.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quisquam sit velit nisi beatae expedita. Quae dolorem saepe sapiente voluptate voluptate. Consequatur rerum tenetur dolorum quo. Ipsam tempore libero consequatur. Similique et vel velit quia vitae.",
                "liveStreamFeedType": "Laudantium sapiente ad in amet velit illum est fugit. Vel inventore voluptates dignissimos minima. Necessitatibus sunt in et quo qui. Libero nobis animi qui sed qui.",
                "name": "Est ut unde maiores repellendus in provident voluptatem. Id nostrum molestias alias similique. Enim harum ut minima incidunt quas. In a beatae excepturi aliquam libero iusto.",
                "released": "Optio voluptates non est totam aut. Ex distinctio ut quaerat aliquam excepturi quod voluptatem maxime. Ut quidem unde dolores quas. Qui ut occaecati minus architecto distinctio.",
                "slowBpm": "Reprehenderit mollitia enim dolores enim. Non non maiores repudiandae id laudantium voluptate. Velit tenetur optio hic dolores.",
                "totalXp": "Harum enim ea sint magni. Officiis dignissimos iste praesentium nihil. Est inventore error deserunt pariatur.",
                "transcriberName": "Nihil dolores quisquam exercitationem inventore. Pariatur odit incidunt vel sit eos tempora sed. Consequuntur libero facilis quis pariatur. Est quod velit repellat laboriosam vitae culpa.",
                "week": 133167258,
                "avatarUrl": "Voluptatem aliquam cumque suscipit hic voluptatum dolores. Deleniti voluptas dolorum cupiditate saepe itaque occaecati. Aut doloremque similique nemo minus temporibus vitae. Alias ex fugiat pariatur repellat sit vero aut.",
                "lengthInSeconds": 736692929,
                "soundsliceSlug": "Vel et possimus quo totam aut ipsam repudiandae. Eius repudiandae ducimus voluptatem eaque accusantium aut est. Dolorum possimus enim quaerat rerum voluptatibus iusto sunt.",
                "staffPickRating": 760484338,
                "studentId": 1890752025,
                "vimeoVideoId": "Ipsa quibusdam molestiae et ab incidunt laborum rerum. Nostrum quaerat voluptatem quibusdam ut eligendi veniam id beatae.",
                "youtubeVideoId": "Et veritatis consequatur natus aut nostrum. Quis nulla autem a velit voluptatem. Eos commodi vel fuga velit ut. Consequatur molestiae tempore quia voluptas vitae ut ducimus ipsam. Aut velit et consequatur provident quia."
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "publishedOn": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "homeStaffPickRating": "108695283",
                "legacyId": 1237496537,
                "legacyWordpressPostId": 1342890876,
                "qnaVideo": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cdTracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chordOrScale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficultyRange": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episodeNumber": 589344364,
                "exerciseBookPages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fastBpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includesSong": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "liveEventStartTime": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "liveStreamFeedType": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slowBpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "totalXp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriberName": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatarUrl": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "lengthInSeconds": 1959409962,
                "soundsliceSlug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staffPickRating": 685598152,
                "studentId": 1019916057,
                "vimeoVideoId": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtubeVideoId": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        }
    ],
    "included": [
        {
            "type": "parent",
            "id": "1",
            "attributes": {
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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
            "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
            "type": "course",
            "sort": "1446138136",
            "status": "published",
            "brand": "brand",
            "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
            "user": "",
            "publishedOn": {
                "date": "1971-05-17 03:07:44.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "archivedOn": {
                "date": "1971-03-18 23:39:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "2000-05-30 00:35:45.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
            "homeStaffPickRating": "108695283",
            "legacyId": 1237496537,
            "legacyWordpressPostId": 1342890876,
            "qnaVideo": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
            "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
            "title": "Maiores excepturi iure quis velit dicta.",
            "xp": 1081763825,
            "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
            "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
            "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
            "cdTracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
            "chordOrScale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
            "difficultyRange": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
            "episodeNumber": 589344364,
            "exerciseBookPages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
            "fastBpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
            "includesSong": true,
            "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
            "liveEventStartTime": {
                "date": "2007-07-27 12:02:54.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1976-10-31 04:47:06.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
            "liveStreamFeedType": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
            "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
            "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
            "slowBpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
            "totalXp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
            "transcriberName": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
            "week": 376217367,
            "avatarUrl": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
            "lengthInSeconds": 1959409962,
            "soundsliceSlug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
            "staffPickRating": 685598152,
            "studentId": 1019916057,
            "vimeoVideoId": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
            "youtubeVideoId": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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
        "id": "5",
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
                "slug": "Necessitatibus id fuga minima magni ullam. Numquam mollitia qui quia dolorum temporibus inventore nemo. Non voluptate velit animi. Excepturi beatae enim illo ut amet dolore. Est recusandae quo animi qui.",
                "type": "course",
                "sort": "1446138136",
                "status": "published",
                "brand": "brand",
                "language": "Sequi aliquid est et beatae consequatur. Non autem minus dicta pariatur dignissimos. Autem magni tenetur minima. Corporis id unde nobis. Dolorem nulla asperiores atque architecto nemo minima natus. Est enim error itaque velit.",
                "user": "",
                "published_on": {
                    "date": "1971-05-17 03:07:44.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        },
        {
            "type": "parent",
            "id": "2",
            "attributes": {
                "child_position": 2
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
            "language": "necessitatibus",
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
            "sort": "1446138136",
            "status": "draft",
            "brand": "brand",
            "language": "necessitatibus",
            "user": "1",
            "publishedOn": "2019-05-21 21:20:10",
            "archivedOn": {
                "date": "1971-03-18 23:39:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "2000-05-30 00:35:45.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
            "homeStaffPickRating": "108695283",
            "legacyId": 1237496537,
            "legacyWordpressPostId": 1342890876,
            "qnaVideo": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
            "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
            "title": "Maiores excepturi iure quis velit dicta.",
            "xp": 1081763825,
            "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
            "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
            "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
            "cdTracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
            "chordOrScale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
            "difficultyRange": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
            "episodeNumber": 589344364,
            "exerciseBookPages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
            "fastBpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
            "includesSong": true,
            "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
            "liveEventStartTime": {
                "date": "2007-07-27 12:02:54.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1976-10-31 04:47:06.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
            "liveStreamFeedType": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
            "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
            "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
            "slowBpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
            "totalXp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
            "transcriberName": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
            "week": 376217367,
            "avatarUrl": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
            "lengthInSeconds": 1959409962,
            "soundsliceSlug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
            "staffPickRating": 685598152,
            "studentId": 1019916057,
            "vimeoVideoId": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
            "youtubeVideoId": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
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
                "slug": "02-getting-started",
                "type": "course",
                "sort": "1446138136",
                "status": "draft",
                "brand": "brand",
                "language": "necessitatibus",
                "user": "1",
                "published_on": "2019-05-21 21:20:10",
                "archived_on": {
                    "date": "1971-03-18 23:39:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2000-05-30 00:35:45.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Porro sit sunt tempora rem quas architecto. Molestiae ducimus sint a a aperiam pariatur sit. Labore excepturi quia minus sit.",
                "home_staff_pick_rating": "108695283",
                "legacy_id": 1237496537,
                "legacy_wordpress_post_id": 1342890876,
                "qna_video": "Debitis optio nulla numquam neque. Expedita aliquid voluptatum amet quae magni fugiat accusantium. Velit qui eum sint qui debitis inventore iusto. Accusamus fugit beatae quia nam.",
                "style": "Incidunt sapiente earum culpa ea accusamus cum ab. Veniam occaecati odit veritatis. Molestias sed voluptatem quisquam impedit. Qui unde quia harum eos ad ullam. Aut vel esse et alias sed. Iure sunt debitis harum nihil officia.",
                "title": "Maiores excepturi iure quis velit dicta.",
                "xp": 1081763825,
                "album": "A non et sed eos in suscipit. Molestiae modi dignissimos eveniet similique eum nobis minus. Vitae hic soluta sit dolor at et. Non modi consequatur nesciunt facilis id. In a libero doloremque consectetur. Molestiae sed repellendus quod esse.",
                "artist": "Voluptate ducimus libero sunt atque. Id laudantium itaque nihil non laborum. Et saepe dolor et beatae. Ad molestiae impedit itaque harum architecto.",
                "bpm": "Est placeat repudiandae qui ut quia. Velit aut dolorem tempore. Libero sit ex commodi ut delectus. Qui quia ut deserunt velit provident.",
                "cd_tracks": "Temporibus nisi consequatur sed quod numquam dolores. Dolores natus consequatur sed nobis blanditiis quia ut voluptatem. Illo dolorum deserunt non eos ut qui nihil. Nihil facere ea sapiente sit. Autem quidem excepturi omnis dolores.",
                "chord_or_scale": "Eaque blanditiis corrupti corrupti et. Reprehenderit quia suscipit ipsa quidem corrupti. Dolore harum nisi enim fugit. Ea enim voluptatum omnis vel sint provident.",
                "difficulty_range": "Non minima dolor occaecati vitae. Voluptatem ut magnam alias voluptatem. Quia assumenda et exercitationem numquam perferendis. Fugit quis et non accusantium. Dignissimos eaque voluptatum minima voluptatibus. Et est rerum impedit ea ex tempore.",
                "episode_number": 589344364,
                "exercise_book_pages": "Velit blanditiis sunt nesciunt sed nostrum quo perferendis. At voluptate beatae delectus consectetur non aliquid qui totam. Et consequuntur voluptatibus velit ut. Est qui quisquam odio eos.",
                "fast_bpm": "Recusandae est nulla magni aut sed iusto aperiam. Modi porro soluta molestias earum facilis at labore. Debitis occaecati sed aspernatur sequi laudantium iusto beatae.",
                "includes_song": true,
                "instructors": "Enim et aut tempora. Veritatis adipisci distinctio accusamus. Esse quas autem iusto libero doloremque modi ducimus. Ut eligendi reprehenderit distinctio et ex nulla eligendi.",
                "live_event_start_time": {
                    "date": "2007-07-27 12:02:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1976-10-31 04:47:06.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Quibusdam error sint labore optio voluptates. Perspiciatis aspernatur enim sed ut. Dolor ratione id rem reprehenderit nulla eius dicta dignissimos.",
                "live_stream_feed_type": "Perferendis est et nisi labore libero. Sapiente magni et dolorem possimus. Voluptates repellendus voluptas et sint. Quia labore consequatur temporibus. Vel consequatur qui id aspernatur ut. Sed iusto modi aspernatur nulla et repudiandae quo libero.",
                "name": "Error error quae ipsum quaerat molestias. Tempora laboriosam sed ab excepturi aut quia. Ad et deleniti occaecati minus ad.",
                "released": "Odio fugiat dolorum omnis et quia voluptas sit sequi. Nobis recusandae natus ut labore et. Beatae molestiae necessitatibus et dolorum sed.",
                "slow_bpm": "Dolores neque optio porro ex quisquam repudiandae eum. Qui autem ipsa perferendis neque voluptatem et molestiae. Inventore qui et eius esse ipsam nulla.",
                "total_xp": "Animi suscipit ducimus quo vel hic. Pariatur voluptate nobis quia quo et. Dolores quaerat perferendis nam.",
                "transcriber_name": "Non qui doloremque facere aut minus tempora rerum. Dicta nemo et ducimus ut totam assumenda alias. Laudantium odio dolorem est placeat ipsa ipsum non illo. Et perspiciatis magni quae inventore.",
                "week": 376217367,
                "avatar_url": "Aut voluptatem quia nisi similique. Facilis exercitationem maxime molestiae et odit est ut. Dolorum distinctio aut id numquam possimus reiciendis maiores.",
                "length_in_seconds": 1959409962,
                "soundslice_slug": "Esse et aut nulla amet iusto vitae dolor. In id aspernatur ea nisi quisquam eaque eius. Quibusdam deleniti a et culpa et voluptate et. Et aspernatur magnam dolores nihil quia laudantium. Qui qui porro minima autem perferendis assumenda.",
                "staff_pick_rating": 685598152,
                "student_id": 1019916057,
                "vimeo_video_id": "Sed eius quia suscipit adipisci sunt. Possimus doloribus amet consectetur velit. Natus sint debitis voluptate dolor enim. Id cupiditate magnam optio sequi facere.",
                "youtube_video_id": "Pariatur quia vitae sed harum et quia. Vel rerum ut ut officiis voluptatem distinctio nobis. Voluptatem aperiam omnis voluptates quis. Est assumenda quod sit voluptatem quis voluptatem id."
            }
        },
        {
            "type": "parent",
            "id": "2",
            "attributes": {
                "child_position": 2
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

### Response Example (204):

```json
null
```




<!-- END_6db1e06526b714b35026eddcf5e1efb9 -->

