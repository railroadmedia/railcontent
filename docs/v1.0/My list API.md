# My list API

# JSON Endpoints


<!-- START_c0f3be7f8a8582faf9eded5ca139e05e -->
## Add a content to authenticated user playlist


### HTTP Request
    `PUT railcontent/add-to-my-list`
    
### Mobile Request
    `PUT api/railcontent/add-to-my-list`


### Permissions
    - Must be logged in
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|content_id|  yes  |The id of the content that should be added to the list.|


### Validation Rules
```php
        return [
            'content_id' =>'required',
        ];
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/add-to-my-list',
    type: 'PUT',
    data: {
        "content_id": 1,
    }
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": "success"
}
```




<!-- END_c0f3be7f8a8582faf9eded5ca139e05e -->





<!-- START_c771ec122eac231459ef2eeb003a51b6 -->
## Remove a content from authenticated user playlist


### HTTP Request
    `PUT railcontent/remove-from-my-list`
    
### Mobile Request
    `PUT api/railcontent/remove-from-my-list`


### Permissions
    - Must be logged in
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|content_id|  yes  |The id of the content that should be removed from the list.|


### Validation Rules
```php
        return [
            'content_id' =>'required',
        ];
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/remove-from-my-list',
    type: 'PUT',
    data: {
        "content_id": 1,
    }   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": true
}
```




<!-- END_c771ec122eac231459ef2eeb003a51b6 -->

<!-- START_b2202db6547dcbe6b75e0cbc642af8de -->
## Get authenticated user playlist


### HTTP Request
    `GET railcontent/my-list`
    
### Mobile Request
    `GET api/railcontent/my-list`

### Permissions
    - Must be logged in
    
### Request Parameters


|Type|Key|Required|Default|Notes|
|----|---|--------|-----|-----|
|body|state|  no  | |State options:'completed' or 'started'. If state it's defined only the contents with specified progress are returned. If state is not defined the contents added to user playlist are returned.|
|body|included_types|  no  | Types defined in config file: appUserListContentTypes| Only contents with these types will be returned.|
|body|required_fields| no  |  |All returned contents are required to have this field. Value format is: key,value|
|body|included_fields| no  |  |Contents that have any of these fields will be returned. Only one included field is the same as a required field but all included fields after the first act inclusively. Value format is: key,value.|
|body|sort| no  |  Default: 'newest'|Can be any of the following: 'newest', 'oldest', 'popularity', 'trending', 'relevance' 'progress' and 'slug'|
|body|page|  no  |Default:1 |Which page to load, will be {limit} long|
|body|limit| no  |   Default:10 |	How many to load per page. |


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/my-list',
    data: {
    "included_types":["course","song"],
    "required_fields":["difficulty,3"],
},
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (201):

