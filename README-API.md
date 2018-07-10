- [API endpoints](README-API.md#api-endpoints)
  * [Get content - JSON controller](README-API.md#get-content---json-controller)
    + [Request Example](README-API.md#request-example)
    + [Request Parameters](README-API.md#request-parameters)
    + [Response Example](README-API.md#response-example)
  * [Get contents based on ids - JSON controller](README-API.md#get-contents-based-on-ids---json-controller)
    + [Request Example](README-API.md#request-example-1)
    + [Request Parameters](README-API.md#request-parameters-1)
    + [Response Example](README-API.md#response-example-1)
  * [Get contents that are childrens of the content id - JSON controller](README-API.md#get-contents-that-are-childrens-of-the-content-id---json-controller)
    + [Request Example](README-API.md#request-example-2)
    + [Request Parameters](README-API.md#request-parameters-2)
    + [Response Example](README-API.md#response-example-2)
  * [Filter contents  - JSON controller](README-API.md#filter-contents----json-controller)
    + [Request Example](README-API.md#request-example-3)
    + [Request Parameters](README-API.md#request-parameters-3)
    + [Response Example](README-API.md#response-example-3)
  * [Store content - JSON controller](README-API.md#store-content---json-controller)
    + [Request Example](README-API.md#request-example-4)
    + [Request Parameters](README-API.md#request-parameters-4)
    + [Response Example](README-API.md#response-example-4)
  * [Update content - JSON controller](README-API.md#update-content---json-controller)
    + [Request Example](README-API.md#request-example-5)
    + [Request Parameters](README-API.md#request-parameters-5)
    + [Response Example](README-API.md#response-example-5)
  * [Delete content - JSON controller](README-API.md#delete-content---json-controller)
    + [Request Example](README-API.md#request-example-6)
    + [Request Parameters](README-API.md#request-parameters-6)
    + [Response Example](README-API.md#response-example-6)
  * [Soft delete content - JSON controller](README-API.md#soft-delete-content---json-controller)
    + [Request Example](README-API.md#request-example-7)
    + [Request Parameters](README-API.md#request-parameters-7)
    + [Response Example](README-API.md#response-example-7)
  * [Configure Route Options - JSON controller](README-API.md#configure-route-options---json-controller)
  * [Store content field - JSON controller](README-API.md#store-content-field---json-controller)
    + [Request Example](README-API.md#request-example-8)
    + [Request Parameters](README-API.md#request-parameters-8)
    + [Response Example](README-API.md#response-example-8)
  * [Update content field - JSON controller](README-API.md#update-content-field---json-controller)
    + [Request Example](README-API.md#request-example-9)
    + [Request Parameters](README-API.md#request-parameters-9)
    + [Response Example](README-API.md#response-example-9)
  * [Delete content field - JSON controller](README-API.md#delete-content-field---json-controller)
    + [Request Example](README-API.md#request-example-10)
    + [Request Parameters](README-API.md#request-parameters-10)
    + [Response Example](README-API.md#response-example-10)
  * [Get content field - JSON controller](README-API.md#get-content-field---json-controller)
    + [Request Example](README-API.md#request-example-11)
    + [Request Parameters](README-API.md#request-parameters-11)
    + [Response Example](README-API.md#response-example-11)
  * [Store content datum - JSON controller](README-API.md#store-content-datum---json-controller)
    + [Request Example](README-API.md#request-example-12)
    + [Request Parameters](README-API.md#request-parameters-12)
    + [Response Example](README-API.md#response-example-12)
  * [Update content datum - JSON controller](README-API.md#update-content-datum---json-controller)
    + [Request Example](README-API.md#request-example-13)
    + [Request Parameters](README-API.md#request-parameters-13)
    + [Response Example](README-API.md#response-example-13)
  * [Delete content datum - JSON controller](README-API.md#delete-content-datum---json-controller)
    + [Request Example](README-API.md#request-example-14)
    + [Request Parameters](README-API.md#request-parameters-14)
    + [Response Example](README-API.md#response-example-14)
  * [Store content hierarchy - JSON controller](README-API.md#store-content-hierarchy---json-controller)
    + [Request Example](README-API.md#request-example-15)
    + [Request Parameters](README-API.md#request-parameters-15)
    + [Response Example](README-API.md#response-example-15)
  * [Change child position in content hierarchy - JSON controller](README-API.md#change-child-position-in-content-hierarchy---json-controller)
    + [Request Example](README-API.md#request-example-16)
    + [Request Parameters](README-API.md#request-parameters-16)
    + [Response Example](README-API.md#response-example-16)
  * [Delete child from content hierarchy - JSON controller](README-API.md#delete-child-from-content-hierarchy---json-controller)
    + [Request Example](README-API.md#request-example-17)
    + [Request Parameters](README-API.md#request-parameters-17)
    + [Response Example](README-API.md#response-example-17)
  * [Start authenticated user progress on content - JSON controller](README-API.md#start-authenticated-user-progress-on-content---json-controller)
    + [Request Example](README-API.md#request-example-18)
    + [Request Parameters](README-API.md#request-parameters-18)
    + [Response Example](README-API.md#response-example-18)
  * [Save authenticated user progress on content - JSON controller](README-API.md#save-authenticated-user-progress-on-content---json-controller)
    + [Request Example](README-API.md#request-example-19)
    + [Request Parameters](README-API.md#request-parameters-19)
    + [Response Example](README-API.md#response-example-19)
  * [Reset authenticated user progress on content - JSON controller](README-API.md#reset-authenticated-user-progress-on-content---json-controller)
    + [Request Example](README-API.md#request-example-20)
    + [Request Parameters](README-API.md#request-parameters-20)
    + [Response Example](README-API.md#response-example-20)
  * [Complete authenticated user progress on content - JSON controller](README-API.md#complete-authenticated-user-progress-on-content---json-controller)
    + [Request Example](README-API.md#request-example-21)
    + [Request Parameters](README-API.md#request-parameters-21)
    + [Response Example](README-API.md#response-example-21)


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
        "results":[
          {
            "id":"243",
            "slug":"quis",
            "status":"draft",
            "type":"nihil",
            "parent_id":null,
            "language":"en-US",
            "brand":"drumeo",
            "created_on":"2017-10-26 16:00:03"
        		}, ...
          ]
    }
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
	"user_id:null,
	"published_on":null,
	"created_on":"2015-09-28 16:25:05"
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
	"user_id:null,
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
        "results":{
            "id":"1",
            "content_id":"1",
            "key":"dolorem",
            "value":"nihil",
            "type":"atque",
            "position":"1"
        }
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