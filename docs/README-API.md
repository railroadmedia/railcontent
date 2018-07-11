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
  * [Pull assigned to me comments - JSON controller](#pull-assigned-to-me-comments---json-controller)
    + [Request Example](#request-example-40)
    + [Request Parameters](#request-parameters-38)
    + [Response Example](#response-example-41)
  * [Delete comment assignation - JSON controller](#delete-comment-assignation---json-controller)
    + [Request Example](#request-example-41)
    + [Request Parameters](#request-parameters-39)
    + [Response Example](#response-example-42)

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
| query           |  sort                             |  no       |  'published_on'  |  Defaults to ascending order; to switch to descending order put a minus sign (-) in front of the value. Can be any of the following: slug; status; type; brand; language; position; parent_id; published_on; created_on; archived_on                                            | 
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
