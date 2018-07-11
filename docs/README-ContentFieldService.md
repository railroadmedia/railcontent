Content Field Service
========================================================================================================================

- [Content Field Service](#content-field-service)
    + [get](#get)
      - [Usage Example](#usage-example)
      - [Parameters](#parameters)
      - [Responses](#responses)
    + [getByKeyValueTypePosition](#getbykeyvaluetypeposition)
      - [Parameters](#parameters-1)
      - [Responses](#responses-1)
    + [getByKeyValueType](#getbykeyvaluetype)
      - [Usage Example](#usage-example-1)
      - [Parameters](#parameters-2)
      - [Responses](#responses-2)
    + [create](#create)
      - [Usage Example](#usage-example-2)
      - [Parameters](#parameters-3)
      - [Responses](#responses-3)
    + [update](#update)
      - [Usage Example](#usage-example-3)
      - [Parameters](#parameters-4)
      - [Responses](#responses-4)
    + [delete](#delete)
      - [Usage Example](#usage-example-4)
      - [Parameters](#parameters-5)
      - [Responses](#responses-5)




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

#### Usage Example

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

```php
$vimeoIdFields = $this->contentFieldService->getByKeyValueTypePosition(
                'vimeo_video_id',
                $event->mediaId,
                'string',
                1
            );
```

#### Parameters

| #  |  name     |  required |  type     |  description                                  | 
|----|-----------|-----------|-----------|-----------------------------------------------| 
| 1  |  key      |  yes      |  string   |  key of content field you want to pull        | 
| 2  |  value    |  yes      |  string   |  value of the content key                     | 
| 3  |  type     |  yes      |  string   |  type of the content field                    | 
| 4  |  position |   yes     |  integer  |  position of the field in content fields list | 

 
<!--
#, name, required, type, description
1 , key , yes, string , key of content field you want to pull  
2 , value , yes, string , value of the content key 
3 , type, yes, string , type of the content field 
4 , position,  yes, integer , position of the field in content fields list     
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "fuga"<br/>&emsp;"value" => "suscipit"<br/>&emsp;"type" => "string"<br/>&emsp;"position" => "1"<br/>]|  Fields details          | 

### getByKeyValueType

#### Usage Example

```php
$videoFields = $this->contentFieldService->getByKeyValueType(
                    'video',
                    $vimeoIdField['content_id'],
                    'content_id'
                );
```
#### Parameters

| #  |  name   |  required |  type    |  description                             | 
|----|---------|-----------|----------|------------------------------------------| 
| 1  |  key    |  yes      |  string  |  key of content field you want to pull   | 
| 2  |  value  |  yes      |  string  |  value of the content key                | 
| 3  |  type   |  yes      |  string  |  type of the content field               | 


 
<!--
#, name, required, type, description
1 , key , yes, string , key of content field you want to pull  
2 , value , yes, string , value of the content key 
3 , type, yes, string , type of the content field     
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "fuga"<br/>&emsp;"value" => "suscipit"<br/>&emsp;"type" => "string"<br/>&emsp;"position" => "1"<br/>]|  Fields details          | 


### create

#### Usage Example

```php
 $this->contentFieldService->create(
                $video['id'],
                'length_in_seconds',
                $songData['video_length_in_seconds'],
                1,
                'integer'
            );
```
#### Parameters

| #  |  name        |  required |  type     |  description                                                                                      | 
|----|--------------|-----------|-----------|---------------------------------------------------------------------------------------------------| 
| 1  |  content_id  |  yes      |  integer  |  The content id this field belongs to.                                                            | 
| 2  |  key         |  yes      |  string   |  The key of this field also know as the name.                                                     | 
| 3  |  value       |  yes      |  string   |  The value of the field.                                                                          | 
| 4  |  position    |   yes     |  integer  |  The position of this field relative to other fields with the same key under the same content id. | 
| 5  |  type        |  yes      |  string   |  The type of field this is. Options are 'string' 'integer' 'content_id'.                          | 
 
<!--
#, name, required, type, description
1 , content_id , yes, integer , The content id this field belongs to.
2 , key , yes, string , The key of this field also know as the name.
3 , value , yes, string , The value of the field. 
4 , position,  yes, integer , The position of this field relative to other fields with the same key under the same content id.
5 , type, yes, string , The type of field this is. Options are 'string' 'integer' 'content_id'.    
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "length_in_seconds"<br/>&emsp;"value" => "10"<br/>&emsp;"type" => "integer"<br/>&emsp;"position" => "1"<br/>]|  Field details          | 

### update

#### Usage Example

```php
 $this->contentFieldService->update($field['id'], [
 	'value' => 120
    ]);
```
#### Parameters

| #  |  name  |  required |  type     |  description                                         | 
|----|--------|-----------|-----------|------------------------------------------------------| 
| 1  |  id    |  yes      |  integer  |  Id of the field you want to edit.                   | 
| 2  |  data  |  yes      |  array    |  Key value field array data that should be modified. | 

 
<!--
#, name, required, type, description
1 , id , yes , integer , Id of the field you want to edit.
2 , data , yes, array , Key value field array data that should be modified.   
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| failed   |  null             |  null                                                                                                                                                                                                                                                                                                       |                          | 
| succeded |  array    | [<br/>&emsp; "id" => "1"<br/>&emsp;"content_id" => "1"<br/>&emsp;"key" => "length_in_seconds"<br/>&emsp;"value" => "120"<br/>&emsp;"type" => "integer"<br/>&emsp;"position" => "1"<br/>]|  Field details          | 

### delete

#### Usage Example

```php
 $this->contentFieldService->delete($field['id']);
```
#### Parameters

| #  |  name  |  required |  type     |  description                                         | 
|----|--------|-----------|-----------|------------------------------------------------------| 
| 1  |  id    |  yes      |  integer  |  Id of the field you want to delete                  | 


 
<!--
#, name, required, type, description
1 , id , yes , integer , Id of the field you want to delete.   
-->

#### Responses

| outcome  |  return data type |  return data value (example)                                                                                                                                                                                                                                                                                |  notes about return data | 
|----------|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------| 
| not exist   |  null             |  null                   |                          | 
| succeded |  boolean    | true|            | 
| failed |  boolean    | false|            | 
