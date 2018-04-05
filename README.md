
Railcontent
========================================================================================================================

Data first simple CMS.



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


#### number_of_children

(optional)

See "**Important Note about the "numeric" rule**" note above.

Provide this in cases where a content type requires a set number of children before it can be set to a 
"restricted" state (perhaps "published" or "scheduled").




### Configuration Example

```php
'validation' => [
    'qux_brand' => [
        'restrictions' => ['published','scheduled'],
        'course' => [
            'number_of_children' => 'numeric|min:1',

            'fields' => [
                'title' => ['rules' => 'required|min:1|max:180'],
                'difficulty' => ['rules' => 'required|numeric|min:1|max:10'],
                'instructor' => [
                    'rules' => [
                        Rule::exists($connectionMaskPrefix . 'content', 'id')->where(
                            function ($query) { $query->where('type', 'instructor'); }
                        ),
                        'required'
                    ],
                    'can_have_multiple' => true,
                ],
                'topics' => [
                    'rules' => 'string|min:1|max:64',
                    'can_have_multiple' => true,
                ],
                'tags' => [
                    'rules' => 'string|min:1|max:64',
                    'can_have_multiple' => true,
                ],
            ],

            'data' => [ // "data" not "datum" because the former is what the arrays' key use
                'thumbnail_url' => [
                    'rules' => ['required', 'url', 'regex:/^.*\.(jpg|png)$/'], // stackoverflow.com/a/37495, // cannot have more than 1s
                ],
                'all_resources_zip_url' => [
                    'rules' => 'required|url|regex:/^.*\.(zip)$/',
                ],
                'description' => [
                    'rules' => 'string|min:1|max:1000',
                    'can_have_multiple' => true,
                ]
            ],
        ],
        'course_part' => [
            'number_of_children' => 0,
            'fields' => [
                'title' => ['rules' => 'required|min:1|max:180'],
                'video' => ['rules' => [Rule::exists($connectionMaskPrefix . 'content', 'id')->where(
                        function ($query) { $query->where('type', 'vimeo-video'); }
                    ),'required']
                ]
            ],
            'data' => [
                'card_thumbnail' => ['rules' => 'required|url|regex:/^.*\.(jpg|png)$/',],
                'mp3_exercises_zip' => ['rules' => 'required|url|regex:/^.*\.(zip)$/',],
                'sheet_music_pdf' => ['rules' => 'required|url|regex:/^.*\.(pdf)$/',],
                'sheet_music_png' => [
                    'rules' => 'required|url|regex:/^.*\.(jpg|png)$/',
                    'can_have_multiple' => true,
                ],
                'description' => ['rules' => 'string|min:1|max:1000',]
            ],
        ],
        
    ]
]
```