```json
{
    "data": [
        {
            "id": 257692,
            "slug": "creative-concepts",
            "type": "course",
            "sort": 0,
            "status": "published",
            "total_xp": "1400",
            "brand": "pianote",
            "language": "en-US",
            "show_in_new_feed": true,
            "user": "",
            "published_on": "2020-06-10 19:00:00",
            "archived_on": null,
            "created_on": "2020-05-25 13:10:33",
            "difficulty": "3",
            "home_staff_pick_rating": null,
            "legacy_id": null,
            "legacy_wordpress_post_id": null,
            "qna_video": null,
            "title": "Creative Composition",
            "xp": "1400",
            "album": null,
            "artist": null,
            "bpm": null,
            "cd_tracks": null,
            "chord_or_scale": null,
            "difficulty_range": null,
            "episode_number": null,
            "exercise_book_pages": null,
            "fast_bpm": null,
            "includes_song": null,
            "instructors": null,
            "live_event_start_time": null,
            "live_event_end_time": null,
            "live_event_youtube_id": null,
            "live_stream_feed_type": null,
            "name": null,
            "released": null,
            "slow_bpm": null,
            "transcriber_name": null,
            "week": null,
            "avatar_url": null,
            "length_in_seconds": 0,
            "soundslice_slug": null,
            "staff_pick_rating": null,
            "student_id": null,
            "vimeo_video_id": null,
            "youtube_video_id": null,
            "permissions": [],
            "user_progress": {
                "149628": []
            },
            "progress_state": false,
            "progress_percent": 0,
            "completed": false,
            "started": false,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "url": "https://dev.pianote.com/members/courses/creative-concepts/257692",
            "mobile_app_url": "",
            "chapters": [],
            "current_lesson_index": 1,
            "current_lesson": {
                "id": 259652,
                "slug": "chords-that-sound-great-together",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "total_xp": "150",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": true,
                "user": "",
                "published_on": "2020-06-10 19:00:00",
                "archived_on": null,
                "created_on": "2020-06-09 13:56:18",
                "difficulty": null,
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Chords That Sound Great Together",
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 138238,
                        "content_id": 259652,
                        "key": "description",
                        "value": "<p>In order to compose a song, you need a framework. One of the easist ways to do this is to learn what chords sound good together so that you can build the perfect backdrop for you melody.</p>",
                        "position": 1
                    },
                    {
                        "id": 138305,
                        "content_id": 259652,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/259652-card-thumbnail-maxres-1591799963.png",
                        "position": 1
                    },
                    {
                        "id": 138306,
                        "content_id": 259652,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/259652-card-thumbnail-1591799966.png",
                        "position": 1
                    }
                ],
                "fields": [
                    {
                        "id": 370437584,
                        "content_id": 259652,
                        "key": "title",
                        "value": "Chords That Sound Great Together",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 202716958,
                        "content_id": 259652,
                        "key": "total_xp",
                        "value": "150",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 190282937,
                        "content_id": 259652,
                        "key": "video",
                        "value": {
                            "id": 259331,
                            "slug": "vimeo-video-426045754",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-06-04 22:30:28",
                            "archived_on": null,
                            "created_on": "2020-06-04 22:30:28",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 464,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "426045754",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 1709127066,
                                    "content_id": 259331,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1950918303,
                                    "content_id": 259331,
                                    "key": "vimeo_video_id",
                                    "value": "426045754",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 2068948469,
                                    "content_id": 259331,
                                    "key": "length_in_seconds",
                                    "value": 464,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    }
                ]
            },
            "next_lesson": {
                "id": 259653,
                "slug": "songwriting-in-minor-keys",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "total_xp": "150",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": true,
                "user": "",
                "published_on": "2020-06-10 19:00:00",
                "archived_on": null,
                "created_on": "2020-06-09 13:56:31",
                "difficulty": null,
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Songwriting In Minor Keys",
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 138244,
                        "content_id": 259653,
                        "key": "description",
                        "value": "<p>Now that you know how to create awesome chord combinations in major keys, it is important to look at minor sounds! Minor sounds will add a more moody and emotional component to your composition. </p>",
                        "position": 1
                    },
                    {
                        "id": 138307,
                        "content_id": 259653,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/259653-card-thumbnail-maxres-1591799999.png",
                        "position": 1
                    },
                    {
                        "id": 138308,
                        "content_id": 259653,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/259653-card-thumbnail-1591800002.png",
                        "position": 1
                    }
                ],
                "fields": [
                    {
                        "id": 1215446153,
                        "content_id": 259653,
                        "key": "title",
                        "value": "Songwriting In Minor Keys",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 340209542,
                        "content_id": 259653,
                        "key": "total_xp",
                        "value": "150",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 12851945,
                        "content_id": 259653,
                        "key": "video",
                        "value": {
                            "id": 259330,
                            "slug": "vimeo-video-426045868",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-06-04 22:30:27",
                            "archived_on": null,
                            "created_on": "2020-06-04 22:30:27",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 318,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "426045868",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 951058002,
                                    "content_id": 259330,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1042944530,
                                    "content_id": 259330,
                                    "key": "vimeo_video_id",
                                    "value": "426045868",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1486111621,
                                    "content_id": 259330,
                                    "key": "length_in_seconds",
                                    "value": 318,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    }
                ]
            },
            "lessons": [
                {
                    "id": 259648,
                    "slug": "welcome-to-creative-composition",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:52:03",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Welcome To Creative Composition",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 1136838467,
                            "content_id": 259648,
                            "key": "title",
                            "value": "Welcome To Creative Composition",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 925189616,
                            "content_id": 259648,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1314270948,
                            "content_id": 259648,
                            "key": "video",
                            "value": {
                                "id": 259332,
                                "slug": "vimeo-video-426045738",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:28",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:28",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 47,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426045738",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 85383352,
                                        "content_id": 259332,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 664875505,
                                        "content_id": 259332,
                                        "key": "vimeo_video_id",
                                        "value": "426045738",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1588178391,
                                        "content_id": 259332,
                                        "key": "length_in_seconds",
                                        "value": 47,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138230,
                            "content_id": 259648,
                            "key": "description",
                            "value": "<p>Welcome! This course will teach players of all levels how to compose on the piano!</p>",
                            "position": 1
                        },
                        {
                            "id": 138303,
                            "content_id": 259648,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259648-card-thumbnail-maxres-1591799947.png",
                            "position": 1
                        },
                        {
                            "id": 138304,
                            "content_id": 259648,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259648-card-thumbnail-1591799950.png",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 259652,
                    "slug": "chords-that-sound-great-together",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:56:18",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Chords That Sound Great Together",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 1168882629,
                            "content_id": 259652,
                            "key": "title",
                            "value": "Chords That Sound Great Together",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 855897382,
                            "content_id": 259652,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 496763002,
                            "content_id": 259652,
                            "key": "video",
                            "value": {
                                "id": 259331,
                                "slug": "vimeo-video-426045754",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:28",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:28",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 464,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426045754",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 1391676756,
                                        "content_id": 259331,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 2118297866,
                                        "content_id": 259331,
                                        "key": "vimeo_video_id",
                                        "value": "426045754",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1682319581,
                                        "content_id": 259331,
                                        "key": "length_in_seconds",
                                        "value": 464,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138238,
                            "content_id": 259652,
                            "key": "description",
                            "value": "<p>In order to compose a song, you need a framework. One of the easist ways to do this is to learn what chords sound good together so that you can build the perfect backdrop for you melody.</p>",
                            "position": 1
                        },
                        {
                            "id": 138305,
                            "content_id": 259652,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259652-card-thumbnail-maxres-1591799963.png",
                            "position": 1
                        },
                        {
                            "id": 138306,
                            "content_id": 259652,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259652-card-thumbnail-1591799966.png",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 259653,
                    "slug": "songwriting-in-minor-keys",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:56:31",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Songwriting In Minor Keys",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 519971749,
                            "content_id": 259653,
                            "key": "title",
                            "value": "Songwriting In Minor Keys",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1282540324,
                            "content_id": 259653,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 811867027,
                            "content_id": 259653,
                            "key": "video",
                            "value": {
                                "id": 259330,
                                "slug": "vimeo-video-426045868",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:27",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:27",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 318,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426045868",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 24004004,
                                        "content_id": 259330,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1772999851,
                                        "content_id": 259330,
                                        "key": "vimeo_video_id",
                                        "value": "426045868",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 114848277,
                                        "content_id": 259330,
                                        "key": "length_in_seconds",
                                        "value": 318,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138244,
                            "content_id": 259653,
                            "key": "description",
                            "value": "<p>Now that you know how to create awesome chord combinations in major keys, it is important to look at minor sounds! Minor sounds will add a more moody and emotional component to your composition. </p>",
                            "position": 1
                        },
                        {
                            "id": 138307,
                            "content_id": 259653,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259653-card-thumbnail-maxres-1591799999.png",
                            "position": 1
                        },
                        {
                            "id": 138308,
                            "content_id": 259653,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259653-card-thumbnail-1591800002.png",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 259654,
                    "slug": "songwriting-in-minor-keys",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:56:38",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "How To Create A Melody",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 704152401,
                            "content_id": 259654,
                            "key": "title",
                            "value": "How To Create A Melody",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 103470618,
                            "content_id": 259654,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 261384274,
                            "content_id": 259654,
                            "key": "video",
                            "value": {
                                "id": 259329,
                                "slug": "vimeo-video-426045963",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:27",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:27",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 693,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426045963",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 2063858239,
                                        "content_id": 259329,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1997504043,
                                        "content_id": 259329,
                                        "key": "vimeo_video_id",
                                        "value": "426045963",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1176189034,
                                        "content_id": 259329,
                                        "key": "length_in_seconds",
                                        "value": 693,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138248,
                            "content_id": 259654,
                            "key": "description",
                            "value": "<p>Creating melody is so much fun but it can also be the most difficult part of songwriting as we tend to get \"stuck\" in our heads about what our song should sound like. This lesson takes a creative approach to finding and creating the perfect melody for your song. </p>",
                            "position": 1
                        },
                        {
                            "id": 138309,
                            "content_id": 259654,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259654-card-thumbnail-maxres-1591800016.png",
                            "position": 1
                        },
                        {
                            "id": 138310,
                            "content_id": 259654,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259654-card-thumbnail-1591800019.png",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 259655,
                    "slug": "songwriting-in-minor-keys",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:56:46",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Song Structure 101",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 820921207,
                            "content_id": 259655,
                            "key": "title",
                            "value": "Song Structure 101",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1997566959,
                            "content_id": 259655,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 219290226,
                            "content_id": 259655,
                            "key": "video",
                            "value": {
                                "id": 259328,
                                "slug": "vimeo-video-426046130",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:26",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:26",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 687,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426046130",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 795204619,
                                        "content_id": 259328,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1178538358,
                                        "content_id": 259328,
                                        "key": "vimeo_video_id",
                                        "value": "426046130",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 947888560,
                                        "content_id": 259328,
                                        "key": "length_in_seconds",
                                        "value": 687,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138255,
                            "content_id": 259655,
                            "key": "description",
                            "value": "<p>What is a verse, chorus, bridge, pre chorus and how can you use them to create your own unique composition? This lesson explains it all!</p>",
                            "position": 1
                        },
                        {
                            "id": 138311,
                            "content_id": 259655,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259655-card-thumbnail-maxres-1591800035.png",
                            "position": 1
                        },
                        {
                            "id": 138312,
                            "content_id": 259655,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259655-card-thumbnail-1591800039.png",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 259656,
                    "slug": "songwriting-in-minor-keys",
                    "type": "course-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-06-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-06-09 13:56:52",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Creating The Perfect Mood For Your Composition",
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 290881470,
                            "content_id": 259656,
                            "key": "title",
                            "value": "Creating The Perfect Mood For Your Composition",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1795232619,
                            "content_id": 259656,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 2076124871,
                            "content_id": 259656,
                            "key": "video",
                            "value": {
                                "id": 259321,
                                "slug": "vimeo-video-426046294",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-06-04 22:30:25",
                                "archived_on": null,
                                "created_on": "2020-06-04 22:30:25",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 406,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "426046294",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 1429428678,
                                        "content_id": 259321,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1780254857,
                                        "content_id": 259321,
                                        "key": "vimeo_video_id",
                                        "value": "426046294",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 796399157,
                                        "content_id": 259321,
                                        "key": "length_in_seconds",
                                        "value": 406,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 138267,
                            "content_id": 259656,
                            "key": "description",
                            "value": "<p>So you've got your basic song structure down and it is time for the finishing touches. This lesson is about how to use rhythm, dynamics and accompaniment patterns to create the perfect mood for your song!</p>",
                            "position": 1
                        },
                        {
                            "id": 138313,
                            "content_id": 259656,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259656-card-thumbnail-maxres-1591800054.png",
                            "position": 1
                        },
                        {
                            "id": 138314,
                            "content_id": 259656,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/259656-card-thumbnail-1591800058.png",
                            "position": 1
                        }
                    ]
                }
            ],
            "lesson_count": 6,
            "like_count": "1",
            "is_liked_by_current_user": false,
            "resources": [],
            "xp_bonus": 500,
            "fields": [
                {
                    "content_id": 257692,
                    "key": "title",
                    "value": "Creative Composition",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "difficulty",
                    "value": "3",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "total_xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "chord progression",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "chording",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "chords",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "compose",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "composition",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "song structure",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "song writing",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 257692,
                    "key": "tag",
                    "value": "write your own music",
                    "position": 1,
                    "type": "string"
                }
            ],
            "data": [
                {
                    "id": 138266,
                    "content_id": 257692,
                    "key": "description",
                    "value": "<p>If you've always dreamed of writing your own songs on the piano than this is the course for YOU. Learn about song structure, what chords sound good together, how to create chord progressions, melodic themes, and more.</p>",
                    "position": 1
                },
                {
                    "id": 138301,
                    "content_id": 257692,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/257692-card-thumbnail-maxres-1591799927.png",
                    "position": 1
                },
                {
                    "id": 138302,
                    "content_id": 257692,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/257692-card-thumbnail-1591799931.png",
                    "position": 1
                }
            ],
            "children": [
                {
                    "child_id": 259648
                },
                {
                    "child_id": 259652
                },
                {
                    "child_id": 259653
                },
                {
                    "child_id": 259654
                },
                {
                    "child_id": 259655
                },
                {
                    "child_id": 259656
                }
            ]
        },
        {
            "id": 255531,
            "slug": "my-immortal",
            "type": "song",
            "sort": 0,
            "status": "published",
            "total_xp": "1400",
            "brand": "pianote",
            "language": "en-US",
            "show_in_new_feed": true,
            "user": "",
            "published_on": "2020-05-29 19:00:00",
            "archived_on": null,
            "created_on": "2020-05-08 11:17:20",
            "difficulty": "3",
            "home_staff_pick_rating": null,
            "legacy_id": null,
            "legacy_wordpress_post_id": null,
            "qna_video": null,
            "title": "My Immortal",
            "xp": "1400",
            "album": null,
            "artist": "Evanescence",
            "bpm": null,
            "cd_tracks": null,
            "chord_or_scale": null,
            "difficulty_range": null,
            "episode_number": null,
            "exercise_book_pages": null,
            "fast_bpm": null,
            "includes_song": null,
            "instructors": null,
            "live_event_start_time": null,
            "live_event_end_time": null,
            "live_event_youtube_id": null,
            "live_stream_feed_type": null,
            "name": null,
            "released": null,
            "slow_bpm": null,
            "transcriber_name": null,
            "week": null,
            "avatar_url": null,
            "length_in_seconds": 0,
            "soundslice_slug": null,
            "staff_pick_rating": null,
            "student_id": null,
            "vimeo_video_id": null,
            "youtube_video_id": null,
            "permissions": [],
            "user_progress": {
                "149628": []
            },
            "progress_state": false,
            "progress_percent": 0,
            "completed": false,
            "started": false,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "url": "https://dev.pianote.com/members/songs/my-immortal/255531",
            "mobile_app_url": "",
            "chapters": [],
            "current_lesson_index": 1,
            "current_lesson": {
                "id": 258576,
                "slug": "asd",
                "type": "song-part",
                "sort": 0,
                "status": "published",
                "total_xp": "275",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": true,
                "user": "",
                "published_on": "2020-05-29 19:00:00",
                "archived_on": null,
                "created_on": "2020-05-29 13:55:56",
                "difficulty": "3",
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Accompaniment Version",
                "xp": 150,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 136496,
                        "content_id": 258576,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258576-card-thumbnail-maxres-1590764568.jpg",
                        "position": 1
                    },
                    {
                        "id": 136497,
                        "content_id": 258576,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258576-card-thumbnail-1590764575.jpg",
                        "position": 1
                    },
                    {
                        "id": 136500,
                        "content_id": 258576,
                        "key": "chapter_timecode",
                        "value": "20",
                        "position": 1
                    },
                    {
                        "id": 136501,
                        "content_id": 258576,
                        "key": "chapter_description",
                        "value": "Intro",
                        "position": 1
                    },
                    {
                        "id": 136502,
                        "content_id": 258576,
                        "key": "chapter_timecode",
                        "value": "95",
                        "position": 2
                    },
                    {
                        "id": 136503,
                        "content_id": 258576,
                        "key": "chapter_description",
                        "value": "Verse",
                        "position": 2
                    },
                    {
                        "id": 136504,
                        "content_id": 258576,
                        "key": "chapter_timecode",
                        "value": "270",
                        "position": 3
                    },
                    {
                        "id": 136505,
                        "content_id": 258576,
                        "key": "chapter_description",
                        "value": "Pre-Chorus",
                        "position": 3
                    },
                    {
                        "id": 136506,
                        "content_id": 258576,
                        "key": "chapter_timecode",
                        "value": "360",
                        "position": 4
                    },
                    {
                        "id": 136507,
                        "content_id": 258576,
                        "key": "chapter_description",
                        "value": "Chorus",
                        "position": 4
                    },
                    {
                        "id": 136508,
                        "content_id": 258576,
                        "key": "chapter_timecode",
                        "value": "594",
                        "position": 5
                    },
                    {
                        "id": 136509,
                        "content_id": 258576,
                        "key": "chapter_description",
                        "value": "Solo",
                        "position": 5
                    },
                    {
                        "id": 141703,
                        "content_id": 258576,
                        "key": "resource_name",
                        "value": "Lead Sheet PDF",
                        "position": 1
                    },
                    {
                        "id": 141704,
                        "content_id": 258576,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1594651207.pdf",
                        "position": 1
                    }
                ],
                "fields": [
                    {
                        "id": 1215603658,
                        "content_id": 258576,
                        "key": "title",
                        "value": "Accompaniment Version",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 881896826,
                        "content_id": 258576,
                        "key": "difficulty",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1445534578,
                        "content_id": 258576,
                        "key": "xp",
                        "value": 150,
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1087219472,
                        "content_id": 258576,
                        "key": "total_xp",
                        "value": "275",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1785128648,
                        "content_id": 258576,
                        "key": "video",
                        "value": {
                            "id": 257969,
                            "slug": "vimeo-video-422579392",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-05-25 22:30:24",
                            "archived_on": null,
                            "created_on": "2020-05-25 22:30:24",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 844,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "422579392",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 719991396,
                                    "content_id": 257969,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1862275983,
                                    "content_id": 257969,
                                    "key": "vimeo_video_id",
                                    "value": "422579392",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 2087232481,
                                    "content_id": 257969,
                                    "key": "length_in_seconds",
                                    "value": 844,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    },
                    {
                        "content_id": 258576,
                        "key": "tag",
                        "value": "2003",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258576,
                        "key": "tag",
                        "value": "evanescence",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258576,
                        "key": "tag",
                        "value": "fallen",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258576,
                        "key": "tag",
                        "value": "my immortal",
                        "type": "string",
                        "position": 1
                    }
                ]
            },
            "next_lesson": {
                "id": 258577,
                "slug": "asd",
                "type": "song-part",
                "sort": 0,
                "status": "published",
                "total_xp": "275",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": true,
                "user": "",
                "published_on": "2020-05-29 19:00:00",
                "archived_on": null,
                "created_on": "2020-05-29 13:56:10",
                "difficulty": "3",
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Instrumental Version",
                "xp": 150,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 136527,
                        "content_id": 258577,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258577-card-thumbnail-maxres-1590766497.jpg",
                        "position": 1
                    },
                    {
                        "id": 136528,
                        "content_id": 258577,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258577-card-thumbnail-1590766501.jpg",
                        "position": 1
                    },
                    {
                        "id": 136531,
                        "content_id": 258577,
                        "key": "chapter_timecode",
                        "value": "27",
                        "position": 1
                    },
                    {
                        "id": 136532,
                        "content_id": 258577,
                        "key": "chapter_description",
                        "value": "Intro",
                        "position": 1
                    },
                    {
                        "id": 136533,
                        "content_id": 258577,
                        "key": "chapter_timecode",
                        "value": "50",
                        "position": 2
                    },
                    {
                        "id": 136534,
                        "content_id": 258577,
                        "key": "chapter_description",
                        "value": "Verse",
                        "position": 2
                    },
                    {
                        "id": 136535,
                        "content_id": 258577,
                        "key": "chapter_timecode",
                        "value": "147",
                        "position": 3
                    },
                    {
                        "id": 136536,
                        "content_id": 258577,
                        "key": "chapter_description",
                        "value": "Pre-Chorus",
                        "position": 3
                    },
                    {
                        "id": 136537,
                        "content_id": 258577,
                        "key": "chapter_timecode",
                        "value": "163",
                        "position": 4
                    },
                    {
                        "id": 136538,
                        "content_id": 258577,
                        "key": "chapter_description",
                        "value": "Chorus",
                        "position": 4
                    },
                    {
                        "id": 136539,
                        "content_id": 258577,
                        "key": "chapter_timecode",
                        "value": "292",
                        "position": 5
                    },
                    {
                        "id": 136540,
                        "content_id": 258577,
                        "key": "chapter_description",
                        "value": "Solo",
                        "position": 5
                    },
                    {
                        "id": 141705,
                        "content_id": 258577,
                        "key": "resource_name",
                        "value": "Lead Sheet PDF",
                        "position": 1
                    },
                    {
                        "id": 141706,
                        "content_id": 258577,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1594651207.pdf",
                        "position": 1
                    }
                ],
                "fields": [
                    {
                        "id": 1403579152,
                        "content_id": 258577,
                        "key": "title",
                        "value": "Instrumental Version",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1488270311,
                        "content_id": 258577,
                        "key": "difficulty",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1306485383,
                        "content_id": 258577,
                        "key": "xp",
                        "value": 150,
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 682954745,
                        "content_id": 258577,
                        "key": "total_xp",
                        "value": "275",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 98557305,
                        "content_id": 258577,
                        "key": "video",
                        "value": {
                            "id": 257963,
                            "slug": "vimeo-video-422579557",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-05-25 22:00:25",
                            "archived_on": null,
                            "created_on": "2020-05-25 22:00:25",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 504,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "422579557",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 335787660,
                                    "content_id": 257963,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 511964899,
                                    "content_id": 257963,
                                    "key": "vimeo_video_id",
                                    "value": "422579557",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1945662171,
                                    "content_id": 257963,
                                    "key": "length_in_seconds",
                                    "value": 504,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    },
                    {
                        "content_id": 258577,
                        "key": "tag",
                        "value": "2003",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258577,
                        "key": "tag",
                        "value": "evanescence",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258577,
                        "key": "tag",
                        "value": "fallen",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 258577,
                        "key": "tag",
                        "value": "my immortal",
                        "type": "string",
                        "position": 1
                    }
                ]
            },
            "lessons": [
                {
                    "id": 258572,
                    "slug": "introduction",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "200",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-05-29 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-05-29 13:16:27",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Introduction",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 2006268004,
                            "content_id": 258572,
                            "key": "title",
                            "value": "Introduction",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1214071683,
                            "content_id": 258572,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1677086948,
                            "content_id": 258572,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 161270382,
                            "content_id": 258572,
                            "key": "total_xp",
                            "value": "200",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 886489309,
                            "content_id": 258572,
                            "key": "video",
                            "value": {
                                "id": 257964,
                                "slug": "vimeo-video-422579542",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-05-25 22:00:26",
                                "archived_on": null,
                                "created_on": "2020-05-25 22:00:26",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 70,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "422579542",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 506347172,
                                        "content_id": 257964,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1377115022,
                                        "content_id": 257964,
                                        "key": "vimeo_video_id",
                                        "value": "422579542",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 852029466,
                                        "content_id": 257964,
                                        "key": "length_in_seconds",
                                        "value": 70,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 258572,
                            "key": "tag",
                            "value": "2003",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258572,
                            "key": "tag",
                            "value": "evanescence",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258572,
                            "key": "tag",
                            "value": "fallen",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258572,
                            "key": "tag",
                            "value": "intro",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258572,
                            "key": "tag",
                            "value": "my immortal",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 136481,
                            "content_id": 258572,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-card-thumbnail-maxres-1590762556.jpg",
                            "position": 1
                        },
                        {
                            "id": 136482,
                            "content_id": 258572,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-card-thumbnail-1590762561.jpg",
                            "position": 1
                        },
                        {
                            "id": 136485,
                            "content_id": 258572,
                            "key": "resource_name",
                            "value": "Full Score PDF",
                            "position": 1
                        },
                        {
                            "id": 136486,
                            "content_id": 258572,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1590762691.pdf",
                            "position": 1
                        },
                        {
                            "id": 141701,
                            "content_id": 258572,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 2
                        },
                        {
                            "id": 141702,
                            "content_id": 258572,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1594651207.pdf",
                            "position": 2
                        }
                    ]
                },
                {
                    "id": 258576,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "275",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-05-29 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-05-29 13:55:56",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Accompaniment Version",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 1080409293,
                            "content_id": 258576,
                            "key": "title",
                            "value": "Accompaniment Version",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1810687575,
                            "content_id": 258576,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 644888499,
                            "content_id": 258576,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1006847007,
                            "content_id": 258576,
                            "key": "total_xp",
                            "value": "275",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 617937039,
                            "content_id": 258576,
                            "key": "video",
                            "value": {
                                "id": 257969,
                                "slug": "vimeo-video-422579392",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-05-25 22:30:24",
                                "archived_on": null,
                                "created_on": "2020-05-25 22:30:24",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 844,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "422579392",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 337720250,
                                        "content_id": 257969,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1672030131,
                                        "content_id": 257969,
                                        "key": "vimeo_video_id",
                                        "value": "422579392",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1030720723,
                                        "content_id": 257969,
                                        "key": "length_in_seconds",
                                        "value": 844,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 258576,
                            "key": "tag",
                            "value": "2003",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258576,
                            "key": "tag",
                            "value": "evanescence",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258576,
                            "key": "tag",
                            "value": "fallen",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258576,
                            "key": "tag",
                            "value": "my immortal",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 136496,
                            "content_id": 258576,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258576-card-thumbnail-maxres-1590764568.jpg",
                            "position": 1
                        },
                        {
                            "id": 136497,
                            "content_id": 258576,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258576-card-thumbnail-1590764575.jpg",
                            "position": 1
                        },
                        {
                            "id": 136500,
                            "content_id": 258576,
                            "key": "chapter_timecode",
                            "value": "20",
                            "position": 1
                        },
                        {
                            "id": 136501,
                            "content_id": 258576,
                            "key": "chapter_description",
                            "value": "Intro",
                            "position": 1
                        },
                        {
                            "id": 136502,
                            "content_id": 258576,
                            "key": "chapter_timecode",
                            "value": "95",
                            "position": 2
                        },
                        {
                            "id": 136503,
                            "content_id": 258576,
                            "key": "chapter_description",
                            "value": "Verse",
                            "position": 2
                        },
                        {
                            "id": 136504,
                            "content_id": 258576,
                            "key": "chapter_timecode",
                            "value": "270",
                            "position": 3
                        },
                        {
                            "id": 136505,
                            "content_id": 258576,
                            "key": "chapter_description",
                            "value": "Pre-Chorus",
                            "position": 3
                        },
                        {
                            "id": 136506,
                            "content_id": 258576,
                            "key": "chapter_timecode",
                            "value": "360",
                            "position": 4
                        },
                        {
                            "id": 136507,
                            "content_id": 258576,
                            "key": "chapter_description",
                            "value": "Chorus",
                            "position": 4
                        },
                        {
                            "id": 136508,
                            "content_id": 258576,
                            "key": "chapter_timecode",
                            "value": "594",
                            "position": 5
                        },
                        {
                            "id": 136509,
                            "content_id": 258576,
                            "key": "chapter_description",
                            "value": "Solo",
                            "position": 5
                        },
                        {
                            "id": 141703,
                            "content_id": 258576,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 1
                        },
                        {
                            "id": 141704,
                            "content_id": 258576,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1594651207.pdf",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 258577,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "275",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-05-29 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-05-29 13:56:10",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Instrumental Version",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 695086968,
                            "content_id": 258577,
                            "key": "title",
                            "value": "Instrumental Version",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 781216554,
                            "content_id": 258577,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1304936053,
                            "content_id": 258577,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 2085912199,
                            "content_id": 258577,
                            "key": "total_xp",
                            "value": "275",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1034398363,
                            "content_id": 258577,
                            "key": "video",
                            "value": {
                                "id": 257963,
                                "slug": "vimeo-video-422579557",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-05-25 22:00:25",
                                "archived_on": null,
                                "created_on": "2020-05-25 22:00:25",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 504,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "422579557",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 705550656,
                                        "content_id": 257963,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1169279905,
                                        "content_id": 257963,
                                        "key": "vimeo_video_id",
                                        "value": "422579557",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 248390495,
                                        "content_id": 257963,
                                        "key": "length_in_seconds",
                                        "value": 504,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 258577,
                            "key": "tag",
                            "value": "2003",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258577,
                            "key": "tag",
                            "value": "evanescence",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258577,
                            "key": "tag",
                            "value": "fallen",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258577,
                            "key": "tag",
                            "value": "my immortal",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 136527,
                            "content_id": 258577,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258577-card-thumbnail-maxres-1590766497.jpg",
                            "position": 1
                        },
                        {
                            "id": 136528,
                            "content_id": 258577,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258577-card-thumbnail-1590766501.jpg",
                            "position": 1
                        },
                        {
                            "id": 136531,
                            "content_id": 258577,
                            "key": "chapter_timecode",
                            "value": "27",
                            "position": 1
                        },
                        {
                            "id": 136532,
                            "content_id": 258577,
                            "key": "chapter_description",
                            "value": "Intro",
                            "position": 1
                        },
                        {
                            "id": 136533,
                            "content_id": 258577,
                            "key": "chapter_timecode",
                            "value": "50",
                            "position": 2
                        },
                        {
                            "id": 136534,
                            "content_id": 258577,
                            "key": "chapter_description",
                            "value": "Verse",
                            "position": 2
                        },
                        {
                            "id": 136535,
                            "content_id": 258577,
                            "key": "chapter_timecode",
                            "value": "147",
                            "position": 3
                        },
                        {
                            "id": 136536,
                            "content_id": 258577,
                            "key": "chapter_description",
                            "value": "Pre-Chorus",
                            "position": 3
                        },
                        {
                            "id": 136537,
                            "content_id": 258577,
                            "key": "chapter_timecode",
                            "value": "163",
                            "position": 4
                        },
                        {
                            "id": 136538,
                            "content_id": 258577,
                            "key": "chapter_description",
                            "value": "Chorus",
                            "position": 4
                        },
                        {
                            "id": 136539,
                            "content_id": 258577,
                            "key": "chapter_timecode",
                            "value": "292",
                            "position": 5
                        },
                        {
                            "id": 136540,
                            "content_id": 258577,
                            "key": "chapter_description",
                            "value": "Solo",
                            "position": 5
                        },
                        {
                            "id": 141705,
                            "content_id": 258577,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 1
                        },
                        {
                            "id": 141706,
                            "content_id": 258577,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258572-resource-1594651207.pdf",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 258578,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": true,
                    "user": "",
                    "published_on": "2020-05-29 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-05-29 13:56:36",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Performance",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 342440188,
                            "content_id": 258578,
                            "key": "title",
                            "value": "Performance",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1173563861,
                            "content_id": 258578,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 693255561,
                            "content_id": 258578,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 495636147,
                            "content_id": 258578,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1529696349,
                            "content_id": 258578,
                            "key": "video",
                            "value": {
                                "id": 257959,
                                "slug": "vimeo-video-422579647",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-05-25 22:00:24",
                                "archived_on": null,
                                "created_on": "2020-05-25 22:00:24",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 220,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "422579647",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 1389437073,
                                        "content_id": 257959,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 731731644,
                                        "content_id": 257959,
                                        "key": "vimeo_video_id",
                                        "value": "422579647",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 15544482,
                                        "content_id": 257959,
                                        "key": "length_in_seconds",
                                        "value": 220,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 258578,
                            "key": "tag",
                            "value": "2003",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258578,
                            "key": "tag",
                            "value": "evanescence",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258578,
                            "key": "tag",
                            "value": "fallen",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 258578,
                            "key": "tag",
                            "value": "my immortal",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 136558,
                            "content_id": 258578,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258578-card-thumbnail-maxres-1590768164.jpg",
                            "position": 1
                        },
                        {
                            "id": 136559,
                            "content_id": 258578,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/258578-card-thumbnail-1590768168.jpg",
                            "position": 1
                        }
                    ]
                }
            ],
            "lesson_count": 4,
            "like_count": "0",
            "is_liked_by_current_user": false,
            "resources": {
                "1": {
                    "resource_name": "Song Resources Pack",
                    "resource_url": "https://d1923uyy6spedc.cloudfront.net/255531-resource-1594651472.zip"
                }
            },
            "xp_bonus": 500,
            "fields": [
                {
                    "content_id": 255531,
                    "key": "title",
                    "value": "My Immortal",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "difficulty",
                    "value": "3",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "artist",
                    "value": "Evanescence",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "total_xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "topic",
                    "value": "Rock",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "2003",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "amy lee",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "beginner",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "fallen",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "song",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 255531,
                    "key": "tag",
                    "value": "songs",
                    "position": 1,
                    "type": "string"
                }
            ],
            "data": [
                {
                    "id": 136476,
                    "content_id": 255531,
                    "key": "description",
                    "value": "<p>This piano power ballad has a beautiful and haunting melody that is a lot of fun to both sing and play!&nbsp;</p>",
                    "position": 1
                },
                {
                    "id": 136477,
                    "content_id": 255531,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/255531-card-thumbnail-maxres-1590756807.jpg",
                    "position": 1
                },
                {
                    "id": 136478,
                    "content_id": 255531,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/255531-card-thumbnail-1590756814.jpg",
                    "position": 1
                },
                {
                    "id": 141707,
                    "content_id": 255531,
                    "key": "resource_name",
                    "value": "Song Resources Pack",
                    "position": 1
                },
                {
                    "id": 141708,
                    "content_id": 255531,
                    "key": "resource_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/255531-resource-1594651472.zip",
                    "position": 1
                }
            ],
            "children": [
                {
                    "child_id": 258572
                },
                {
                    "child_id": 258576
                },
                {
                    "child_id": 258577
                },
                {
                    "child_id": 258578
                }
            ]
        },
        {
            "id": 250094,
            "slug": "creep",
            "type": "song",
            "sort": 0,
            "status": "published",
            "total_xp": "1400",
            "brand": "pianote",
            "language": "en-US",
            "show_in_new_feed": null,
            "user": "",
            "published_on": "2020-04-10 19:00:00",
            "archived_on": null,
            "created_on": "2020-03-30 15:24:33",
            "difficulty": "3",
            "home_staff_pick_rating": null,
            "legacy_id": null,
            "legacy_wordpress_post_id": null,
            "qna_video": null,
            "title": "Creep",
            "xp": "1400",
            "album": null,
            "artist": "Radiohead",
            "bpm": null,
            "cd_tracks": null,
            "chord_or_scale": null,
            "difficulty_range": null,
            "episode_number": null,
            "exercise_book_pages": null,
            "fast_bpm": null,
            "includes_song": null,
            "instructors": null,
            "live_event_start_time": null,
            "live_event_end_time": null,
            "live_event_youtube_id": null,
            "live_stream_feed_type": null,
            "name": null,
            "released": null,
            "slow_bpm": null,
            "transcriber_name": null,
            "week": null,
            "avatar_url": null,
            "length_in_seconds": 0,
            "soundslice_slug": null,
            "staff_pick_rating": null,
            "student_id": null,
            "vimeo_video_id": null,
            "youtube_video_id": null,
            "permissions": [],
            "user_progress": {
                "149628": []
            },
            "progress_state": false,
            "progress_percent": 0,
            "completed": false,
            "started": false,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "url": "https://dev.pianote.com/members/songs/creep/250094",
            "mobile_app_url": "",
            "chapters": [],
            "current_lesson_index": 1,
            "current_lesson": {
                "id": 251043,
                "slug": "asd",
                "type": "song-part",
                "sort": 0,
                "status": "published",
                "total_xp": "275",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": null,
                "user": "",
                "published_on": "2020-04-10 19:00:00",
                "archived_on": null,
                "created_on": "2020-04-06 12:31:46",
                "difficulty": "3",
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Accompaniment Version",
                "xp": 150,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 130492,
                        "content_id": 251043,
                        "key": "resource_name",
                        "value": "Lead Sheet PDF",
                        "position": 1
                    },
                    {
                        "id": 130493,
                        "content_id": 251043,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178664.pdf",
                        "position": 1
                    },
                    {
                        "id": 130494,
                        "content_id": 251043,
                        "key": "resource_name",
                        "value": "Play-Along MP3",
                        "position": 2
                    },
                    {
                        "id": 130495,
                        "content_id": 251043,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178723.mp3",
                        "position": 2
                    },
                    {
                        "id": 130496,
                        "content_id": 251043,
                        "key": "resource_name",
                        "value": "Full Band MP3",
                        "position": 3
                    },
                    {
                        "id": 130497,
                        "content_id": 251043,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178789.mp3",
                        "position": 3
                    },
                    {
                        "id": 130691,
                        "content_id": 251043,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251043-card-thumbnail-1586429762.jpg",
                        "position": 1
                    },
                    {
                        "id": 130692,
                        "content_id": 251043,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251043-card-thumbnail-maxres-1586429764.jpg",
                        "position": 1
                    },
                    {
                        "id": 130885,
                        "content_id": 251043,
                        "key": "chapter_timecode",
                        "value": "20",
                        "position": 1
                    },
                    {
                        "id": 130886,
                        "content_id": 251043,
                        "key": "chapter_description",
                        "value": "Intro",
                        "position": 1
                    },
                    {
                        "id": 130887,
                        "content_id": 251043,
                        "key": "chapter_timecode",
                        "value": "145",
                        "position": 2
                    },
                    {
                        "id": 130888,
                        "content_id": 251043,
                        "key": "chapter_description",
                        "value": "Verse",
                        "position": 2
                    },
                    {
                        "id": 130889,
                        "content_id": 251043,
                        "key": "chapter_timecode",
                        "value": "212",
                        "position": 3
                    },
                    {
                        "id": 130890,
                        "content_id": 251043,
                        "key": "chapter_description",
                        "value": "Chorus",
                        "position": 3
                    },
                    {
                        "id": 130891,
                        "content_id": 251043,
                        "key": "chapter_timecode",
                        "value": "381",
                        "position": 4
                    },
                    {
                        "id": 130892,
                        "content_id": 251043,
                        "key": "chapter_description",
                        "value": "Bridge",
                        "position": 4
                    }
                ],
                "fields": [
                    {
                        "id": 72226071,
                        "content_id": 251043,
                        "key": "title",
                        "value": "Accompaniment Version",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 785780348,
                        "content_id": 251043,
                        "key": "difficulty",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1584314677,
                        "content_id": 251043,
                        "key": "xp",
                        "value": 150,
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 188898686,
                        "content_id": 251043,
                        "key": "total_xp",
                        "value": "275",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 324340363,
                        "content_id": 251043,
                        "key": "video",
                        "value": {
                            "id": 251068,
                            "slug": "vimeo-video-404639820",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-04-06 15:30:14",
                            "archived_on": null,
                            "created_on": "2020-04-06 15:30:14",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 509,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "404639820",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 1907482361,
                                    "content_id": 251068,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 477372575,
                                    "content_id": 251068,
                                    "key": "vimeo_video_id",
                                    "value": "404639820",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 705775719,
                                    "content_id": 251068,
                                    "key": "length_in_seconds",
                                    "value": 509,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "1993",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "accompaniment",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "beginner",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "break down",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "break downs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "break-down",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "break-downs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "breakdown",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "breakdowns",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "creep",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "learn",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "learning",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "lisa witt",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "pablo honey",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "radiohead",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "song",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "songs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251043,
                        "key": "tag",
                        "value": "version",
                        "type": "string",
                        "position": 1
                    }
                ]
            },
            "next_lesson": {
                "id": 251044,
                "slug": "asd",
                "type": "song-part",
                "sort": 0,
                "status": "published",
                "total_xp": "275",
                "brand": "pianote",
                "language": "en-US",
                "show_in_new_feed": null,
                "user": "",
                "published_on": "2020-04-10 19:00:00",
                "archived_on": null,
                "created_on": "2020-04-06 12:32:02",
                "difficulty": "3",
                "home_staff_pick_rating": null,
                "legacy_id": null,
                "legacy_wordpress_post_id": null,
                "qna_video": null,
                "title": "Instrumental Version",
                "xp": 150,
                "album": null,
                "artist": null,
                "bpm": null,
                "cd_tracks": null,
                "chord_or_scale": null,
                "difficulty_range": null,
                "episode_number": null,
                "exercise_book_pages": null,
                "fast_bpm": null,
                "includes_song": null,
                "instructors": null,
                "live_event_start_time": null,
                "live_event_end_time": null,
                "live_event_youtube_id": null,
                "live_stream_feed_type": null,
                "name": null,
                "released": null,
                "slow_bpm": null,
                "transcriber_name": null,
                "week": null,
                "avatar_url": null,
                "length_in_seconds": null,
                "soundslice_slug": null,
                "staff_pick_rating": null,
                "student_id": null,
                "vimeo_video_id": null,
                "youtube_video_id": null,
                "data": [
                    {
                        "id": 130498,
                        "content_id": 251044,
                        "key": "resource_name",
                        "value": "Lead Sheet PDF",
                        "position": 1
                    },
                    {
                        "id": 130499,
                        "content_id": 251044,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178664.pdf",
                        "position": 1
                    },
                    {
                        "id": 130500,
                        "content_id": 251044,
                        "key": "resource_name",
                        "value": "Play-Along MP3",
                        "position": 2
                    },
                    {
                        "id": 130501,
                        "content_id": 251044,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178723.mp3",
                        "position": 2
                    },
                    {
                        "id": 130502,
                        "content_id": 251044,
                        "key": "resource_name",
                        "value": "Full Band MP3",
                        "position": 3
                    },
                    {
                        "id": 130503,
                        "content_id": 251044,
                        "key": "resource_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178789.mp3",
                        "position": 3
                    },
                    {
                        "id": 130693,
                        "content_id": 251044,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251044-card-thumbnail-1586430222.jpg",
                        "position": 1
                    },
                    {
                        "id": 130694,
                        "content_id": 251044,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/251044-card-thumbnail-maxres-1586430228.jpg",
                        "position": 1
                    },
                    {
                        "id": 130909,
                        "content_id": 251044,
                        "key": "chapter_timecode",
                        "value": "42",
                        "position": 1
                    },
                    {
                        "id": 130910,
                        "content_id": 251044,
                        "key": "chapter_description",
                        "value": "Intro",
                        "position": 1
                    },
                    {
                        "id": 130911,
                        "content_id": 251044,
                        "key": "chapter_timecode",
                        "value": "80",
                        "position": 2
                    },
                    {
                        "id": 130912,
                        "content_id": 251044,
                        "key": "chapter_description",
                        "value": "Verse",
                        "position": 2
                    },
                    {
                        "id": 130913,
                        "content_id": 251044,
                        "key": "chapter_timecode",
                        "value": "211",
                        "position": 3
                    },
                    {
                        "id": 130914,
                        "content_id": 251044,
                        "key": "chapter_description",
                        "value": "Chorus",
                        "position": 3
                    },
                    {
                        "id": 130915,
                        "content_id": 251044,
                        "key": "chapter_timecode",
                        "value": "371",
                        "position": 4
                    },
                    {
                        "id": 130916,
                        "content_id": 251044,
                        "key": "chapter_description",
                        "value": "Bridge",
                        "position": 4
                    }
                ],
                "fields": [
                    {
                        "id": 1088269530,
                        "content_id": 251044,
                        "key": "title",
                        "value": "Instrumental Version",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 1183479595,
                        "content_id": 251044,
                        "key": "difficulty",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 610049053,
                        "content_id": 251044,
                        "key": "xp",
                        "value": 150,
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 92411769,
                        "content_id": 251044,
                        "key": "total_xp",
                        "value": "275",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 843221732,
                        "content_id": 251044,
                        "key": "video",
                        "value": {
                            "id": 251080,
                            "slug": "vimeo-video-404640042",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "total_xp": "150",
                            "brand": "pianote",
                            "language": "en-US",
                            "show_in_new_feed": null,
                            "user": "",
                            "published_on": "2020-04-06 16:30:16",
                            "archived_on": null,
                            "created_on": "2020-04-06 16:30:16",
                            "difficulty": null,
                            "home_staff_pick_rating": null,
                            "legacy_id": null,
                            "legacy_wordpress_post_id": null,
                            "qna_video": null,
                            "title": null,
                            "xp": null,
                            "album": null,
                            "artist": null,
                            "bpm": null,
                            "cd_tracks": null,
                            "chord_or_scale": null,
                            "difficulty_range": null,
                            "episode_number": null,
                            "exercise_book_pages": null,
                            "fast_bpm": null,
                            "includes_song": null,
                            "instructors": null,
                            "live_event_start_time": null,
                            "live_event_end_time": null,
                            "live_event_youtube_id": null,
                            "live_stream_feed_type": null,
                            "name": null,
                            "released": null,
                            "slow_bpm": null,
                            "transcriber_name": null,
                            "week": null,
                            "avatar_url": null,
                            "length_in_seconds": 517,
                            "soundslice_slug": null,
                            "staff_pick_rating": null,
                            "student_id": null,
                            "vimeo_video_id": "404640042",
                            "youtube_video_id": null,
                            "fields": [
                                {
                                    "id": 1934272108,
                                    "content_id": 251080,
                                    "key": "total_xp",
                                    "value": "150",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1797421102,
                                    "content_id": 251080,
                                    "key": "vimeo_video_id",
                                    "value": "404640042",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 1301890048,
                                    "content_id": 251080,
                                    "key": "length_in_seconds",
                                    "value": 517,
                                    "type": "string",
                                    "position": 1
                                }
                            ],
                            "data": []
                        },
                        "type": "content_id",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "1993",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "3",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "beginner",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "break down",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "break downs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "break-down",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "break-downs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "breakdown",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "breakdowns",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "creep",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "instrumental",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "learn",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "learning",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "lisa witt",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "melodic",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "melody",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "pablo honey",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "radiohead",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "song",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "songs",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "content_id": 251044,
                        "key": "tag",
                        "value": "version",
                        "type": "string",
                        "position": 1
                    }
                ]
            },
            "lessons": [
                {
                    "id": 251042,
                    "slug": "introduction",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "200",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": null,
                    "user": "",
                    "published_on": "2020-04-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-04-06 12:31:16",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Introduction",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 1222062287,
                            "content_id": 251042,
                            "key": "title",
                            "value": "Introduction",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1494148595,
                            "content_id": 251042,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 128611623,
                            "content_id": 251042,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 248347761,
                            "content_id": 251042,
                            "key": "total_xp",
                            "value": "200",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1229448515,
                            "content_id": 251042,
                            "key": "video",
                            "value": {
                                "id": 251081,
                                "slug": "vimeo-video-404639788",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-04-06 16:30:16",
                                "archived_on": null,
                                "created_on": "2020-04-06 16:30:16",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 62,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "404639788",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 133492720,
                                        "content_id": 251081,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 993429592,
                                        "content_id": 251081,
                                        "key": "vimeo_video_id",
                                        "value": "404639788",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 331205531,
                                        "content_id": 251081,
                                        "key": "length_in_seconds",
                                        "value": 62,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "1993",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "beginner",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "break down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "break downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "break-down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "break-downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "breakdown",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "breakdowns",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "creep",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "intro",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "introduction",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "learn",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "learning",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "lisa witt",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "pablo honey",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "radiohead",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "song",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251042,
                            "key": "tag",
                            "value": "songs",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 130477,
                            "content_id": 251042,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 1
                        },
                        {
                            "id": 130478,
                            "content_id": 251042,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178664.pdf",
                            "position": 1
                        },
                        {
                            "id": 130479,
                            "content_id": 251042,
                            "key": "resource_name",
                            "value": "Full Score PDF",
                            "position": 2
                        },
                        {
                            "id": 130480,
                            "content_id": 251042,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178689.pdf",
                            "position": 2
                        },
                        {
                            "id": 130481,
                            "content_id": 251042,
                            "key": "resource_name",
                            "value": "Play-Along MP3",
                            "position": 3
                        },
                        {
                            "id": 130482,
                            "content_id": 251042,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178723.mp3",
                            "position": 3
                        },
                        {
                            "id": 130483,
                            "content_id": 251042,
                            "key": "resource_name",
                            "value": "Full Band MP3",
                            "position": 4
                        },
                        {
                            "id": 130484,
                            "content_id": 251042,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178789.mp3",
                            "position": 4
                        },
                        {
                            "id": 130689,
                            "content_id": 251042,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-card-thumbnail-1586429477.jpg",
                            "position": 1
                        },
                        {
                            "id": 130690,
                            "content_id": 251042,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-card-thumbnail-maxres-1586429480.jpg",
                            "position": 1
                        }
                    ]
                },
                {
                    "id": 251043,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "275",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": null,
                    "user": "",
                    "published_on": "2020-04-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-04-06 12:31:46",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Accompaniment Version",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 153794151,
                            "content_id": 251043,
                            "key": "title",
                            "value": "Accompaniment Version",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 2032614007,
                            "content_id": 251043,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 685957688,
                            "content_id": 251043,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1988202933,
                            "content_id": 251043,
                            "key": "total_xp",
                            "value": "275",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 726266784,
                            "content_id": 251043,
                            "key": "video",
                            "value": {
                                "id": 251068,
                                "slug": "vimeo-video-404639820",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-04-06 15:30:14",
                                "archived_on": null,
                                "created_on": "2020-04-06 15:30:14",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 509,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "404639820",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 735954465,
                                        "content_id": 251068,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 41435837,
                                        "content_id": 251068,
                                        "key": "vimeo_video_id",
                                        "value": "404639820",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 652578252,
                                        "content_id": 251068,
                                        "key": "length_in_seconds",
                                        "value": 509,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "1993",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "accompaniment",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "beginner",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "break down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "break downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "break-down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "break-downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "breakdown",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "breakdowns",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "creep",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "learn",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "learning",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "lisa witt",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "pablo honey",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "radiohead",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "song",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "songs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251043,
                            "key": "tag",
                            "value": "version",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 130492,
                            "content_id": 251043,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 1
                        },
                        {
                            "id": 130493,
                            "content_id": 251043,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178664.pdf",
                            "position": 1
                        },
                        {
                            "id": 130494,
                            "content_id": 251043,
                            "key": "resource_name",
                            "value": "Play-Along MP3",
                            "position": 2
                        },
                        {
                            "id": 130495,
                            "content_id": 251043,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178723.mp3",
                            "position": 2
                        },
                        {
                            "id": 130496,
                            "content_id": 251043,
                            "key": "resource_name",
                            "value": "Full Band MP3",
                            "position": 3
                        },
                        {
                            "id": 130497,
                            "content_id": 251043,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178789.mp3",
                            "position": 3
                        },
                        {
                            "id": 130691,
                            "content_id": 251043,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251043-card-thumbnail-1586429762.jpg",
                            "position": 1
                        },
                        {
                            "id": 130692,
                            "content_id": 251043,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251043-card-thumbnail-maxres-1586429764.jpg",
                            "position": 1
                        },
                        {
                            "id": 130885,
                            "content_id": 251043,
                            "key": "chapter_timecode",
                            "value": "20",
                            "position": 1
                        },
                        {
                            "id": 130886,
                            "content_id": 251043,
                            "key": "chapter_description",
                            "value": "Intro",
                            "position": 1
                        },
                        {
                            "id": 130887,
                            "content_id": 251043,
                            "key": "chapter_timecode",
                            "value": "145",
                            "position": 2
                        },
                        {
                            "id": 130888,
                            "content_id": 251043,
                            "key": "chapter_description",
                            "value": "Verse",
                            "position": 2
                        },
                        {
                            "id": 130889,
                            "content_id": 251043,
                            "key": "chapter_timecode",
                            "value": "212",
                            "position": 3
                        },
                        {
                            "id": 130890,
                            "content_id": 251043,
                            "key": "chapter_description",
                            "value": "Chorus",
                            "position": 3
                        },
                        {
                            "id": 130891,
                            "content_id": 251043,
                            "key": "chapter_timecode",
                            "value": "381",
                            "position": 4
                        },
                        {
                            "id": 130892,
                            "content_id": 251043,
                            "key": "chapter_description",
                            "value": "Bridge",
                            "position": 4
                        }
                    ]
                },
                {
                    "id": 251044,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "275",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": null,
                    "user": "",
                    "published_on": "2020-04-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-04-06 12:32:02",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Instrumental Version",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 1279106431,
                            "content_id": 251044,
                            "key": "title",
                            "value": "Instrumental Version",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 557903635,
                            "content_id": 251044,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1139982125,
                            "content_id": 251044,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1861560963,
                            "content_id": 251044,
                            "key": "total_xp",
                            "value": "275",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1739442067,
                            "content_id": 251044,
                            "key": "video",
                            "value": {
                                "id": 251080,
                                "slug": "vimeo-video-404640042",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-04-06 16:30:16",
                                "archived_on": null,
                                "created_on": "2020-04-06 16:30:16",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 517,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "404640042",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 425034657,
                                        "content_id": 251080,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 297380650,
                                        "content_id": 251080,
                                        "key": "vimeo_video_id",
                                        "value": "404640042",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 332344342,
                                        "content_id": 251080,
                                        "key": "length_in_seconds",
                                        "value": 517,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "1993",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "beginner",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "break down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "break downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "break-down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "break-downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "breakdown",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "breakdowns",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "creep",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "instrumental",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "learn",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "learning",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "lisa witt",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "melodic",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "melody",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "pablo honey",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "radiohead",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "song",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "songs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251044,
                            "key": "tag",
                            "value": "version",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 130498,
                            "content_id": 251044,
                            "key": "resource_name",
                            "value": "Lead Sheet PDF",
                            "position": 1
                        },
                        {
                            "id": 130499,
                            "content_id": 251044,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178664.pdf",
                            "position": 1
                        },
                        {
                            "id": 130500,
                            "content_id": 251044,
                            "key": "resource_name",
                            "value": "Play-Along MP3",
                            "position": 2
                        },
                        {
                            "id": 130501,
                            "content_id": 251044,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178723.mp3",
                            "position": 2
                        },
                        {
                            "id": 130502,
                            "content_id": 251044,
                            "key": "resource_name",
                            "value": "Full Band MP3",
                            "position": 3
                        },
                        {
                            "id": 130503,
                            "content_id": 251044,
                            "key": "resource_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251042-resource-1586178789.mp3",
                            "position": 3
                        },
                        {
                            "id": 130693,
                            "content_id": 251044,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251044-card-thumbnail-1586430222.jpg",
                            "position": 1
                        },
                        {
                            "id": 130694,
                            "content_id": 251044,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251044-card-thumbnail-maxres-1586430228.jpg",
                            "position": 1
                        },
                        {
                            "id": 130909,
                            "content_id": 251044,
                            "key": "chapter_timecode",
                            "value": "42",
                            "position": 1
                        },
                        {
                            "id": 130910,
                            "content_id": 251044,
                            "key": "chapter_description",
                            "value": "Intro",
                            "position": 1
                        },
                        {
                            "id": 130911,
                            "content_id": 251044,
                            "key": "chapter_timecode",
                            "value": "80",
                            "position": 2
                        },
                        {
                            "id": 130912,
                            "content_id": 251044,
                            "key": "chapter_description",
                            "value": "Verse",
                            "position": 2
                        },
                        {
                            "id": 130913,
                            "content_id": 251044,
                            "key": "chapter_timecode",
                            "value": "211",
                            "position": 3
                        },
                        {
                            "id": 130914,
                            "content_id": 251044,
                            "key": "chapter_description",
                            "value": "Chorus",
                            "position": 3
                        },
                        {
                            "id": 130915,
                            "content_id": 251044,
                            "key": "chapter_timecode",
                            "value": "371",
                            "position": 4
                        },
                        {
                            "id": 130916,
                            "content_id": 251044,
                            "key": "chapter_description",
                            "value": "Bridge",
                            "position": 4
                        }
                    ]
                },
                {
                    "id": 251045,
                    "slug": "asd",
                    "type": "song-part",
                    "sort": 0,
                    "status": "published",
                    "total_xp": "150",
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": null,
                    "user": "",
                    "published_on": "2020-04-10 19:00:00",
                    "archived_on": null,
                    "created_on": "2020-04-06 12:32:16",
                    "difficulty": "3",
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": "Performance",
                    "xp": 150,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": null,
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "id": 2090662841,
                            "content_id": 251045,
                            "key": "title",
                            "value": "Performance",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1940935992,
                            "content_id": 251045,
                            "key": "difficulty",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 1722345167,
                            "content_id": 251045,
                            "key": "xp",
                            "value": 150,
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 122821188,
                            "content_id": 251045,
                            "key": "total_xp",
                            "value": "150",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "id": 888680531,
                            "content_id": 251045,
                            "key": "video",
                            "value": {
                                "id": 251076,
                                "slug": "vimeo-video-404640248",
                                "type": "vimeo-video",
                                "sort": 0,
                                "status": "published",
                                "total_xp": "150",
                                "brand": "pianote",
                                "language": "en-US",
                                "show_in_new_feed": null,
                                "user": "",
                                "published_on": "2020-04-06 16:30:15",
                                "archived_on": null,
                                "created_on": "2020-04-06 16:30:15",
                                "difficulty": null,
                                "home_staff_pick_rating": null,
                                "legacy_id": null,
                                "legacy_wordpress_post_id": null,
                                "qna_video": null,
                                "title": null,
                                "xp": null,
                                "album": null,
                                "artist": null,
                                "bpm": null,
                                "cd_tracks": null,
                                "chord_or_scale": null,
                                "difficulty_range": null,
                                "episode_number": null,
                                "exercise_book_pages": null,
                                "fast_bpm": null,
                                "includes_song": null,
                                "instructors": null,
                                "live_event_start_time": null,
                                "live_event_end_time": null,
                                "live_event_youtube_id": null,
                                "live_stream_feed_type": null,
                                "name": null,
                                "released": null,
                                "slow_bpm": null,
                                "transcriber_name": null,
                                "week": null,
                                "avatar_url": null,
                                "length_in_seconds": 221,
                                "soundslice_slug": null,
                                "staff_pick_rating": null,
                                "student_id": null,
                                "vimeo_video_id": "404640248",
                                "youtube_video_id": null,
                                "fields": [
                                    {
                                        "id": 2065324499,
                                        "content_id": 251076,
                                        "key": "total_xp",
                                        "value": "150",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 858572244,
                                        "content_id": 251076,
                                        "key": "vimeo_video_id",
                                        "value": "404640248",
                                        "type": "string",
                                        "position": 1
                                    },
                                    {
                                        "id": 1039577127,
                                        "content_id": 251076,
                                        "key": "length_in_seconds",
                                        "value": 221,
                                        "type": "string",
                                        "position": 1
                                    }
                                ],
                                "data": []
                            },
                            "type": "content_id",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "1993",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "3",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "beginner",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "break down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "break downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "break-down",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "break-downs",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "breakdown",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "breakdowns",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "creep",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "learn",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "learning",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "lisa witt",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "pablo honey",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "performance",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "performances",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "radiohead",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "song",
                            "type": "string",
                            "position": 1
                        },
                        {
                            "content_id": 251045,
                            "key": "tag",
                            "value": "songs",
                            "type": "string",
                            "position": 1
                        }
                    ],
                    "data": [
                        {
                            "id": 130695,
                            "content_id": 251045,
                            "key": "thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251045-card-thumbnail-1586430415.jpg",
                            "position": 1
                        },
                        {
                            "id": 130696,
                            "content_id": 251045,
                            "key": "original_thumbnail_url",
                            "value": "https://d1923uyy6spedc.cloudfront.net/251045-card-thumbnail-maxres-1586430418.jpg",
                            "position": 1
                        }
                    ]
                }
            ],
            "lesson_count": 4,
            "like_count": "0",
            "is_liked_by_current_user": false,
            "resources": {
                "1": {
                    "resource_name": "Song Resources Pack",
                    "resource_url": "https://d1923uyy6spedc.cloudfront.net/250094-resource-1586531685.zip"
                }
            },
            "xp_bonus": 500,
            "fields": [
                {
                    "content_id": 250094,
                    "key": "title",
                    "value": "Creep",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "difficulty",
                    "value": "3",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "artist",
                    "value": "Radiohead",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "total_xp",
                    "value": "1400",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "topic",
                    "value": "Rock",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "tag",
                    "value": "creep",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "tag",
                    "value": "grunge",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "tag",
                    "value": "radiohead",
                    "position": 1,
                    "type": "string"
                },
                {
                    "content_id": 250094,
                    "key": "tag",
                    "value": "rock",
                    "position": 1,
                    "type": "string"
                }
            ],
            "data": [
                {
                    "id": 130475,
                    "content_id": 250094,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/250094-card-thumbnail-1586176238.jpg",
                    "position": 1
                },
                {
                    "id": 130476,
                    "content_id": 250094,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/250094-card-thumbnail-maxres-1586176244.jpg",
                    "position": 1
                },
                {
                    "id": 130688,
                    "content_id": 250094,
                    "key": "description",
                    "value": "<p>\"Creep\" is the debut single from Radiohead's first album. It was released in September of 1992. Radiohead used inspiration from the Hollies song \"The Air That I Breathe\", and after a legal battle credited Hollies members as co-writers!</p>",
                    "position": 1
                },
                {
                    "id": 130933,
                    "content_id": 250094,
                    "key": "resource_name",
                    "value": "Song Resources Pack",
                    "position": 1
                },
                {
                    "id": 130934,
                    "content_id": 250094,
                    "key": "resource_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/250094-resource-1586531685.zip",
                    "position": 1
                }
            ],
            "children": [
                {
                    "child_id": 251042
                },
                {
                    "child_id": 251043
                },
                {
                    "child_id": 251044
                },
                {
                    "child_id": 251045
                }
            ]
        }
    ],
    "meta": {
        "limit": 10,
        "page": 1,
        "totalResults": 3,
        "filterOptions": {
            "difficulty": [
                "3"
            ],
            "topic": [
                "rock"
            ],
            "artist": [
                "Evanescence",
                "Radiohead"
            ],
            "instructor": [
                {
                    "id": 196999,
                    "slug": "lisa-witt",
                    "type": "instructor",
                    "sort": 0,
                    "status": "published",
                    "total_xp": null,
                    "brand": "pianote",
                    "language": "en-US",
                    "show_in_new_feed": null,
                    "user": "",
                    "published_on": "2018-02-28 17:01:11",
                    "archived_on": null,
                    "created_on": "2018-02-28 17:01:11",
                    "difficulty": null,
                    "home_staff_pick_rating": null,
                    "legacy_id": null,
                    "legacy_wordpress_post_id": null,
                    "qna_video": null,
                    "title": null,
                    "xp": null,
                    "album": null,
                    "artist": null,
                    "bpm": null,
                    "cd_tracks": null,
                    "chord_or_scale": null,
                    "difficulty_range": null,
                    "episode_number": null,
                    "exercise_book_pages": null,
                    "fast_bpm": null,
                    "includes_song": null,
                    "instructors": null,
                    "live_event_start_time": null,
                    "live_event_end_time": null,
                    "live_event_youtube_id": null,
                    "live_stream_feed_type": null,
                    "name": "Lisa Witt",
                    "released": null,
                    "slow_bpm": null,
                    "transcriber_name": null,
                    "week": null,
                    "avatar_url": null,
                    "length_in_seconds": null,
                    "soundslice_slug": null,
                    "staff_pick_rating": null,
                    "student_id": null,
                    "vimeo_video_id": null,
                    "youtube_video_id": null,
                    "fields": [
                        {
                            "content_id": 196999,
                            "key": "name",
                            "value": "Lisa Witt",
                            "position": 1,
                            "type": "string"
                        }
                    ],
                    "data": [
                        {
                            "id": 40009,
                            "content_id": 196999,
                            "key": "head_shot_picture_url",
                            "value": "https://d2vyvo0tyx8ig5.cloudfront.net/instructors/lisawitt.png",
                            "position": 1
                        },
                        {
                            "id": 40010,
                            "content_id": 196999,
                            "key": "biography",
                            "value": "I love to help students unlock their full musical potential. I have taught in a wide variety of settings from Music for Young Children to helping recording artists prepare their songs for the road. I also have specialized experience working with children that struggle with learning, developmental, and physical disabilities. While my background is classical, I'm currently focusing on helping my students play the music they love by ear!\n\nI'm excited to be a part of YOUR journey as you learn how to sight read, play by ear, and progress through musical theory. It is going to be fun!",
                            "position": 1
                        }
                    ]
                }
            ],
            "content_type": [
                "course",
                "song"
            ]
        },
        "activeFilters": {
            "content_type": [
                "course",
                "song"
            ],
            "difficulty": [
                "3"
            ]
        }
    }
}
```






