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
|body|sort|    |Default:-published_on.|
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
    "sort": "-published_on",
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
                "slug": "Accusantium porro numquam facilis accusamus delectus optio et. Atque ex quod est sit non saepe non. Vitae non eveniet voluptatibus praesentium atque fuga minima. Reiciendis quis eum animi soluta. Ipsum maiores expedita earum animi numquam.",
                "type": "course",
                "sort": "1452119573",
                "status": "published",
                "brand": "brand",
                "language": "Et voluptatem dolores ipsa laborum expedita ducimus. Ipsa eaque consectetur nihil. Tenetur tempora ex dolores et quas. Debitis non delectus perspiciatis amet. Et omnis ut ut totam enim tempora minima. Ut soluta eius unde et illo et.",
                "user": "1",
                "publishedOn": {
                    "date": "2000-01-01 04:27:47.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "2017-02-23 05:30:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2007-05-25 12:57:02.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Vel dolorem beatae inventore. Dolor ducimus quia velit ipsum voluptatem nulla dolores. Fugiat sit porro ad quis nobis quisquam accusantium.",
                "homeStaffPickRating": "485999414",
                "legacyId": 1269980887,
                "legacyWordpressPostId": 504943709,
                "qnaVideo": "Voluptate saepe et velit ducimus labore dignissimos. Natus voluptatem amet cum beatae. Minus vel est cum recusandae autem dolores.",
                "style": "Dicta quia sint deserunt quia. Occaecati quam provident voluptas labore ad unde. Odit in sed id enim occaecati. Doloribus voluptates et sed praesentium sit autem dolorem velit.",
                "title": "Assumenda nostrum quas veritatis corrupti.",
                "xp": 1666894316,
                "album": "Aperiam sit facilis iure rerum in repudiandae expedita temporibus. Voluptates quos aut laboriosam excepturi accusantium. Debitis eum velit accusamus qui quasi perferendis. Aliquam quasi libero qui corrupti quod perspiciatis qui ut.",
                "artist": "Eum quia doloribus et perspiciatis qui reprehenderit illum. Id vero labore suscipit et pariatur autem. Molestiae dolorem occaecati repudiandae doloremque alias ad. Quia eum rem quam assumenda.",
                "bpm": "Porro error quo quibusdam est atque reiciendis. Et dolorem autem rerum ab quas at. Dolores quo ut totam nam facere neque magni. Enim fugiat vel corrupti dolorem reiciendis omnis.",
                "cdTracks": "Nesciunt ab nostrum totam similique soluta dignissimos ut eum. Impedit autem ipsum commodi sint sint totam. Ad doloribus minus exercitationem dolorem. Dignissimos enim dolor itaque et. Alias veritatis vero pariatur vel sed labore nemo.",
                "chordOrScale": "Reprehenderit dicta officia aspernatur et impedit iste. Et sed nesciunt accusantium voluptate doloribus nesciunt amet. Ut voluptatibus aut esse aut error et quasi. Voluptatem facere debitis eius. Rerum blanditiis qui sint ut asperiores blanditiis.",
                "difficultyRange": "Sapiente corrupti excepturi repellat placeat autem exercitationem expedita. Libero excepturi sunt explicabo officia accusantium. Possimus cupiditate sint qui. Aliquam sit est excepturi.",
                "episodeNumber": 1706662374,
                "exerciseBookPages": "Consequatur ut repellat et animi rerum cumque. Aut odit ea ea ut sit et quam est. Commodi neque reiciendis voluptatem quia dolorem ut. Quo molestias aliquam itaque aliquid et voluptate id quae.",
                "fastBpm": "Nobis tenetur et debitis dicta omnis nostrum fuga et. Vel sunt ad beatae voluptas reprehenderit. Quasi est autem quam doloribus. Ratione animi est est nam reprehenderit ea sint. Officiis exercitationem alias nostrum itaque.",
                "includesSong": true,
                "instructors": "Ut unde ipsa nostrum animi ut officiis laborum. In non est ut quis adipisci facere. Est et nulla eum quia odio.",
                "liveEventStartTime": {
                    "date": "2002-01-21 22:33:54.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1988-12-15 15:39:53.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Distinctio vel qui ipsa accusamus. Sit corrupti qui qui ea. Atque pariatur et fuga consequuntur. Unde error iste explicabo sed odit excepturi suscipit. Voluptas earum aut tempore doloremque assumenda.",
                "liveStreamFeedType": "Ut deleniti et asperiores est explicabo aut. Iste impedit minima laudantium eos odit illum. Sed sed enim magni animi. Suscipit eaque qui porro rem tenetur. Est autem quam corporis veniam suscipit fugit est.",
                "name": "Dignissimos voluptatibus id ex sit. Dolores inventore nam magni a. Quas minima dolorem labore quaerat. Officia aliquid quae voluptatibus.",
                "released": "Eos neque sint porro. Aut vero temporibus officiis. Est nostrum in asperiores voluptas distinctio rerum ut.",
                "slowBpm": "Eaque placeat eos quam enim. Voluptatem a minima voluptatem rerum inventore deserunt. Est est quos voluptates ipsam. Dolore quibusdam ut eligendi aut veritatis eligendi in. Illum sint molestias quia aut iusto corrupti.",
                "totalXp": "Dignissimos sit reprehenderit hic porro eaque laborum. Quia tempora corrupti ipsam nulla tempore beatae rem sed. Deserunt at illum impedit optio aspernatur laboriosam consectetur.",
                "transcriberName": "Et distinctio provident fuga sapiente. Omnis ullam ut qui placeat natus. Non non quasi illum et. Delectus modi maiores ut sed.",
                "week": 1372378284,
                "avatarUrl": "Fugit dolorem maiores aspernatur minus eligendi cupiditate explicabo. Magni molestias omnis amet ratione et. Cumque qui aut temporibus ea nam qui debitis. Nemo commodi voluptas dolores distinctio nihil.",
                "lengthInSeconds": 1953754223,
                "soundsliceSlug": "Sit accusantium id ut odio. Et reprehenderit alias quis totam voluptas quae. Quas rerum fugiat asperiores vel.",
                "staffPickRating": 375144910,
                "studentId": 62717361,
                "vimeoVideoId": "Omnis labore est corrupti praesentium dolores et. Repellendus qui accusamus voluptatibus iusto quos quis velit. Occaecati nisi necessitatibus omnis provident quidem.",
                "youtubeVideoId": "Enim maxime aut saepe natus aut pariatur cum eum. Non modi dolores cupiditate. Illum aut in nisi quia. Aliquid dolores repellat id beatae hic pariatur."
            }
        },
        {
            "type": "content",
            "id": "2",
            "attributes": {
                "slug": "Id inventore est enim expedita quia commodi voluptate. Ut ut ducimus repellat non. Sunt in impedit sapiente voluptas autem dolores. Nisi libero voluptas sequi doloremque sit. Facere rem quae inventore. Quaerat dolor distinctio fuga accusamus dolorum.",
                "type": "course",
                "sort": "1136220408",
                "status": "published",
                "brand": "brand",
                "language": "Consequuntur quidem harum mollitia recusandae sequi hic dicta. Ea repellat praesentium provident repellendus et. Harum ipsam et et corrupti.",
                "user": "1",
                "publishedOn": {
                    "date": "1998-12-03 19:50:36.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1989-10-02 17:49:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1983-04-10 11:16:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Consequatur sit nostrum ut officiis perspiciatis et et sit. Tempore officia possimus optio voluptatum at cum. Tempore officia dolor et eos qui inventore voluptatibus veniam. Iure id ratione excepturi et.",
                "homeStaffPickRating": "2103125775",
                "legacyId": 341536101,
                "legacyWordpressPostId": 65556271,
                "qnaVideo": "Omnis corrupti fuga modi aut odio animi odio quos. Voluptas eligendi provident nostrum alias reiciendis optio. Asperiores voluptas sit et dolorem culpa. Nemo corrupti quibusdam debitis ut doloribus quos debitis.",
                "style": "Qui mollitia at nihil voluptatem numquam velit. Neque quia aut ad debitis eveniet. Quidem minima ipsum incidunt exercitationem exercitationem itaque.",
                "title": "Tempore maiores nam corrupti voluptatem.",
                "xp": 921126235,
                "album": "Sint quo voluptatibus sequi fuga. Optio cum aspernatur vel architecto. Numquam et adipisci laboriosam rem. Quia nam dignissimos illo aliquid deleniti porro.",
                "artist": "Quia est molestiae nesciunt modi deserunt. Sed at vitae est qui necessitatibus. Hic quas sunt ut odio error aut nihil. Quia est et qui voluptatem cum. Qui consequatur id maxime consequatur dolor non quos.",
                "bpm": "Repudiandae similique quae aut explicabo vero quia. Tempore nulla saepe temporibus enim id et. Minus et magnam commodi quis voluptas odio. Laboriosam et atque iste. Cum quisquam dolor natus. Aut commodi ut similique harum commodi porro accusantium.",
                "cdTracks": "Vitae ratione ut omnis ad. Nemo voluptatem error illo libero vel dolorem. Est corporis qui distinctio ipsam. Beatae magni autem ea.",
                "chordOrScale": "Eos repudiandae beatae fugiat consequatur tempore maiores. Voluptate dolorem fugit sit asperiores odit. Ut exercitationem quae quae earum iure ad. Aut ducimus vel provident quae non consequatur.",
                "difficultyRange": "Ipsam architecto recusandae a. Voluptatum rerum qui voluptatem itaque libero delectus quia.",
                "episodeNumber": 1845016899,
                "exerciseBookPages": "Ut vel consequatur provident id error. Expedita facere impedit ducimus. Pariatur aut accusamus est et sed nihil harum ut. Possimus omnis facere doloribus aliquam. Qui quo rem mollitia eum atque. Ex dolor velit cum molestias aut.",
                "fastBpm": "Fugiat consequatur eum autem veritatis ipsum. Molestiae aspernatur sint explicabo repellat beatae. Accusantium adipisci impedit aut ut porro aut qui. Aliquam commodi sit excepturi tenetur placeat iure repellendus.",
                "includesSong": true,
                "instructors": "Expedita voluptates veritatis consequatur illo dolore sint dolor. Doloribus commodi id quibusdam non ipsam. Eligendi ipsa et itaque facilis aut. Accusantium distinctio tempora optio quibusdam quisquam unde.",
                "liveEventStartTime": {
                    "date": "1973-09-23 23:37:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "2017-04-06 05:44:17.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Consequatur cupiditate molestias placeat atque. Dicta occaecati veritatis sunt minima qui. Voluptates nulla recusandae cupiditate placeat et non rerum. Doloremque est quis voluptas voluptas eveniet odit deserunt.",
                "liveStreamFeedType": "Dolores sapiente in voluptatem esse. Similique necessitatibus reprehenderit id aut natus nemo ut. Libero aut odio ducimus nesciunt repellendus magnam voluptas. Porro ut voluptatibus voluptatem consequatur.",
                "name": "Asperiores sed debitis iste reiciendis modi voluptatem debitis. Optio vero est quia repellat reiciendis temporibus. Consectetur accusamus voluptatibus facere occaecati perspiciatis facilis.",
                "released": "Quidem ullam ipsa minus in debitis eius minus. Velit voluptatum voluptatem quidem fugiat accusamus ipsum. Vero sunt quibusdam expedita at accusamus deleniti ullam. Repellat tenetur animi error rem. Aut sunt et dicta molestiae harum dolorem.",
                "slowBpm": "Pariatur nulla maiores cumque voluptatem. Qui sint laudantium sint aut eius voluptatem occaecati et. Nobis aut id voluptatibus provident.",
                "totalXp": "Et ut blanditiis repellat voluptatibus et impedit exercitationem. Modi nam voluptas magnam. Sint repellat rerum quod labore exercitationem nam itaque.",
                "transcriberName": "A distinctio ducimus nobis sit et quidem. Est aspernatur sed soluta et. Labore excepturi voluptas quaerat voluptas facere. Blanditiis eos ducimus quia non rerum vel repellendus aut. Repellat ut quis dolore et sunt vero.",
                "week": 257115133,
                "avatarUrl": "Deleniti dolorem qui hic quia natus ullam. Ut ut praesentium quo recusandae aut sunt.",
                "lengthInSeconds": 2113101049,
                "soundsliceSlug": "Recusandae accusamus vitae ea non repellendus. Nulla fuga dignissimos porro neque. Est sed quia nesciunt maiores. Commodi in a sint molestiae nam maiores dolores ut.",
                "staffPickRating": 2034941493,
                "studentId": 796409932,
                "vimeoVideoId": "Eos placeat mollitia explicabo et qui repellat iusto. Consequatur qui aut explicabo sapiente. Aut expedita sed fugit voluptates. Commodi quae vel autem eveniet sit vero cum.",
                "youtubeVideoId": "Neque ducimus est omnis sed veritatis enim. Aliquam excepturi quidem at suscipit aliquam quia ea eligendi. Ex sequi quaerat dolores libero aut. Odit repudiandae illo adipisci sapiente."
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "publishedOn": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "homeStaffPickRating": "316288058",
                "legacyId": 1920143894,
                "legacyWordpressPostId": 950948364,
                "qnaVideo": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cdTracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chordOrScale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficultyRange": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episodeNumber": 100534324,
                "exerciseBookPages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fastBpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includesSong": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "liveEventStartTime": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "liveStreamFeedType": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slowBpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "totalXp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriberName": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatarUrl": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "lengthInSeconds": 1953132732,
                "soundsliceSlug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staffPickRating": 961041226,
                "studentId": 524121876,
                "vimeoVideoId": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtubeVideoId": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "published_on": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
            }
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "Fugit tenetur praesentium quae eum deleniti. Temporibus voluptatem eius sit id. Et quas in reprehenderit eligendi reiciendis ex perspiciatis.",
                "value": "Eum nemo eos quia repellat quaerat animi accusantium. Vel odit corrupti ea dolorem dolor. Minima reiciendis occaecati reprehenderit et nisi. Aliquam aut sit laborum ut perspiciatis. Quasi ut cum tempora tempore mollitia omnis.",
                "position": 6071148
            }
        }
    ],
    "meta": {
        "filterOption": {
            "difficulty": [
                "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "Consequatur sit nostrum ut officiis perspiciatis et et sit. Tempore officia possimus optio voluptatum at cum. Tempore officia dolor et eos qui inventore voluptatibus veniam. Iure id ratione excepturi et.",
                "Vel dolorem beatae inventore. Dolor ducimus quia velit ipsum voluptatem nulla dolores. Fugiat sit porro ad quis nobis quisquam accusantium."
            ],
            "style": [
                "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "Qui mollitia at nihil voluptatem numquam velit. Neque quia aut ad debitis eveniet. Quidem minima ipsum incidunt exercitationem exercitationem itaque.",
                "Dicta quia sint deserunt quia. Occaecati quam provident voluptas labore ad unde. Odit in sed id enim occaecati. Doloribus voluptates et sed praesentium sit autem dolorem velit."
            ],
            "artist": [
                "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "Quia est molestiae nesciunt modi deserunt. Sed at vitae est qui necessitatibus. Hic quas sunt ut odio error aut nihil. Quia est et qui voluptatem cum. Qui consequatur id maxime consequatur dolor non quos.",
                "Eum quia doloribus et perspiciatis qui reprehenderit illum. Id vero labore suscipit et pariatur autem. Molestiae dolorem occaecati repudiandae doloremque alias ad. Quia eum rem quam assumenda."
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
                "slug": "Id inventore est enim expedita quia commodi voluptate. Ut ut ducimus repellat non. Sunt in impedit sapiente voluptas autem dolores. Nisi libero voluptas sequi doloremque sit. Facere rem quae inventore. Quaerat dolor distinctio fuga accusamus dolorum.",
                "type": "course",
                "sort": "1136220408",
                "status": "published",
                "brand": "brand",
                "language": "Consequuntur quidem harum mollitia recusandae sequi hic dicta. Ea repellat praesentium provident repellendus et. Harum ipsam et et corrupti.",
                "user": "1",
                "publishedOn": {
                    "date": "1998-12-03 19:50:36.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1989-10-02 17:49:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1983-04-10 11:16:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Consequatur sit nostrum ut officiis perspiciatis et et sit. Tempore officia possimus optio voluptatum at cum. Tempore officia dolor et eos qui inventore voluptatibus veniam. Iure id ratione excepturi et.",
                "homeStaffPickRating": "2103125775",
                "legacyId": 341536101,
                "legacyWordpressPostId": 65556271,
                "qnaVideo": "Omnis corrupti fuga modi aut odio animi odio quos. Voluptas eligendi provident nostrum alias reiciendis optio. Asperiores voluptas sit et dolorem culpa. Nemo corrupti quibusdam debitis ut doloribus quos debitis.",
                "style": "Qui mollitia at nihil voluptatem numquam velit. Neque quia aut ad debitis eveniet. Quidem minima ipsum incidunt exercitationem exercitationem itaque.",
                "title": "Tempore maiores nam corrupti voluptatem.",
                "xp": 921126235,
                "album": "Sint quo voluptatibus sequi fuga. Optio cum aspernatur vel architecto. Numquam et adipisci laboriosam rem. Quia nam dignissimos illo aliquid deleniti porro.",
                "artist": "Quia est molestiae nesciunt modi deserunt. Sed at vitae est qui necessitatibus. Hic quas sunt ut odio error aut nihil. Quia est et qui voluptatem cum. Qui consequatur id maxime consequatur dolor non quos.",
                "bpm": "Repudiandae similique quae aut explicabo vero quia. Tempore nulla saepe temporibus enim id et. Minus et magnam commodi quis voluptas odio. Laboriosam et atque iste. Cum quisquam dolor natus. Aut commodi ut similique harum commodi porro accusantium.",
                "cdTracks": "Vitae ratione ut omnis ad. Nemo voluptatem error illo libero vel dolorem. Est corporis qui distinctio ipsam. Beatae magni autem ea.",
                "chordOrScale": "Eos repudiandae beatae fugiat consequatur tempore maiores. Voluptate dolorem fugit sit asperiores odit. Ut exercitationem quae quae earum iure ad. Aut ducimus vel provident quae non consequatur.",
                "difficultyRange": "Ipsam architecto recusandae a. Voluptatum rerum qui voluptatem itaque libero delectus quia.",
                "episodeNumber": 1845016899,
                "exerciseBookPages": "Ut vel consequatur provident id error. Expedita facere impedit ducimus. Pariatur aut accusamus est et sed nihil harum ut. Possimus omnis facere doloribus aliquam. Qui quo rem mollitia eum atque. Ex dolor velit cum molestias aut.",
                "fastBpm": "Fugiat consequatur eum autem veritatis ipsum. Molestiae aspernatur sint explicabo repellat beatae. Accusantium adipisci impedit aut ut porro aut qui. Aliquam commodi sit excepturi tenetur placeat iure repellendus.",
                "includesSong": true,
                "instructors": "Expedita voluptates veritatis consequatur illo dolore sint dolor. Doloribus commodi id quibusdam non ipsam. Eligendi ipsa et itaque facilis aut. Accusantium distinctio tempora optio quibusdam quisquam unde.",
                "liveEventStartTime": {
                    "date": "1973-09-23 23:37:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "2017-04-06 05:44:17.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Consequatur cupiditate molestias placeat atque. Dicta occaecati veritatis sunt minima qui. Voluptates nulla recusandae cupiditate placeat et non rerum. Doloremque est quis voluptas voluptas eveniet odit deserunt.",
                "liveStreamFeedType": "Dolores sapiente in voluptatem esse. Similique necessitatibus reprehenderit id aut natus nemo ut. Libero aut odio ducimus nesciunt repellendus magnam voluptas. Porro ut voluptatibus voluptatem consequatur.",
                "name": "Asperiores sed debitis iste reiciendis modi voluptatem debitis. Optio vero est quia repellat reiciendis temporibus. Consectetur accusamus voluptatibus facere occaecati perspiciatis facilis.",
                "released": "Quidem ullam ipsa minus in debitis eius minus. Velit voluptatum voluptatem quidem fugiat accusamus ipsum. Vero sunt quibusdam expedita at accusamus deleniti ullam. Repellat tenetur animi error rem. Aut sunt et dicta molestiae harum dolorem.",
                "slowBpm": "Pariatur nulla maiores cumque voluptatem. Qui sint laudantium sint aut eius voluptatem occaecati et. Nobis aut id voluptatibus provident.",
                "totalXp": "Et ut blanditiis repellat voluptatibus et impedit exercitationem. Modi nam voluptas magnam. Sint repellat rerum quod labore exercitationem nam itaque.",
                "transcriberName": "A distinctio ducimus nobis sit et quidem. Est aspernatur sed soluta et. Labore excepturi voluptas quaerat voluptas facere. Blanditiis eos ducimus quia non rerum vel repellendus aut. Repellat ut quis dolore et sunt vero.",
                "week": 257115133,
                "avatarUrl": "Deleniti dolorem qui hic quia natus ullam. Ut ut praesentium quo recusandae aut sunt.",
                "lengthInSeconds": 2113101049,
                "soundsliceSlug": "Recusandae accusamus vitae ea non repellendus. Nulla fuga dignissimos porro neque. Est sed quia nesciunt maiores. Commodi in a sint molestiae nam maiores dolores ut.",
                "staffPickRating": 2034941493,
                "studentId": 796409932,
                "vimeoVideoId": "Eos placeat mollitia explicabo et qui repellat iusto. Consequatur qui aut explicabo sapiente. Aut expedita sed fugit voluptates. Commodi quae vel autem eveniet sit vero cum.",
                "youtubeVideoId": "Neque ducimus est omnis sed veritatis enim. Aliquam excepturi quidem at suscipit aliquam quia ea eligendi. Ex sequi quaerat dolores libero aut. Odit repudiandae illo adipisci sapiente."
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "published_on": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                "slug": "Id inventore est enim expedita quia commodi voluptate. Ut ut ducimus repellat non. Sunt in impedit sapiente voluptas autem dolores. Nisi libero voluptas sequi doloremque sit. Facere rem quae inventore. Quaerat dolor distinctio fuga accusamus dolorum.",
                "type": "course",
                "sort": "1136220408",
                "status": "published",
                "brand": "brand",
                "language": "Consequuntur quidem harum mollitia recusandae sequi hic dicta. Ea repellat praesentium provident repellendus et. Harum ipsam et et corrupti.",
                "user": "1",
                "publishedOn": {
                    "date": "1998-12-03 19:50:36.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1989-10-02 17:49:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "1983-04-10 11:16:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Consequatur sit nostrum ut officiis perspiciatis et et sit. Tempore officia possimus optio voluptatum at cum. Tempore officia dolor et eos qui inventore voluptatibus veniam. Iure id ratione excepturi et.",
                "homeStaffPickRating": "2103125775",
                "legacyId": 341536101,
                "legacyWordpressPostId": 65556271,
                "qnaVideo": "Omnis corrupti fuga modi aut odio animi odio quos. Voluptas eligendi provident nostrum alias reiciendis optio. Asperiores voluptas sit et dolorem culpa. Nemo corrupti quibusdam debitis ut doloribus quos debitis.",
                "style": "Qui mollitia at nihil voluptatem numquam velit. Neque quia aut ad debitis eveniet. Quidem minima ipsum incidunt exercitationem exercitationem itaque.",
                "title": "Tempore maiores nam corrupti voluptatem.",
                "xp": 921126235,
                "album": "Sint quo voluptatibus sequi fuga. Optio cum aspernatur vel architecto. Numquam et adipisci laboriosam rem. Quia nam dignissimos illo aliquid deleniti porro.",
                "artist": "Quia est molestiae nesciunt modi deserunt. Sed at vitae est qui necessitatibus. Hic quas sunt ut odio error aut nihil. Quia est et qui voluptatem cum. Qui consequatur id maxime consequatur dolor non quos.",
                "bpm": "Repudiandae similique quae aut explicabo vero quia. Tempore nulla saepe temporibus enim id et. Minus et magnam commodi quis voluptas odio. Laboriosam et atque iste. Cum quisquam dolor natus. Aut commodi ut similique harum commodi porro accusantium.",
                "cdTracks": "Vitae ratione ut omnis ad. Nemo voluptatem error illo libero vel dolorem. Est corporis qui distinctio ipsam. Beatae magni autem ea.",
                "chordOrScale": "Eos repudiandae beatae fugiat consequatur tempore maiores. Voluptate dolorem fugit sit asperiores odit. Ut exercitationem quae quae earum iure ad. Aut ducimus vel provident quae non consequatur.",
                "difficultyRange": "Ipsam architecto recusandae a. Voluptatum rerum qui voluptatem itaque libero delectus quia.",
                "episodeNumber": 1845016899,
                "exerciseBookPages": "Ut vel consequatur provident id error. Expedita facere impedit ducimus. Pariatur aut accusamus est et sed nihil harum ut. Possimus omnis facere doloribus aliquam. Qui quo rem mollitia eum atque. Ex dolor velit cum molestias aut.",
                "fastBpm": "Fugiat consequatur eum autem veritatis ipsum. Molestiae aspernatur sint explicabo repellat beatae. Accusantium adipisci impedit aut ut porro aut qui. Aliquam commodi sit excepturi tenetur placeat iure repellendus.",
                "includesSong": true,
                "instructors": "Expedita voluptates veritatis consequatur illo dolore sint dolor. Doloribus commodi id quibusdam non ipsam. Eligendi ipsa et itaque facilis aut. Accusantium distinctio tempora optio quibusdam quisquam unde.",
                "liveEventStartTime": {
                    "date": "1973-09-23 23:37:24.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "2017-04-06 05:44:17.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Consequatur cupiditate molestias placeat atque. Dicta occaecati veritatis sunt minima qui. Voluptates nulla recusandae cupiditate placeat et non rerum. Doloremque est quis voluptas voluptas eveniet odit deserunt.",
                "liveStreamFeedType": "Dolores sapiente in voluptatem esse. Similique necessitatibus reprehenderit id aut natus nemo ut. Libero aut odio ducimus nesciunt repellendus magnam voluptas. Porro ut voluptatibus voluptatem consequatur.",
                "name": "Asperiores sed debitis iste reiciendis modi voluptatem debitis. Optio vero est quia repellat reiciendis temporibus. Consectetur accusamus voluptatibus facere occaecati perspiciatis facilis.",
                "released": "Quidem ullam ipsa minus in debitis eius minus. Velit voluptatum voluptatem quidem fugiat accusamus ipsum. Vero sunt quibusdam expedita at accusamus deleniti ullam. Repellat tenetur animi error rem. Aut sunt et dicta molestiae harum dolorem.",
                "slowBpm": "Pariatur nulla maiores cumque voluptatem. Qui sint laudantium sint aut eius voluptatem occaecati et. Nobis aut id voluptatibus provident.",
                "totalXp": "Et ut blanditiis repellat voluptatibus et impedit exercitationem. Modi nam voluptas magnam. Sint repellat rerum quod labore exercitationem nam itaque.",
                "transcriberName": "A distinctio ducimus nobis sit et quidem. Est aspernatur sed soluta et. Labore excepturi voluptas quaerat voluptas facere. Blanditiis eos ducimus quia non rerum vel repellendus aut. Repellat ut quis dolore et sunt vero.",
                "week": 257115133,
                "avatarUrl": "Deleniti dolorem qui hic quia natus ullam. Ut ut praesentium quo recusandae aut sunt.",
                "lengthInSeconds": 2113101049,
                "soundsliceSlug": "Recusandae accusamus vitae ea non repellendus. Nulla fuga dignissimos porro neque. Est sed quia nesciunt maiores. Commodi in a sint molestiae nam maiores dolores ut.",
                "staffPickRating": 2034941493,
                "studentId": 796409932,
                "vimeoVideoId": "Eos placeat mollitia explicabo et qui repellat iusto. Consequatur qui aut explicabo sapiente. Aut expedita sed fugit voluptates. Commodi quae vel autem eveniet sit vero cum.",
                "youtubeVideoId": "Neque ducimus est omnis sed veritatis enim. Aliquam excepturi quidem at suscipit aliquam quia ea eligendi. Ex sequi quaerat dolores libero aut. Odit repudiandae illo adipisci sapiente."
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "publishedOn": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archivedOn": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "createdOn": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "homeStaffPickRating": "316288058",
                "legacyId": 1920143894,
                "legacyWordpressPostId": 950948364,
                "qnaVideo": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cdTracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chordOrScale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficultyRange": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episodeNumber": 100534324,
                "exerciseBookPages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fastBpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includesSong": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "liveEventStartTime": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventEndTime": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "liveEventYoutubeId": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "liveStreamFeedType": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slowBpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "totalXp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriberName": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatarUrl": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "lengthInSeconds": 1953132732,
                "soundsliceSlug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staffPickRating": 961041226,
                "studentId": 524121876,
                "vimeoVideoId": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtubeVideoId": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "published_on": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
            }
        },
        {
            "type": "contentData",
            "id": "1",
            "attributes": {
                "key": "Fugit tenetur praesentium quae eum deleniti. Temporibus voluptatem eius sit id. Et quas in reprehenderit eligendi reiciendis ex perspiciatis.",
                "value": "Eum nemo eos quia repellat quaerat animi accusantium. Vel odit corrupti ea dolorem dolor. Minima reiciendis occaecati reprehenderit et nisi. Aliquam aut sit laborum ut perspiciatis. Quasi ut cum tempora tempore mollitia omnis.",
                "position": 6071148
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
            "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
            "type": "course",
            "sort": "2067485678",
            "status": "published",
            "brand": "brand",
            "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
            "user": "1",
            "publishedOn": {
                "date": "1977-09-27 19:18:30.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "archivedOn": {
                "date": "1988-12-24 01:14:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "2012-09-17 21:17:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
            "homeStaffPickRating": "316288058",
            "legacyId": 1920143894,
            "legacyWordpressPostId": 950948364,
            "qnaVideo": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
            "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
            "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
            "xp": 300676256,
            "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
            "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
            "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
            "cdTracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
            "chordOrScale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
            "difficultyRange": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
            "episodeNumber": 100534324,
            "exerciseBookPages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
            "fastBpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
            "includesSong": false,
            "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
            "liveEventStartTime": {
                "date": "1998-12-31 22:59:10.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1986-11-25 06:26:37.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
            "liveStreamFeedType": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
            "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
            "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
            "slowBpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
            "totalXp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
            "transcriberName": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
            "week": 334193965,
            "avatarUrl": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
            "lengthInSeconds": 1953132732,
            "soundsliceSlug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
            "staffPickRating": 961041226,
            "studentId": 524121876,
            "vimeoVideoId": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
            "youtubeVideoId": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                "key": "Fugit tenetur praesentium quae eum deleniti. Temporibus voluptatem eius sit id. Et quas in reprehenderit eligendi reiciendis ex perspiciatis.",
                "value": "Eum nemo eos quia repellat quaerat animi accusantium. Vel odit corrupti ea dolorem dolor. Minima reiciendis occaecati reprehenderit et nisi. Aliquam aut sit laborum ut perspiciatis. Quasi ut cum tempora tempore mollitia omnis.",
                "position": 6071148
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
                "slug": "Unde modi amet soluta ipsum dolorem. Rerum facere quo est totam vero quasi facilis. Tempore animi omnis consectetur dolor repudiandae sit fuga. Ipsa qui dignissimos unde dolorem quibusdam quisquam laudantium.",
                "type": "course",
                "sort": "2067485678",
                "status": "published",
                "brand": "brand",
                "language": "Ipsa repellendus eos id ut qui nobis odit. Hic harum ipsum illum incidunt vitae. Qui tempora voluptas nulla modi et. Voluptates architecto velit velit et omnis natus consequatur. Dolores rem ipsa alias quia voluptatum libero inventore.",
                "user": "1",
                "published_on": {
                    "date": "1977-09-27 19:18:30.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "archived_on": {
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
            }
        },
        {
            "type": "parent",
            "id": "4",
            "attributes": {
                "child_position": 1684253885
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
                "date": "1988-12-24 01:14:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "createdOn": {
                "date": "2012-09-17 21:17:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
            "homeStaffPickRating": "316288058",
            "legacyId": 1920143894,
            "legacyWordpressPostId": 950948364,
            "qnaVideo": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
            "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
            "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
            "xp": 300676256,
            "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
            "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
            "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
            "cdTracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
            "chordOrScale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
            "difficultyRange": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
            "episodeNumber": 100534324,
            "exerciseBookPages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
            "fastBpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
            "includesSong": false,
            "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
            "liveEventStartTime": {
                "date": "1998-12-31 22:59:10.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventEndTime": {
                "date": "1986-11-25 06:26:37.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "liveEventYoutubeId": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
            "liveStreamFeedType": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
            "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
            "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
            "slowBpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
            "totalXp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
            "transcriberName": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
            "week": 334193965,
            "avatarUrl": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
            "lengthInSeconds": 1953132732,
            "soundsliceSlug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
            "staffPickRating": 961041226,
            "studentId": 524121876,
            "vimeoVideoId": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
            "youtubeVideoId": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                    "date": "1988-12-24 01:14:14.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "created_on": {
                    "date": "2012-09-17 21:17:41.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "difficulty": "Ut nemo omnis deleniti quos consequatur quia. Et odit magni pariatur soluta qui non.",
                "home_staff_pick_rating": "316288058",
                "legacy_id": 1920143894,
                "legacy_wordpress_post_id": 950948364,
                "qna_video": "Voluptates quo tempore ut nihil rerum. Et aut laboriosam et aliquid hic aliquid. Error aut qui illo sint deleniti ut a. Voluptatem mollitia tempora sequi nesciunt ratione rem. Dolores at ut fuga. In amet totam officia autem numquam.",
                "style": "Qui ducimus possimus odit ut est quam fuga. Qui accusamus esse aliquid. Illum aspernatur quo fugit cumque sequi earum laudantium dolor. Inventore nostrum corporis eum totam magnam.",
                "title": "Corrupti voluptatem sunt tenetur provident dignissimos.",
                "xp": 300676256,
                "album": "Eos labore soluta dolorem id vero ut sit. Laboriosam delectus aut ipsam reprehenderit impedit quasi dicta. Et voluptate ipsa et quis temporibus non rem.",
                "artist": "Reiciendis soluta sed voluptate consequatur blanditiis. Repellendus sed nihil at occaecati ut. Rerum veritatis inventore sunt molestiae rerum corrupti. Incidunt id ut voluptates modi ducimus quos.",
                "bpm": "Dolorem error veniam inventore eaque aut. Sed facilis in doloribus vel. Et nobis voluptatem quae consectetur. Voluptatem qui illo et alias aut.",
                "cd_tracks": "Eaque dicta et cupiditate sit ducimus voluptates voluptates et. Quia at eum consequatur sit autem.",
                "chord_or_scale": "Et facilis ratione sunt maiores. Maxime libero minima provident magni facere nostrum. Tempore excepturi quia saepe quia laboriosam vel.",
                "difficulty_range": "Iusto et officia molestiae aut. Omnis quo ipsa et voluptatum. Non ut quia voluptas adipisci. Assumenda voluptas repellendus minus ad praesentium ut in. Quis expedita a in accusantium et. Officiis voluptas nesciunt id sapiente.",
                "episode_number": 100534324,
                "exercise_book_pages": "Eligendi non pariatur hic alias. Illo et autem sit velit officiis et. Illum illo dolorem dolores officiis magni illo quo. Dolorem veritatis illo accusantium vel ducimus.",
                "fast_bpm": "Distinctio ut perferendis natus est molestias doloremque. Amet et eius sunt ad autem. Vel quo quas ratione doloribus. Sint error autem ex vel quisquam. Ut totam consequatur repellendus nisi. Cum tenetur vero reprehenderit aut ad maiores.",
                "includes_song": false,
                "instructors": "Quo ullam accusamus officiis exercitationem possimus veritatis non sunt. Est in corporis dolor. Nesciunt saepe ratione ex eveniet voluptas qui porro.",
                "live_event_start_time": {
                    "date": "1998-12-31 22:59:10.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_end_time": {
                    "date": "1986-11-25 06:26:37.000000",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "live_event_youtube_id": "Consequatur qui rerum iste vel qui non nisi. Doloremque odio ad dicta minima omnis dolores. Dolore qui nostrum dolore deserunt molestiae.",
                "live_stream_feed_type": "Est fuga et qui esse asperiores impedit vel quas. Et quisquam qui enim aliquid assumenda. Iure quo officiis maxime earum consectetur impedit rerum similique. Consectetur architecto praesentium ut eos doloremque voluptas quam natus.",
                "name": "Error veniam iusto non aliquam ea voluptas amet. Facilis minima laudantium at itaque. Est nihil qui inventore quo. Id atque et eaque voluptas. Vero dolorem sapiente consequuntur ad eius laudantium veritatis.",
                "released": "Error sed velit molestiae. Ut minima est repellat. Fuga iusto facilis ipsum vel at. Quam laboriosam libero nam voluptatum.",
                "slow_bpm": "Provident distinctio omnis qui consequatur fugiat. Iure a et aliquid eligendi alias quia quis. Fugiat et provident eos atque aut.",
                "total_xp": "Tenetur sed et aut provident. Dolorem alias suscipit pariatur. Cumque dolor et corrupti fuga qui eum minus. Perspiciatis aspernatur est voluptatibus sit laudantium ut reiciendis. Quia quia quis iste.",
                "transcriber_name": "Sed quia natus cumque perferendis ut aliquam. Odio repellat nihil fugit sed laboriosam. Omnis accusantium est facilis sint exercitationem.",
                "week": 334193965,
                "avatar_url": "Dolor quia commodi maiores. Et libero in sapiente tenetur. Quis voluptates doloribus labore quis enim nam. Ut rerum nihil sint minima distinctio possimus. Dicta quo eos doloribus aut nemo quaerat aut asperiores.",
                "length_in_seconds": 1953132732,
                "soundslice_slug": "Qui est quia voluptatem repellat natus atque aperiam. Quod eum dolor facere dolores quos. Libero in error quis consequatur cupiditate et eos veniam. Nesciunt repellendus laborum sit adipisci et explicabo iusto quam.",
                "staff_pick_rating": 961041226,
                "student_id": 524121876,
                "vimeo_video_id": "Repellat rerum quasi porro corrupti fugit. Sunt dolores temporibus ipsum a. Sit accusantium cum optio quis odio.",
                "youtube_video_id": "Nesciunt nihil ullam quo soluta sunt esse. Odio architecto eligendi amet ex velit. Impedit aliquam nulla beatae voluptas voluptatem. A quia modi quae aut. Corrupti quibusdam inventore rerum qui quibusdam ipsa et."
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
                "child_position": 1684253884
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

