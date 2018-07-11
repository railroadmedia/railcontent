Content Datum Service
========================================================================================================================

- [Content Datum Service](#content-datum-service)
    + [get](#get)
      - [Usage Example](#usage-example)
      - [Parameters](#parameters)
      - [Responses](#responses)
    + [getByContentIds](#getbycontentids)
      - [Usage Example](#usage-example-1)
      - [Parameters](#parameters-1)
      - [Responses](#responses-1)
    + [create](#create)
      - [Usage Example](#usage-example-2)
      - [Parameters](#parameters-2)
      - [Responses](#responses-2)
    + [update](#update)
      - [Usage Example](#usage-example-3)
      - [Parameters](#parameters-3)
      - [Responses](#responses-3)
    + [delete](#delete)
      - [Usage Example](#usage-example-4)
      - [Parameters](#parameters-4)
      - [Responses](#responses-4)





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

#### Usage Example

```php
$contentDatum = $this->contentDatumService->get($id);
```

#### Parameters

| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  id |  yes      |  integer  |  id of content datum you want to pull | 
 
<!--
#, name, required, type, description
1 , id, yes, integer , id of content datum you want to pull
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "voluptatem"<br/>&emsp;"value" => "aut"<br/>&emsp;"position" => "1"<br/>]|  Datum details          | 


### getByContentIds

#### Usage Example

```php
$contentDatum = $this->contentDatumService->getByContentIds([$content1, $content2]);
```
#### Parameters

| #  |  name   |  required |  type    |  description                             | 
|----|---------|-----------|----------|------------------------------------------| 
| 1  |  ids    |  yes      |  array  |  The content ids for each you want to pull data  | 



 
<!--
#, name, required, type, description
1 , ids , yes, array , The content ids for each you want to pull data    
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "fuga"<br/>&emsp;"value" => "suscipit"<br/>&emsp;"type" => "string"<br/>&emsp;"position" => "1"<br/>]|  Datum details          | 


### create

#### Usage Example

```php
 $this->contentDatumService->create($content['id'], 'description', $lesson->get('description'), 1);
```
#### Parameters

| #  |  name        |  required |  type     |  description                                                                                     | 
|----|--------------|-----------|-----------|--------------------------------------------------------------------------------------------------| 
| 1  |  content_id  |  yes      |  integer  |  The content id this datum belongs to.                                                           | 
| 2  |  key         |  yes      |  string   |  The key of this datum also know as the name.                                                    | 
| 3  |  value       |  yes      |  string   |  The value of the datum.                                                                         | 
| 4  |  position    |   yes     |  integer  |  The position of this datum relative to other datum with the same key under the same content id. | 
                     | 
 
<!--
#, name, required, type, description
1 , content_id , yes, integer , The content id this datum belongs to.
2 , key , yes, string , The key of this datum also know as the name.
3 , value , yes, string , The value of the datum. 
4 , position,  yes, integer , The position of this datum relative to other datum with the same key under the same content id.  
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "description"<br/>&emsp;"value" => "Description"<br/>&emsp;"position" => "1"<br/>]|  Datum details          | 

### update

#### Usage Example

```php
 $this->contentDatumService->update($datum['id'], [
 	'value' => 'New value'
    ]);
```
#### Parameters

| #  |  name  |  required |  type     |  description                                         | 
|----|--------|-----------|-----------|------------------------------------------------------| 
| 1  |  id    |  yes      |  integer  |  Id of the datum you want to edit.                   | 
| 2  |  data  |  yes      |  array    |  Key value datum array data that should be modified. | 

 
<!--
#, name, required, type, description
1 , id , yes , integer , Id of the datum you want to edit.
2 , data , yes, array , Key value datum array data that should be modified.   
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "description"<br/>&emsp;"value" => "New value"<br/>&emsp;"position" => "1"<br/>]|  Datum details          | 

### delete

#### Usage Example

```php
 $this->contentDatumService->delete($datum['id']);
```
#### Parameters

| #  |  name  |  required |  type     |  description                                         | 
|----|--------|-----------|-----------|------------------------------------------------------| 
| 1  |  id    |  yes      |  integer  |  Id of the datum you want to delete                  | 


 
<!--
#, name, required, type, description
1 , id , yes , integer , Id of the datum you want to delete.   
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| not exist   |  null             |  null                   |                          | 
| succeded |  boolean    | true|            | 
| failed |  boolean    | false|            | 
