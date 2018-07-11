- [getById](#getbyid)
  * [Usage Example](#usage-example)
  * [Parameters](#parameters)
  * [Responses](#responses)
- [getByIds](#getbyids)
  * [Usage Example](#usage-example-1)
  * [Parameters](#parameters-1)
  * [Responses](#responses-1)
- [getAllByType](#getallbytype)
  * [Usage Example](#usage-example-2)
  * [Parameters](#parameters-2)
  * [Responses](#responses-2)
- [getWhereTypeInAndStatusAndField](#getwheretypeinandstatusandfield)
  * [Usage Example](#usage-example-3)
  * [Parameters](#parameters-3)
  * [Responses](#responses-3)
- [getWhereTypeInAndStatusAndPublishedOnOrdered](#getwheretypeinandstatusandpublishedonordered)
  * [Usage Example](#usage-example-4)
  * [Parameters](#parameters-4)
  * [Responses](#responses-4)
- [getBySlugAndType](#getbyslugandtype)
  * [Usage Example](#usage-example-5)
  * [Parameters](#parameters-5)
  * [Responses](#responses-5)
- [getByUserIdTypeSlug](#getbyuseridtypeslug)
  * [Usage Example](#usage-example-6)
  * [Parameters](#parameters-6)
  * [Responses](#responses-6)
- [getByParentId](#getbyparentid)
  * [Usage Example](#usage-example-7)
  * [Parameters](#parameters-7)
  * [Responses](#responses-7)
- [getByParentIdWhereTypeIn](#getbyparentidwheretypein)
  * [Usage Example](#usage-example-8)
  * [Parameters](#parameters-8)
  * [Responses](#responses-8)
- [getByParentIds](#getbyparentids)
  * [Usage Example](#usage-example-9)
  * [Parameters](#parameters-9)
  * [Responses](#responses-9)
- [getByChildIdWhereType](#getbychildidwheretype)
  * [Usage Example](#usage-example-10)
  * [Parameters](#parameters-10)
  * [Responses](#responses-10)
- [getByChildIdsWhereType](#getbychildidswheretype)
  * [Usage Example](#usage-example-11)
  * [Parameters](#parameters-11)
  * [Responses](#responses-11)
- [getByChildIdWhereParentTypeIn](#getbychildidwhereparenttypein)
  * [Usage Example](#usage-example-12)
  * [Parameters](#parameters-12)
  * [Responses](#responses-12)
- [getPaginatedByTypeUserProgressState](#getpaginatedbytypeuserprogressstate)
  * [Usage Example](#usage-example-13)
  * [Parameters](#parameters-13)
  * [Responses](#responses-13)
- [getPaginatedByTypesUserProgressState](#getpaginatedbytypesuserprogressstate)
  * [Usage Example](#usage-example-14)
  * [Parameters](#parameters-14)
  * [Responses](#responses-14)
- [getTypeNeighbouringSiblings](#gettypeneighbouringsiblings)
  * [Usage Example](#usage-example-15)
  * [Parameters](#parameters-15)
  * [Responses](#responses-15)
- [getByContentFieldValuesForTypes](#getbycontentfieldvaluesfortypes)
  * [Usage Example](#usage-example-16)
  * [Parameters](#parameters-16)
  * [Responses](#responses-16)
- [countByTypesUserProgressState](#countbytypesuserprogressstate)
  * [Usage Example](#usage-example-17)
  * [Parameters](#parameters-17)
  * [Responses](#responses-17)
- [getFiltered](#getfiltered)
  * [Usage Example](#usage-example-18)
  * [Parameters](#parameters-18)
  * [Responses](#responses-18)
- [create](#create)
  * [Usage Example](#usage-example-19)
  * [Parameters](#parameters-19)
  * [Responses](#responses-19)
- [update](#update)
  * [Usage Example](#usage-example-20)
  * [Parameters](#parameters-20)
  * [Responses](#responses-20)
- [delete](#delete)
  * [Usage Example](#usage-example-21)
  * [Parameters](#parameters-21)
  * [Responses](#responses-21)
- [softDelete](#softdelete)
  * [Usage Example](#usage-example-22)
  * [Parameters](#parameters-22)
  * [Responses](#responses-22)
- [attachPlaylistsToContents](#attachplayliststocontents)
  * [Usage Example](#usage-example-23)
  * [Parameters](#parameters-23)
  * [Responses](#responses-23)


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