
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
- [API endpoints](README-API.md#api-endpoints)
  * [Get content - JSON controller](README-API.md#get-content---json-controller)
    + [Request Example(s)](README-API.md#request-example-s-)
    + [Request Parameters](README-API.md#request-parameters)
    + [Response Example(s)](README-API.md#response-example-s-)
      - [`201 OK`](README-API.md#-201-ok-)
      - [`404 Not Found`](README-API.md#-404-not-found-)
  * [Get contents based on ids - JSON controller](README-API.md#get-contents-based-on-ids---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--1)
    + [Request Parameters](README-API.md#request-parameters-1)
    + [Response Example(s)](README-API.md#response-example-s--1)
      - [`200 OK`](README-API.md#-200-ok-)
  * [Get contents that are childrens of the content id - JSON controller](README-API.md#get-contents-that-are-childrens-of-the-content-id---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--2)
    + [Request Parameters](README-API.md#request-parameters-2)
    + [Response Example(s)](README-API.md#response-example-s--2)
      - [`200 OK`](README-API.md#-200-ok--1)
  * [Filter contents  - JSON controller](README-API.md#filter-contents----json-controller)
    + [Request Example(s)](README-API.md#request-example-s--3)
    + [Request Parameters](README-API.md#request-parameters-3)
    + [Response Example(s)](README-API.md#response-example-s--3)
      - [`200 OK`](README-API.md#-200-ok--2)
  * [Store content - JSON controller](README-API.md#store-content---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--4)
    + [Request Parameters](README-API.md#request-parameters-4)
    + [Response Example(s)](README-API.md#response-example-s--4)
      - [`200 OK`](README-API.md#-200-ok--3)
  * [Update content - JSON controller](README-API.md#update-content---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--5)
    + [Request Parameters](README-API.md#request-parameters-5)
    + [Response Example(s)](README-API.md#response-example-s--5)
      - [`201 OK`](README-API.md#-201-ok--1)
      - [`404 Not Found`](README-API.md#-404-not-found--1)
  * [Delete content - JSON controller](README-API.md#delete-content---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--6)
    + [Request Parameters](README-API.md#request-parameters-6)
    + [Response Example(s)](README-API.md#response-example-s--6)
      - [`204 No Content`](README-API.md#-204-no-content-)
      - [`404 Not Found`](README-API.md#-404-not-found--2)
  * [Soft delete content - JSON controller](README-API.md#soft-delete-content---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--7)
    + [Request Parameters](README-API.md#request-parameters-7)
    + [Response Example(s)](README-API.md#response-example-s--7)
      - [`204 No Content`](README-API.md#-204-no-content--1)
      - [`404 Not Found`](README-API.md#-404-not-found--3)
  * [Configure Route Options - JSON controller](README-API.md#configure-route-options---json-controller)
  * [Store content field - JSON controller](README-API.md#store-content-field---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--8)
    + [Request Parameters](README-API.md#request-parameters-8)
    + [Response Example(s)](README-API.md#response-example-s--8)
      - [`200 OK`](README-API.md#-200-ok--4)
  * [Update content field - JSON controller](README-API.md#update-content-field---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--9)
    + [Request Parameters](README-API.md#request-parameters-9)
    + [Response Example(s)](README-API.md#response-example-s--9)
      - [`201 OK`](README-API.md#-201-ok--2)
      - [`404 Not Found`](README-API.md#-404-not-found--4)
  * [Delete content field - JSON controller](README-API.md#delete-content-field---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--10)
    + [Request Parameters](README-API.md#request-parameters-10)
    + [Response Example(s)](README-API.md#response-example-s--10)
      - [`204 No Content`](README-API.md#-204-no-content--2)
      - [`404 Not Found`](README-API.md#-404-not-found--5)
  * [Get content field - JSON controller](README-API.md#get-content-field---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--11)
    + [Request Parameters](README-API.md#request-parameters-11)
    + [Response Example(s)](README-API.md#response-example-s--11)
      - [`200 OK`](README-API.md#-200-ok--5)
  * [Store content datum - JSON controller](README-API.md#store-content-datum---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--12)
    + [Request Parameters](README-API.md#request-parameters-12)
    + [Response Example(s)](README-API.md#response-example-s--12)
      - [`200 OK`](README-API.md#-200-ok--6)
  * [Update content datum - JSON controller](README-API.md#update-content-datum---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--13)
    + [Request Parameters](README-API.md#request-parameters-13)
    + [Response Example(s)](README-API.md#response-example-s--13)
      - [`201 OK`](README-API.md#-201-ok--3)
      - [`404 Not Found`](README-API.md#-404-not-found--6)
  * [Delete content datum - JSON controller](README-API.md#delete-content-datum---json-controller)
    + [Request Example(s)](README-API.md#request-example-s--14)
    + [Request Parameters](README-API.md#request-parameters-14)
    + [Response Example(s)](README-API.md#response-example-s--14)
      - [`204 No Content`](README-API.md#-204-no-content--3)
      - [`404 Not Found`](README-API.md#-404-not-found--7)
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

Installation, Configuration, Use
------------------------------------------------------------------------------------------------------------------------

### Installation


1. setup [railenv](https://github.com/railroadmedia/railenvironment)
2. run $ r setup, select railcontent
3. follow instructions at end

Run `$ composer vendor:publish` to copy the package's configuration file "*/config/railcontent.php*" to your application's "*/config*" directory.

*(assuming you're using Composer and Laravel)*





### Configuration

Define the following environmental variables with appropriate values:

* *AWS_S3_REMOTE_STORAGE_ACCESS_KEY*
* *AWS_S3_REMOTE_STORAGE_ACCESS_SECRET*
* *AWS_S3_REMOTE_STORAGE_REGION*
* *AWS_S3_REMOTE_STORAGE_BUCKET*


* *VIMEO_CLIENT_ID*
* *VIMEO_CLIENT_SECRET*
* *VIMEO_ACCESS_TOKEN*


* *YOUTUBE_API_KEY*
* *YOUTUBE_USERNAME*

Add the service provider (`\Railroad\Railcontent\Providers\RailcontentServiceProvider`) to the `'providers` array in you application's */config/app.php*:

```php
'providers' => [
    # ...
    \Railroad\Railcontent\Providers\RailcontentServiceProvider::class,
]
```

Run `$ php artisan vendor:publish` to copy the config file and create a *railcontent.php* file in your application's */config* directory. This will take the values you supplied in the *.env* file and pass them needed.


# Services


ContentService
--------------------

All methods below are *public*.

Inject the `Railroad\Railcontent\Services\ContentService` class where needed

```php
/** @var Railroad\Railcontent\Services\ContentService $contentService */
protected $contentService;

public function __constructor(Railroad\Railcontent\Services\ContentService $contentService){
    $this->contentService = $contentService;
}
```

Include namespace at top of file:

```php
use Railroad\Railcontent\Services;
```

... to save yourself having to specify the namespace everywhere:

```php
/** @var RailcontentService $contentService */
protected $contentService;

public function __constructor(ContentService $contentService){
    $this->contentService = $contentService;
}
```


### getById

#### Usage Example(s)

```php
$content = $this->contentService->getById($id);
```

#### Parameters

| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  id |  yes      |  integer  |  id of content you want to pull | 
 
<!--
#, name, required, type, description
1 , id, yes, integer , id of content you want to pull  
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  ContentEntity    | Railroad\Railcontent\Entities\ContentEntity{<br/>storage: [<br/>&emsp; "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "nihil"<br/>&emsp;"sort" => "0"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"published_on" => "2017-10-26 16:00:03"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]<br/>}|  ContentEntity with the content data            | 


<!--
outcome, return data type, return data value (example), notes about return data
failed, null, null,
succeded, ContentEntity, { Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"nihil"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"]}, ContentEntity with the content data
-->



### getByIds

#### Usage Example(s)

```php
$contents = $this->contentService->getByIds([$id1, $id2]);
```

#### Parameters

| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  ids |  yes      |  array  |  an array of the ids you want to pull | 
 
<!--
#, name, required, type, description
1 , id, yes, integer , id of content you want to pull  
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data       | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if ids not exists | 
| succeded |  array    |  [<br/>&emsp;1 => Railroad\Railcontent\Entities\ContentEntity{<br/>storage: [<br/>&emsp; "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "nihil"<br/>&emsp;"sort" => "0"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"published_on" => "2017-10-26 16:00:03"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]}<br/>&emsp;2 => Railroad\Railcontent\Entities\ContentEntity{<br/>storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "gytre"<br/>&emsp;"sort" => "0"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"published_on" => "2017-10-23 12:00:00":<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...<br/>&emsp;}]<br/>] |  array of ContentEntity        | 




<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if ids not exists
succeded, ContentEntity, [1 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"nihil"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"} 2 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"2"            "slug":"deret"            "status":"draft"            "type":"gytre"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-23 10:50:47"}], array of ContentEntity
-->




### getAllByType

#### Usage Example(s)

```php
$learningPaths = $this->contentService->getAllByType('learning-path');
```

#### Parameters

| #  |  name |  required |  type    |  description                           | 
|----|-------|-----------|----------|----------------------------------------| 
| 1  |  type |  yes      |  string  |  type of the contents you want to pull | 
 
<!--
#, name, required, type, description
1 , type, yes, string , type of the contents you want to pull
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |  notes about return data                        | 
|----------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |  empty array if not exists content with type    | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;    "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;...}<br/> 2 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...}<br/>] |  array of ContentEntity with the specified type | 







<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if not exists content with type
succeded, ContentEntity, [1 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"'learning-path'"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"} 2 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"2"            "slug":"deret"            "status":"draft"            "type":"'learning-path'"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-23 10:50:47"}], array of ContentEntity with the specified type
-->

### getWhereTypeInAndStatusAndField

#### Usage Example(s)

```php
$publishedCoursesWithDifficulty = $this->contentService->getWhereTypeInAndStatusAndField(
	['course'],
    'published',
    'difficulty',
    2,
    'string'
);
```

#### Parameters

| #  |  name                    |  required |  default |  type   |  description                                                     | 
|----|--------------------------|-----------|----------|---------|------------------------------------------------------------------| 
| 1  |  types                   |  yes      |          |  array  |  Type of the contents you want to pull                           | 
| 2  |  status                  |  yes      |          |  string |  Status of the contents                                          | 
| 3  |  fieldKey                |  yes      |          |  string |  The key of the content field                                    | 
| 4  |  fieldValue              |  yes      |          |  string |  The value of the content field                                  | 
| 5  |  fieldType               |  yes      |          |  string |  The field type; possible value: string multiple or content_id   | 
| 6  |  fieldComparisonOperator |  no       |  '='     |         | The comparison operator                                          | 


 
<!--
#, name, required, default, type, description
1 , types, yes, , array, Type of the contents you want to pull
2 , status, yes, , string, Status of the contents
3 , fieldKey, yes, , string, The key of the content field
4 , fieldValue, yes, , string, The value of the content field
5 , fieldType, yes, , string, The field type; possible value: string multiple or content_id  
6 , fieldComparisonOperator, no, '=', ,The comparison operator 
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |  notes about return data                        |                         | 
|----------|-------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------|-------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |  empty array if not exists content              |                         | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "dolorum-corporis-adipisci-sit-soluta-recusandae-corporis"<br/>&emsp;"type" => "course"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-10-06 02:12:49"<br/>&emsp;"created_on" => "2018-07-06 11:14:22"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => [<br/>&emsp;&emsp;        0 => [<br/>&emsp;&emsp;&emsp;"id" => "1"<br/>&emsp;&emsp;&emsp;"content_id" => "1"<br/>&emsp;&emsp;&emsp;"key" => "difficulty"<br/>&emsp;&emsp;&emsp;"value" => "2"<br/>&emsp;&emsp;&emsp;"type" => "string"<br/>&emsp;&emsp;&emsp;"position" => "1"<br/>&emsp;&emsp;]<br/>&emsp;]<br/>&emsp;&emsp;"data" => []<br/>&emsp;&emsp;"permissions" => []<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified type; field value and status | 



<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if not exists content 
succeded, ContentEntity, [1 => Railroad\Railcontent\Entities\ContentEntity{storage:["id" => "1"      "slug" => "dolorum-corporis-adipisci-sit-soluta-recusandae-corporis"      "type" => "course"      "sort" => "0"      "status" => "published"      "language" => "en-US"      "brand" => "brand"      "published_on" => "1926-10-06 02:12:49"      "created_on" => "2018-07-06 11:14:22"      "archived_on" => null      "parent_id" => null      "child_id" => null      "fields" => [        0 => [          "id" => "1"          "content_id" => "1"          "key" => "difficulty"          "value" => "2"          "type" => "string"          "position" => "1"        ]      ]      "data" => []      "permissions" => []    ]]            }], array of ContentEntity with the specified type, field value and status
-->



### getWhereTypeInAndStatusAndPublishedOnOrdered

#### Usage Example(s)

```php
$liveEvents = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
    array_merge(
        [
            'student-focus',
            'song',
        ],
        ContentTypes::$shows
    ),
    ContentService::STATUS_SCHEDULED,
    Carbon::now()->subHours(2)->toDateTimeString(),
    '>'
);
```

#### Parameters

| #  |  name                          |  required |  default        |  type    |  description                           | 
|----|--------------------------------|-----------|-----------------|----------|----------------------------------------| 
| 1  |  types                         |  yes      |                 |  array   |  Type of the contents you want to pull | 
| 2  |  status                        |  yes      |                 |  string  |  Status of the contents                | 
| 3  |  publishedOnValue              |  yes      |                 |  string  |  Content published on date             | 
| 4  |  publishedOnComparisonOperator |  no       |  '='            |  string  |  The comparison operator               | 
| 5  |  orderByColumn                 |  no       |  'published_on' |  string  |  The order by column value             | 
| 6  |  orderByDirection              |  no       |  'desc'         |  string  | The order by direction value           | 



 
<!--
#, name, required, default, type, description
1 , types, yes, , array, Type of the contents you want to pull
2 , status, yes, , string, Status of the contents
3 , publishedOnValue, yes, , string, Content published on date
4 , publishedOnComparisonOperator, no, '=' , string, The comparison operator 
5 , orderByColumn, no, 'published_on', string, The order by column value
6 , orderByDirection, no, 'desc', string ,The order by direction value
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |  [1 => <br/>&emsp;Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage : [<br/>&emsp;&emsp;"id" => "1"<br/>&emsp;&emsp;"slug" => "dolorum-corporis-adipisci-sit-soluta-recusandae-corporis"<br/>&emsp;&emsp;"type" => "song"<br/>&emsp;&emsp;"sort" => "0"<br/>&emsp;&emsp;"status" => "sheduled"<br/>&emsp;&emsp;  "language" => "en-US"<br/>&emsp;&emsp;"brand" => "brand"<br/>&emsp;&emsp;"published_on" => "2018-07-06 15:12:49"<br/>&emsp;&emsp;"created_on" => "2018-07-06 11:14:22"<br/>&emsp;&emsp;"archived_on" => null<br/>&emsp;&emsp;"parent_id" => null<br/>&emsp;&emsp;"child_id" => null<br/>&emsp;&emsp;"fields" => [<br/>&emsp;&emsp;&emsp;0 => [<br/>&emsp;&emsp;&emsp;&emsp;"id" => "1"<br/>&emsp;&emsp;&emsp;&emsp;"content_id" => "1"<br/>&emsp;&emsp;&emsp;&emsp;"key" => "difficulty"<br/>&emsp;&emsp;&emsp;&emsp;"value" => "2"<br/>&emsp;&emsp;&emsp;&emsp;"type" => "string"<br/>&emsp;&emsp;&emsp;&emsp;"position" => "1"<br/>&emsp;&emsp;&emsp;]<br/>&emsp;&emsp;]<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>]<br/>}] |  array of ContentEntity with the specified type; published on date and status | 



<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if not exists content 
succeded, ContentEntity, [1 => Railroad\Railcontent\Entities\ContentEntity{storage:["id" => "1"      "slug" => "dolorum-corporis-adipisci-sit-soluta-recusandae-corporis"      "type" => "song"      "sort" => "0"      "status" => "sheduled"      "language" => "en-US"      "brand" => "brand"      "published_on" => "2018-07-06 15:12:49"      "created_on" => "2018-07-06 11:14:22"      "archived_on" => null      "parent_id" => null      "child_id" => null      "fields" => [        0 => [          "id" => "1"          "content_id" => "1"          "key" => "difficulty"          "value" => "2"          "type" => "string"          "position" => "1"        ]      ]      "data" => []      "permissions" => []    ]]            }], array of ContentEntity with the specified type; published on date and status
-->



### getBySlugAndType

#### Usage Example(s)

```php
$contents = $this->contentService->getBySlugAndType($slug, $type);
```
#### Parameters

| #  |  name |  required |  type   |  description                           | 
|----|-------|-----------|---------|----------------------------------------| 
| 1  |  slug |  yes      |  string |  Slug of the contents you want to pull | 
| 2  |  type |  yes      |  string |  Type of the contents                  | 


<!--
#, name, required, type, description
1 , slug, yes, string, Slug of the contents you want to pull
2 , type, yes, string, Type of the contents
-->


#### Responses


| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "amet-enim-quae-laborum-ut-ut-et"<br/>&emsp;"type" => "course"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "1945-05-14 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified slug and type | 


### getByUserIdTypeSlug

#### Usage Example(s)

```php
$usersPrimaryPlaylists = $this->contentService->getByUserIdTypeSlug(
                $userId,
                'user-playlist',
                'primary-playlist'
            );
```


#### Parameters

| #  |  name   |  required |  type    |  description                                         | 
|----|---------|-----------|----------|------------------------------------------------------| 
| 1  |  userId |  yes      |  integer |  The user id for which we want to pull the content   | 
| 2  |  type   |  yes      |  string  |  The content type we want to pull                    | 
| 3  |  slug   |  yes      |  string  |  Slug of the contents you want to pull               | 


<!--
#, name, required, type, description
1 , userId, yes, integer, The user id for which we want to pull the content  
2 , type, yes, string, The content type we want to pull
3 , slug, yes, string, Slug of the contents you want to pull
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "primary-playlist"<br/>&emsp;"type" => "user-playlist"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified slug and type that are created by the user with specified userId | 

### getByParentId

#### Usage Example(s)

```php
$learningPathLessons = $this->contentService->getByParentId($learningPathId);

```

#### Parameters

| #  |  name             |  required |  default          |  type   |  description                                    | 
|----|-------------------|-----------|-------------------|---------|-------------------------------------------------| 
| 1  |  parentId         |  yes      |                   | integer |  The content parent id                          | 
| 2  |  orderBy          |  no       |  'child_position' | string  |  The column after which the results are ordered | 
| 3  |  orderByDirection |  no       |  'asc'            |  string |  The sort order. Values: asc or desc            | 



<!--
#, name, required, default, type, description
1 , parentId, yes,  ,integer, The content parent id   
2 , orderBy, no, 'child_position',string, The column after which the results are ordered
3 , orderByDirection, no, 'asc', string, The sort order. Values: asc or desc
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "iusto<br/>&emsp;"type" => "lesson"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified parent | 

### getByParentIdWhereTypeIn

#### Usage Example(s)

```php
$addedPlans = $this->contentService->getByParentIdWhereTypeIn(
                $usersPrimaryPlaylistId,
                ['learning-path']
            );

```

#### Parameters


| #  |  name             |  required |  default          |  type   |  description                                        | 
|----|-------------------|-----------|-------------------|---------|-----------------------------------------------------| 
| 1  |  parentId         |  yes      |                   | integer |  The content parent id                              | 
| 2  |  types            |  yes      |                   |  array  |  Array with the content types that should be pulled | 
| 3  |  orderBy          |  no       |  'child_position' | string  |  The column after which the results are ordered     | 
| 4  |  orderByDirection |  no       |  'asc'            |  string |  The sort order. Values: asc or desc                | 



<!--
#, name, required, default, type, description
1 , parentId, yes,  ,integer, The content parent id   
2 , types, yes,  , array, Array with the content types that should be pulled
3 , orderBy, no, 'child_position',string, The column after which the results are ordered
4 , orderByDirection, no, 'asc', string, The sort order. Values: asc or desc
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "shdsedshdsd<br/>&emsp;"type" => "learning-path"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified parent and type | 

### getByParentIds

#### Usage Example(s)

```php
$courseLessons = $this->contentService->getByParentIds([$courseId1, $courseId2]);

```
#### Parameters


| #  |  name             |  required |  default          |  type   |  description                                    | 
|----|-------------------|-----------|-------------------|---------|-------------------------------------------------| 
| 1  |  parentIds        |  yes      |                   | array   |  The content parent ids                         | 
| 2  |  orderBy          |  no       |  'child_position' | string  |  The column after which the results are ordered | 
| 3  |  orderByDirection |  no       |  'asc'            |  string |  The sort order. Values: asc or desc            | 



<!--
#, name, required, default, type, description
1 , parentIds, yes,  ,array, The content parent ids   
2 , orderBy, no, 'child_position',string, The column after which the results are ordered
3 , orderByDirection, no, 'asc', string, The sort order. Values: asc or desc
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "shdsedshdsd<br/>&emsp;"type" => "learning-path"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity with the specified parent| 


### getByChildIdWhereType

#### Usage Example(s)


```php

$packs = $this->contentService->getByChildIdWhereType($packBundleId, 'pack');

```

#### Parameters

| #  |  name    |  required |  type    |  description                                          | 
|----|----------|-----------|----------|-------------------------------------------------------| 
| 1  |  childId |  yes      |  integer |  The returned content should be parent of child id    | 
| 2  |  type    |  yes      |  string  |  The content type that should be pulled               | 


<!--
#, name, required, type, description
1 , childId, yes, integer, The returned content should be parent of child id   
2 , type, yes, string, The content type that should be pulled
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "shdsedshdsd<br/>&emsp;"type" => "pack"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity - parent for the child id with the specified type| 

### getByChildIdsWhereType

#### Usage Example(s)

```php

$courses = $this->contentService->getByChildIdsWhereType([$coursePartId1, $coursePartId2], 'course');

```

#### Parameters

| #  |  name     |  required |  type   |  description                                                    | 
|----|-----------|-----------|---------|-----------------------------------------------------------------| 
| 1  |  childIds |  yes      |  array  |  An array with the content ids whose parents should be pulled   | 
| 2  |  type     |  yes      |  string |  The content type that should be pulled                         | 

<!--
#, name, required, type, description
1 , childIds, yes, array, An array with the content ids whose parents should be pulled  
2 , type, yes, string, The content type that should be pulled
-->


#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "shdsedshdsd<br/>&emsp;"type" => "course"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity - parent for the child id with the specified type| 


### getByChildIdWhereParentTypeIn

#### Usage Example(s)

```php

$packBundles = $this->contentService->getByChildIdWhereParentTypeIn($contentId, ['pack-bundle']);

```

#### Parameters

| #  |  name    |  required |  type  |  description                                     | 
|----|----------|-----------|--------|--------------------------------------------------| 
| 1  |  childId |  yes      |  array |  The content id whose parents should be pulled   | 
| 2  |  types   |  yes      |  array |  The content types that should be pulled         | 

<!--
#, name, required, type, description
1 , childId, yes, array, The content id whose parents should be pulled  
2 , types, yes, array, The content types that should be pulled
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |  notes about return data                                                      | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |  empty array if not exists content                                            | 
| succeded |  array    |[1 =><br/>Railroad\Railcontent\Entities\ContentEntity{<br/>storage : [<br/>&emsp;"id" => "1"<br/>&emsp;"slug" => "shdsedshdsd<br/>&emsp;"type" => "pack-bundle"<br/>&emsp;"sort" => "0"<br/>&emsp;"status" => "published"<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "brand"<br/>&emsp;"published_on" => "2018-07-06 19:19:38"<br/>&emsp;"created_on" => "2018-07-06 14:24:52"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => 2<br/>&emsp;"child_id" => 1<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;"position" => 1<br/>&emsp;]<br/>}] |  array of ContentEntity - parent for the child id with the specified type| 

### getPaginatedByTypeUserProgressState

#### Usage Example(s)

```php

$lessons = $this->contentService->getPaginatedByTypeUserProgressState('song', $userId, 'started', 15, 0);

```

#### Parameters

| #  |  name   |  required |  default |  type    |  description                                                         | 
|----|---------|-----------|----------|----------|----------------------------------------------------------------------| 
| 1  |  type   |  yes      |          |  string  |  The content type that should be pulled                              | 
| 2  |  userId |  yes      |          |  integer |  The content should have the specified state for the specified user  | 
| 3  |  state  |  yes      |          |  string  |  The content should have the specified state                         | 
| 4  |  limit  |  no       |  25      |  integer |  The max amount of contents that can be returned.                    | 
| 5  |  skip   |  no       |  0       |  integer |  The amount of contents that will be skiped                          | 


<!--
#, name, required, default, type, description
1 , type, yes, , string, The content type that should be pulled  
2 , userId, yes,  , integer, The content should have the specified state for the specified user 
3 , state, yes, , string, The content should have the specified state
4 , limit, no, 25, integer, The max amount of contents that can be returned.
5 , skip, no , 0, integer, The amount of contents that will be skiped
-->


#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |  notes about return data                        | 
|----------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |  empty array if not exists content with type    | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;    "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "published"<br/>&emsp;"type" => "song"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;...}<br/> 2 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "published"<br/>&emsp;"type" => "song"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...}<br/>] |  array of ContentEntity with the specified state for user  | 


### getPaginatedByTypesUserProgressState

#### Usage Example(s)


```php

$lessons = $this->contentService->getPaginatedByTypeUserProgressState(['song', 'course-part'], $userId, 'started', 15, 0);

```

#### Parameters

| #  |  name   |  required |  default |  type    |  description                                                         | 
|----|---------|-----------|----------|----------|----------------------------------------------------------------------| 
| 1  |  types  |  yes      |          |  array   |  The content types that should be pulled                             | 
| 2  |  userId |  yes      |          |  integer |  The content should have the specified state for the specified user  | 
| 3  |  state  |  yes      |          |  string  |  The content should have the specified state                         | 
| 4  |  limit  |  no       |  25      |  integer |  The max amount of contents that can be returned.                    | 
| 5  |  skip   |  no       |  0       |  integer |  The amount of contents that will be skiped                          | 



<!--
#, name, required, default, type, description
1 , types, yes, , array, The content types that should be pulled  
2 , userId, yes,  , integer, The content should have the specified state for the specified user 
3 , state, yes, , string, The content should have the specified state
4 , limit, no, 25, integer, The max amount of contents that can be returned.
5 , skip, no , 0, integer, The amount of contents that will be skiped
-->


#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |  notes about return data                        | 
|----------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |  empty array if not exists content with type    | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;    "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "published"<br/>&emsp;"type" => "song"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;...}<br/> 2 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "published"<br/>&emsp;"type" => "course-part"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...}<br/>] |  array of ContentEntity with the specified state and type for user  | 




### getTypeNeighbouringSiblings

#### Usage Example(s)


```php

 $siblings = $this->contentService->getTypeNeighbouringSiblings(
            $lesson['type'],
            'published_on',
            $lesson['published_on'],
            1,
            'published_on',
            'asc'
        );

```

#### Parameters

| #  |  name             |  required |  default        |  type    |  description                                    | 
|----|-------------------|-----------|-----------------|----------|-------------------------------------------------| 
| 1  |  type             |  yes      |                 |  string  |  The content type that should be pulled         | 
| 2  |  columnName       |  yes      |                 |  integer |                                                 | 
| 3  |  columnValue      |  yes      |                 |  string  |                                                 | 
| 4  |  siblingPairLimit |  no       |  1              |  integer |  The sibling pair limit that should be returned | 
| 4  |  orderColumn      |  no       |  'published_on' |  string  |  The results should be ordered by               | 
| 5  |  orderDirection   |  no       |  'desc'         |  string  |  Order direction for the results                | 



<!--
#, name, required, default, type, description
1 , type, yes, , string, The content type that should be pulled  
2 , columnName, yes,  , integer, 
3 , columnValue, yes, , string, 
4 , siblingPairLimit, no, 1 , integer, The sibling pair limit that should be returned
4 , orderColumn, no, 'published_on', string, The results should be ordered by 
5 , orderDirection, no , 'desc' , string, Order direction for the results
-->

#### Responses

### getByContentFieldValuesForTypes

#### Usage Example(s)
```php

 $idsOfContentMissingDuration = $this->contentService->getByContentFieldValuesForTypes(
            ['vimeo-video'], 'length_in_seconds',  [0]
        );

```
#### Parameters

| #  |  name               |  required |  type   |  description                                                | 
|----|---------------------|-----------|---------|-------------------------------------------------------------| 
| 1  |  contentTypes       |  yes      |  array  |  The content types that can be pulled                       | 
| 2  |  contentFieldKey    |  yes      |  string |  The content field key that should have the specified value | 
| 3  |  contentFieldValues |  yes      |  array  |  Array with the allowed field value                         | 


<!--
#, name, required, type, description
1 , contentTypes, yes, array, The content types that can be pulled  
2 , contentFieldKey, yes, string, The content field key that should have the specified value
3 , contentFieldValues, yes, array, Array with the allowed field value 
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                   |  notes about return data            | 
|----------|-------------------|--------------------------------------------------------------------------------|-------------------------------------| 
| failed   |  array            |  []                                                                            |  empty array if not exists content  | 
| succeded |  array            |  [0 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;"id" => 1<br/>}] |                                     | 
<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if not exists content 
succeded, array, [0 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;"id" => 1<br/>}]
-->

### countByTypesUserProgressState

#### Usage Example(s)
```php

  $completedLessonCount = $this->contentService->countByTypesUserProgressState(
            ['course-part', 'song-part', 'play-along-part'],
            $userId,
            'completed'
        );

```
#### Parameters

| #  |  name   |  required |  type    |  description                                                      | 
|----|---------|-----------|----------|-------------------------------------------------------------------| 
| 1  |  types  |  yes      |  array   |  The content types that can be counted                            | 
| 2  |  userId |  yes      |  integer |  The content should have the required state for specified user id | 
| 3  |  state  |  yes      |  string  |  The content should have the specified state                      | 

<!--
#, name, required, type, description
1 , types, yes, array, The content types that can be counted  
2 , userId, yes, integer, The content should have the required state for specified user id
3 , state, yes, string, The content should have the specified state 
-->

#### Responses

| outcome   |  return data type |  return data value (example) |  notes about return data  | 
|-----------|-------------------|------------------------------|---------------------------| 
| not exist |  integer          |  0                           |  0 if not exists content  | 
| succeded  |  integer          |                              |  number of results        | 


<!--
outcome, return data type, return data value (example), notes about return data
not exist, integer, 0, 0 if not exists content 
succeded, integer, , number of results
-->


### getFiltered
#### Usage Example(s)
```php 
  $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', 'published_on'),
            $request->get('included_types', []),
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $parsedFilters['required_fields'] ?? [],
            $parsedFilters['included_fields'] ?? [],
            $parsedFilters['required_user_states'] ?? [],
            $parsedFilters['included_user_states'] ?? []
        );
```
#### Parameters
| #   |  name                |  required |  default         |  type    |  description                                                                                                                                                                                                                                                                    | 
|-----|----------------------|-----------|------------------|----------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| 1   |  page                |  yes      |                  |  integer |  Which page in the result set to return. The amount of contents skipped is ((limit - 1) * page).                                                                                                                                                                                | 
| 2   |  limit               |  no       |                  |  integer |  The max amount of contents that can be returned. Can be 'null' for no limit.                                                                                                                                                                                                   | 
| 3   |  orderByAndDirection |  no       |  '-published_on' |  string  |  Defaults to ascending order; to switch to descending order put a minus sign (-) in front of the value. Can be any of the following: slug status type brand language position parent_id published_on created_on archived_on                                                     | 
| 4   |  includedTypes       |  no       |   []             |  array   |  Contents with these types will be returned.                                                                                                                                                                                                                                    | 
| 5   |  slugHierarchy       |  no       |  []              |  array   |                                                                                                                                                                                                                                                                                 | 
| 6   |  requiredParentIds   |  no       |  []              |  array   |  All contents must be a child of any of the passed in parent ids.                                                                                                                                                                                                               | 
| 7   |  requiredFields      |  no       |  []              |  array   |  All returned contents are required to have this field. Value format is: key value type (type is optional; if its not declared all types will be included)                                                                                                                      | 
| 8   |  includedFields      |  no       |  []              |  array   |  Contents that have any of these fields will be returned. The first included field is the same as a required field; but all included fields after the first act inclusively. Value format is: key value type (type is optional; if its not declared all types will be included) | 
| 9   |  requiredUserStates  |  no       |  []              |  array   |  All returned contents are required to have these states for the authenticated user. Value format is: state                                                                                                                                                                     | 
| 10  |  includedUserStates  |  no       |  []              |  array   |  Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state; but all included states after the first act inclusively. Value format is: state                                        | 


#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |  notes about return data                        | 
|----------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |  empty array if not exists content for specified criteria    | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;    "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;...}<br/> 2 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...}<br/>] |  array of ContentEntity| 







<!--
outcome, return data type, return data value (example), notes about return data
failed, array, [], empty array if not exists content with type
succeded, ContentEntity, [1 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"'learning-path'"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"} 2 => Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"2"            "slug":"deret"            "status":"draft"            "type":"'learning-path'"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-23 10:50:47"}], array of ContentEntity with the specified type
-->


### create
#### Usage Example(s)
```php
$content = $this->contentService->create(
            $request->get('slug'),
            $request->get('type'),
            $request->get('status'),
            $request->get('language'),
            $request->get('brand'),
            $request->get('user_id'),
            $request->get('published_on'),
            $request->get('parent_id'),
            $request->get('sort', 0)
        );
        
```
#### Parameters

| #  |  name         |  required |  default  |  type      |  description                                                        | 
|----|---------------|-----------|-----------|------------|---------------------------------------------------------------------| 
| 1  |  slug         |  yes      |  array    |            |  The content slug                                                   | 
| 2  |  type         |  yes      |           |  string    |  Type of content. Examples: 'recording' 'course' 'course-lesson'    | 
| 3  |  status       |  no       |  'draft'  |  string    |  Can be 'draft' 'published' 'archived'.                             | 
| 4  |  language     |  no       |  'en-US'  |  string    |  Language locale.                                                   | 
| 5  |  brand        |  no       |           |  string    |  'drumeo' 'pianote' etc                                             | 
| 6  |  user_id      |  no       |  null     |  integer   |                                                                     | 
| 7  |  published_on |  no       |  now      |  datetime  |                                                                     | 
| 8  |  parentId     |  no       |  null     |  integer   |  Id of the parent content you want to make this content a child of. | 
| 9  |  sort         |  no       |  0        |  integer   |                                                                     | 

<!--
#, name, required, default, type, description
1 , slug, yes, array, , The content slug 
2 , type, yes, , string, Type of content. Examples: 'recording' 'course' 'course-lesson'
3 , status, no, 'draft', string, Can be 'draft' 'published' 'archived'.
4 , language, no, 'en-US' , string, Language locale.
5 , brand, no, , string, 'drumeo' 'pianote' etc
6 , user_id, no, null, integer
7 , published_on, no, now, datetime 
8 , parentId, no, null, integer, Id of the parent content you want to make this content a child of.
9 , sort, no, 0, integer,
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  ContentEntity    | Railroad\Railcontent\Entities\ContentEntity{<br/>storage: [<br/>&emsp; "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "nihil"<br/>&emsp;"sort" => "0"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"published_on" => "2017-10-26 16:00:03"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]<br/>}|  ContentEntity with the content data            | 


<!--
outcome, return data type, return data value (example), notes about return data
failed, null, null,
succeded, ContentEntity, { Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"nihil"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"]}, ContentEntity with the content data
-->


### update
#### Usage Example(s)
```php
 $this->contentService->update(
                    $contentId,
                    [
                        'type' => $contentTypeSlug,
                        'status' => ContentService::STATUS_PUBLISHED,
                        'published_on' => Carbon::now()->toDateTimeString()
                    ]
                );
```


#### Parameters

| #  |  name |  required |  type    |  description                                                                                                                     | 
|----|-------|-----------|----------|----------------------------------------------------------------------------------------------------------------------------------| 
| 1  |  id   |  yes      |  integer |  Id of the content you want to edit.                                                                                             | 
| 2  |  data |  yes      |  array   |  An array with the content data that should be updated. The key should be the content column name and the value the desired data | 

<!--
#, name, required, type, description
1 , id, yes, integer, Id of the content you want to edit.
2 , data, yes, array, An array with the content data that should be updated. The key should be the content column name and the value the desired data  
-->

#### Responses
| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  ContentEntity    | Railroad\Railcontent\Entities\ContentEntity{<br/>storage: [<br/>&emsp; "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "published"<br/>&emsp;"type" => "nihil"<br/>&emsp;"sort" => "0"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"published_on" => "2017-10-26 16:00:03"<br/>&emsp;"created_on" => "2018-07-09 16:00:03"<br/>&emsp;"archived_on" => null<br/>&emsp;"parent_id" => null<br/>&emsp;"child_id" => null<br/>&emsp;"fields" => []<br/>&emsp;"data" => []<br/>&emsp;"permissions" => []<br/>&emsp;]<br/>}|  ContentEntity with the content data            | 


<!--
outcome, return data type, return data value (example), notes about return data
failed, null, null,
succeded, ContentEntity, { Railroad\Railcontent\Entities\ContentEntity{storage: array:15 [            "id":"1"            "slug":"quis"            "status":"draft"            "type":"nihil"            "parent_id":null            "language":"en-US"            "brand":"drumeo"            "created_on":"2017-10-26 16:00:03"]}, ContentEntity with the content data
-->


### delete
#### Usage Example(s)

```php
$this->contentService->delete($contentId);
```

#### Parameters

| #  |  name |  required |  type    |  description                           | 
|----|-------|-----------|----------|----------------------------------------| 
| 1  |  id   |  yes      |  integer |  Id of the content you want to delete. | 


<!--
#, name, required, type, description
1 , id, yes, integer, Id of the content you want to delete.
-->

#### Responses

| outcome  |  return data type |  return data value (example) |  notes about return data | 
|----------|-------------------|------------------------------|--------------------------| 
| failed   |  null             |  null                        |                          | 
| succeded |  boolean          |  1                           |                          | 

<!--
outcome, return data type, return data value (example), notes about return data
failed, null, null,
succeded, boolean, 1
-->

### softDelete
#### Usage Example(s)

```php
$this->contentService->softDelete($contentId);
```

#### Parameters

| #  |  name |  required |  type    |  description                                    | 
|----|-------|-----------|----------|-------------------------------------------------| 
| 1  |  id   |  yes      |  integer |  Id of the content you want to mark as deleted. | 

<!--
#, name, required, type, description
1 , id, yes, integer, Id of the content you want to mark as deleted.
-->

#### Responses

| outcome  |  return data type |  return data value (example) |  notes about return data | 
|----------|-------------------|------------------------------|--------------------------| 
| failed   |  null             |  null                        |                          | 
| succeded |  boolean          |  1                           |                          | 

<!--
outcome, return data type, return data value (example), notes about return data
failed, null, null,
succeded, boolean, 1
-->


### attachPlaylistsToContents
#### Usage Example(s)

```php
$this->contentService->attachPlaylistsToContents($userId, $lessons);
```
#### Parameters

| #  |  name               |  required |  default |  type           |  description                                              | 
|----|---------------------|-----------|----------|-----------------|-----------------------------------------------------------| 
| 1  |  userId             |  yes      |          |  integer        |  Id of the user you want to attach contents to playlists. | 
| 2  |  contentOrContents  |  yes      |          |  integer\|array |  Id of the content you want to attach playlists.          | 
| 3  |  singlePlaylistSlug |  no       |  null    |  string         |  The content playlist slug                                | 
<!--
#, name, required, default, type, description
1 , userId, yes, , integer, Id of the user you want to attach contents to playlists.
2 , contentOrContents, yes, , integer\|array, Id of the content you want to attach playlists.
3 , singlePlaylistSlug, no, null, string, The content playlist slug
-->

#### Responses


| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |  notes about return data                        | 
|----------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------| 
| failed   |  array            |  []                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |   | 
| succeded |  array    |  [1 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;    "id" => "1"<br/>&emsp;"slug" => "quis"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-26 16:00:03"<br/>&emsp;...}<br/> 2 => Railroad\Railcontent\Entities\ContentEntity{<br/>&emsp;storage: [<br/>&emsp;"id" => "2"<br/>&emsp;"slug" => "deret"<br/>&emsp;"status" => "draft"<br/>&emsp;"type" => "learning-path"<br/>&emsp;"parent_id" => null<br/>&emsp;"language" => "en-US"<br/>&emsp;"brand" => "drumeo"<br/>&emsp;"created_on" => "2017-10-23 10:50:47"<br/>&emsp;...}<br/>] |  array of ContentEntity| 


ContentFieldService
--------------------

All methods below are *public*.

Inject the `Railroad\Railcontent\Services\ContentFieldService` class where needed

```php
/** @var Railroad\Railcontent\Services\ContentFieldService $contentFieldService */
protected $contentFieldService;

public function __constructor(Railroad\Railcontent\Services\ContentFieldService $contentFieldService){
    $this->contentFieldService = $contentFieldService;
}
```

Include namespace at top of file:

```php
use Railroad\Railcontent\Services\ContentFieldService;
```

... to save yourself having to specify the namespace everywhere:

```php
/** @var ContentFieldService $contentFieldService */
protected $contentFieldService;

public function __constructor(ContentFieldService $contentFieldService){
    $this->contentFieldService = $contentFieldService;
}
```


### get

#### Usage Example(s)

```php
$contentField = $this->contentFieldService->get($id);
```

#### Parameters

| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  id |  yes      |  integer  |  id of content field you want to pull | 
 
<!--
#, name, required, type, description
1 , id, yes, integer , id of content field you want to pull  
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "fuga"<br/>&emsp;"value" => "suscipit"<br/>&emsp;"type" => "string"<br/>&emsp;"position" => "1"<br/>]|  Field details          | 

### getByKeyValueTypePosition

[TODO]

### getByKeyValueType

[TODO]

### create

[TODO]

### update

[TODO]

### delete

[TODO]


ContentDatumService
--------------------

All methods below are *public*.

Inject the `Railroad\Railcontent\Services\ContentDatumService` class where needed

```php
/** @var Railroad\Railcontent\Services\ContentDatumService $contentDatumService */
protected $contentDatumService;

public function __constructor(Railroad\Railcontent\Services\ContentDatumService $contentDatumService){
    $this->contentDatumService = $contentDatumService;
}
```

Include namespace at top of file:

```php
use Railroad\Railcontent\Services\ContentDatumService;
```

... to save yourself having to specify the namespace everywhere:

```php
/** @var ContentDatumService $contentDatumService */
protected $contentDatumService;

public function __constructor(ContentDatumService $contentDatumService){
    $this->contentDatumService = $contentDatumService;
}
```


### get

#### Usage Example(s)

```php
$contentDatum = $this->contentDatumService->get($id);
```

### getByContentIds

[TODO]


### create

[TODO]

### update

[TODO]

### delete

[TODO]



Progress-Bubbling
------------------------------------------------------------------------------------------------------------------------

When a content has its progress saved, a `UserContentProgressSaved` event is fired. This event triggers the `bubbleProgress` method of `UserContentProgressService`. If the content saved—that triggered the event—has a parent, the type of that parent will be evaluated against config values defined in you're application's copy of */config/railcontent.php*.

This is useful when you have a kind of content (like "course" for Drumeo) that should be marked as started when a child is started. However, if you have a kind of content that you don't want marked as started (say perhaps because it has it's own system, like Learning-Paths for Drumeo), you don't want the parent started when the child is. Keep in mind that children can have multiple parents, thus if a lesson is started we may want that to cause one parent to be started, but another to *remain unstarted*.

You can restrict which content **parent** types should be marked as started or completed when their children are started by ***omitting*** them from the allowed_types lists.

```php
'allowed_types_for_bubble_progress' => [
    'started' =>    [
        'foo','bar', 'baz' 
    ],
    'completed' =>  [ 
        'foo','bar', 'qux'
    ]
];
```

You can have a value in both list if it has no restrictions, or just one, or neither.

Note that this only applies for progress ***bubbling***. This does not effect the `startContent`, `completeContent`, or `saveContentProgress` methods of `UserContentProgressService`.


### Example

Say you have a parent of a type for which *bubbling of **started** progress event is **not** allowed*.

If that parent is itself **not yet started**, it will not have progress record written or updated when one of it's children is. If it's in the "completed" allowed-types list, it can be marked as completed if all it's children are, but unless exactly that happens, it will not have it's progress_percent saved. That is *unless* it is already started of it's own accord. If the parent is already started, then when a child is updated, the progress_percent value of the parent will be edited as per any other content of a type allowed as per the allowed-for-started config settings.



Validation
------------------------------------------------------------------------------------------------------------------------

This is *"business rules"* validation. This does not validate that the content is suitable for the the database. Rather
 it is used if your application requires content to require information to be set to a state - like "public" or
 "published", for example.

In your application's config/ directory, you should have a railcontent.php file. In there under 'validation', you can
list the brands for which you want validation. If a brand is not present, validation will not run.

Under each brand is an array called "*restrictions*" which defines which content *states* the validation is to
protect. If a request to change a content's state requests to set the state to one of these protected states, then
the validation will run. If the content is invalid, the protected state will not be set. Similarly, if a content has a
state that is in this list of protected states, any change to the content (including fields or data) will trigger
validation. If the validation fails, it is because the requested change would break the business rules for that content
type, thus the change will not be made.

Also under each brand - as a sibling to the "*restrictions*" array - are the rules for each "*content-type*". The key
for each content-type **must** be the same as the content-type used in the application. Each content-type's rules has
five components:

1. fields
2. data
3. number_of_children (optional)

If a content-type exists in these rules, then validation will run on as described above. If the content-type is not
represented in the rules, the validation rules will not protect that content type according to the rules.

*(There is not currently a way to provide custom "restrictions" for a select content-type. See the "todo.md" file for
notes about how to change this package to make that possible.)*


### Note about field or datum that reference another piece of content

When a content has a field or datum that is itself a reference to another piece of content, the id of that referenced
content is what is evaluated.

Thus, your rule must accommodate|use this.

For example: A video has a field with the id of a video... and that video is a piece of content itself. The rule might
look like this:

```php
'video' => [
    'rules' => [
        Rule::exists($connectionMaskPrefix . 'content', 'id')->where(
            function ($query) { $query->where('type', 'vimeo-video'); }
        ),
        'required'
    ]
],
``` 

This is done using the following logic within the "validateContent" method of the 
"\Railroad\Railcontent\Requests\\**CustomFormRequest**" class:

```php
if (($contentProperty['type'] ?? null) === 'content' && isset($inputToValidate['id'])) {
    $inputToValidate = $inputToValidate['id'];
}
```

You can see that if the `($contentProperty['type']` is "content" and the


### Important Note about the "numeric" rule

```
If you don't include the "numeric" rule here, this doesn't work. I don't know why and it
doesn't make sense. Laravel' validator should - for the min, max, and size rules according to the
documentation - evaluate the evaluated value in regards to these rules based on the data-type
of the value under evaluation. If it's a string, it will evaluate the length. Thus, if min:5,
the string must have at least 5 characters. If the value is an integer min:5 will pass only if
the value of the integer is 5 or higher. If an array it evaluates the count. You get the idea.
But here it's failing to do that. Even if casting the value to an int just to be sure, and then
debugging to make sure it's not changed into a string somehow (because that would break it of
course because the string "6" would only pass for "min:1" and would fail for "min:2" and upwards
but the integer 6 would pass for "min:2" to "min:6". Maybe something about the "numeric" rule
is casting it to an int somewhere I didn't see. Anyways this is smelly af because that "numeric"
condition is just there as a hack to circumvent failure of the system to act as expected. But
it works, so fuck.
```

(^ Crudely written note copied here from comment in code)



### Specifying rules

You can "...specify the validation rules as an array instead of using the | character to delimit them" ([from
"Specifying A Custom Column Name" section here](https://laravel.com/docs/5.6/validation#rule-exists)).

For example; both `bar` and `bax` here would have the same effect:

```php
foo => [
    'bar' => ['max:2|required'],
    'bax' => [
        'max:2',
        'required'
    ]
]
```


### Details of options available for each brand

#### fields

(required)

Array of rules keyed by the field they apply to. Each keyed value in this "fields" array represents one field. The
value for each can be either a string or array representing the rules available in the Laravel version used. For
details about Laravel rules, [see their documentation](
https://laravel.com/docs/master/validation#available-validation-rules).


#### data

(required)

Same as fields, except data.


#### number_of_children

(optional)

See "**Important Note about the "numeric" rule**" note above.

Provide this in cases where a content type requires a set number of children before it can be set to a 
"restricted" state (perhaps "published" or "scheduled").

Can be defined either of the two ways:

```php
'number_of_children' => 'min:3', 
'number_of_children' => ['rules' => 'min:3'],
```

Unlike the rest of the rules, this doesn't *need* to be an item called "rules" in an array. It can be, or not. Either
 way will work.


### Configuration Example

```php
'validation' => [
    'brand' => [
        'content-type' => [
            'content-status|content-status|...' => [
                'number_of_children' => 'min:3',
                'fields' => [
                    'key' => [
                        rules => ['validation-rule', 'validation-rule', ...],
                        'can_have_multiple' => true/false],
                    ],
                    'key' => [
                        rules => 'validation-rule|validation-rule|...',
                        'can_have_multiple' => true/false],
                    ],
                ],
                'data' => [
                    'key' => [
                        rules => ['validation-rule', 'validation-rule', ...],
                        'can_have_multiple' => true/false],
                    ],
                    'key' => [
                        rules => 'validation-rule|validation-rule|...',
                        'can_have_multiple' => true/false],
                    ],
                ]
            ]
        ],
    ]
]
```


### MultipleColumnExistsValidator

***NOTE**: This actually doesn't work properly right now, so if the above may not quuuuite be accurate.*

You may not be able to use the `Rule::Exists()` feature of the Laravel's validator where you specify your validation 
rules. Perhaps you specify your rules in configuration files that are cache calling a method statically like that breaks
them for some reason. 

To overcome this, there exists a custom rule in this package called (Railroad\Railcontent\Validators) 
"MultipleColumnExistsValidator". Also, there is a test for it: (Tests\Feature) "MultipleColumnExistsRuleTest".

Look at the class to understand fully how it works, if need be. If you only need a quick look, this is what it does:

```php
$exists = $this->databaseManager->connection($connection)
    ->table($table)
    ->where($row, $value)
    ->exists();
```

You pass these arguments via your rules:

```php
$connection = $parameterParts[0];
$table = $parameterParts[1];
$row = $parameterParts[2];
$value = isset($parameterParts[3]) ? $parameterParts[3] : $value;
```

A configured rule looks like this:


```
'video' => 'exists_multiple_columns:mysql,railcontent_content,id&mysql,railcontent_content,type,vimeo-video'
```

unpacked we get this:

```
exists_multiple_columns:
    mysql,railcontent_content,id
    &
    mysql,railcontent_content,type,vimeo-video
```

Breaking down each line:

`exists_multiple_columns` is the name of the custom rule

`mysql,railcontent_content,id` is a set or rules for a single "where exists" clause to the database validation that will 
run.

`&` (ampersand) is our delimiter - since the pipe, or vertical bar (`|`) is already used by laravel to delimit
rules.

`mysql,railcontent_content,type,vimeo-video` is another *"where exists" clause added to the database validation that
will run when all clauses are compiled.

For the validation to pass in this case, both *"where exists" validations* must pass.

Within each *"where exists" validation*, values are delimited by commas (`,`).

So, the first set has THREE (3) values

```
mysql
railcontent_content
id
```

And the second set has FOUR (4) values:

```
mysql
railcontent_content
type
vimeo-video
```

The first THREE (3) parameters are required, the FOURTH (4th)) is optional.

As you may have guessed by the code snippet above, the parameters are as such:

1. connection (required)
2. table (required) 
3. $row (required)
4. $value (optional)

If the FOURTH (4th) parameter is not passed, the value used for the "where exists" evaluation will be the value which
the whole rule is validating.

Reviewing the example, we see that we're validating the value submitted to the `video` input against the rule 
`'exists_multiple_columns:mysql,railcontent_content,id&mysql,railcontent_content,type,vimeo-video'` to ensure that
the value matches the two clauses `mysql,railcontent_content,id` and `mysql,railcontent_content,type,vimeo-video`.
The first ensures that by the connection "mysql", in the table "railcontent_content", the value under validation matches
a value in the "id" column. The second does the same, but the value isn't the values passed in, but rather the value
hard-coded in rule as the FOURTH parameter - "vimeo-video". Thus, it ensures that there exists a record where the value
passes in matches something in the "id" column **and** at least one records matching that also has value or "vimeo-video"
in it's "type" column.


#### WHERE *AND*

The above example describes a "WHERE ... AND ... " query. This is standard behaviour - everything must be present in at
least one row for the validation to pass.


#### WHERE *OR*

This describes a "WHERE ... **OR** ... " query.

You can prepend your "clause rule string" (remember these are demarcated from each other with ampersands(&)) with `or:`, 
so that for the examples above, the second one instead of looking like this:

```
mysql,railcontent_content,type,vimeo-video
```

would look like this

```
or:mysql,railcontent_content,type,vimeo-video
```

This works with the preceding rule and when there exists an `or:` "between" them, they're connected is an or statement.

Note that because you can have more than two "clause rule strings" in a rule, you can combine ORs and ANDs thusly:

```
exists_multiple_columns:
    mysql,railcontent_content,id
    &
    or:mysql,railcontent_content,foo_id
    &
    mysql,railcontent_content,type,vimeo-video
    &
    or:mysql,railcontent_content,slug,'bar baz'
```

Means that one of the first two "clause rule strings" must match with one of the two last "clause rule strings".

```
(
    mysql,railcontent_content,id
    OR
    mysql,railcontent_content,foo_id
)
AND
(
    mysql,railcontent_content,type,vimeo-video
    OR
    mysql,railcontent_content,slug,'bar baz'
)
```


Comment-Likes
------------------------------------------------------------------------------------------------------------------------

### TL;DR: 

| description |  URL                      |    type     |  params     |  success code |  returns         | 
|-------------|---------------------------|-------------|-------------|---------------|------------------| 
| like        |  railcontent/comment-like |  **put**    |  comment_id |  200          |  boolean `true`  | 
| unlike      |  railcontent/comment-like |  **delete** |  comment_id |  200          |  boolean `true`  | 
 

<!--
description, url, type, params, success code, returns
like, railcontent/comment-like, put, comment_id, 200, boolean `true` 
unlike, railcontent/comment-like, delete, comment_id, 200, boolean `true`
-->


### Wordy explaination

There are currently two functions here. *Like* and *Unlike*. Both requests will be *same in all manners except for the request method*. One is `PUT`, the other is `DELETE`. 

They both...

* call the same URL ("*railcontent/comment-like*")
* pass only one parameter ("*comment_id*")
* on success they both return a `200` status-code and a simple boolean `true` value

Note the similarities in the following examples:


#### Like

```javascript
$.ajax({
    url: 'https://www.foo.com' +
        '/railcontent/comment-like',
    type: 'put',
    data: {'comment_id': 123 },
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});
```

returns:

```json
{
    "status":"ok",
    "code":200,
    "results":true
}
```

#### Unlike

```javascript
$.ajax({
    url: 'https://www.foo.com' +
        '/railcontent/comment-like',
    type: 'delete',
    data: {'comment_id': 123 },
    dataType: 'json',
    success: function(response) {
        // handle success
    },
    error: function(response) {
        // handle error
    }
});
```

returns:

```json
{
    "status":"ok",
    "code":200,
    "results":true
}
```

See? They're both the same except for the 'type' value defined in the request.
