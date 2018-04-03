
ToDo: Improve Validation By Making It Work As Per a Schema Like This
------------------------------------------------------------------------------------------------------------------------

What follows is an abandoned section for the readme file of this package. It describes a better way of configuring
the config information for the validation. It was abandoned to save time. 

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
4. can_have_multiple (optional)
5. restrictions (optional)

If a content-type exists in these rules, then validation will run on as described above. If the content-type is not
represented in the rules, the validation rules will not protect that content type according to the rules.

If a content-type requires unique content-state restrictions, you can specify a "restrictions" array as a child to the
content array (sibling to number_of_children, fields, data, and can_have_multiple). **If this array is empty, the 
validation will default to the general restrictions. If you want a content-type to not have any restrictions, do not
include said type in the configuration.**



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

If a content type requires a set number of children before it can be set to a "restricted" state (perhaps "published" or
"scheduled").


#### can_have_multiple

(optional)


#### restrictions

**\[TO DO\]**

(optional)

If a content-type requires unique content-state restrictions, you can specify a "restrictions" array as a child to the
content array (sibling to number_of_children, fields, data, and can_have_multiple).

**If this array is *EMPTY*, the 
validation will default to the general restrictions. If you want a content-type to not have any restrictions, do not
include said type in the configuration.**



### Configuration Example

```php
'validation' => [
    'qux_brand' => [
        'restrictions' => ['published','scheduled'],
        'course' => [
            'number_of_children' => 'numeric|min:2',
            'fields' => [
                'title' => 'required|min:1|max:180',
                'difficulty' => 'required|numeric|min:1|max:10',
                'instructor' => [
                    Rule::exists($connectionMaskPrefix . 'content', 'id')->where(
                        function ($query) { $query->where('type', 'instructor'); }
                    ),
                    'required'
                ],
                'topics' => 'string|min:1|max:64',
                'tags' => 'string|min:1|max:64'
            ],
            'data' => [
                'thumbnail_url' => ['required|url|regex:/^.*\.(jpg|png)$/',
                'all_resources_zip_url' => 'required|url|regex:/^.*\.(zip)$/',
                'description' => 'string|min:1|max:1000'
            ],
            'can_have_multiple' => ['fields' => ['instructor', 'topics', 'tags'], 'data' => ['description']]
        ],
        'foo_content_type' => [
            'number_of_children' => 'numeric|min:3',
            'fields' => [
                'bar' => 'string|min:1|max:32',
                'baz' => 'string|min:5|max:64'
            ],
            'data' => [
                'thumbnail_url' => ['required|url|regex:/^.*\.(jpg|png)$/'
            ]
            'restrictions' => [
                'qux', 'published', 'quux', 'quuz', 'corge'
            ]
        ]
    ]
]
```
