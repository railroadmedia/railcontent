- [API endpoints](#api-endpoints)
  * [Get content - JSON controller](#get-content---json-controller)
    + [Request Example](#request-example)
    + [Request Parameters](#request-parameters)
    + [Response Example](#response-example)
  * [Get contents based on ids - JSON controller](#get-contents-based-on-ids---json-controller)
    + [Request Example](#request-example-1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example](#response-example-1)
  * [Get contents that are childrens of the content id - JSON controller](#get-contents-that-are-childrens-of-the-content-id---json-controller)
    + [Request Example](#request-example-2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example](#response-example-2)
  * [Filter contents  - JSON controller](#filter-contents----json-controller)
    + [Request Example](#request-example-3)
    + [Request Parameters](#request-parameters-3)
    + [Response Example](#response-example-3)
  * [Full text search  - JSON controller](#full-text-search----json-controller)
    + [Request Example](#request-example-4)
    + [Request Parameters](#request-parameters-4)
    + [Response Example](#response-example-4)
  * [Store content - JSON controller](#store-content---json-controller)
    + [Request Example](#request-example-5)
    + [Request Parameters](#request-parameters-5)
    + [Response Example](#response-example-5)
  * [Update content - JSON controller](#update-content---json-controller)
    + [Request Example](#request-example-6)
    + [Request Parameters](#request-parameters-6)
    + [Response Example](#response-example-6)
  * [Delete content - JSON controller](#delete-content---json-controller)
    + [Request Example](#request-example-7)
    + [Request Parameters](#request-parameters-7)
    + [Response Example](#response-example-7)
  * [Soft delete content - JSON controller](#soft-delete-content---json-controller)
    + [Request Example](#request-example-8)
    + [Request Parameters](#request-parameters-8)
    + [Response Example](#response-example-8)
  * [Configure Route Options - JSON controller](#configure-route-options---json-controller)
  * [Store content field - JSON controller](#store-content-field---json-controller)
    + [Request Example](#request-example-9)
    + [Request Parameters](#request-parameters-9)
    + [Response Example](#response-example-9)
  * [Update content field - JSON controller](#update-content-field---json-controller)
    + [Request Example](#request-example-10)
    + [Request Parameters](#request-parameters-10)
    + [Response Example](#response-example-10)
  * [Delete content field - JSON controller](#delete-content-field---json-controller)
    + [Request Example](#request-example-11)
    + [Request Parameters](#request-parameters-11)
    + [Response Example](#response-example-11)
  * [Get content field - JSON controller](#get-content-field---json-controller)
    + [Request Example](#request-example-12)
    + [Request Parameters](#request-parameters-12)
    + [Response Example](#response-example-12)
  * [Store content datum - JSON controller](#store-content-datum---json-controller)
    + [Request Example](#request-example-13)
    + [Request Parameters](#request-parameters-13)
    + [Response Example](#response-example-13)
  * [Update content datum - JSON controller](#update-content-datum---json-controller)
    + [Request Example](#request-example-14)
    + [Request Parameters](#request-parameters-14)
    + [Response Example](#response-example-14)
  * [Delete content datum - JSON controller](#delete-content-datum---json-controller)
    + [Request Example](#request-example-15)
    + [Request Parameters](#request-parameters-15)
    + [Response Example](#response-example-15)
  * [Store content hierarchy - JSON controller](#store-content-hierarchy---json-controller)
    + [Request Example](#request-example-16)
    + [Request Parameters](#request-parameters-16)
    + [Response Example](#response-example-16)
  * [Change child position in content hierarchy - JSON controller](#change-child-position-in-content-hierarchy---json-controller)
    + [Request Example](#request-example-17)
    + [Request Parameters](#request-parameters-17)
    + [Response Example](#response-example-17)
  * [Delete child from content hierarchy - JSON controller](#delete-child-from-content-hierarchy---json-controller)
    + [Request Example](#request-example-18)
    + [Request Parameters](#request-parameters-18)
    + [Response Example](#response-example-18)
  * [Start authenticated user progress on content - JSON controller](#start-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-19)
    + [Request Parameters](#request-parameters-19)
    + [Response Example](#response-example-19)
  * [Save authenticated user progress on content - JSON controller](#save-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-20)
    + [Request Parameters](#request-parameters-20)
    + [Response Example](#response-example-20)
  * [Reset authenticated user progress on content - JSON controller](#reset-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-21)
    + [Request Parameters](#request-parameters-21)
    + [Response Example](#response-example-21)
  * [Complete authenticated user progress on content - JSON controller](#complete-authenticated-user-progress-on-content---json-controller)
    + [Request Example](#request-example-22)
    + [Request Parameters](#request-parameters-22)
    + [Response Example](#response-example-22)
  * [Store permission - JSON controller](#store-permission---json-controller)
    + [Request Example](#request-example-23)
    + [Request Parameters](#request-parameters-23)
    + [Response Example](#response-example-23)
  * [Change permission - JSON controller](#change-permission---json-controller)
    + [Request Example](#request-example-24)
    + [Request Parameters](#request-parameters-24)
    + [Response Example](#response-example-24)
  * [Delete permission - JSON controller](#delete-permission---json-controller)
    + [Request Example](#request-example-25)
    + [Request Parameters](#request-parameters-25)
    + [Response Example](#response-example-25)
  * [Assign permission - JSON controller](#assign-permission---json-controller)
    + [Request Example](#request-example-26)
    + [Request Parameters](#request-parameters-26)
    + [Response Example](#response-example-26)
  * [Dissociate permission - JSON controller](#dissociate-permission---json-controller)
    + [Request Example](#request-example-27)
    + [Request Parameters](#request-parameters-27)
    + [Response Example](#response-example-27)
  * [Get permissions - JSON controller](#get-permissions---json-controller)
    + [Request Example](#request-example-28)
    + [Response Example](#response-example-28)
  * [Give user access - JSON controller](#give-user-access---json-controller)
    + [Request Example](#request-example-29)
    + [Request Parameters](#request-parameters-28)
    + [Response Example](#response-example-29)
  * [Change user access - JSON controller](#change-user-access---json-controller)
    + [Request Example](#request-example-30)
    + [Request Parameters](#request-parameters-29)
    + [Response Example](#response-example-30)
  * [Delete user access - JSON controller](#delete-user-access---json-controller)
    + [Request Example](#request-example-31)
    + [Request Parameters](#request-parameters-30)
    + [Response Example](#response-example-31)
  * [Pull users permissions - JSON controller](#pull-users-permissions---json-controller)
    + [Request Example](#request-example-32)
    + [Request Parameters](#request-parameters-31)
    + [Response Example](#response-example-32)
    + [Request Parameters](#request-parameters-32)
    + [Response Example](#response-example-33)
  * [Change comment - JSON controller](#change-comment---json-controller)
    + [Request Example](#request-example-33)
    + [Request Parameters](#request-parameters-33)
    + [Response Example](#response-example-34)
  * [Delete comment - JSON controller](#delete-comment---json-controller)
    + [Request Example](#request-example-34)
    + [Request Parameters](#request-parameters-34)
    + [Response Example](#response-example-35)
  * [Reply to a comment - JSON controller](#reply-to-a-comment---json-controller)
    + [Request Example](#request-example-35)
    + [Request Parameters](#request-parameters-35)
    + [Response Example](#response-example-36)
  * [Pull comments - JSON controller](#pull-comments---json-controller)
    + [Request Example](#request-example-36)
    + [Request Parameters](#request-parameters-36)
    + [Response Example](#response-example-37)
  * [Get linked comments - JSON controller](#get-linked-comments---json-controller)
    + [Request Example](#request-example-37)
    + [Request Parameters](#request-parameters-37)
    + [Response Example](#response-example-38)
  * [Like a comment - JSON controller](#like-a-comment---json-controller)
    + [Request Example](#request-example-38)
    + [Response Example](#response-example-39)
  * [Unlike a comment - JSON controller](#unlike-a-comment---json-controller)
    + [Request Example](#request-example-39)
    + [Response Example](#response-example-40)
  * [Get comment likes- JSON controller](#get-comment-likes--json-controller)
    + [Request Example](#request-example-40)
    + [Request Parameters](#request-parameters-38)
    + [Response Example](#response-example-41)
  * [Pull assigned to me comments - JSON controller](#pull-assigned-to-me-comments---json-controller)
    + [Request Example](#request-example-41)
    + [Request Parameters](#request-parameters-39)
    + [Response Example](#response-example-42)
  * [Delete comment assignation - JSON controller](#delete-comment-assignation---json-controller)
    + [Request Example](#request-example-42)
    + [Request Parameters](#request-parameters-40)
    + [Response Example](#response-example-43)
  * [Follow a content - JSON controller](#follow-a-content---json-controller)
    + [Request Example](#request-example-43)
    + [Response Example](#response-example-44)
  * [Unfollow a content - JSON controller](#unfollow-a-content---json-controller)
    + [Request Example](#request-example-44)
    + [Response Example](#response-example-45)
  * [Get followed contents - JSON controller](#get-followed-contents---json-controller)
    + [Request Example](#request-example-45)
    + [Request Parameters](#request-parameters-41)
    + [Response Example](#response-example-46)
  * [Get lessons from the specific coaches that the user follows - JSON controller](#get-lessons-from-the-specific-coaches-that-the-user-follows---json-controller)
    + [Request Example](#request-example-46)
    + [Request Parameters](#request-parameters-42)
    + [Response Example](#response-example-47)

<!-- ecotrust-canada.github.io/markdown-toc -->


# API endpoints


Get content - JSON controller
--------------------------------------

`{ GET /content/{id} }`

Get content data based on content id.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/1',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body | key                | required | description\|notes             |
| ----------------- | ------------------ | -------- | ------------------------------ |
| path              | id                 | yes      | Id of the content you want to pull  |


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes ,  , Id of the content you want to pull
-->


### Response Example


```201 OK```

```json

{
    "status":"ok",
    "code":201,
    "results":{
            "id":"1",
            "slug":"quis",
            "status":"draft",
            "type":"nihil",
            "parent_id":null,
            "language":"en-US",
            "brand":"drumeo",
            "created_on":"2017-10-26 16:00:03"
    }
}

```

```404 Not Found```
```json

{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"No content with id 2 exists."
      }
}
```


Get contents based on ids - JSON controller
--------------------------------------

`{ GET /content/get-by-ids }`

Get an array with contents data based on content ids.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/get-by-ids?ids=234,22,1663,2,9',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body | key                | required | description\|notes             |
| ----------------- | ------------------ | -------- | ------------------------------ |
| query              | ids                 | yes      | A comma separated string of the ids you want to pull.  |


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
query , ids , yes ,  , A comma separated string of the ids you want to pull.
-->


### Response Example

```200 OK```

```json

{
    "status":"ok",
    "code":201,
    "results":{
       
            "id":"243",
            "slug":"quis",
            "status":"draft",
            "type":"nihil",
            "parent_id":null,
            "language":"en-US",
            "brand":"drumeo",
            "created_on":"2017-10-26 16:00:03"
        		}, ...
}

```

Get contents that are childrens of the content id - JSON controller
--------------------------------------

`{ GET /content/parent/{parentId} }`

Get an array with contents data that are childrens of the specified content id.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/parent/1',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  default |  description\|notes                                  | 
|-----------------|------|-----------|----------|------------------------------------------------------| 
| query           |  id  |  yes      |          |  The parent content id you want to pull content for. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
query , id , yes ,  , The parent content id you want to pull content for.
-->


### Response Example

```200 OK```

```json

{
    "status":"ok",
    "code":200,
    "results":{
      "2":{
            "id":"2",
            "slug":"asperiores",
            "type":"course",
            "status":"published",
            "language":"en-US",
            "brand":"drumeo",
            "published_on":"2008-09-01 01:44:13",
            "created_on":"2017-12-21 13:02:52",
            "archived_on":null,
            "parent_id":"1",
            "child_id":"2",
            "fields":[],
            "data":[],
            "permissions":[],
            "child_ids":["2"],
            "position":"1"
      },
      "3":{
        		"id":"3",
        		"slug":"magnam",
        		"type":"course",
        		"status":"published",
        		"language":"en-US",
        		"brand":"drumeo",
        		"published_on":"2017-10-19 21:40:53",
        		"created_on":"2017-12-21 13:02:52",
        		"archived_on":null,
        		"parent_id":"1",
        		"child_id":"3",
        		"fields":[],
        		"data":[],
        		"permissions":[],
        		"child_ids":["3"],
        		"position":"2"
      }
    }
}  


```

Filter contents  - JSON controller
--------------------------------------

`{ GET /content }`

Get an array with contents data that respect filters criteria. The results are paginated.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content?' +
        'page=1' + '&' +
        'limit=1' + '&' +
        'included_types[]=course' + '&' +
        'statuses[]=published' + '&' +
        'required_parent_ids[]=6' + '&' +
        'filter[required_fields][]=topic,rock,string' + '&' +
        'filter[included_fields][]=topic,jazz,string' + '&' +
        'filter[included_fields][]=difficulty,3,integer' + '&' +
        'filter[included_fields][]=difficulty,9' + '&' +
        'filter[required_user_states][]=completed' + '&' +
        'filter[included_user_states][]=started' + '&' +
        'filter[required_user_playlists][]=my_fun_list' + '&' +
        'filter[included_user_playlists][]=my_other_fun_list',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body|  key                              |  required |  default         |  description\|notes                                                                                                                                                                                                                                                             | 
|-----------------|-----------------------------------|-----------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| query           |  page                             |  no       |  10              |  Which page in the result set to return. The amount of contents skipped is ((limit - 1) * page).                                                                                                                                                                                | 
| query           |  limit                            |  no       |  1               |  The max amount of contents that can be returned. Can be 'null' for no limit.                                                                                                                                                                                                   | 
| query           |  sort                             |  no       |  'published_on'  |  Defaults to ascending order; to switch to descending order put a minus sign (-) in front of the value. Can be any of the following: slug; status; type; brand; language; position; parent_id; published_on; created_on; archived_on; popularity                                            | 
| query           |  included_types                   |  no       |  []              |  Contents with these types will be returned.                                                                                                                                                                                                                                    | 
| query           |  slug_hierarchy                   |  no       |  []              |  Contents with these types will be returned.                                                                                                                                                                                                                                    | 
| query           |  statuses                         |  no       |  'published'     |  All content must have one of these statuses.                                                                                                                                                                                                                                   | 
| query           |  required_parent_ids              |  no       |  []              |  All contents must be a child of any of the passed in parent ids.                                                                                                                                                                                                               | 
| query           |  filter[required_fields]          |  no       |  []              |  All returned contents are required to have this field. Value format is: key;value;type (type is optional if its not declared all types will be included)                                                                                                                       | 
| query           |  filter[included_fields]          |  no       |  []              |  Contents that have any of these fields will be returned. The first included field is the same as a required field but all included fields after the first act inclusively. Value format is: key value type (type is optional - if its not declared all types will be included) | 
| query           |  filter[required_user_states]     |  no       |  []              |  All returned contents are required to have these states for the authenticated user. Value format is: state                                                                                                                                                                     | 
| query           |  filter[included_user_states]     |  no       |  []              |  Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state but all included states after the first act inclusively. Value format is: state.                                        | 
| query           |  filter[required_user_playlists]  |  no       |  []              |  All returned contents are required to be inside these authenticated users playlists. Value format is: name.                                                                                                                                                                    | 
| query           |  filter[included_user_playlists]  |  no       |  []              |  Contents that are in any of the authenticated users playlists will be returned. The first included user playlist is the same as a required user playlist but all included playlist after the first act inclusively. Value format is: name                                      | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
query , page , no , 10 , Which page in the result set to return. The amount of contents skipped is ((limit - 1) * page).
query , limit , no , 1 , The max amount of contents that can be returned. Can be 'null' for no limit.
query , sort , no , 'published_on' , Defaults to ascending order; to switch to descending order put a minus sign (-) in front of the value. Can be any of the following: slug; status; type; brand; language; position; parent_id; published_on; created_on; archived_on
query , included_types , no , [] , Contents with these types will be returned.
query , slug_hierarchy , no , [] , Contents with these types will be returned.
query , statuses , no , 'published' , All content must have one of these statuses.
query , required_parent_ids , no , [] , All contents must be a child of any of the passed in parent ids.
query , filter[required_fields] , no , [] , All returned contents are required to have this field. Value format is: key;value;type (type is optional if its not declared all types will be included)
query , filter[included_fields] , no , [] , Contents that have any of these fields will be returned. The first included field is the same as a required field but all included fields after the first act inclusively. Value format is: key value type (type is optional - if its not declared all types will be included)
query , filter[required_user_states] , no , [] , All returned contents are required to have these states for the authenticated user. Value format is: state
query , filter[included_user_states] , no , [] , Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state but all included states after the first act inclusively. Value format is: state.
query , filter[required_user_playlists] , no , [] , All returned contents are required to be inside these authenticated users playlists. Value format is: name.
query , filter[included_user_playlists] , no , [] , Contents that are in any of the authenticated users playlists will be returned. The first included user playlist is the same as a required user playlist but all included playlist after the first act inclusively. Value format is: name
-->


### Response Example

```200 OK```

```json

{
    "status":"ok",
    "code":200,
    "page":1,
    "limit":1,
    "total_results":97,
    "results":{
        "3353":{
            "id":3353,
            "slug":"accusamus-rerum-occaecati",
            "status":"published",
            "type":"recording",
            "position":144,
            "parent_id":null,
            "language":"en-US",
            "published_on":"1975-02-09 09:44:58",
            "created_on":"2017-10-24 20:18:42",
            "brand":"drumeo",
            "fields":[
                {
                    "id":6416,
                    "key":"difficulty",
                    "value":"3",
                    "type":"integer",
                    "position":null
                },
                {
                    "id":2134,
                    "key":"topic",
                    "value":"rock",
                    "type":"string",
                    "position":null
                },
                {
                    "id":7,
                    "key":"topic",
                    "value":"jazz",
                    "type":"string",
                    "position":null
                },
                {
                    "id":144,
                    "key":"instructor",
                    "value":{
                        "id":57,
                        "slug":"reuben-spyker",
                        "type":"instructor",
                        "status":"published",
                        "language":"en-US",
                        "brand":"drumeo",
                        "published_on":"2017-10-31 18:14:07",
                        "archived_on":null,
                        "fields":[
                            {
                                "id":143,
                                "key":"name",
                                "value":"Reuben Spyker",
                                "type":"string",
                                "position":1
                            }
                        ],
                        "data":[
                            {
                                "id":115,
                                "key":"head_shot_picture_url",
                                "value":"http:\/\/dev.drumeo.com\/laravel\/assets\/images\/instructors\/reuben-spyker.png?v=1504720892",
                                "position":1
                            },
                            {
                                "id":116,
                                "key":"biography",
                                "value":"Reuben Spyker, a technique freak but also a player of many types of music, filmed his first lesson for Drumeo in 2015! He just recently joined the Drumeo team and will be working here full time. Attended Cap University for two years, recent projects include an electronic\/hip hop duo group (will be releasing music soon) and also manages a youtube channel. I like all styles of music (probably listen to Jazz, hip hop, neo soul and electronic the most) I also love espresso, free line skating, fashion, dancing and drawing\/painting. In my spare time I am currently learning bass guitar, latte art and juggling.",
                                "position":1
                            }
                        ]
                    },
                    "type":"content",
                    "position":1
                }
            ],
            "data":[
                {
                    "id":16471,
                    "key":"some-data",
                    "value":"large peice of data"
                }
            ]
        }
    },
    "filter_options":{
        "topic":[
            "rock",
            "jazz",
            "inventore",
            "tenetur",
            "voluptate",
            "repudiandae"
        ],
        "instructor":[
            {
                "id":39,
                "slug":"gavin-harrison",
                "type":"instructor",
                "status":"published",
                "language":"en-US",
                "brand":"drumeo",
                "published_on":"2017-10-31 18:14:06",
                "archived_on":null,
                "fields":[
                    {
                        "id":98,
                        "key":"name",
                        "value":"Gavin Harrison",
                        "type":"string",
                        "position":1
                    }
                ],
                "data":[
                    {
                        "id":75,
                        "key":"head_shot_picture_url",
                        "value":"http:\/\/dev.drumeo.com\/laravel\/assets\/images\/instructors\/gavin-harrison.png?v=1504720892",
                        "position":1
                    },
                    {
                        "id":76,
                        "key":"biography",
                        "value":"",
                        "position":1
                    },
                    {
                        "id":79,
                        "key":"head_shot_picture_url",
                        "value":"http:\/\/dev.drumeo.com\/laravel\/assets\/images\/instructors\/gavin-harrison.png?v=1504720892",
                        "position":1
                    },
                    {
                        "id":80,
                        "key":"biography",
                        "value":"",
                        "position":1
                    }
                ]
            },
            {
                "id":48,
                "slug":"kyle-radomsky",
                "type":"instructor",
                "status":"published",
                "language":"en-US",
                "brand":"drumeo",
                "published_on":"2017-10-31 18:14:06",
                "archived_on":null,
                "fields":[
                    {
                        "id":121,
                        "key":"name",
                        "value":"Kyle Radomsky",
                        "type":"string",
                        "position":1
                    }
                ],
                "data":[
                    {
                        "id":95,
                        "key":"head_shot_picture_url",
                        "value":"http:\/\/dev.drumeo.com\/laravel\/assets\/images\/instructors\/kyle-radomsky.png?v=1504720892",
                        "position":1
                    },
                    {
                        "id":96,
                        "key":"biography",
                        "value":"Kyle Radomsky is a versatile drummer with an assortment of experiences to draw from as an instructor, having toured internationally with a variety of bands including performances in Canada, the United States, United Arab Emirates, Taiwan, the Philippines, Indonesia, Bosnia, New Zealand, and Poland. He loves teaching, and is excited about the emergence of online lessons and the ability to connect with students around the world in real-time!",
                        "position":1
                    }
                ]
            }
        ],
        "difficulty":[
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10"
        ]
    }
}
```




Full text search  - JSON controller
--------------------------------------

`{ GET /search }`

Full text search in contents.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/search?' +
        'page=1' + '&' +
        'limit=10' + '&' +
        'term=practice along',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key             |  required |  default      |  description\|notes                                                                                                                               | 
|-------------------|------------------|-----------|---------------|---------------------------------------------------------------------------------------------------------------------------------------------------| 
| query             |  page            |  no       |  1            |  Which page in the result set to return. The amount of contents skipped is ((limit - 1) * page).                                                  | 
| query             |  limit           |  no       |  10           |  The max amount of contents that can be returned. Can be 'null' for no limit.                                                                     | 
| query             |  term            |  yes      |               |  Search criteria                                                                                                                                  | 
| query             |  included_types  |  no       |  []           |  Contents with these types will be returned.                                                                                                      | 
| query             |  statuses        |  no       |  'published'  |  All content must have one of these statuses.                                                                                                     | 
| query             |  sort            |  no       |  '-score'     |  Defaults to descending order; to switch to ascending order remove the minus sign (-). Can be any of the following: score or content_published_on | 
| query             |  brand           |  no       |               |  Contents from the brand will be returned.                                                                                                        |
| query             |  coach_ids       |  no       |     []        |  Only coaches contents will be returned.                                                                                                         |



<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
query , page , no , 1 , Which page in the result set to return. The amount of contents skipped is ((limit - 1) * page).
query , limit , no , 10 , The max amount of contents that can be returned. Can be 'null' for no limit.
query , term , yes ,  , Search criteria
query , included_types , no , [] , Contents with these types will be returned.
query , statuses , no , 'published' , All content must have one of these statuses.
query , sort , no , '-score' , Defaults to descending order; to switch to ascending order remove the minus sign (-). Can be any of the following: score or content_published_on
query , brand , no ,  , Contents from the brand will be returned.
-->


### Response Example

```200 OK```

```json

{
    "status": "ok",
    "code": 200,
    "page": "1",
    "limit": "10",
    "total_results": 2,
    "results": {
        "2": {
            "id": 2,
            "slug": "course 2",
            "type": "courses",
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "published_on": "2017-11-01 00:00:00",
            "created_on": "2017-11-27 00:00:00",
            "archived_on": null,
            "parent_id": null,
            "fields": [
                {
                    "id": 2,
                    "content_id": 2,
                    "key": "title",
                    "value": "Double-Bass Triplet Practice-Along",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 6,
                    "content_id": 2,
                    "key": "instructor",
                    "value": {
                        "id": 6,
                        "slug": "Reuben-Spyker",
                        "type": "instructor",
                        "status": "published",
                        "language": "en-US",
                        "brand": "drumeo",
                        "published_on": "2017-11-10 00:00:00",
                        "created_on": "2017-11-27 00:00:00",
                        "archived_on": null,
                        "parent_id": null,
                        "fields": [
                            {
                                "id": 7,
                                "content_id": 6,
                                "key": "name",
                                "value": "Reuben Spyker",
                                "type": "string",
                                "position": 1
                            }
                        ],
                        "data": [
                            {
                                "id": 2,
                                "content_id": 6,
                                "key": "description",
                                "value": "Reuben Spyker, a technique freak but also a player of many types of music, filmed his first lesson for Drumeo in 2015! He just recently joined the Drumeo team and will be working here full time. Attended Cap University for two years, recent projects include an electronic/hip hop duo group (will be releasing music soon) and also manages a youtube channel. I like all styles of music (probably listen to Jazz, hip hop, neo soul and electronic the most) I also love espresso, free line skating, fashion, dancing and drawing/painting. In my spare time I am currently learning bass guitar, latte art and juggling.",
                                "position": 1
                            }
                        ],
                        "permissions": []
                    },
                    "type": "content",
                    "position": 1
                }
            ],
            "data": [],
            "permissions": []
        },
        "3": {
            "id": 3,
            "slug": "course 3",
            "type": "courses",
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "published_on": "2017-11-16 00:00:00",
            "created_on": "2017-11-27 00:00:00",
            "archived_on": null,
            "parent_id": null,
            "fields": [
                {
                    "id": 3,
                    "content_id": 3,
                    "key": "title",
                    "value": "Double Bass Practice-Along ",
                    "type": "string",
                    "position": 1
                }
            ],
            "data": [],
            "permissions": []
        }
    },
    "filter_options": null
}
```

Store content - JSON controller
--------------------------------------

`{ PUT /content }`

Create a new content based on request data and return the new created content in JSON format.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content',
    type: 'put'
  	data: {slug: 'test-slug', type: 'course-lesson' status: 'draft'} 
		// language, brand, will be set to internal defaults
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key           |  required |  default                |  description\|notes                                                 | 
|-----------------|----------------|-----------|-------------------------|---------------------------------------------------------------------| 
| body            |  slug          |  yes      |                         |  Slug of the content                                                | 
| body            |  type          |  yes      |                         |  Type of content. Examples: 'recording' 'course' 'course-lesson'    | 
| body            |  status        |  yes      |                         |  Can be 'draft' 'published' 'archived'                              | 
| body            |  language      |  no       |  en-US                  |  Language locale                                                    | 
| body            |  brand         |  no       |  brand from config file |  'drumeo' 'pianote' etc                                             | 
| body            |  user_id       |  no       |  null                   |                                                                     | 
| body            |  published_on  |  no       |  now                    |  The published on date                                              | 
| body            |  created_on    |  no       |  now                    |  The creation date                                                  | 
| body            |  parent_id     |  no       |                         |  Id of the parent content you want to make this content a child of. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , slug , yes ,  , Slug of the content
body , type , yes ,  , Type of content. Examples: 'recording' 'course' 'course-lesson'
body , status , yes ,  , Can be 'draft' 'published' 'archived'
body , language , no , en-US , Language locale
body , brand , no , brand from config file, 'drumeo' 'pianote' etc
body , user_id , no , null ,
body , published_on , no , now , The published on date
body , created_on , no , now , The creation date
body , parent_id , no,  , Id of the parent content you want to make this content a child of.
-->


### Response Example

```200 OK```

```json

{
	"id":1075,
	"slug":"test-slug",
	"type":"course-lesson",
	"status":"draft",
	"language":"en-US",
	"brand":"drumeo",
	"user_id":null,
	"published_on":null,
	"created_on":"2015-09-28 16:25:05",
	"archived_on":null
}

```

Update content - JSON controller
--------------------------------------

`{ PATCH /content/{id} }`

Update a content with the request data and return the updated content in JSON format. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/17',
    type: 'patch'
  	data: {slug: 'my-new-slug', status: 'published'}
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key           |  required |  default                |  description\|notes                                                  | 
|-----------------|----------------|-----------|-------------------------|----------------------------------------------------------------------| 
| path            |  id            |  yes      |                         |  Id of the content you want to edit.                                 | 
| body            |  slug          |  yes      |                         |  New slug of the content                                             | 
| body            |  type          |  yes      |                         |  New type of content. Examples: 'recording' 'course' 'course-lesson' | 
| body            |  status        |  yes      |                         |  New status. Can be 'draft' 'published' 'archived'                   | 
| body            |  language      |  no       |  en-US                  |  New language locale                                                 | 
| body            |  brand         |  no       |  brand from config file |  New brand. Can be: 'drumeo' 'pianote' etc                           | 
| body            |  user_id       |  no       |  null                   |                                                                      | 
| body            |  published_on  |  no       |  now                    |  New published on date                                               | 
| body            |  created_on    |  no       |  now                    |  New creation date                                                   | 
| body            |  parent_id     |  no       |                         |  Id of the parent content you want to make this content a child of.  | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content you want to edit.
body , slug , yes ,  , New slug of the content
body , type , yes ,  , New type of content. Examples: 'recording' 'course' 'course-lesson'
body , status , yes ,  , New status. Can be 'draft' 'published' 'archived'
body , language , no , en-US , New language locale
body , brand , no , brand from config file, New brand. Can be: 'drumeo' 'pianote' etc
body , user_id , no , null ,
body , published_on , no , now , New published on date
body , created_on , no , now , New creation date
body , parent_id , no,  , Id of the parent content you want to make this content a child of.
-->


### Response Example

```201 OK```

```json

{
	"id":17,
	"slug":"my-new-slug",
	"type":"course-lesson",
	"status":"published",
	"language":"en-US",
	"brand":"drumeo",
	"user_id":null,
	"published_on":"2015-09-28 16:25:05",
	"created_on":"2015-09-28 16:25:05",
	"archived_on":null
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, content not found with id: 17"
      }
}
```


Delete content - JSON controller
--------------------------------------

`{ DELETE /content/{id} }`

Delete content and content related links if exists in the database. 

The content related links are: links with the parent, content childrens, content fields, content datum, links with the permissions, content comments, replies and assignation and links with the playlists.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/2',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  default |  description\|notes                    | 
|-----------------|------|-----------|----------|----------------------------------------| 
| path            |  id  |  yes      |          |  Id of the content you want to delete. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content you want to delete.
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, content not found with id: 2"
      }
}
```

Soft delete content - JSON controller
--------------------------------------

`{ DELETE /soft/content/{id} }`

The contents are  never actually deleted out of the database, it's only mark as deleted: the status it's set as `deleted`. 

If a content it's `soft deleted` the API will automatically filter it out from the pull request unless the status set on the pull requests explicitly state otherwise.  


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/soft/content/2',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  default |  description\|notes                             | 
|-----------------|------|-----------|----------|-------------------------------------------------| 
| path            |  id  |  yes      |          |  Id of the content you want to mark as deleted. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content you want to mark as deleted.
-->


### Response Example

```204 No Content``` 

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, content not found with id: 2"
      }
}
```

Configure Route Options - JSON controller
--------------------------------------

`{ OPTIONS /content }`

There are a number of route options that can be set on each route: allow `POST, PATCH, GET, OPTIONS, PUT, DELETE` methods, allow `X-Requested-With, content-type` headers.


Store content field - JSON controller
--------------------------------------

`{ PUT /content/field }`

Create a new content field based on request data and return the new created field data in JSON format.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/field',
    type: 'put'
  	data: {content_id: 3, key: 'topic' value: 'rock', type: 'string'} 
		// position will automatically be set to the end of the stack if you dont pass one in
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                               | 
|-----------------|--------------|-----------|----------|---------------------------------------------------------------------------------------------------| 
| body            |  content_id  |  yes      |          |  The content id this field belongs to.                                                            | 
| body            |  key         |  yes      |          |  The key of this field; also know as the name.                                                    | 
| body            |  value       |  yes      |          |  The value of the field.                                                                          | 
| body            |  position    |  no       |  1       |  The position of this field relative to other fields with the same key under the same content id. | 
| body            |  type        |  no       |  string  |  The type of field this is. Options are 'string' 'integer' 'content_id'                         | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , content_id , yes ,  , The content id this field belongs to.
body , key , yes ,  , The key of this field; also know as the name.
body , value , yes ,  , The value of the field.
body , position , no , 1 , The position of this field relative to other fields with the same key under the same content id.
body , type , no , string , The type of field this is. Options are 'string' 'integer' 'content_id'.
-->


### Response Example

```200 OK```

```json

{
	"id":162,
	"key":"topic",
	"value":"rock",
	"position":1,
	"type":"string"
}

```

Update content field - JSON controller
--------------------------------------

`{ PATCH /content/field/{fieldId} }`

Update a content with the request data and return the updated content in JSON format. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/field/513',
    type: 'patch'
  	data: {value: 'punk'} 
		// position will automatically be set to the end of the stack if you dont pass one in
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                               | 
|-----------------|--------------|-----------|----------|---------------------------------------------------------------------------------------------------| 
| path            |  id          |  yes      |          |  Id of the field you want to edit.                                                                | 
| body            |  content_id  |  yes      |          |  The content id this field belongs to.                                                            | 
| body            |  key         |  yes      |          |  The key of this field; also know as the name.                                                    | 
| body            |  value       |  yes      |          |  The value of the field.                                                                          | 
| body            |  position    |  no       |  1       |  The position of this field relative to other fields with the same key under the same content id. | 
| body            |  type        |  no       |  string  |  The type of field this is. Options are 'string' 'integer' 'content_id'.                          | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , Id of the field you want to edit.
body , content_id , yes ,  , The content id this field belongs to.
body , key , yes ,  , The key of this field; also know as the name.
body , value , yes ,  , The value of the field.
body , position , no , 1 , The position of this field relative to other fields with the same key under the same content id.
body , type , no , string , The type of field this is. Options are 'string' 'integer' 'content_id'.
-->


### Response Example

```201 OK```

```json

{
	"id":513,
	"key":"topic",
	"value":"punk",
	"position":1,
	"type":"string"
}

```
`404 Not Found`

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, content field not found with id: 513"
      }
}
```
Delete content field - JSON controller
--------------------------------------

`{ DELETE /content/field/{fieldId} }`

Delete content field if exists in the database. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/field/2',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  default |  description\|notes                    | 
|-----------------|------|-----------|----------|----------------------------------------| 
| path            |  id  |  yes      |          |  Id of the content field you want to delete. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content field you want to delete.
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, content field not found with id: 2"
      }
}
```

Get content field - JSON controller
--------------------------------------

`{ GET /content/field/{id} }`

Get content field data based on content field id.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/field/1',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body | key                | required | description\|notes             |
| ----------------- | ------------------ | -------- | ------------------------------ |
| path              | id                 | yes      | Id of the content field you want to pull  |


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes ,  , Id of the content field you want to pull
-->


### Response Example

```200 OK```

```json
{
    "status":"ok",
    "code":200,
    "results":{
            "id":"1",
            "content_id":"1",
            "key":"dolorem",
            "value":"nihil",
            "type":"atque",
            "position":"1"
        }
}

```


Store content datum - JSON controller
--------------------------------------

`{ PUT /content/datum }`

Create a new content datum record based on request data and return the new created datum data in JSON format.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum',
    type: 'put'
  	data: {content_id: 3, key: 'description' value: 'very long description here'} 
		// position will automatically be set to the end of the stack if you dont pass one in
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                               | 
|-----------------|--------------|-----------|----------|---------------------------------------------------------------------------------------------------| 
| body            |  content_id  |  yes      |          |  The content id this datum belongs to.                                                            | 
| body            |  key         |  yes      |          |  The key of this datum; also know as the name.                                                    | 
| body            |  value       |  yes      |          |  The value of the datum.                                                                          | 
| body            |  position    |  no       |  1       |  The position of this datum relative to other datum with the same key under the same content id. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , content_id , yes ,  , The content id this datum belongs to.
body , key , yes ,  , The key of this datum; also know as the name.
body , value , yes ,  , The value of the datum.
body , position , no , 1 , The position of this datum relative to other datum with the same key under the same content id.
-->


### Response Example

```200 OK```

```json

{
	"id":12,
	"key":"description",
	"value":"very long description here",
	"position":1
}

```

Update content datum - JSON controller
--------------------------------------

`{ PATCH /content/datum/{id} }`

Update the content datum with the request data and return the updated datum in JSON format. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum/73',
    type: 'patch'
  	data: {value: 'another long description here'}
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  default |  description\|notes                                                                              | 
|-----------------|--------------|-----------|----------|--------------------------------------------------------------------------------------------------| 
| path            |  id          |  yes      |          |  Id of the datum you want to edit.                                                               | 
| body            |  content_id  |  no       |          |  The content id this datum belongs to.                                                           | 
| body            |  key         |  no       |          |  The key of this datum; also know as the name.                                                   | 
| body            |  value       |  no       |          |  The value of the datum.                                                                         | 
| body            |  position    |  no       |  1       |  The position of this datum relative to other datum with the same key under the same content id. | 
                     | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , Id of the datum you want to edit.
body , content_id , no ,  , The content id this datum belongs to.
body , key , no ,  , The key of this datum; also know as the name.
body , value , no ,  , The value of the datum.
body , position , no , 1 , The position of this datum relative to other datum with the same key under the same content id.
-->


### Response Example

```201 OK```

```json
{
	"id":73,
	"key":"description",
	"value":"another long description here",
	"position":1
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, datum not found with id: 513"
      }
}
```
Delete content datum - JSON controller
--------------------------------------

`{ DELETE /content/datum/{id} }`

Delete content datum if exists in the database. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/datum/2',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  default |  description\|notes                    | 
|-----------------|------|-----------|----------|----------------------------------------| 
| path            |  id  |  yes      |          |  Id of the content datum you want to delete. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes,  , Id of the content datum you want to delete.
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, datum not found with id: 2"
      }
}
```

Store content hierarchy - JSON controller
--------------------------------------

`{ PUT /content/hierarchy }`

Create content hierarchy specifying parent id, child id and child position.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/hierarchy',
    type: 'put'
  	data: {parent_id: 3, child_id: 1, child_position: 22} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key             |  required |  default |  description\|notes                                                                                                                                                      | 
|-----------------|------------------|-----------|----------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| body            |  parent_id       |  yes      |          |  The content id of the parent.                                                                                                                                           | 
| body            |  child_id        |  yes      |          |  The content id of the child.                                                                                                                                            | 
| body            |  child_position  |  no      |  null    |  The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , parent_id , yes ,  , The content id of the parent.
body , child_id , yes ,  , The content id of the child.
body , child_position , no , null , The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.
-->


### Response Example

```200 OK```

```json

{
    "status":"ok",
    "code":200,
    "results":{
        "id":"1",
        "parent_id":"3",
        "child_id":"1",
        "child_position":"22"
    }
}

```
Change child position in content hierarchy - JSON controller
--------------------------------------

`{ PATCH /content/hierarchy/{parentId}/{childId} }`

Update the position for the child in the content hierarchy and recalculate position for other siblings.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/hierarchy/3/82',
    type: 'patch'
  	data: {child_position: 27} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key             |  required |  default |  description\|notes                                                                                                                                                      | 
|-----------------|------------------|-----------|----------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| path            |  parent_id       |  yes      |          |  Id of the parent content.                                                                                                                                               | 
| path            |  child_id        |  yes      |          |  Id of the child content that should be positioned.                                                                                                                      | 
| body            |  child_position  |  yes      |  null    |  The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , parent_id , yes , , Id of the parent content.
path , child_id , yes , , Id of the child content that should be positioned.
body , child_position , yes , null , The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.
-->


### Response Example

```201 OK```

```json
{
    "status":"ok",
    "code":201,
    "results":{
        "id":"1",
        "parent_id":"3",
        "child_id":"82",
        "child_position":"27"
    }
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update hierarchy failed."
      }
}
```
Delete child from content hierarchy - JSON controller
--------------------------------------

`{ DELETE /content/hierarchy/{parentId}/{childId} }`

Delete the link between parent content and child content and reposition other childrens.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/content/hierarchy/3/82',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key        |  required |  description\|notes        | 
|-----------------|-------------|-----------|----------------------------| 
| path            |  parent_id  |  yes      |  Id of the content parent. | 
| path            |  child_id   |  yes      |  Id of the child that should be removed from the hierarchy.          | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , parent_id , yes, Id of the content parent.
path , child_id , yes, Id of the child that should be removed from the hierarchy.    
-->


### Response Example

```204 No Content```  


Start authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /start }`

Start authenticated user progress on content. Please see more details about content progress in [Progress-Bubbling](https://github.com/railroadmedia/railcontent/tree/user-permission#progress-bubbling) section.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/start',
    type: 'put'
  	data: {content_id: 2} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  description\|notes                | 
|-----------------|--------------|-----------|------------------------------------| 
| body            |  content_id  |  yes      |  The content id you want to start. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id you want to start.
-->


### Response Example

```200 OK```

```json

{
  "status":"ok",
  "code":200,
  "results":true
}

```



Save authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /progress }`

Save the progress on a content for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/progress',
    type: 'put'
  	data: {content_id: 2, progress_percent: 30} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key               |  required |  description\|notes                                 | 
|-----------------|--------------------|-----------|-----------------------------------------------------| 
| body            |  content_id        |  yes      |  The content id on which we save the user progress. | 
| body            |  progress_percent  |  yes      |  The progress percent.                              | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we save the user progress.
body , progress_percent , yes , The progress percent.  
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```

Reset authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /reset }`

Delete the content progress for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/reset',
    type: 'put'
  	data: {content_id: 2} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  description\|notes                                  | 
|-----------------|--------------|-----------|------------------------------------------------------| 
| body            |  content_id  |  yes      |  The content id on which we reset the user progress. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we reset the user progress. 
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```

Complete authenticated user progress on content - JSON controller
--------------------------------------

`{ PUT /complete }`

Set content as complete for the authenticated user.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/complete',
    type: 'put'
  	data: {content_id: 2} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key         |  required |  description\|notes                                  | 
|-----------------|--------------|-----------|------------------------------------------------------| 
| body            |  content_id  |  yes      |  The content id on which we complete the user progress. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
body , content_id , yes , The content id on which we complete the user progress. 
-->


### Response Example

```201 OK```

```json

{
  "status":"ok",
  "code":201,
  "results":true
}

```

Store permission - JSON controller
--------------------------------------

`{ PUT /permission }`

Store a new permission in the CMS.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission',
    type: 'put'
  	data: {name: 'drumeo edge'} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key    |  required |  default                                    |  description\|notes                                       | 
|-----------------|---------|-----------|---------------------------------------------|-----------------------------------------------------------| 
| body            |  name   |  yes      |                                             |  The name of this permission - for example: 'drumeo edge' | 
| body            |  brand  |  no       |  The default brand from configuration file  |  The brand where the permission it's available            | 








<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , name , yes , , The name of this permission - for example: 'drumeo edge'
body , brand , no , The default brand from configuration file , The brand where the permission it's available
-->


### Response Example

```200 OK```

```json

{
	"id":24,
	"name":"drumeo edge",
    "brand":"brand"
}

```

Change permission - JSON controller
--------------------------------------

`{ PATCH /permission/{id} }`

Change permission name or the brand where the permission it's available.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/73',
    type: 'patch'
  	data: {name: 'bass drum system',} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key   |  required |  default |  description\|notes                            | 
|-----------------|--------|-----------|----------|------------------------------------------------| 
| path            |  id    |  yes      |          |  Id of the permission you want to change.      | 
| body            |  name  |  yes      |          |  The new name of this permission               | 
| body            |  brand |  no       |          |  The brand where the permission it's available | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes, , Id of the permission you want to change.
body , name , yes , , The new name of this permission 
body , brand, no , , The brand where the permission it's available
-->


### Response Example

```201 OK```

```json
{
	"id":73,
	"name":"bass drum system",
    "brand":"brand"
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, permission not found with id: 73"
      }
}
```

Delete permission - JSON controller
--------------------------------------

`{ DELETE /permission/{id} }`

Delete the permission and all the links with contents.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/23',
    type: 'delete',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  description\|notes    | 
|-----------------|------|-----------|------------------------| 
| path            |  id  |  yes      |  Id of the permission. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the permission.   
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, permission not found with id: 23"
      }
}
```

Assign permission - JSON controller
--------------------------------------

`{ PUT /permission/assign }`

Assign permission to a specific content or to all content of certain type.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/assign',
    type: 'put'
  	data: {content_type: 'course', permission_id: 24} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key            |  required |  default |  description\|notes                                         | 
|-----------------|-----------------|-----------|----------|-------------------------------------------------------------| 
| body            |  permission_id  |  yes      |          |  The permission id you want to assign to the content.       | 
| body            |  content_id     |  no       |  null    |  The content id you want to assign the permission to.       | 
| body            |  content_type   |  no       |  null    |  The type of contents you want to assign the permission to. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , permission_id , yes , , The permission id you want to assign to the content.
body , content_id , no , null , The content id you want to assign the permission to.
body , content_type , no , null , The type of contents you want to assign the permission to.
-->


### Response Example

```200 OK```

```json

{ 
  "id": 2,
  "content_id": null,
  "content_type": "course",
  "permission_id": 24,
  "name": "drumeo edge",
  "brand":"brand"
}

```

Dissociate permission - JSON controller
--------------------------------------

`{ PATCH /permission/dissociate }`

Dissociate permissions from a specific content or all content of a certain type


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission/dissociate',
    type: 'patch',
  	// Let's say there are 42 courses that have had permission id 23 assigned to them
    // ... there should then be 42 successful contentPermission table rows deleted.
    data: {content_type: 'course', permission_id: 23} ,
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key            |  required |  default |  description\|notes                                        | 
|-----------------|-----------------|-----------|----------|------------------------------------------------------------| 
| body            |  permission_id  |  yes      |          |  The permission id you want to dissociate to the content.  | 
| body            |  content_id     |  no       |  null    |  The content id with which permission is associated.       | 
| body            |  content_type   |  no       |  null    |  The type of contents with which permission is associated. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , permission_id , yes , , The permission id you want to dissociate to the content.
body , content_id , no , null , The content id with which permission is associated.
body , content_type , no , null , The type of contents with which permission is associated.
-->


### Response Example

```200 OK```

```json

42

```

Get permissions - JSON controller
--------------------------------------

`{ GET /permission }`

Get all the permissions from the database.


### Request Example

```js   
$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/permission',
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```


### Response Example

```200 OK```

```json
{
    "status":"ok",
    "code":200,
    "results":[
        {
            "id":1,
            "name":"drumeo_membership"
        },
        {
            "id":2,
            "name":"drumming_system"
        }
    ]
}

```
Give user access - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Give users access to specific content for a specific amount of time.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission',
    type: 'put'
  	data: {user_id: '1', permission_id: 24, start_date: '2018-07-11 05:21:23', expiration_date: '2018-12-11 05:21:23'} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters
| path\|query\|body |  key              |  required |  default |  description\|notes                                                                                             | 
|-----------------|-------------------|-----------|----------|-----------------------------------------------------------------------------------------------------------------| 
| body            |  user_id          |  yes      |          |  The user id.                                                                                                   | 
| body            |  permission_id    |  yes      |          |  The permission id.                                                                                             | 
| body            |  start_date       |  yes      |          |  The date when the user has access.                                                                             | 
| body            |  expiration_date  |  no       |  null    |  If expiration date is null they have access forever; otherwise the user have access until the expiration date. | 


<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , user_id , yes , , The user id.
body , permission_id , yes , , The permission id.
body , start_date , yes ,  , The date when the user has access.
body , expiration_date , no , null , If expiration date is null they have access forever; otherwise the user have access until the expiration date.
-->


### Response Example

```200 OK```

```json

{ 
		"id":"1",
        "user_id":"1",
        "permissions_id":"1",
        "start_date":"2018-07-11 05:21:23",
        "expiration_date":null,
        "created_on":"2018-07-11 05:21:23",
        "updated_on":null
}

```
Change user access - JSON controller
--------------------------------------

`{ PATCH /user-permission/{userPermissionId} }`

Change user access.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission/1',
    type: 'patch'
  	data: {expiration_date: '2018-09-11 05:21:23',} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key              |  required |  default |  description\|notes                                                                                             | 
|-----------------|-------------------|-----------|----------|-----------------------------------------------------------------------------------------------------------------| 
| path            |  id               |  yes      |          |  The user permission id.                                                                                        | 
| body            |  user_id          |  no       |          |  The user id.                                                                                                   | 
| body            |  permission_id    |  no       |          |  The permission id.                                                                                             | 
| body            |  start_date       |  no       |          |  The date when the user has access.                                                                             | 
| body            |  expiration_date  |  no       |          |  If expiration date is null they have access forever; otherwise the user have access until the expiration date. | 





<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , The user permission id.
body , user_id , no , , The user id.
body , permission_id , no , , The permission id.
body , start_date , no ,  , The date when the user has access.
body , expiration_date , no ,  , If expiration date is null they have access forever; otherwise the user have access until the expiration date.
-->


### Response Example

```201 OK```

```json
{
 		"id":"1",
        "user_id":"1",
        "permissions_id":"1",
        "start_date":"2018-07-11 05:56:13",
        "expiration_date":"2018-09-11 05:21:23",
        "created_on":"2018-07-11 05:56:13",
        "updated_on":"2018-07-11 05:56:13"
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, user permission not found with id: 1"
      }
}
```

Delete user access - JSON controller
--------------------------------------

`{ DELETE /user-permission/{id} }`

Delete user access to content.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission/1',
    type: 'delete',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  description\|notes    | 
|-----------------|------|-----------|------------------------| 
| path            |  id  |  yes      |  Id of the user permission. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the user permission.   
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, user permission not found with id: 1"
      }
}
```

Pull users permissions - JSON controller
--------------------------------------

`{ GET /user-permission }`

Get active users permissions. 

IF `only_active` it's set false on the request the expired permissions are returned also.

IF `user_id` it's set on the request only the permissions for the specified user are returned


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/user-permission',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key          |  required |  default |  description\|notes                                                   |                                                       | 
|-----------------|---------------|-----------|----------|-----------------------------------------------------------------------|-------------------------------------------------------| 
| body            |  user_id      |  no       |  null    |  If it's set only the permissions for the specified user are returned |  otherwise all the user permissions are returned.     | 
| body            |  only_active  |  no       |  true    |  If it's false the expired permissions are returned also              |  otherwise only active user permissions are returned. | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , user_id , no , null , If it's set only the permissions for the specified user are returned, otherwise all the user permissions are returned.
body , only_active , no , true , If it's false the expired permissions are returned also, otherwise only active user permissions are returned.
-->


### Response Example

```200 OK```

```json
{
    "status":"ok",
    "code":200,
    "results":[
           {
            "id":"1",
            "user_id":"1",
            "permissions_id":"1",
            "start_date":"2018-07-11 06:34:45",
            "expiration_date":null,
            "created_on":"2018-07-11 06:34:45",
            "updated_on":null,
            "name":"nobis",
            "brand":"brand"
          },
          {
            "id":"1",
            "user_id":"2",
            "permissions_id":"1",
            "start_date":"2018-07-11 06:34:45",
            "expiration_date":null,
            "created_on":"2018-07-11 06:34:45",
            "updated_on":null,
            "name":"nobis",
            "brand":"brand"
          }
        ]
}

```

```
Comment a content - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Add a comment to a content if the request data pass the validation. Only authenticated users can add comments and the content type should allow comments.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment',
    type: 'put'
   	data: {comment: 'my comment', content_id: 1} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters
| path\|query\|body |  key           |  required |  default |  description\|notes                                                 | 
|-----------------|----------------|-----------|----------|---------------------------------------------------------------------| 
| body            |  comment       |  yes      |          |  The comment description.                                           | 
| body            |  content_id    |  yes      |          |  The content id you want to assign the comment to.                  | 
| body            |  display_name  |  yes      |          |  The display name that should be displayed; by default empty string | 



<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , comment , yes , , The comment description.
body , content_id , yes , , The content id you want to assign the comment to.
body , display_name , yes ,  , The display name that should be displayed; by default empty string
-->


### Response Example

```200 OK```

```json

{
    "status": "ok",
    "code": 200,
    "results": {
        "id": 5,
        "content_id": 1,
        "parent_id": null,
        "user_id": 1,
        "comment": "my comment",
        "created_on": "2017-11-15 07:53:48",
        "deleted_at": null
    }
}

```
```403 Not allowed``` Content type not allow comments

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"The content type does not allow comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can add comment. Please sign in."
      }
}
```

Change comment - JSON controller
--------------------------------------

`{ PATCH /comment/{id} }`

Change comment. Administrator can edit any comment; other users can edit only their comments. 


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/3',
    type: 'patch'
   	data: {comment: 'my comment modified'} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters
| path\|query\|body |  key           |  required |  default |  description\|notes                                 | 
|-----------------|----------------|-----------|----------|-----------------------------------------------------| 
| path            |  id            |  yes      |          |  Id of the comment you want to edit.                | 
| body            |  comment       |  no       |          |  The description of the comment.                    | 
| body            |  content_id    |  no       |          |  The content id this comment belongs to.            | 
| body            |  parent_id     |  no       |          |  The parent comment id if the comment it's a reply. | 
| body            |  user_id       |  no       |          |  User id.                                           | 
| body            |  display_name  |  no       |          |  The display name.                                  | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
path , id , yes , , The user permission id.
body , user_id , no , , The user id.
body , permission_id , no , , The permission id.
body , start_date , no ,  , The date when the user has access.
body , expiration_date , no ,  , If expiration date is null they have access forever; otherwise the user have access until the expiration date.
-->


### Response Example

```201 OK```

```json
{
    "status": "ok",
    "code": 201,
    "results": {
        "id": 3,
        "content_id": 1,
        "parent_id": null,
        "user_id": 1,
        "comment": "my comment modified",
        "created_on": "2017-11-15 07:31:54",
        "deleted_at": null
    }
}

```
```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Update failed, comment not found with id: 3"
      }
}
```
```403 Not allowed``` 

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Update failed, you can update only your comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can modify own comments. Please sign in."
      }
}
```

Delete comment - JSON controller
--------------------------------------

`{ DELETE /comment/{id} }`

Delete content comment or mark comment as deleted: if the user it's admin the comment with all his replies will be deleted, otherwise the comment with the replies are only soft deleted (marked as deleted).

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/2',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  description\|notes    | 
|-----------------|------|-----------|------------------------| 
| path            |  id  |  yes      |  Id of the comment. | 






<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, description\|notes
path , id , yes, Id of the comment.   
-->


### Response Example

```204 No Content```  

```404 Not Found```

```json
{
      "status":"error",
      "code":404,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Entity not found.",
        "detail":"Delete failed, comment not found with id: 1"
      }
}
```
```403 Not allowed``` 

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Delete failed, you can delete only your comments."
      }
}
```


Reply to a comment - JSON controller
--------------------------------------

`{ PUT /user-permission }`

Add a reply to a comment if the request data pass the validation. Only authenticated users can add replies and the content type should allow comments.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/reply',
    type: 'put'
   	data: {comment: 'my reply', parent_id: 3} 
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters
| path\|query\|body |  key        |  required |  default |  description\|notes                              | 
|-----------------|-------------|-----------|----------|--------------------------------------------------| 
| body            |  comment    |  no       |          |  The comment description.                        | 
| body            |  parent_id  |  no       |          |  The comment id you want to assign the reply to. | 




<!-- donatstudios.com/CsvToMarkdownTable
path|query|body, key, required, default, description\|notes
body , comment , no , , The comment description.
body , parent_id , no , , The comment id you want to assign the reply to.
-->


### Response Example

```200 OK```


```json
{
    "status": "ok",
    "code": 200,
    "results": {
        "id": 6,
        "content_id": 1,
        "parent_id": 3,
        "user_id": 1,
        "comment": "my reply",
        "created_on": "2017-11-15 08:36:38",
        "deleted_at": null
    }
}
```

```403 Not allowed``` Content type not allow comments

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"The content type does not allow comments."
      }
}
```

```403 Not allowed``` Guest

```json
{
      "status":"error",
      "code":403,
      "total_results":0,
      "results":[],
      "error":{
        "title":"Not allowed.",
        "detail":"Only registered user can reply to comment. Please sign in."
      }
}
```

Pull comments - JSON controller
--------------------------------------

`{ GET /comment }`

Pull the comments based on the criteria passed in request:

`content_id`   => pull the comments for given content id

 `user_id`      => pull user's comments
 
`content_type` => pull the comments for the contents with given type


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment?page=3&limit=25&content_id=3&user_id=9923',
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key                  |  required |  default        |  description\|notes                                                               | 
|-------------------|-----------------------|-----------|-----------------|-----------------------------------------------------------------------------------| 
| query             |  page                 |  no       |  1              |  Pagination page.                                                                 | 
| query             |  limit                |  no       |  10             |  Amount of comments to pull per page.                                             | 
| query             |  sort                 |  no       |  '-created_on'  |  Sort column name and direction. If it starts with - it will be descending order. | 
| query             |  content_id           |  no       |                 |  Only comments for this content id will be returned.                              | 
| query             |  user_id              |  no       |                 |  Only comments by this user id will be pulled.                                    | 
| query             |  content_type         |  no       |                 |  Only comments on content with this type will be pulled.                          | 
| query             |  assigned_to_user_id  |  no       |                 |  Only comments assigned to this user will be pulled.                              | 



<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
query , page , no , 1 , Pagination page.
query , limit , no , 10 , Amount of comments to pull per page.
query , sort , no , '-created_on' , Sort column name and direction. If it starts with - it will be descending order.
query , content_id , no , , Only comments for this content id will be returned.
query , user_id , no ,  , Only comments by this user id will be pulled.
query , content_type , no ,  , Only comments on content with this type will be pulled.
query , assigned_to_user_id , no ,  , Only comments assigned to this user will be pulled.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "page": 1,
    "limit": 10,
    "total_results": 3,
    "results": {
        "2": {
            "id": 2,
            "content_id": 1,
            "comment": "comment text",
            "parent_id": null,
            "user_id": 1,
            "created_on": "2017-11-15 07:28:44",
            "deleted_at": null,
            "replies": []
        },
        "3": {
            "id": 3,
            "content_id": 1,
            "comment": "comment text 2",
            "parent_id": null,
            "user_id": 1,
            "created_on": "2017-11-15 07:31:54",
            "deleted_at": null,
            "replies": {
                0: {
                    "id": 4,
                    "content_id": 1,
                    "comment": "my reply to your comment",
                    "parent_id": 3,
                    "user_id": 1,
                    "created_on": "2017-11-15 07:34:48",
                    "deleted_at": null
                }
            }
        }
    },
    "filter_options": null
}

```

Get linked comments - JSON controller
--------------------------------------

`{ GET /comment/{id} }`

Get the linked comments.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment/3,
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key    |  required |  default |  description\|notes                   | 
|-------------------|---------|-----------|----------|---------------------------------------| 
| path              |  id     |  yes      |          |  The comment id                       | 
| query             |  limit  |  no       |  10      |  Amount of comments to pull per page. | 



<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
path , id, yes, , The comment id
query , limit , no , 10 , Amount of comments to pull per page.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "page": 1,
    "limit": 10,
    "total_results": 3,
    "results": {
        "0": {
           "id": 4,
           "content_id": 1,
           "comment": "Doloribus ad vitae possimus libero aperiam doloremque est molestiae. Nihil eum.",
           "parent_id": 3,
           "user_id": 1,
           "created_on": "2017-11-15 07:34:48",
           "deleted_at": null,
           "replies":[]
        }
    },
    "filter_options": null
}

```

Like a comment - JSON controller
--------------------------------------

`{ PUT /comment-like/{id} }`

Authenticated user like a comment.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment-like/1',
    type: 'put'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Response Example

```200 OK```


```json
{
    "status": "ok",
    "code": 200,
    "results": true
}
```

Unlike a comment - JSON controller
--------------------------------------

`{ DELETE /comment-like/{id} }`

Authenticated user unlike a comment.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment-like/1',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Response Example

```200 OK```


```json
{
    "status": "ok",
    "code": 200,
    "results": true
}
```

Get comment likes- JSON controller
--------------------------------------

`{ GET /comment-likes/{commentId} }`

Get likes for the given comment id - paginated.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/comment-likes/12345?page=2&limi=10',
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key    |  required |  default |  description\|notes                   | 
|-------------------|---------|-----------|----------|---------------------------------------| 
| path              |  id     |  yes      |          |  The comment id                       | 
| query             |  page   |  no       |  1       |  Pagination page.                     |
| query             |  limit  |  no       |  10      |  Amount of comments to pull per page. | 


### Response Example

```200 OK```

```json
{
   "data":[
      {
         "display_name":"Keef",
         "avatar_url":"https:\/\/drumeo-user-avatars.s3-us-west-2.amazonaws.com\/77750_avatar_url_1464798831.gif",
         "xp":0,
         "access_level":"pack"
      },
      {
         "display_name":"EmmaSB",
         "avatar_url":"https:\/\/drumeo-user-avatars.s3-us-west-2.amazonaws.com\/97451_avatar_url_1473355968.jpg",
         "xp":0,
         "access_level":"pack"
      }
   ],
   "meta":{
      "totalResults":9,
      "page":"3",
      "limit":"2"
   }
}

```

Pull assigned to me comments - JSON controller
--------------------------------------

`{ GET /assigned-comments }`

The managers have the ability to get comment assignments for.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/assigned-comments?user_id=232',
    type: 'get'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key      |  required |  default |  description\|notes                                                                                                         | 
|-------------------|-----------|-----------|----------|-----------------------------------------------------------------------------------------------------------------------------| 
| query             |  user_id  |  no       |          |  The user ID to get comment assignments for. Leave out this parameter to get the comments for the currently logged in user. | 




<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, default, description\|notes
query , user_id , no ,  , The user ID to get comment assignments for. Leave out this parameter to get the comments for the currently logged in user.
-->


### Response Example

```200 OK```

```json
{
    "status": "ok",
    "code": 200,
    "results": {
        "2": {
            "id": 2,
            "content_id": 1,
            "comment": "comment text",
            "parent_id": null,
            "user_id": 145,
            "created_on": "2017-11-15 07:28:44",
            "deleted_at": null
        },
        "3": {
            "id": 3,
            "content_id": 1,
            "comment": "comment text 2",
            "parent_id": null,
            "user_id": 14,
            "created_on": "2017-11-15 07:31:54",
            "deleted_at": null
        }
    }
}

```


Delete comment assignation - JSON controller
--------------------------------------

`{ DELETE /assigned-comments/{id} }`

Delete comment assignations.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/assigned-comment/1',
    type: 'delete'
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key |  required |  description\|notes | 
|-------------------|------|-----------|---------------------| 
| path              |  id  |  yes      |  Id of the comment  | 





<!-- donatstudios.com/CsvToMarkdownTable
path\|query\|body, key, required, description\|notes
path , id , yes, Id of the comment
-->


### Response Example

```204 No Content```


Follow a content - JSON controller
--------------------------------------

`{ PUT /follow }`

Authenticated user follow a content.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/follow',
    type: 'put',
    dataType: 'json',
    data: {content_id: 1},
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Response Example

```200 OK```


```json
{
  "data": [
    {
      "id": 4,
      "content_id": 1,
      "user_id": 149628,
      "created_on": "2021-10-25 11:30:51"
    }
  ]
}
```

Unfollow a content - JSON controller
--------------------------------------

`{ PUT /unfollow }`

Authenticated user unfollow a content.


### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/unfollow',
    type: 'put',
    dataType: 'json',
    data: {content_id: 1},
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Response Example

```204 OK```


```json
{}
```

Get followed contents - JSON controller
--------------------------------------

`{ GET /followed-content }`

Get followed contents - paginated.

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/followed-content?page=1&limit=2',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key    |  required |  default |  description\|notes                   |
|-------------------|---------|-----------|----------|---------------------------------------|
| query             |  brand   |  no       |  value set in config file    | Pull only followed contents from specified brand                   |
| query             |  content_type   |  no       |  null       |  Pull only followed contents with specified content type                   |
| query             |  page   |  no       |  1       |  Pagination page.                     |
| query             |  limit  |  no       |  10      |  Amount of content to pull per page. |


### Response Example

```200 OK```

```json
{
  "data": [
    {
      "id": 281906,
      "popularity": null,
      "slug": "aric-improta",
      "type": "coach",
      "sort": 0,
      "status": "published",
      "language": "en-US",
      "brand": "drumeo",
      "total_xp": "0",
      "published_on": "2020/12/29 19:31:50",
      "created_on": "2020-12-29 19:31:50",
      "archived_on": null,
      "parent_id": null,
      "child_id": null,
      "fields": [
        {
          "id": 417372,
          "content_id": 281906,
          "key": "name",
          "value": "Aric Improta",
          "type": "string",
          "position": 1
        },
        {
          "id": 417373,
          "content_id": 281906,
          "key": "title",
          "value": "Aric Improta",
          "type": "string",
          "position": 1
        },
        {
          "key": "difficulty",
          "value": "all",
          "type": "string",
          "position": 1
        }
      ],
      "data": [
        {
          "id": 164381,
          "content_id": 281906,
          "key": "head_shot_picture_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281906-avatar-1609277595.png",
          "position": 1
        },
        {
          "id": 164345,
          "content_id": 281906,
          "key": "short_description",
          "value": "<p>Aric Improta is pushing the boundaries of drum performances. Look no further than his exhilarating backflips mid drum solo in front of thousands of screaming fans.</p><p><br></p><p>A dedicated artist, Aric uses his original music projects (Night Verses &amp; Fever333) to deliver sensational visual performances to the masses.</p><p><br></p><p>And now he’s here to help you think outside the box with your drumming and question the implied “rules” that might be holding you back from your next creative breakthrough.</p><p><br></p>",
          "position": 1
        },
        {
          "id": 164346,
          "content_id": 281906,
          "key": "long_description",
          "value": "<p>Aric Improta is pushing the boundaries of drum performances. Look no further than his exhilarating backflips mid drum solo in front of thousands of screaming fans.</p><p><br></p><p>A dedicated artist, Aric uses his original music projects (Night Verses &amp; Fever333) to deliver sensational visual performances to the masses.</p><p><br></p><p>And now he’s here to help you think outside the box with your drumming and question the implied “rules” that might be holding you back from your next creative breakthrough.</p>",
          "position": 1
        },
        {
          "id": 164347,
          "content_id": 281906,
          "key": "header_image_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281906-header-image-1609277589.jpg",
          "position": 1
        },
        {
          "id": 164348,
          "content_id": 281906,
          "key": "thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281906-card-thumbnail-1624382173.png",
          "position": 1
        },
        {
          "id": 164349,
          "content_id": 281906,
          "key": "original_thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281906-card-thumbnail-maxres-1624382169.png",
          "position": 1
        }
      ],
      "permissions": [
        {
          "id": 1,
          "content_id": 281906,
          "content_type": null,
          "permission_id": 1,
          "brand": "drumeo",
          "name": "Drumeo Edge"
        }
      ],
      "user_progress": {
        "149628": []
      },
      "completed": false,
      "started": false,
      "progress_percent": 0,
      "user_playlists": {
        "149628": []
      },
      "is_added_to_primary_playlist": false,
      "published_on_in_timezone": "2020/12/29 21:31:50",
      "is_new": false,
      "like_count": 0,
      "url": "https://dev.drumeo.com/laravel/public/members/coaches/aric-improta",
      "biography": "<p>Aric Improta is pushing the boundaries of drum performances. Look no further than his exhilarating backflips mid drum solo in front of thousands of screaming fans.</p><p><br></p><p>A dedicated artist, Aric uses his original music projects (Night Verses &amp; Fever333) to deliver sensational visual performances to the masses.</p><p><br></p><p>And now he’s here to help you think outside the box with your drumming and question the implied “rules” that might be holding you back from your next creative breakthrough.</p>"
    },
    {
      "id": 281905,
      "popularity": null,
      "slug": "dorothea-taylor",
      "type": "coach",
      "sort": 0,
      "status": "published",
      "language": "en-US",
      "brand": "drumeo",
      "total_xp": "0",
      "published_on": "2020/12/29 19:31:50",
      "created_on": "2020-12-29 19:31:50",
      "archived_on": null,
      "parent_id": null,
      "child_id": null,
      "fields": [
        {
          "id": 417370,
          "content_id": 281905,
          "key": "name",
          "value": "Dorothea Taylor",
          "type": "string",
          "position": 1
        },
        {
          "id": 417371,
          "content_id": 281905,
          "key": "title",
          "value": "Dorothea Taylor",
          "type": "string",
          "position": 1
        },
        {
          "key": "difficulty",
          "value": "all",
          "type": "string",
          "position": 1
        }
      ],
      "data": [
        {
          "id": 164375,
          "content_id": 281905,
          "key": "head_shot_picture_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281905-avatar-1609277433.png",
          "position": 1
        },
        {
          "id": 164340,
          "content_id": 281905,
          "key": "short_description",
          "value": "<p>Dorothea Taylor spent the majority of her drum career out of the spotlight -- teaching lessons to budding Michigan drum students.</p><p><br></p><p>That’s until she partnered with Drumeo to create a powerful viral video addressing societal expectations in drumming culture -- shocking audiences with her (un)surprising command of a hard-rock anthem, garnering millions of views in two days.</p><p><br></p><p>Get ready to hang with one of the internet’s most renowned drum instructors and strengthen your hands with Dorothea’s go-to drumline workouts.</p>",
          "position": 1
        },
        {
          "id": 164341,
          "content_id": 281905,
          "key": "long_description",
          "value": "<p>Dorothea Taylor spent the majority of her drum career out of the spotlight -- teaching lessons to budding Michigan drum students.</p><p><br></p><p>That’s until she partnered with Drumeo to create a powerful viral video addressing societal expectations in drumming culture -- shocking audiences with her (un)surprising command of a hard-rock anthem, garnering millions of views in two days.</p><p><br></p><p>Get ready to hang with one of the internet’s most renowned drum instructors and strengthen your hands with Dorothea’s go-to drumline workouts.</p>",
          "position": 1
        },
        {
          "id": 164342,
          "content_id": 281905,
          "key": "header_image_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/header-image-1634059455.jpg",
          "position": 1
        },
        {
          "id": 164343,
          "content_id": 281905,
          "key": "thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281905-card-thumbnail-1624382185.png",
          "position": 1
        },
        {
          "id": 164344,
          "content_id": 281905,
          "key": "original_thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281905-card-thumbnail-maxres-1624382181.png",
          "position": 1
        }
      ],
      "permissions": [
        {
          "id": 1,
          "content_id": 281905,
          "content_type": null,
          "permission_id": 1,
          "brand": "drumeo",
          "name": "Drumeo Edge"
        }
      ],
      "user_progress": {
        "149628": []
      },
      "completed": false,
      "started": false,
      "progress_percent": 0,
      "user_playlists": {
        "149628": []
      },
      "is_added_to_primary_playlist": false,
      "published_on_in_timezone": "2020/12/29 21:31:50",
      "is_new": false,
      "like_count": 0,
      "url": "https://dev.drumeo.com/laravel/public/members/coaches/dorothea-taylor",
      "biography": "<p>Dorothea Taylor spent the majority of her drum career out of the spotlight -- teaching lessons to budding Michigan drum students.</p><p><br></p><p>That’s until she partnered with Drumeo to create a powerful viral video addressing societal expectations in drumming culture -- shocking audiences with her (un)surprising command of a hard-rock anthem, garnering millions of views in two days.</p><p><br></p><p>Get ready to hang with one of the internet’s most renowned drum instructors and strengthen your hands with Dorothea’s go-to drumline workouts.</p>"
    },
    {
      "id": 281904,
      "popularity": null,
      "slug": "larnell-lewis",
      "type": "coach",
      "sort": 0,
      "status": "published",
      "language": "en-US",
      "brand": "drumeo",
      "total_xp": "0",
      "published_on": "2020/12/29 19:31:50",
      "created_on": "2020-12-29 19:31:50",
      "archived_on": null,
      "parent_id": null,
      "child_id": null,
      "fields": [
        {
          "id": 417368,
          "content_id": 281904,
          "key": "name",
          "value": "Larnell Lewis",
          "type": "string",
          "position": 1
        },
        {
          "id": 417369,
          "content_id": 281904,
          "key": "title",
          "value": "Larnell Lewis",
          "type": "string",
          "position": 1
        },
        {
          "key": "difficulty",
          "value": "all",
          "type": "string",
          "position": 1
        }
      ],
      "data": [
        {
          "id": 164382,
          "content_id": 281904,
          "key": "head_shot_picture_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281904-avatar-1609277645.png",
          "position": 1
        },
        {
          "id": 164335,
          "content_id": 281904,
          "key": "short_description",
          "value": "<p>In 2015, Larnell Lewis boarded a plane to the Netherlands to fill in for one of his drumming heroes, Robert “Sput” Searight. The rest is history.</p><p><br></p><p>Larnell learned a complex fusion set during the flight and went on to record one of the most celebrated live albums of the 21st century: <em>We Like It Here</em> by Snarky Puppy.</p><p><br></p><p>He’s a Grammy Award-winning musician, composer, producer, and educator -- and he’s here to teach YOU.</p>",
          "position": 1
        },
        {
          "id": 164336,
          "content_id": 281904,
          "key": "long_description",
          "value": "<p>In 2015, Larnell Lewis boarded a plane to the Netherlands to fill in for one of his drumming heroes, Robert “Sput” Searight. The rest is history.</p><p><br></p><p>Larnell learned a complex fusion set during the flight and went on to record one of the most celebrated live albums of the 21st century: <em>We Like It Here</em> by Snarky Puppy.</p><p><br></p><p>He’s a Grammy Award-winning musician, composer, producer, and educator -- and he’s here to teach YOU.</p>",
          "position": 1
        },
        {
          "id": 164337,
          "content_id": 281904,
          "key": "header_image_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281904-header-image-1609277640.jpg",
          "position": 1
        },
        {
          "id": 164338,
          "content_id": 281904,
          "key": "thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281904-card-thumbnail-1624382199.png",
          "position": 1
        },
        {
          "id": 164339,
          "content_id": 281904,
          "key": "original_thumbnail_url",
          "value": "https://d1923uyy6spedc.cloudfront.net/281904-card-thumbnail-maxres-1624382194.png",
          "position": 1
        }
      ],
      "permissions": [
        {
          "id": 1,
          "content_id": 281904,
          "content_type": null,
          "permission_id": 1,
          "brand": "drumeo",
          "name": "Drumeo Edge"
        }
      ],
      "user_progress": {
        "149628": []
      },
      "completed": false,
      "started": false,
      "progress_percent": 0,
      "user_playlists": {
        "149628": []
      },
      "is_added_to_primary_playlist": false,
      "published_on_in_timezone": "2020/12/29 21:31:50",
      "is_new": false,
      "like_count": 0,
      "url": "https://dev.drumeo.com/laravel/public/members/coaches/larnell-lewis",
      "biography": "<p>In 2015, Larnell Lewis boarded a plane to the Netherlands to fill in for one of his drumming heroes, Robert “Sput” Searight. The rest is history.</p><p><br></p><p>Larnell learned a complex fusion set during the flight and went on to record one of the most celebrated live albums of the 21st century: <em>We Like It Here</em> by Snarky Puppy.</p><p><br></p><p>He’s a Grammy Award-winning musician, composer, producer, and educator -- and he’s here to teach YOU.</p>"
    }
  ],
  "meta": {
    "totalResults": 3,
    "page": 1,
    "limit": 10,
    "filterOptions": []
  }
}
```

Get lessons from the specific coaches that the user follows - JSON controller
--------------------------------------

`{ GET /followed-lessons }`

Get lessons from the specific coaches that the user follows

### Request Example

```js   

$.ajax({
    url: 'https://www.musora.com' +
        '/railcontent/followed-lessons?page=1&limit=2&included_types[]=course',
    type: 'get',
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});

```

### Request Parameters

| path\|query\|body |  key    |  required |  default |  description\|notes                   |
|-------------------|---------|-----------|----------|---------------------------------------|
| query             |  brand   |  no       |  value set in config file    | Pull only contents from specified brand                   |
| query             |  included_types   |  no       |  null       |  Pull only contents with specified content type                   |
| query             |  statuses   |  no       |  []       |  Pull only contents with specified status                   |
| query             |  page   |  no       |  1       |  Pagination page.                     |
| query             |  limit  |  no       |  10      |  Amount of content to pull per page. |
| query             |  sort  |  no       |  -published_on      |  Sort option. |



### Response Example

```200 OK```

```json
{
    "data": [
        {
            "id": 276247,
            "popularity": 80,
            "slug": "the-grooves-of-snarky-puppy",
            "type": "course",
            "sort": 0,
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "total_xp": "1700",
            "published_on": "2020/12/05 16:00:00",
            "created_on": "2020-11-20 16:06:23",
            "archived_on": null,
            "parent_id": null,
            "child_id": null,
            "fields": [
                {
                    "id": 409161,
                    "content_id": 276247,
                    "key": "tag",
                    "value": "here",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 406134,
                    "content_id": 276247,
                    "key": "show_in_new_feed",
                    "value": "1",
                    "type": "boolean",
                    "position": 1
                },
                {
                    "id": 406135,
                    "content_id": 276247,
                    "key": "title",
                    "value": "The Grooves Of Snarky Puppy",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 406136,
                    "content_id": 276247,
                    "key": "difficulty",
                    "value": "7",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 406137,
                    "content_id": 276247,
                    "key": "xp",
                    "value": "500",
                    "type": "integer",
                    "position": 1
                },
                {
                    "id": 406138,
                    "content_id": 276247,
                    "key": "topic",
                    "value": "Beats",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 409160,
                    "content_id": 276247,
                    "key": "tag",
                    "value": "it",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 406141,
                    "content_id": 276247,
                    "key": "topic",
                    "value": "Musicality",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 409159,
                    "content_id": 276247,
                    "key": "tag",
                    "value": "like",
                    "type": "string",
                    "position": 3
                },
                {
                    "id": 409158,
                    "content_id": 276247,
                    "key": "tag",
                    "value": "we",
                    "type": "string",
                    "position": 4
                },
                {
                    "id": 409157,
                    "content_id": 276247,
                    "key": "tag",
                    "value": "2014",
                    "type": "string",
                    "position": 5
                },
                {
                    "id": 409714,
                    "content_id": 276247,
                    "key": "instructor",
                    "value": {
                        "id": 31895,
                        "popularity": null,
                        "slug": "larnell-lewis",
                        "type": "instructor",
                        "sort": 0,
                        "status": "published",
                        "language": "en-US",
                        "brand": "drumeo",
                        "total_xp": null,
                        "published_on": "2017-12-13 17:23:21",
                        "created_on": "2017-12-13 17:23:21",
                        "archived_on": null,
                        "parent_id": null,
                        "child_id": null,
                        "fields": [
                            {
                                "id": 60901,
                                "content_id": 31895,
                                "key": "name",
                                "value": "Larnell Lewis",
                                "type": "string",
                                "position": 1
                            }
                        ],
                        "data": [
                            {
                                "id": 18702,
                                "content_id": 31895,
                                "key": "head_shot_picture_url",
                                "value": "https://s3.amazonaws.com/drumeo-assets/instructors/larnell-lewis.png?v=1513185407",
                                "position": 1
                            },
                            {
                                "id": 18703,
                                "content_id": 31895,
                                "key": "biography",
                                "value": "Larnell Lewis is a versatile and sought-after drummer, composer, producer, educator, and clinician, who has performed with Snarky Puppy, Fred Hammond, Jully Black, and Glen Lewis. A professor at Humber College's Faculty of Music, where as a student he received the Oscar Peterson Award for “Outstanding Achievement in Music”, Larnell is the ultimate groove master and one of the go-to Drumeo instructors for developing an awesome feel.",
                                "position": 1
                            }
                        ],
                        "permissions": []
                    },
                    "type": "content",
                    "position": 1
                }
            ],
            "data": [
                {
                    "id": 159831,
                    "content_id": 276247,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/276247-card-thumbnail-maxres-1607363530.png",
                    "position": 1
                },
                {
                    "id": 159832,
                    "content_id": 276247,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/276247-card-thumbnail-1607363537.png",
                    "position": 1
                },
                {
                    "id": 157392,
                    "content_id": 276247,
                    "key": "description",
                    "value": "<p>In this Course, Larnell Lewis teaches you some of his favorite grooves that he created for Snarky Puppy's amazing music.</p>",
                    "position": 1
                },
                {
                    "id": 159958,
                    "content_id": 276247,
                    "key": "header_image_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/276247-header-image-1607363545.png",
                    "position": 1
                }
            ],
            "permissions": [
                {
                    "id": 1,
                    "content_id": null,
                    "content_type": "course",
                    "permission_id": 1,
                    "brand": "drumeo",
                    "name": "Drumeo Edge"
                }
            ],
            "user_progress": {
                "149628": []
            },
            "completed": false,
            "started": false,
            "progress_percent": 0,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "published_on_in_timezone": "2020/12/05 18:00:00",
            "instructors": [
                "Larnell Lewis",
                "Larnell Lewis"
            ],
            "is_new": false,
            "url": "https://dev.drumeo.com/laravel/public/members/lessons/courses/276247",
            "lesson_count": 0,
            "duration": 0,
            "xp": "500",
            "xp_bonus": "500",
            "total_length_in_seconds": 5728,
            "current_lesson_index": 0,
            "current_lesson": {
                "id": 278241,
                "popularity": 68,
                "slug": "intro",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "200",
                "published_on": "2020/12/05 16:00:00",
                "created_on": "2020-12-04 13:50:08",
                "archived_on": null,
                "parent_id": 276247,
                "child_id": 278241,
                "fields": [
                    {
                        "id": 409145,
                        "content_id": 278241,
                        "key": "title",
                        "value": "Intro",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 409146,
                        "content_id": 278241,
                        "key": "show_in_new_feed",
                        "value": "1",
                        "type": "boolean",
                        "position": 1
                    },
                    {
                        "id": 409163,
                        "content_id": 278241,
                        "key": "xp",
                        "value": "200",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 409165,
                        "content_id": 278241,
                        "key": "tag",
                        "value": "started",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 409164,
                        "content_id": 278241,
                        "key": "tag",
                        "value": "intro",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 409166,
                        "content_id": 278241,
                        "key": "tag",
                        "value": "getting",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 409162,
                        "content_id": 278241,
                        "key": "video",
                        "value": {
                            "id": 277389,
                            "popularity": null,
                            "slug": "vimeo-video-484613463",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "150",
                            "published_on": "2020-11-27 23:00:53",
                            "created_on": "2020-11-27 23:00:53",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 408140,
                                    "content_id": 277389,
                                    "key": "vimeo_video_id",
                                    "value": "484613463",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 408141,
                                    "content_id": 277389,
                                    "key": "length_in_seconds",
                                    "value": "1006",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 159833,
                        "content_id": 278241,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/278241-card-thumbnail-maxres-1607090952.png",
                        "position": 1
                    },
                    {
                        "id": 159834,
                        "content_id": 278241,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/278241-card-thumbnail-1607090957.png",
                        "position": 1
                    },
                    {
                        "id": 159911,
                        "content_id": 278241,
                        "key": "description",
                        "value": "<p>In this video, Larnell shares the story of what it's like to be in a band like Snarky Puppy.</p>",
                        "position": 1
                    },
                    {
                        "id": 159915,
                        "content_id": 278241,
                        "key": "chapter_timecode",
                        "value": "67",
                        "position": 1
                    },
                    {
                        "id": 159916,
                        "content_id": 278241,
                        "key": "chapter_description",
                        "value": "How Larnell Got To Play For Snarky Puppy",
                        "position": 1
                    },
                    {
                        "id": 159917,
                        "content_id": 278241,
                        "key": "chapter_timecode",
                        "value": "474",
                        "position": 2
                    },
                    {
                        "id": 159918,
                        "content_id": 278241,
                        "key": "chapter_description",
                        "value": "Structure Of The Band",
                        "position": 2
                    },
                    {
                        "id": 159919,
                        "content_id": 278241,
                        "key": "chapter_timecode",
                        "value": "631",
                        "position": 3
                    },
                    {
                        "id": 159920,
                        "content_id": 278241,
                        "key": "chapter_description",
                        "value": "The Writing Process",
                        "position": 3
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    278241
                ],
                "position": 1,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2020/12/05 18:00:00",
                "is_new": false,
                "chapters": [
                    {
                        "chapter_timecode": "67",
                        "chapter_description": "How Larnell Got To Play For Snarky Puppy"
                    },
                    {
                        "chapter_timecode": "474",
                        "chapter_description": "Structure Of The Band"
                    },
                    {
                        "chapter_timecode": "631",
                        "chapter_description": "The Writing Process"
                    }
                ],
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/278241",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/278241",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/278241",
                "stbs": [],
                "xp": 200,
                "xp_bonus": "200",
                "length_in_seconds": "1006",
                "last_watch_position_in_seconds": 0,
                "like_count": 51
            },
            "next_lesson": {
                "id": 278242,
                "popularity": 63,
                "slug": "what-about-me",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "200",
                "published_on": "2020/12/05 16:00:00",
                "created_on": "2020-12-04 13:50:23",
                "archived_on": null,
                "parent_id": 276247,
                "child_id": 278242,
                "fields": [
                    {
                        "id": 409147,
                        "content_id": 278242,
                        "key": "title",
                        "value": "\"What About Me?\"",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 409148,
                        "content_id": 278242,
                        "key": "show_in_new_feed",
                        "value": "1",
                        "type": "boolean",
                        "position": 1
                    },
                    {
                        "id": 409167,
                        "content_id": 278242,
                        "key": "xp",
                        "value": "200",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 409169,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "snarky puppy",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 409174,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "2014",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 409173,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "here",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 409172,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "it",
                        "type": "string",
                        "position": 4
                    },
                    {
                        "id": 409171,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "like",
                        "type": "string",
                        "position": 5
                    },
                    {
                        "id": 409170,
                        "content_id": 278242,
                        "key": "tag",
                        "value": "we",
                        "type": "string",
                        "position": 6
                    },
                    {
                        "id": 409168,
                        "content_id": 278242,
                        "key": "video",
                        "value": {
                            "id": 277388,
                            "popularity": null,
                            "slug": "vimeo-video-484615601",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "150",
                            "published_on": "2020-11-27 23:00:52",
                            "created_on": "2020-11-27 23:00:52",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 408138,
                                    "content_id": 277388,
                                    "key": "vimeo_video_id",
                                    "value": "484615601",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 408139,
                                    "content_id": 277388,
                                    "key": "length_in_seconds",
                                    "value": "1319",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 159835,
                        "content_id": 278242,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/278242-card-thumbnail-maxres-1607091293.png",
                        "position": 1
                    },
                    {
                        "id": 159836,
                        "content_id": 278242,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/278242-card-thumbnail-1607091297.png",
                        "position": 1
                    },
                    {
                        "id": 159837,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "12",
                        "position": 1
                    },
                    {
                        "id": 159838,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "The Main Groove",
                        "position": 1
                    },
                    {
                        "id": 159910,
                        "content_id": 278242,
                        "key": "description",
                        "value": "<p>\"What About Me\" is the song that really brought Snarky Puppy and Larnell to the next level. This song has it all: crazy accents, odd time, and a face melting drum solo!</p>",
                        "position": 1
                    },
                    {
                        "id": 159839,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "45",
                        "position": 2
                    },
                    {
                        "id": 159840,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "The Story Behind The Groove",
                        "position": 2
                    },
                    {
                        "id": 159841,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "183",
                        "position": 3
                    },
                    {
                        "id": 159842,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "Making It His Own",
                        "position": 3
                    },
                    {
                        "id": 159843,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "348",
                        "position": 4
                    },
                    {
                        "id": 159844,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "Solo Section",
                        "position": 4
                    },
                    {
                        "id": 159845,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "601",
                        "position": 5
                    },
                    {
                        "id": 159846,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "Performance",
                        "position": 5
                    },
                    {
                        "id": 159847,
                        "content_id": 278242,
                        "key": "chapter_timecode",
                        "value": "1034",
                        "position": 6
                    },
                    {
                        "id": 159848,
                        "content_id": 278242,
                        "key": "chapter_description",
                        "value": "Pre Guitar-Solo Section",
                        "position": 6
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    278242
                ],
                "position": 2,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2020/12/05 18:00:00",
                "is_new": false,
                "chapters": [
                    {
                        "chapter_timecode": "12",
                        "chapter_description": "The Main Groove"
                    },
                    {
                        "chapter_timecode": "45",
                        "chapter_description": "The Story Behind The Groove"
                    },
                    {
                        "chapter_timecode": "183",
                        "chapter_description": "Making It His Own"
                    },
                    {
                        "chapter_timecode": "348",
                        "chapter_description": "Solo Section"
                    },
                    {
                        "chapter_timecode": "601",
                        "chapter_description": "Performance"
                    },
                    {
                        "chapter_timecode": "1034",
                        "chapter_description": "Pre Guitar-Solo Section"
                    }
                ],
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/278242",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/278242",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/278242",
                "stbs": [],
                "xp": 200,
                "xp_bonus": "200",
                "length_in_seconds": "1319",
                "last_watch_position_in_seconds": 0,
                "like_count": 55
            },
            "like_count": 1
        },
        {
            "id": 263840,
            "popularity": 153,
            "slug": "drumline-exercises-for-better-stick-control",
            "type": "course",
            "sort": 0,
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "total_xp": "1575",
            "published_on": "2020/08/15 15:00:00",
            "created_on": "2020-07-27 10:19:03",
            "archived_on": null,
            "parent_id": null,
            "child_id": null,
            "fields": [
                {
                    "id": 363268,
                    "content_id": 263840,
                    "key": "tag",
                    "value": "drum line",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 358810,
                    "content_id": 263840,
                    "key": "show_in_new_feed",
                    "value": "1",
                    "type": "boolean",
                    "position": 1
                },
                {
                    "id": 358811,
                    "content_id": 263840,
                    "key": "title",
                    "value": "Drumline Exercises For Better Stick Control",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 358812,
                    "content_id": 263840,
                    "key": "difficulty",
                    "value": "1",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 358813,
                    "content_id": 263840,
                    "key": "xp",
                    "value": "500",
                    "type": "integer",
                    "position": 1
                },
                {
                    "id": 363493,
                    "content_id": 263840,
                    "key": "topic",
                    "value": "Rudiments",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 363269,
                    "content_id": 263840,
                    "key": "tag",
                    "value": "drum corps",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 376346,
                    "content_id": 263840,
                    "key": "topic",
                    "value": "Technique",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 358814,
                    "content_id": 263840,
                    "key": "instructor",
                    "value": {
                        "id": 234095,
                        "popularity": null,
                        "slug": "dorothea-taylor",
                        "type": "instructor",
                        "sort": 0,
                        "status": "published",
                        "language": "en-US",
                        "brand": "drumeo",
                        "total_xp": null,
                        "published_on": "2019-10-03 12:32:14",
                        "created_on": "2019-10-03 12:32:16",
                        "archived_on": null,
                        "parent_id": null,
                        "child_id": null,
                        "fields": [
                            {
                                "id": 300843,
                                "content_id": 234095,
                                "key": "name",
                                "value": "Dorothea Taylor",
                                "type": "string",
                                "position": 1
                            }
                        ],
                        "data": [
                            {
                                "id": 107095,
                                "content_id": 234095,
                                "key": "head_shot_picture_url",
                                "value": "https://d1923uyy6spedc.cloudfront.net/234095-avatar-1570448168.jpg",
                                "position": 1
                            },
                            {
                                "id": 107096,
                                "content_id": 234095,
                                "key": "biography",
                                "value": "<p>Dorothea Taylor is a very knowledgeable multi-instrumentalist and instructor with over 50 years of experience. She got introduced to the world of high-level drumming through the Blue Notes Drum and Bugle Corps which was instrumental in establishing her high standards, which ultimately helped her build a very successful career in and out of the studio. Over the years, Dorothea played with acts such as the Long Bay Symphony, the jazz band UNI, and Rick Alviti, besides lending her percussion and organ chops to the Ray Charles Concert and her Church, respectively. When she's not playing, Dorothea is teaching at the Forestbrook Middle School and Sound Systems Music Store.</p>",
                                "position": 1
                            }
                        ],
                        "permissions": []
                    },
                    "type": "content",
                    "position": 1
                }
            ],
            "data": [
                {
                    "id": 144955,
                    "content_id": 263840,
                    "key": "description",
                    "value": "<p>In this Course, Dorothea Taylor will teach you how to adapt drumline exercises to your drum-kit routine to improve your flow and technique around the kit.</p>",
                    "position": 1
                },
                {
                    "id": 144961,
                    "content_id": 263840,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/263840-card-thumbnail-maxres-1597157625.png",
                    "position": 1
                },
                {
                    "id": 144962,
                    "content_id": 263840,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/263840-card-thumbnail-1597157630.png",
                    "position": 1
                },
                {
                    "id": 169910,
                    "content_id": 263840,
                    "key": "resource_name",
                    "value": "Course Resources Pack",
                    "position": 1
                },
                {
                    "id": 169911,
                    "content_id": 263840,
                    "key": "resource_url",
                    "value": "https://s3.amazonaws.com/drumeo/courses/resource-files/dcb-102-drumline-exercises-for-better-stick-control-1.zip",
                    "position": 1
                }
            ],
            "permissions": [
                {
                    "id": 1,
                    "content_id": null,
                    "content_type": "course",
                    "permission_id": 1,
                    "brand": "drumeo",
                    "name": "Drumeo Edge"
                }
            ],
            "user_progress": {
                "149628": {
                    "id": 11601877,
                    "content_id": 263840,
                    "user_id": 149628,
                    "state": "started",
                    "progress_percent": 92,
                    "higher_key_progress": null,
                    "updated_on": "2021-05-18 07:56:42",
                    "started_on": "2020-11-18 00:00:00",
                    "completed_on": null
                }
            },
            "completed": false,
            "started": true,
            "progress_percent": 92,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "published_on_in_timezone": "2020/08/15 18:00:00",
            "instructors": [
                "Dorothea Taylor",
                "Dorothea Taylor"
            ],
            "is_new": false,
            "resources": {
                "1": {
                    "resource_id": 169910,
                    "resource_name": "Course Resources Pack",
                    "resource_url": "https://s3.amazonaws.com/drumeo/courses/resource-files/dcb-102-drumline-exercises-for-better-stick-control-1.zip"
                }
            },
            "url": "https://dev.drumeo.com/laravel/public/members/lessons/courses/263840",
            "lesson_count": 0,
            "duration": 0,
            "xp": "500",
            "xp_bonus": "500",
            "total_length_in_seconds": 2491,
            "current_lesson_index": 5,
            "current_lesson": {
                "id": 265667,
                "popularity": 43,
                "slug": "timing-exercise",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "175",
                "published_on": "2020/08/15 15:00:00",
                "created_on": "2020-08-11 14:24:13",
                "archived_on": null,
                "parent_id": 263840,
                "child_id": 265667,
                "fields": [
                    {
                        "id": 363264,
                        "content_id": 265667,
                        "key": "show_in_new_feed",
                        "value": "1",
                        "type": "boolean",
                        "position": 1
                    },
                    {
                        "id": 363265,
                        "content_id": 265667,
                        "key": "title",
                        "value": "Timing Exercise & Conclusion",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 363280,
                        "content_id": 265667,
                        "key": "xp",
                        "value": "150",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 363382,
                        "content_id": 265667,
                        "key": "video",
                        "value": {
                            "id": 265798,
                            "popularity": null,
                            "slug": "vimeo-video-447403633",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "150",
                            "published_on": "2020-08-13 08:30:15",
                            "created_on": "2020-08-13 08:30:15",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 363364,
                                    "content_id": 265798,
                                    "key": "vimeo_video_id",
                                    "value": "447403633",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 363365,
                                    "content_id": 265798,
                                    "key": "length_in_seconds",
                                    "value": "499",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 144985,
                        "content_id": 265667,
                        "key": "description",
                        "value": "<p>In this lesson, Dorothea teaches how to use a timing exercise to improve your sense of time and counting ability.</p>",
                        "position": 1
                    },
                    {
                        "id": 144986,
                        "content_id": 265667,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/265667-card-thumbnail-maxres-1597161668.png",
                        "position": 1
                    },
                    {
                        "id": 144987,
                        "content_id": 265667,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/265667-card-thumbnail-1597161673.png",
                        "position": 1
                    },
                    {
                        "id": 145300,
                        "content_id": 265667,
                        "key": "resource_name",
                        "value": "PDF Sheet Music",
                        "position": 1
                    },
                    {
                        "id": 145301,
                        "content_id": 265667,
                        "key": "resource_url",
                        "value": "https://s3.amazonaws.com/drumeo/courses/pdf/dcb-102-drumline-exercises-for-better-stick-control/dcb-102f.pdf",
                        "position": 1
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    265667
                ],
                "position": 6,
                "user_progress": {
                    "149628": {
                        "id": 11601886,
                        "content_id": 265667,
                        "user_id": 149628,
                        "state": "started",
                        "progress_percent": 49,
                        "higher_key_progress": null,
                        "updated_on": "2021-05-18 07:56:31",
                        "started_on": "2020-11-18 00:00:00",
                        "completed_on": null
                    }
                },
                "completed": false,
                "started": true,
                "progress_percent": 49,
                "user_playlists": {
                    "149628": [
                        {
                            "id": 186385,
                            "slug": "primary-playlist",
                            "type": "user-playlist",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "122852",
                            "published_on": "2017-12-13 17:27:17",
                            "created_on": "2017-12-13 17:27:17",
                            "archived_on": null,
                            "popularity": null,
                            "child_position": null,
                            "child_id": null,
                            "parent_id": null
                        }
                    ]
                },
                "is_added_to_primary_playlist": true,
                "published_on_in_timezone": "2020/08/15 18:00:00",
                "is_new": false,
                "resources": {
                    "1": {
                        "resource_id": 145300,
                        "resource_name": "PDF Sheet Music",
                        "resource_url": "https://s3.amazonaws.com/drumeo/courses/pdf/dcb-102-drumline-exercises-for-better-stick-control/dcb-102f.pdf"
                    }
                },
                "xp": 175,
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/265667",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/265667",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/265667",
                "stbs": [],
                "xp_bonus": "150",
                "length_in_seconds": "499",
                "last_watch_position_in_seconds": 0,
                "like_count": 69
            },
            "next_lesson": null,
            "like_count": 0
        },
        {
            "id": 247388,
            "popularity": 26,
            "slug": "the-soloing-blueprint",
            "type": "course",
            "sort": 0,
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "total_xp": "1500",
            "published_on": "2020/03/14 15:00:00",
            "created_on": "2020-03-04 13:15:33",
            "archived_on": null,
            "parent_id": null,
            "child_id": null,
            "fields": [
                {
                    "id": 398643,
                    "content_id": 247388,
                    "key": "topic",
                    "value": "Musicality",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 398644,
                    "content_id": 247388,
                    "key": "tag",
                    "value": "larnell lewis",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 398649,
                    "content_id": 247388,
                    "key": "style",
                    "value": "All",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 398650,
                    "content_id": 247388,
                    "key": "difficulty",
                    "value": "9",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 332381,
                    "content_id": 247388,
                    "key": "title",
                    "value": "The Soloing Blueprint",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 332383,
                    "content_id": 247388,
                    "key": "xp",
                    "value": "500",
                    "type": "integer",
                    "position": 1
                },
                {
                    "id": 398645,
                    "content_id": 247388,
                    "key": "tag",
                    "value": "drumeo course",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 398646,
                    "content_id": 247388,
                    "key": "tag",
                    "value": "how to solo",
                    "type": "string",
                    "position": 3
                },
                {
                    "id": 398647,
                    "content_id": 247388,
                    "key": "tag",
                    "value": "soloing tips",
                    "type": "string",
                    "position": 4
                },
                {
                    "id": 398648,
                    "content_id": 247388,
                    "key": "tag",
                    "value": "drum solo tips",
                    "type": "string",
                    "position": 5
                },
                {
                    "id": 332384,
                    "content_id": 247388,
                    "key": "instructor",
                    "value": {
                        "id": 31895,
                        "popularity": null,
                        "slug": "larnell-lewis",
                        "type": "instructor",
                        "sort": 0,
                        "status": "published",
                        "language": "en-US",
                        "brand": "drumeo",
                        "total_xp": null,
                        "published_on": "2017-12-13 17:23:21",
                        "created_on": "2017-12-13 17:23:21",
                        "archived_on": null,
                        "parent_id": null,
                        "child_id": null,
                        "fields": [
                            {
                                "id": 60901,
                                "content_id": 31895,
                                "key": "name",
                                "value": "Larnell Lewis",
                                "type": "string",
                                "position": 1
                            }
                        ],
                        "data": [
                            {
                                "id": 18702,
                                "content_id": 31895,
                                "key": "head_shot_picture_url",
                                "value": "https://s3.amazonaws.com/drumeo-assets/instructors/larnell-lewis.png?v=1513185407",
                                "position": 1
                            },
                            {
                                "id": 18703,
                                "content_id": 31895,
                                "key": "biography",
                                "value": "Larnell Lewis is a versatile and sought-after drummer, composer, producer, educator, and clinician, who has performed with Snarky Puppy, Fred Hammond, Jully Black, and Glen Lewis. A professor at Humber College's Faculty of Music, where as a student he received the Oscar Peterson Award for “Outstanding Achievement in Music”, Larnell is the ultimate groove master and one of the go-to Drumeo instructors for developing an awesome feel.",
                                "position": 1
                            }
                        ],
                        "permissions": []
                    },
                    "type": "content",
                    "position": 1
                }
            ],
            "data": [
                {
                    "id": 124692,
                    "content_id": 247388,
                    "key": "thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/247388-card-thumbnail-1583922553.jpg",
                    "position": 1
                },
                {
                    "id": 124693,
                    "content_id": 247388,
                    "key": "original_thumbnail_url",
                    "value": "https://d1923uyy6spedc.cloudfront.net/247388-card-thumbnail-maxres-1583922555.jpg",
                    "position": 1
                },
                {
                    "id": 124712,
                    "content_id": 247388,
                    "key": "description",
                    "value": "<p>In this Course, Larnell Lewis will teach you the soloing blueprint: his personal approach for building incredible solos. It includes an overview of each of the four parts of the blueprint, technique, fills, as well as about the importance of confidence and decisiveness when soloing. </p>",
                    "position": 1
                }
            ],
            "permissions": [
                {
                    "id": 1,
                    "content_id": null,
                    "content_type": "course",
                    "permission_id": 1,
                    "brand": "drumeo",
                    "name": "Drumeo Edge"
                }
            ],
            "user_progress": {
                "149628": {
                    "id": 7010100,
                    "content_id": 247388,
                    "user_id": 149628,
                    "state": "started",
                    "progress_percent": 11,
                    "higher_key_progress": null,
                    "updated_on": "2020-04-22 07:27:32",
                    "started_on": "2020-04-21 00:00:00",
                    "completed_on": null
                }
            },
            "completed": false,
            "started": true,
            "progress_percent": 11,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "published_on_in_timezone": "2020/03/14 17:00:00",
            "instructors": [
                "Larnell Lewis",
                "Larnell Lewis"
            ],
            "is_new": false,
            "url": "https://dev.drumeo.com/laravel/public/members/lessons/courses/247388",
            "lesson_count": 0,
            "duration": 0,
            "xp": "500",
            "xp_bonus": "500",
            "total_length_in_seconds": 2384,
            "current_lesson_index": 1,
            "current_lesson": {
                "id": 247673,
                "popularity": 29,
                "slug": "be-decisive",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "100",
                "published_on": "2020/03/14 15:00:00",
                "created_on": "2020-03-09 12:46:14",
                "archived_on": null,
                "parent_id": 247388,
                "child_id": 247673,
                "fields": [
                    {
                        "id": 332987,
                        "content_id": 247673,
                        "key": "title",
                        "value": "Be Decisive",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 333010,
                        "content_id": 247673,
                        "key": "xp",
                        "value": "100",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 333012,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "decisive",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 333011,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "be",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 333014,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "courses",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 333013,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "course",
                        "type": "string",
                        "position": 4
                    },
                    {
                        "id": 333017,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "3",
                        "type": "string",
                        "position": 5
                    },
                    {
                        "id": 333016,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "beginner",
                        "type": "string",
                        "position": 6
                    },
                    {
                        "id": 333015,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "larnell lewis",
                        "type": "string",
                        "position": 7
                    },
                    {
                        "id": 333019,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "solos",
                        "type": "string",
                        "position": 8
                    },
                    {
                        "id": 333018,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "solo",
                        "type": "string",
                        "position": 9
                    },
                    {
                        "id": 333021,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "blueprint",
                        "type": "string",
                        "position": 10
                    },
                    {
                        "id": 333020,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "soloing",
                        "type": "string",
                        "position": 11
                    },
                    {
                        "id": 333022,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "blue print",
                        "type": "string",
                        "position": 12
                    },
                    {
                        "id": 333023,
                        "content_id": 247673,
                        "key": "tag",
                        "value": "blue-print",
                        "type": "string",
                        "position": 13
                    },
                    {
                        "id": 333009,
                        "content_id": 247673,
                        "key": "video",
                        "value": {
                            "id": 247550,
                            "popularity": null,
                            "slug": "vimeo-video-395979302",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "150",
                            "published_on": "2020-03-06 16:30:20",
                            "created_on": "2020-03-06 16:30:20",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 332823,
                                    "content_id": 247550,
                                    "key": "vimeo_video_id",
                                    "value": "395979302",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 332824,
                                    "content_id": 247550,
                                    "key": "length_in_seconds",
                                    "value": "233",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 124696,
                        "content_id": 247673,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/247673-card-thumbnail-1583923625.jpg",
                        "position": 1
                    },
                    {
                        "id": 124697,
                        "content_id": 247673,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/247673-card-thumbnail-maxres-1583923629.jpg",
                        "position": 1
                    },
                    {
                        "id": 124594,
                        "content_id": 247673,
                        "key": "description",
                        "value": "<p>In this lesson, Larnell will talk about decisiveness while soloing and teach you how to decide on what to play.</p>",
                        "position": 1
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    247673
                ],
                "position": 2,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2020/03/14 17:00:00",
                "is_new": false,
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/247673",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/247673",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/247673",
                "stbs": [],
                "xp": 100,
                "xp_bonus": "100",
                "length_in_seconds": "233",
                "last_watch_position_in_seconds": 0,
                "like_count": 60
            },
            "next_lesson": {
                "id": 247674,
                "popularity": 28,
                "slug": "blueprint-part-1",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "100",
                "published_on": "2020/03/14 15:00:00",
                "created_on": "2020-03-09 12:46:36",
                "archived_on": null,
                "parent_id": 247388,
                "child_id": 247674,
                "fields": [
                    {
                        "id": 332988,
                        "content_id": 247674,
                        "key": "title",
                        "value": "Blueprint Part 1",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 333025,
                        "content_id": 247674,
                        "key": "xp",
                        "value": "100",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 333027,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "courses",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 333026,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "course",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 333028,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "beginner",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 333029,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "3",
                        "type": "string",
                        "position": 4
                    },
                    {
                        "id": 333031,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "part 1",
                        "type": "string",
                        "position": 5
                    },
                    {
                        "id": 333030,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "blueprint",
                        "type": "string",
                        "position": 6
                    },
                    {
                        "id": 333032,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "part #1",
                        "type": "string",
                        "position": 7
                    },
                    {
                        "id": 333033,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "#1",
                        "type": "string",
                        "position": 8
                    },
                    {
                        "id": 333035,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "solos",
                        "type": "string",
                        "position": 9
                    },
                    {
                        "id": 333034,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "solo",
                        "type": "string",
                        "position": 10
                    },
                    {
                        "id": 333037,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "blue print",
                        "type": "string",
                        "position": 11
                    },
                    {
                        "id": 333036,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "soloing",
                        "type": "string",
                        "position": 12
                    },
                    {
                        "id": 333038,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "blue-print",
                        "type": "string",
                        "position": 13
                    },
                    {
                        "id": 333039,
                        "content_id": 247674,
                        "key": "tag",
                        "value": "larnell lewis",
                        "type": "string",
                        "position": 14
                    },
                    {
                        "id": 333040,
                        "content_id": 247674,
                        "key": "video",
                        "value": {
                            "id": 247548,
                            "popularity": null,
                            "slug": "vimeo-video-395979353",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": "150",
                            "published_on": "2020-03-06 16:30:19",
                            "created_on": "2020-03-06 16:30:19",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 332821,
                                    "content_id": 247548,
                                    "key": "vimeo_video_id",
                                    "value": "395979353",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 332822,
                                    "content_id": 247548,
                                    "key": "length_in_seconds",
                                    "value": "143",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 124698,
                        "content_id": 247674,
                        "key": "thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/247674-card-thumbnail-1583923671.jpg",
                        "position": 1
                    },
                    {
                        "id": 124699,
                        "content_id": 247674,
                        "key": "original_thumbnail_url",
                        "value": "https://d1923uyy6spedc.cloudfront.net/247674-card-thumbnail-maxres-1583923674.jpg",
                        "position": 1
                    },
                    {
                        "id": 124595,
                        "content_id": 247674,
                        "key": "description",
                        "value": "<p>Over the years, Larnell has found that soloing has become increasingly easier to do with great quality by splitting up his solos into different sections, or blueprints. In this lesson he'll get you started on this concept with the first part of the blueprint: basing a solo phrase on a groove, right before starting to solo.</p>",
                        "position": 1
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    247674
                ],
                "position": 3,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2020/03/14 17:00:00",
                "is_new": false,
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/247674",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/247674",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/247674",
                "stbs": [],
                "xp": 100,
                "xp_bonus": "100",
                "length_in_seconds": "143",
                "last_watch_position_in_seconds": 0,
                "like_count": 56
            },
            "like_count": 0
        },
        {
            "id": 21065,
            "popularity": 3045,
            "slug": "gospel-drumming",
            "type": "course",
            "sort": 0,
            "status": "published",
            "language": "en-US",
            "brand": "drumeo",
            "total_xp": "2150",
            "published_on": "2014/04/04 10:00:04",
            "created_on": "2014-04-04 10:00:04",
            "archived_on": null,
            "parent_id": null,
            "child_id": null,
            "fields": [
                {
                    "id": 12849,
                    "content_id": 21065,
                    "key": "legacy_wordpress_post_id",
                    "value": "21065",
                    "type": "integer",
                    "position": 1
                },
                {
                    "id": 2421,
                    "content_id": 21065,
                    "key": "title",
                    "value": "Gospel Drumming",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 359044,
                    "content_id": 21065,
                    "key": "xp",
                    "value": "500",
                    "type": "integer",
                    "position": 1
                },
                {
                    "id": 388536,
                    "content_id": 21065,
                    "key": "topic",
                    "value": "Styles",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 388538,
                    "content_id": 21065,
                    "key": "tag",
                    "value": "larnell lewis",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 388543,
                    "content_id": 21065,
                    "key": "style",
                    "value": "R&B",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 388544,
                    "content_id": 21065,
                    "key": "difficulty",
                    "value": "6",
                    "type": "string",
                    "position": 1
                },
                {
                    "id": 388537,
                    "content_id": 21065,
                    "key": "topic",
                    "value": "Beats",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 388539,
                    "content_id": 21065,
                    "key": "tag",
                    "value": "gospel chops",
                    "type": "string",
                    "position": 2
                },
                {
                    "id": 388540,
                    "content_id": 21065,
                    "key": "tag",
                    "value": "gospel drums",
                    "type": "string",
                    "position": 3
                },
                {
                    "id": 388541,
                    "content_id": 21065,
                    "key": "tag",
                    "value": "linear drumming",
                    "type": "string",
                    "position": 4
                },
                {
                    "id": 388542,
                    "content_id": 21065,
                    "key": "tag",
                    "value": "dynamic drumming",
                    "type": "string",
                    "position": 5
                },
                {
                    "id": 75016,
                    "content_id": 21065,
                    "key": "instructor",
                    "value": {
                        "id": 31895,
                        "popularity": null,
                        "slug": "larnell-lewis",
                        "type": "instructor",
                        "sort": 0,
                        "status": "published",
                        "language": "en-US",
                        "brand": "drumeo",
                        "total_xp": null,
                        "published_on": "2017-12-13 17:23:21",
                        "created_on": "2017-12-13 17:23:21",
                        "archived_on": null,
                        "parent_id": null,
                        "child_id": null,
                        "fields": [
                            {
                                "id": 60901,
                                "content_id": 31895,
                                "key": "name",
                                "value": "Larnell Lewis",
                                "type": "string",
                                "position": 1
                            }
                        ],
                        "data": [
                            {
                                "id": 18702,
                                "content_id": 31895,
                                "key": "head_shot_picture_url",
                                "value": "https://s3.amazonaws.com/drumeo-assets/instructors/larnell-lewis.png?v=1513185407",
                                "position": 1
                            },
                            {
                                "id": 18703,
                                "content_id": 31895,
                                "key": "biography",
                                "value": "Larnell Lewis is a versatile and sought-after drummer, composer, producer, educator, and clinician, who has performed with Snarky Puppy, Fred Hammond, Jully Black, and Glen Lewis. A professor at Humber College's Faculty of Music, where as a student he received the Oscar Peterson Award for “Outstanding Achievement in Music”, Larnell is the ultimate groove master and one of the go-to Drumeo instructors for developing an awesome feel.",
                                "position": 1
                            }
                        ],
                        "permissions": []
                    },
                    "type": "content",
                    "position": 1
                }
            ],
            "data": [
                {
                    "id": 41568,
                    "content_id": 21065,
                    "key": "resource_name",
                    "value": "Full Course PDF",
                    "position": 1
                },
                {
                    "id": 41569,
                    "content_id": 21065,
                    "key": "resource_url",
                    "value": "//drumeo.s3.amazonaws.com/courses/pdf/dci-41.pdf",
                    "position": 1
                },
                {
                    "id": 2421,
                    "content_id": 21065,
                    "key": "description",
                    "value": "This course will dive into the essentials of gospel drumming. Larnell Lewis will teach you some popular gospel drum grooves, how to apply rudiments to gospel music, how to utilize different sounds, and more!",
                    "position": 1
                },
                {
                    "id": 12521,
                    "content_id": 21065,
                    "key": "thumbnail_url",
                    "value": "https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/courses/550/dci-41.jpg",
                    "position": 1
                },
                {
                    "id": 41566,
                    "content_id": 21065,
                    "key": "resource_name",
                    "value": "Course Resources Pack",
                    "position": 2
                },
                {
                    "id": 41567,
                    "content_id": 21065,
                    "key": "resource_url",
                    "value": "https://drumeo.s3.amazonaws.com/courses/resource-files/dci-41-gospel-drumming.zip",
                    "position": 2
                }
            ],
            "permissions": [
                {
                    "id": 1,
                    "content_id": null,
                    "content_type": "course",
                    "permission_id": 1,
                    "brand": "drumeo",
                    "name": "Drumeo Edge"
                }
            ],
            "user_progress": {
                "149628": []
            },
            "completed": false,
            "started": false,
            "progress_percent": 0,
            "user_playlists": {
                "149628": []
            },
            "is_added_to_primary_playlist": false,
            "published_on_in_timezone": "2014/04/04 13:00:04",
            "instructors": [
                "Larnell Lewis",
                "Larnell Lewis"
            ],
            "is_new": false,
            "resources": {
                "1": {
                    "resource_id": 41568,
                    "resource_name": "Full Course PDF",
                    "resource_url": "https://drumeo.s3.amazonaws.com/courses/pdf/dci-41.pdf"
                },
                "2": {
                    "resource_id": 41566,
                    "resource_name": "Course Resources Pack",
                    "resource_url": "https://drumeo.s3.amazonaws.com/courses/resource-files/dci-41-gospel-drumming.zip"
                }
            },
            "url": "https://dev.drumeo.com/laravel/public/members/lessons/courses/21065",
            "lesson_count": 0,
            "duration": 0,
            "xp": "500",
            "xp_bonus": "500",
            "total_length_in_seconds": 4752,
            "current_lesson_index": 0,
            "current_lesson": {
                "id": 21067,
                "popularity": 35,
                "slug": "01-7-must-know-gospel-drum-beats",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "325",
                "published_on": "2014/04/04 09:24:27",
                "created_on": "2014-04-04 09:24:27",
                "archived_on": null,
                "parent_id": 21065,
                "child_id": 21067,
                "fields": [
                    {
                        "id": 32274,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "beats",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 12853,
                        "content_id": 21067,
                        "key": "legacy_wordpress_post_id",
                        "value": "21067",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 2433,
                        "content_id": 21067,
                        "key": "title",
                        "value": "7 Must Know Gospel Drum Beats",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 359045,
                        "content_id": 21067,
                        "key": "xp",
                        "value": "150",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 83178,
                        "content_id": 21067,
                        "key": "sbt_exercise_number",
                        "value": "1",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 83179,
                        "content_id": 21067,
                        "key": "sbt_bpm",
                        "value": "105",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 32275,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "intermediate",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 32276,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "larnell lewis",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 32277,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "groove",
                        "type": "string",
                        "position": 4
                    },
                    {
                        "id": 32278,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "gospel",
                        "type": "string",
                        "position": 5
                    },
                    {
                        "id": 32279,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "5",
                        "type": "string",
                        "position": 6
                    },
                    {
                        "id": 32280,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "7",
                        "type": "string",
                        "position": 7
                    },
                    {
                        "id": 32281,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "beat",
                        "type": "string",
                        "position": 8
                    },
                    {
                        "id": 32282,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "grooves",
                        "type": "string",
                        "position": 9
                    },
                    {
                        "id": 32283,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "seven",
                        "type": "string",
                        "position": 10
                    },
                    {
                        "id": 32284,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "should know",
                        "type": "string",
                        "position": 11
                    },
                    {
                        "id": 32285,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "must know",
                        "type": "string",
                        "position": 12
                    },
                    {
                        "id": 32286,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "drumming",
                        "type": "string",
                        "position": 13
                    },
                    {
                        "id": 32287,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "church",
                        "type": "string",
                        "position": 14
                    },
                    {
                        "id": 32288,
                        "content_id": 21067,
                        "key": "tag",
                        "value": "snarky puppy",
                        "type": "string",
                        "position": 15
                    },
                    {
                        "id": 75141,
                        "content_id": 21067,
                        "key": "video",
                        "value": {
                            "id": 34754,
                            "popularity": null,
                            "slug": "vimeo-video-89957446",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": null,
                            "published_on": "2017-12-13 17:24:27",
                            "created_on": "2017-12-13 17:24:27",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 66528,
                                    "content_id": 34754,
                                    "key": "vimeo_video_id",
                                    "value": "89957446",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 66529,
                                    "content_id": 34754,
                                    "key": "length_in_seconds",
                                    "value": "774",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 43316,
                        "content_id": 21067,
                        "key": "resource_name",
                        "value": "Sheet Music PDF",
                        "position": 1
                    },
                    {
                        "id": 43317,
                        "content_id": 21067,
                        "key": "resource_url",
                        "value": "https://drumeo.s3.amazonaws.com/courses/pdf/dci-41a.pdf",
                        "position": 1
                    },
                    {
                        "id": 22838,
                        "content_id": 21067,
                        "key": "sbt_video_url",
                        "value": "https://s3.amazonaws.com/drumeosecure/courses/sbt/dci-41a-01-105.mp4",
                        "position": 1
                    },
                    {
                        "id": 22839,
                        "content_id": 21067,
                        "key": "sbt_image_url",
                        "value": "https://s3.amazonaws.com/drumeosecure/courses/png/dci-41a-01.png",
                        "position": 1
                    },
                    {
                        "id": 2433,
                        "content_id": 21067,
                        "key": "description",
                        "value": "",
                        "position": 1
                    },
                    {
                        "id": 72382,
                        "content_id": 21067,
                        "key": "original_thumbnail_url",
                        "value": "https://i.vimeocdn.com/video/471954740_640x360.jpg?r=pad",
                        "position": 1
                    },
                    {
                        "id": 12523,
                        "content_id": 21067,
                        "key": "thumbnail_url",
                        "value": "https://dzryyo1we6bm3.cloudfront.net/thumbnails/21067_thumbnail_360p.jpg",
                        "position": 1
                    },
                    {
                        "id": 142844,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "74",
                        "position": 1
                    },
                    {
                        "id": 142845,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #1",
                        "position": 1
                    },
                    {
                        "id": 43314,
                        "content_id": 21067,
                        "key": "resource_name",
                        "value": "MP3 Resources Pack",
                        "position": 2
                    },
                    {
                        "id": 43315,
                        "content_id": 21067,
                        "key": "resource_url",
                        "value": "//drumeo.s3.amazonaws.com/courses/audio/dci-41a.zip",
                        "position": 2
                    },
                    {
                        "id": 142846,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "181",
                        "position": 2
                    },
                    {
                        "id": 142847,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #2",
                        "position": 2
                    },
                    {
                        "id": 142848,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "241",
                        "position": 3
                    },
                    {
                        "id": 142849,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #3",
                        "position": 3
                    },
                    {
                        "id": 142850,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "368",
                        "position": 4
                    },
                    {
                        "id": 142851,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #4",
                        "position": 4
                    },
                    {
                        "id": 142852,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "499",
                        "position": 5
                    },
                    {
                        "id": 142853,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #5",
                        "position": 5
                    },
                    {
                        "id": 142854,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "564",
                        "position": 6
                    },
                    {
                        "id": 142855,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #6",
                        "position": 6
                    },
                    {
                        "id": 142856,
                        "content_id": 21067,
                        "key": "chapter_timecode",
                        "value": "661",
                        "position": 7
                    },
                    {
                        "id": 142857,
                        "content_id": 21067,
                        "key": "chapter_description",
                        "value": "Beat #7",
                        "position": 7
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    21067
                ],
                "position": 1,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2014/04/04 12:24:27",
                "is_new": false,
                "resources": {
                    "1": {
                        "resource_id": 43316,
                        "resource_name": "Sheet Music PDF",
                        "resource_url": "https://drumeo.s3.amazonaws.com/courses/pdf/dci-41a.pdf"
                    },
                    "2": {
                        "resource_id": 43314,
                        "resource_name": "MP3 Resources Pack",
                        "resource_url": "https://drumeo.s3.amazonaws.com/courses/audio/dci-41a.zip"
                    }
                },
                "chapters": [
                    {
                        "chapter_timecode": "74",
                        "chapter_description": "Beat #1"
                    },
                    {
                        "chapter_timecode": "181",
                        "chapter_description": "Beat #2"
                    },
                    {
                        "chapter_timecode": "241",
                        "chapter_description": "Beat #3"
                    },
                    {
                        "chapter_timecode": "368",
                        "chapter_description": "Beat #4"
                    },
                    {
                        "chapter_timecode": "499",
                        "chapter_description": "Beat #5"
                    },
                    {
                        "chapter_timecode": "564",
                        "chapter_description": "Beat #6"
                    },
                    {
                        "chapter_timecode": "661",
                        "chapter_description": "Beat #7"
                    }
                ],
                "xp": 325,
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/21067",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/21067",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/21067",
                "stbs": {
                    "1": {
                        "105": {
                            "video_url": "https://s3.amazonaws.com/drumeosecure/courses/sbt/dci-41a-01-105.mp4",
                            "image_url": "https://s3.amazonaws.com/drumeosecure/courses/png/dci-41a-01.png"
                        }
                    }
                },
                "xp_bonus": "150",
                "length_in_seconds": "774",
                "last_watch_position_in_seconds": 0,
                "like_count": 39
            },
            "next_lesson": {
                "id": 21069,
                "popularity": 20,
                "slug": "02-the-beat-builder",
                "type": "course-part",
                "sort": 0,
                "status": "published",
                "language": "en-US",
                "brand": "drumeo",
                "total_xp": "275",
                "published_on": "2014/04/04 09:25:51",
                "created_on": "2014-04-04 09:25:51",
                "archived_on": null,
                "parent_id": 21065,
                "child_id": 21069,
                "fields": [
                    {
                        "id": 32289,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "beats",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 12854,
                        "content_id": 21069,
                        "key": "legacy_wordpress_post_id",
                        "value": "21069",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 2434,
                        "content_id": 21069,
                        "key": "title",
                        "value": "The Beat Builder",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 359082,
                        "content_id": 21069,
                        "key": "xp",
                        "value": "150",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 83192,
                        "content_id": 21069,
                        "key": "sbt_exercise_number",
                        "value": "1",
                        "type": "string",
                        "position": 1
                    },
                    {
                        "id": 83193,
                        "content_id": 21069,
                        "key": "sbt_bpm",
                        "value": "90",
                        "type": "integer",
                        "position": 1
                    },
                    {
                        "id": 32290,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "intermediate",
                        "type": "string",
                        "position": 2
                    },
                    {
                        "id": 32291,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "larnell lewis",
                        "type": "string",
                        "position": 3
                    },
                    {
                        "id": 32292,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "groove",
                        "type": "string",
                        "position": 4
                    },
                    {
                        "id": 32293,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "gospel",
                        "type": "string",
                        "position": 5
                    },
                    {
                        "id": 32294,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "5",
                        "type": "string",
                        "position": 6
                    },
                    {
                        "id": 32295,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "beat",
                        "type": "string",
                        "position": 7
                    },
                    {
                        "id": 32296,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "grooves",
                        "type": "string",
                        "position": 8
                    },
                    {
                        "id": 32297,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "create",
                        "type": "string",
                        "position": 9
                    },
                    {
                        "id": 32298,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "building",
                        "type": "string",
                        "position": 10
                    },
                    {
                        "id": 32299,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "unique",
                        "type": "string",
                        "position": 11
                    },
                    {
                        "id": 32300,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "drumming",
                        "type": "string",
                        "position": 12
                    },
                    {
                        "id": 32301,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "build",
                        "type": "string",
                        "position": 13
                    },
                    {
                        "id": 32302,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "church",
                        "type": "string",
                        "position": 14
                    },
                    {
                        "id": 32303,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "builder",
                        "type": "string",
                        "position": 15
                    },
                    {
                        "id": 32304,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "snarky puppy",
                        "type": "string",
                        "position": 16
                    },
                    {
                        "id": 32305,
                        "content_id": 21069,
                        "key": "tag",
                        "value": "own",
                        "type": "string",
                        "position": 17
                    },
                    {
                        "id": 75142,
                        "content_id": 21069,
                        "key": "video",
                        "value": {
                            "id": 34755,
                            "popularity": null,
                            "slug": "vimeo-video-89957447",
                            "type": "vimeo-video",
                            "sort": 0,
                            "status": "published",
                            "language": "en-US",
                            "brand": "drumeo",
                            "total_xp": null,
                            "published_on": "2017-12-13 17:24:27",
                            "created_on": "2017-12-13 17:24:27",
                            "archived_on": null,
                            "parent_id": null,
                            "child_id": null,
                            "fields": [
                                {
                                    "id": 66530,
                                    "content_id": 34755,
                                    "key": "vimeo_video_id",
                                    "value": "89957447",
                                    "type": "string",
                                    "position": 1
                                },
                                {
                                    "id": 66531,
                                    "content_id": 34755,
                                    "key": "length_in_seconds",
                                    "value": "715",
                                    "type": "integer",
                                    "position": 1
                                }
                            ],
                            "data": [],
                            "permissions": []
                        },
                        "type": "content",
                        "position": 1
                    },
                    {
                        "key": "difficulty",
                        "value": "all",
                        "type": "string",
                        "position": 1
                    }
                ],
                "data": [
                    {
                        "id": 142859,
                        "content_id": 21069,
                        "key": "chapter_timecode",
                        "value": "101",
                        "position": 1
                    },
                    {
                        "id": 142860,
                        "content_id": 21069,
                        "key": "chapter_description",
                        "value": "Beat #1",
                        "position": 1
                    },
                    {
                        "id": 43312,
                        "content_id": 21069,
                        "key": "resource_name",
                        "value": "Sheet Music PDF",
                        "position": 1
                    },
                    {
                        "id": 43313,
                        "content_id": 21069,
                        "key": "resource_url",
                        "value": "https://drumeo.s3.amazonaws.com/courses/pdf/dci-41b.pdf",
                        "position": 1
                    },
                    {
                        "id": 22852,
                        "content_id": 21069,
                        "key": "sbt_video_url",
                        "value": "https://s3.amazonaws.com/drumeosecure/courses/sbt/dci-41b-01-90.mp4",
                        "position": 1
                    },
                    {
                        "id": 22853,
                        "content_id": 21069,
                        "key": "sbt_image_url",
                        "value": "https://s3.amazonaws.com/drumeosecure/courses/png/dci-41b-01.png",
                        "position": 1
                    },
                    {
                        "id": 2434,
                        "content_id": 21069,
                        "key": "description",
                        "value": "",
                        "position": 1
                    },
                    {
                        "id": 72381,
                        "content_id": 21069,
                        "key": "original_thumbnail_url",
                        "value": "https://i.vimeocdn.com/video/471954824_640x360.jpg?r=pad",
                        "position": 1
                    },
                    {
                        "id": 12525,
                        "content_id": 21069,
                        "key": "thumbnail_url",
                        "value": "https://dzryyo1we6bm3.cloudfront.net/thumbnails/21069_thumbnail_360p.jpg",
                        "position": 1
                    },
                    {
                        "id": 142861,
                        "content_id": 21069,
                        "key": "chapter_timecode",
                        "value": "259",
                        "position": 2
                    },
                    {
                        "id": 142862,
                        "content_id": 21069,
                        "key": "chapter_description",
                        "value": "Beat #2",
                        "position": 2
                    },
                    {
                        "id": 43310,
                        "content_id": 21069,
                        "key": "resource_name",
                        "value": "MP3 Resources Pack",
                        "position": 2
                    },
                    {
                        "id": 43311,
                        "content_id": 21069,
                        "key": "resource_url",
                        "value": "//drumeo.s3.amazonaws.com/courses/audio/dci-41b.zip",
                        "position": 2
                    },
                    {
                        "id": 142863,
                        "content_id": 21069,
                        "key": "chapter_timecode",
                        "value": "373",
                        "position": 3
                    },
                    {
                        "id": 142864,
                        "content_id": 21069,
                        "key": "chapter_description",
                        "value": "Beat #3",
                        "position": 3
                    },
                    {
                        "id": 142865,
                        "content_id": 21069,
                        "key": "chapter_timecode",
                        "value": "447",
                        "position": 4
                    },
                    {
                        "id": 142866,
                        "content_id": 21069,
                        "key": "chapter_description",
                        "value": "Beat #4",
                        "position": 4
                    },
                    {
                        "id": 142867,
                        "content_id": 21069,
                        "key": "chapter_timecode",
                        "value": "501",
                        "position": 5
                    },
                    {
                        "id": 142868,
                        "content_id": 21069,
                        "key": "chapter_description",
                        "value": "Beat #5",
                        "position": 5
                    }
                ],
                "permissions": [
                    {
                        "id": 1,
                        "content_id": null,
                        "content_type": "course-part",
                        "permission_id": 1,
                        "brand": "drumeo",
                        "name": "Drumeo Edge"
                    }
                ],
                "child_ids": [
                    21069
                ],
                "position": 2,
                "user_progress": {
                    "149628": []
                },
                "completed": false,
                "started": false,
                "progress_percent": 0,
                "user_playlists": {
                    "149628": []
                },
                "is_added_to_primary_playlist": false,
                "published_on_in_timezone": "2014/04/04 12:25:51",
                "is_new": false,
                "resources": {
                    "1": {
                        "resource_id": 43312,
                        "resource_name": "Sheet Music PDF",
                        "resource_url": "https://drumeo.s3.amazonaws.com/courses/pdf/dci-41b.pdf"
                    },
                    "2": {
                        "resource_id": 43310,
                        "resource_name": "MP3 Resources Pack",
                        "resource_url": "https://drumeo.s3.amazonaws.com/courses/audio/dci-41b.zip"
                    }
                },
                "chapters": [
                    {
                        "chapter_timecode": "101",
                        "chapter_description": "Beat #1"
                    },
                    {
                        "chapter_timecode": "259",
                        "chapter_description": "Beat #2"
                    },
                    {
                        "chapter_timecode": "373",
                        "chapter_description": "Beat #3"
                    },
                    {
                        "chapter_timecode": "447",
                        "chapter_description": "Beat #4"
                    },
                    {
                        "chapter_timecode": "501",
                        "chapter_description": "Beat #5"
                    }
                ],
                "xp": 275,
                "url": "https://dev.drumeo.com/laravel/public/members/lessons/course-part/21069",
                "mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/21069",
                "musora_api_mobile_app_url": "https://dev.drumeo.com/laravel/public/musora-api/content/21069",
                "stbs": {
                    "1": {
                        "90": {
                            "video_url": "https://s3.amazonaws.com/drumeosecure/courses/sbt/dci-41b-01-90.mp4",
                            "image_url": "https://s3.amazonaws.com/drumeosecure/courses/png/dci-41b-01.png"
                        }
                    }
                },
                "xp_bonus": "150",
                "length_in_seconds": "715",
                "last_watch_position_in_seconds": 0,
                "like_count": 25
            },
            "like_count": 1
        }
    ],
    "meta": {
        "totalResults": 4,
        "page": 1,
        "limit": 10,
        "filterOptions": []
    }
}
```