
Railcontent
========================================================================================================================

Data first simple CMS.

  * [Installation, Configuration, Use](#installation--configuration--use)
    + [Installation](#installation)
    + [Configuration](#configuration)
- [Services](#services)
  * [ContentService](#contentservice)
    + [getById](#getbyid)
      - [Usage Example(s)](#usage-example-s-)
      - [Parameters](#parameters)
      - [Responses](#responses)
    + [getByIds](#getbyids)
      - [Usage Example(s)](#usage-example-s--1)
      - [Parameters](#parameters-1)
      - [Responses](#responses-1)
    + [getAllByType](#getallbytype)
      - [Usage Example(s)](#usage-example-s--2)
      - [Parameters](#parameters-2)
      - [Responses](#responses-2)
    + [getWhereTypeInAndStatusAndField](#getwheretypeinandstatusandfield)
      - [Usage Example(s)](#usage-example-s--3)
      - [Parameters](#parameters-3)
      - [Responses](#responses-3)
    + [getWhereTypeInAndStatusAndPublishedOnOrdered](#getwheretypeinandstatusandpublishedonordered)
      - [Usage Example(s)](#usage-example-s--4)
      - [Parameters](#parameters-4)
      - [Responses](#responses-4)
    + [getBySlugAndType](#getbyslugandtype)
      - [Usage Example(s)](#usage-example-s--5)
      - [Parameters](#parameters-5)
      - [Responses](#responses-5)
    + [getByUserIdTypeSlug](#getbyuseridtypeslug)
      - [Usage Example(s)](#usage-example-s--6)
      - [Parameters](#parameters-6)
      - [Responses](#responses-6)
    + [getByParentId](#getbyparentid)
      - [Usage Example(s)](#usage-example-s--7)
      - [Parameters](#parameters-7)
      - [Responses](#responses-7)
    + [getByParentIdWhereTypeIn](#getbyparentidwheretypein)
      - [Usage Example(s)](#usage-example-s--8)
      - [Parameters](#parameters-8)
      - [Responses](#responses-8)
    + [getByParentIds](#getbyparentids)
      - [Usage Example(s)](#usage-example-s--9)
      - [Parameters](#parameters-9)
      - [Responses](#responses-9)
    + [getByChildIdWhereType](#getbychildidwheretype)
      - [Usage Example(s)](#usage-example-s--10)
      - [Parameters](#parameters-10)
      - [Responses](#responses-10)
    + [getByChildIdsWhereType](#getbychildidswheretype)
      - [Usage Example(s)](#usage-example-s--11)
      - [Parameters](#parameters-11)
      - [Responses](#responses-11)
    + [getByChildIdWhereParentTypeIn](#getbychildidwhereparenttypein)
      - [Usage Example(s)](#usage-example-s--12)
      - [Parameters](#parameters-12)
      - [Responses](#responses-12)
    + [getPaginatedByTypeUserProgressState](#getpaginatedbytypeuserprogressstate)
      - [Usage Example(s)](#usage-example-s--13)
      - [Parameters](#parameters-13)
      - [Responses](#responses-13)
    + [getPaginatedByTypesUserProgressState](#getpaginatedbytypesuserprogressstate)
      - [Usage Example(s)](#usage-example-s--14)
      - [Parameters](#parameters-14)
      - [Responses](#responses-14)
    + [getTypeNeighbouringSiblings](#gettypeneighbouringsiblings)
      - [Usage Example(s)](#usage-example-s--15)
      - [Parameters](#parameters-15)
      - [Responses](#responses-15)
    + [getByContentFieldValuesForTypes](#getbycontentfieldvaluesfortypes)
      - [Usage Example(s)](#usage-example-s--16)
      - [Parameters](#parameters-16)
      - [Responses](#responses-16)
    + [countByTypesUserProgressState](#countbytypesuserprogressstate)
      - [Usage Example(s)](#usage-example-s--17)
      - [Parameters](#parameters-17)
      - [Responses](#responses-17)
    + [getFiltered](#getfiltered)
      - [Usage Example(s)](#usage-example-s--18)
      - [Parameters](#parameters-18)
      - [Responses](#responses-18)
    + [create](#create)
      - [Usage Example(s)](#usage-example-s--19)
      - [Parameters](#parameters-19)
      - [Responses](#responses-19)
    + [update](#update)
      - [Usage Example(s)](#usage-example-s--20)
      - [Parameters](#parameters-20)
      - [Responses](#responses-20)
    + [delete](#delete)
      - [Usage Example(s)](#usage-example-s--21)
      - [Parameters](#parameters-21)
      - [Responses](#responses-21)
    + [softDelete](#softdelete)
      - [Usage Example(s)](#usage-example-s--22)
      - [Parameters](#parameters-22)
      - [Responses](#responses-22)
    + [attachPlaylistsToContents](#attachplayliststocontents)
      - [Usage Example(s)](#usage-example-s--23)
      - [Parameters](#parameters-23)
      - [Responses](#responses-23)
  * [ContentFieldService](#contentfieldservice)
    + [get](#get)
      - [Usage Example(s)](#usage-example-s--24)
      - [Parameters](#parameters-24)
      - [Responses](#responses-24)
    + [getByKeyValueTypePosition](#getbykeyvaluetypeposition)
    + [getByKeyValueType](#getbykeyvaluetype)
    + [create](#create-1)
    + [update](#update-1)
    + [delete](#delete-1)
  * [ContentDatumService](#contentdatumservice)
    + [get](#get-1)
      - [Usage Example(s)](#usage-example-s--25)
    + [getByContentIds](#getbycontentids)
    + [create](#create-2)
    + [update](#update-2)
    + [delete](#delete-2)
  * [Get content - JSON controller](#get-content---json-controller)
    + [Request Example(s)](#request-example-s-)
    + [Request Parameters](#request-parameters)
    + [Response Example(s)](#response-example-s-)
      - [`201 OK`](#-201-ok-)
      - [`404 Not Found`](#-404-not-found-)
- [API endpoints](#api-endpoints)
  * [Get contents based on ids - JSON controller](#get-contents-based-on-ids---json-controller)
    + [Request Example(s)](#request-example-s--1)
    + [Request Parameters](#request-parameters-1)
    + [Response Example(s)](#response-example-s--1)
      - [`200 OK`](#-200-ok-)
  * [Get contents that are childrens of the content id - JSON controller](#get-contents-that-are-childrens-of-the-content-id---json-controller)
    + [Request Example(s)](#request-example-s--2)
    + [Request Parameters](#request-parameters-2)
    + [Response Example(s)](#response-example-s--2)
      - [`200 OK`](#-200-ok--1)
  * [Filter contents  - JSON controller](#filter-contents----json-controller)
    + [Request Example(s)](#request-example-s--3)
    + [Request Parameters](#request-parameters-3)
    + [Response Example(s)](#response-example-s--3)
      - [`200 OK`](#-200-ok--2)
  * [Store content - JSON controller](#store-content---json-controller)
    + [Request Example(s)](#request-example-s--4)
    + [Request Parameters](#request-parameters-4)
    + [Response Example(s)](#response-example-s--4)
      - [`200 OK`](#-200-ok--3)
  * [Update content - JSON controller](#update-content---json-controller)
    + [Request Example(s)](#request-example-s--5)
    + [Request Parameters](#request-parameters-5)
    + [Response Example(s)](#response-example-s--5)
      - [`201 OK`](#-201-ok--1)
      - [`404 Not Found`](#-404-not-found--1)
  * [Delete content - JSON controller](#delete-content---json-controller)
    + [Request Example(s)](#request-example-s--6)
    + [Request Parameters](#request-parameters-6)
    + [Response Example(s)](#response-example-s--6)
      - [`204 No Content`](#-204-no-content-)
      - [`404 Not Found`](#-404-not-found--2)
  * [Soft delete content - JSON controller](#soft-delete-content---json-controller)
    + [Request Example(s)](#request-example-s--7)
    + [Request Parameters](#request-parameters-7)
    + [Response Example(s)](#response-example-s--7)
      - [`204 No Content`](#-204-no-content--1)
      - [`404 Not Found`](#-404-not-found--3)
  * [Configure Route Options - JSON controller](#configure-route-options---json-controller)
  * [Store content field - JSON controller](#store-content-field---json-controller)
    + [Request Example(s)](#request-example-s--8)
    + [Request Parameters](#request-parameters-8)
    + [Response Example(s)](#response-example-s--8)
      - [`200 OK`](#-200-ok--4)
  * [Update content field - JSON controller](#update-content-field---json-controller)
    + [Request Example(s)](#request-example-s--9)
    + [Request Parameters](#request-parameters-9)
    + [Response Example(s)](#response-example-s--9)
      - [`201 OK`](#-201-ok--2)
      - [`404 Not Found`](#-404-not-found--4)
  * [Delete content field - JSON controller](#delete-content-field---json-controller)
    + [Request Example(s)](#request-example-s--10)
    + [Request Parameters](#request-parameters-10)
    + [Response Example(s)](#response-example-s--10)
      - [`204 No Content`](#-204-no-content--2)
      - [`404 Not Found`](#-404-not-found--5)
  * [Get content field - JSON controller](#get-content-field---json-controller)
    + [Request Example(s)](#request-example-s--11)
    + [Request Parameters](#request-parameters-11)
    + [Response Example(s)](#response-example-s--11)
      - [`200 OK`](#-200-ok--5)
  * [Progress-Bubbling](#progress-bubbling)
    + [Example](#example)
  * [Validation](#validation)
    + [Note about field or datum that reference another piece of content](#note-about-field-or-datum-that-reference-another-piece-of-content)
    + [Important Note about the "numeric" rule](#important-note-about-the--numeric--rule)
    + [Specifying rules](#specifying-rules)
    + [Details of options available for each brand](#details-of-options-available-for-each-brand)
      - [fields](#fields)
      - [data](#data)
      - [number_of_children](#number-of-children)
    + [Configuration Example](#configuration-example)
    + [MultipleColumnExistsValidator](#multiplecolumnexistsvalidator)
      - [WHERE *AND*](#where--and-)
      - [WHERE *OR*](#where--or-)
  * [Comment-Likes](#comment-likes)
    + [TL;DR:](#tl-dr-)
    + [Wordy explaination](#wordy-explaination)
      - [Like](#like)
      - [Unlike](#unlike)


<!-- ecotrust-canada.github.io/markdown-toc -->


# API endpoints


Get content - JSON controller
--------------------------------------

`{ GET /content/{id} }`

Get content data based on content id.


### Request Example(s)

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


### Response Example(s)

#### `201 OK`

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

#### `404 Not Found`
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
# API endpoints

Get contents based on ids - JSON controller
--------------------------------------

`{ GET /content/get-by-ids }`

Get an array with contents data based on content ids.


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


### Request Example(s)

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


### Response Example(s)

#### `201 OK`

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
#### `404 Not Found`

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


### Request Example(s)

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


### Response Example(s)

#### `204 No Content`  

#### `404 Not Found`

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


### Request Example(s)

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


### Response Example(s)

#### `204 No Content`  

#### `404 Not Found`

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


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


### Request Example(s)

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


### Response Example(s)

#### `201 OK`

```json

{
	"id":513,
	"key":"topic",
	"value":"punk",
	"position":1,
	"type":"string"
}

```
#### `404 Not Found`

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


### Request Example(s)

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


### Response Example(s)

#### `204 No Content`  

#### `404 Not Found`

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


### Request Example(s)

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


### Response Example(s)

#### `200 OK`

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


