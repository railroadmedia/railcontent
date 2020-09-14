Railcontent
========================================================================================================================

Data first simple CMS.

  * [Installation, Configuration, Use](#installation--configuration--use)
    + [Installation](#installation)
    + [Configuration](#configuration)
* [Content Service](docs/v0.5/README-ContentService.md#contentservice)
  - [getById](docs/v0.5/README-ContentService.md#getbyid)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters)
    * [Responses](docs/v0.5/README-ContentService.md#responses)
  - [getByIds](docs/v0.5/README-ContentService.md#getbyids)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-1)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-1)
    * [Responses](docs/v0.5/README-ContentService.md#responses-1)
  - [getAllByType](docs/v0.5/README-ContentService.md#getallbytype)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-2)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-2)
    * [Responses](docs/v0.5/README-ContentService.md#responses-2)
  - [getWhereTypeInAndStatusAndField](docs/v0.5/README-ContentService.md#getwheretypeinandstatusandfield)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-3)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-3)
    * [Responses](docs/v0.5/README-ContentService.md#responses-3)
  - [getWhereTypeInAndStatusAndPublishedOnOrdered](docs/v0.5/README-ContentService.md#getwheretypeinandstatusandpublishedonordered)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-4)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-4)
    * [Responses](docs/v0.5/README-ContentService.md#responses-4)
  - [getBySlugAndType](docs/v0.5/README-ContentService.md#getbyslugandtype)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-5)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-5)
    * [Responses](docs/v0.5/README-ContentService.md#responses-5)
  - [getByUserIdTypeSlug](docs/v0.5/README-ContentService.md#getbyuseridtypeslug)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-6)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-6)
    * [Responses](docs/v0.5/README-ContentService.md#responses-6)
  - [getByParentId](docs/v0.5/README-ContentService.md#getbyparentid)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-7)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-7)
    * [Responses](docs/v0.5/README-ContentService.md#responses-7)
  - [getByParentIdWhereTypeIn](docs/v0.5/README-ContentService.md#getbyparentidwheretypein)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-8)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-8)
    * [Responses](docs/v0.5/README-ContentService.md#responses-8)
  - [getByParentIds](docs/v0.5/README-ContentService.md#getbyparentids)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-9)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-9)
    * [Responses](docs/v0.5/README-ContentService.md#responses-9)
  - [getByChildIdWhereType](docs/v0.5/README-ContentService.md#getbychildidwheretype)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-10)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-10)
    * [Responses](docs/v0.5/README-ContentService.md#responses-10)
  - [getByChildIdsWhereType](docs/v0.5/README-ContentService.md#getbychildidswheretype)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-11)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-11)
    * [Responses](docs/v0.5/README-ContentService.md#responses-11)
  - [getByChildIdWhereParentTypeIn](docs/v0.5/README-ContentService.md#getbychildidwhereparenttypein)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-12)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-12)
    * [Responses](docs/v0.5/README-ContentService.md#responses-12)
  - [getPaginatedByTypeUserProgressState](docs/v0.5/README-ContentService.md#getpaginatedbytypeuserprogressstate)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-13)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-13)
    * [Responses](docs/v0.5/README-ContentService.md#responses-13)
  - [getPaginatedByTypesUserProgressState](docs/v0.5/README-ContentService.md#getpaginatedbytypesuserprogressstate)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-14)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-14)
    * [Responses](docs/v0.5/README-ContentService.md#responses-14)
  - [getTypeNeighbouringSiblings](docs/v0.5/README-ContentService.md#gettypeneighbouringsiblings)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-15)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-15)
    * [Responses](docs/v0.5/README-ContentService.md#responses-15)
  - [getByContentFieldValuesForTypes](docs/v0.5/README-ContentService.md#getbycontentfieldvaluesfortypes)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-16)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-16)
    * [Responses](docs/v0.5/README-ContentService.md#responses-16)
  - [countByTypesUserProgressState](docs/v0.5/README-ContentService.md#countbytypesuserprogressstate)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-17)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-17)
    * [Responses](docs/v0.5/README-ContentService.md#responses-17)
  - [getFiltered](docs/v0.5/README-ContentService.md#getfiltered)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-18)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-18)
    * [Responses](docs/v0.5/README-ContentService.md#responses-18)
  - [create](docs/v0.5/README-ContentService.md#create)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-19)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-19)
    * [Responses](docs/v0.5/README-ContentService.md#responses-19)
  - [update](docs/v0.5/README-ContentService.md#update)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-20)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-20)
    * [Responses](docs/v0.5/README-ContentService.md#responses-20)
  - [delete](docs/v0.5/README-ContentService.md#delete)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-21)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-21)
    * [Responses](docs/v0.5/README-ContentService.md#responses-21)
  - [softDelete](docs/v0.5/README-ContentService.md#softdelete)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-22)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-22)
    * [Responses](docs/v0.5/README-ContentService.md#responses-22)
  - [attachPlaylistsToContents](docs/v0.5/README-ContentService.md#attachplayliststocontents)
    * [Usage Example](docs/v0.5/README-ContentService.md#usage-example-23)
    * [Parameters](docs/v0.5/README-ContentService.md#parameters-23)
    * [Responses](docs/v0.5/README-ContentService.md#responses-23)
 * [Content Field Service](docs/v0.5/README-ContentFieldService.md#content-field-service)
     + [get](docs/v0.5/README-ContentFieldService.md#get)
       - [Usage Example](docs/v0.5/README-ContentFieldService.md#usage-example)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses)
     + [getByKeyValueTypePosition](docs/v0.5/README-ContentFieldService.md#getbykeyvaluetypeposition)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters-1)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses-1)
     + [getByKeyValueType](docs/v0.5/README-ContentFieldService.md#getbykeyvaluetype)
       - [Usage Example](docs/v0.5/README-ContentFieldService.md#usage-example-1)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters-2)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses-2)
     + [create](docs/v0.5/README-ContentFieldService.md#create)
       - [Usage Example](docs/v0.5/README-ContentFieldService.md#usage-example-2)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters-3)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses-3)
     + [update](docs/v0.5/README-ContentFieldService.md#update)
       - [Usage Example](docs/v0.5/README-ContentFieldService.md#usage-example-3)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters-4)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses-4)
     + [delete](docs/v0.5/README-ContentFieldService.md#delete)
       - [Usage Example](docs/v0.5/README-ContentFieldService.md#usage-example-4)
       - [Parameters](docs/v0.5/README-ContentFieldService.md#parameters-5)
       - [Responses](docs/v0.5/README-ContentFieldService.md#responses-5)
* [Content Datum Service](docs/v0.5/README-ContentDatumService.md#content-datum-service)
    + [get](docs/v0.5/README-ContentDatumService.md#get)
      - [Usage Example](docs/v0.5/README-ContentDatumService.md#usage-example)
      - [Parameters](docs/v0.5/README-ContentDatumService.md#parameters)
      - [Responses](docs/v0.5/README-ContentDatumService.md#responses)
    + [getByContentIds](docs/v0.5/README-ContentDatumService.md#getbycontentids)
      - [Usage Example](docs/v0.5/README-ContentDatumService.md#usage-example-1)
      - [Parameters](docs/v0.5/README-ContentDatumService.md#parameters-1)
      - [Responses](docs/v0.5/README-ContentDatumService.md#responses-1)
    + [create](docs/v0.5/README-ContentDatumService.md#create)
      - [Usage Example](docs/v0.5/README-ContentDatumService.md#usage-example-2)
      - [Parameters](docs/v0.5/README-ContentDatumService.md#parameters-2)
      - [Responses](docs/v0.5/README-ContentDatumService.md#responses-2)
    + [update](docs/v0.5/README-ContentDatumService.md#update)
      - [Usage Example](docs/v0.5/README-ContentDatumService.md#usage-example-3)
      - [Parameters](docs/v0.5/README-ContentDatumService.md#parameters-3)
      - [Responses](docs/v0.5/README-ContentDatumService.md#responses-3)
    + [delete](docs/v0.5/README-ContentDatumService.md#delete)
      - [Usage Example](docs/v0.5/README-ContentDatumService.md#usage-example-4)
      - [Parameters](docs/v0.5/README-ContentDatumService.md#parameters-4)
      - [Responses](docs/v0.5/README-ContentDatumService.md#responses-4)
* [Content Hierarchy Service](#)
    + [get](#)
    + [getByParentIds](#)
    + [countParentsChildren](#)  
    + [create](#)
    + [update](#)
    + [delete](#)
    + [repositionSiblings](#)                  
* [Permission Service]()  
    + [get](#)
    + [getAll](#)
    + [create](#)
    + [update](#)
    + [delete](#)
* [Content Permission Service]()
    + [get](#)
    + [getByContentTypeOrIdAndByPermissionId](#)
    + [dissociate](#)
    + [create](#)    
    + [update](#)
    + [delete](#)
* [User Permission Service]() 
    + [create](#)    
    + [update](#)
    + [delete](#)
    + [getUserPermissions](#)    
    + [getUserPermissionIdByPermissionAndUser](#)   
* [User Progress Service]()  
    + [getMostRecentByContentTypeUserState](#)    
    + [countTotalStatesForContentIds](#)
    + [startContent](#)
    + [completeContent](#)    
    + [resetContent](#) 
    + [saveContentProgress](#)    
    + [attachProgressToContents](#)
    + [bubbleProgress](#)
    + [getForUser](#)    
    + [getForUserStateContentTypes](#)  
    + [getLessonsForUserByType](#)    
    + [countLessonsForUserByTypeAndProgressState](#)         
* [Comment Service]()  
    + [get](#)    
    + [create](#)
    + [update](#)
    + [delete](#)    
    + [getComments](#) 
    + [attachCommentsToContents](#)    
    + [countLatestComments](#)
    + [getCommentPage](#)
* [Comment Assignment Service]() 
    + [store](#)    
    + [getAssignedCommentsForUser](#)
    + [countAssignedCommentsForUser](#)
    + [deleteCommentAssignations](#)    
* [Content Like Service]() 
    + [getByCommentIds](#) 
    + [countForCommentIds](#)    
    + [getUserIdsForEachCommentId](#)
    + [create](#)
    + [delete](#)   
* [Full Text Search Service]() 
    + [search](#)  
- [API endpoints](docs/v0.5/README-API.md#api-endpoints)
  * [Content](docs/v0.5/README-API-Content.md#content---api-endpoints)
  * [Content fields](docs/v0.5/README-API-Field.md#content-fields---api-endpoints)
  * [Content datum](docs/v0.5/README-API-Datum.md#content-datum---api-endpoints)
  * [Content hierarchy](docs/v0.5/README-API-Content-Hierarchy.md#content-hierarchy---api-endpoints)
  * [User progress on contents](docs/v0.5/README-API-User-Progress.md#user-progress-on-contents---api-endpoints)
  * [Permissions](docs/v0.5/README-API-Permissions.md#permissions---api-endpoints)
  * [User Access](docs/v0.5/README-API-User-Access.md#user-access---api-endpoints)
  * [Comments](docs/v0.5/README-API-Comments.md#comments---api-endpoints)
  * [Assign Comments to managers](docs/v0.5/README-API-Assign-Comments.md#assign-comments-to-managers---api-endpoints)
 
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

### Exemption

Are you implementing validation but have content with a protected state (say, "published" for example) that maybe be imcomplete according to the rules you're creating? There's no issue with that - the content will not be affected. The only problem is that users will not be able to edit the content - any attempt to edit content with a protected state that fails validation will be be rejected. So, how to make a small change to pre-existing content if you don't want to go and fill in previously left-blank parts of it?

Just set a date in your railroad config that specifies a before which all content is exempt from validation. Exempt, except for validation failures on any part edited and failing in a request.

Do this an any content with a protected state and a "created_on" date before your date specified in the config will not fail validation so long as what single field|datum|info you're changing doesn't fail it's specific validation rules. But the rest of the content-parts? Can fail and won't prevent from saving edits to other non-failing parts. 

Set the following value in "config/railcontent.php": 

```
'validation_exemption_date' => '2018-08-01 00:00:00',
```

Where the key is "validation_exemption_date", and the value is a datetime stamp - or any other single string that can passed to Carbon's `new Carbon()` instantiation.

(see docs: https://carbon.nesbot.com/docs/#api-instantiation)

(note, could easily enough be modified to take timezone if needed)


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
