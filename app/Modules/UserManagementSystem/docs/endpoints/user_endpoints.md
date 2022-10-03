# User endpoints

### Important: for mobile requests, the HTTP request must contain the Authorization header where the Bearer token is provided
```js
$.ajax({
    url: '',
     headers: {
        'Authorization': `Bearer ${token}`, 
        'Accept': 'application/json'
    },
    success: function(response) {},
    error: function(response) {}
});
```


### Important: for json responses requests, the HTTP request must contain the Accept header with the value 'application/json'

```js
$.ajax({
    url: '',
     headers: {
        'Accept': 'application/json'
    },
    success: function(response) {},
    error: function(response) {}
});
```

### User Form API

**`PUT /user-management-system/user/store`**
**`PATCH /user-management-system/user/update/{user_id}`**
**`DELETE /user-management-system/user/delete/{user_id}`**

Parameters and validation for PUT/PATCH:

**\* NOTE: Email can only be updated by admins with special privileges. Normal users must use the email change endpoint.**

*NOTE: Required parameters are only required for PUT/create requests.

```php
[
    'email' => 'required|email|unique:usora_users,email',
    'display_name' => 'required|string|max:255|min:2|unique:usora_users,display_name',
    'password' => 'required|string|min:8|max:128',
    
    'first_name' => 'nullable|string|max:255',
    'last_name' => 'nullable|string|max:255',
    'gender' => 'nullable|string|in:male,female,other',
    'country' => 'nullable|string',
    'region' => 'nullable|string',
    'city' => 'nullable|string',
    'birthday' => 'nullable|string|date',
    'phone_number' => 'nullable|string|integer',
    'biography' => 'nullable|string',
    'profile_picture_url' => 'nullable|string|url',
    'timezone' => 'nullable|string|in:' . implode(',', timezone_identifiers_list()),
    'permission_level' => 'nullable|string',
    
    'notify_on_lesson_comment_reply' => 'nullable|boolean',
    'notify_weekly_update' => 'nullable|boolean',
    'notify_on_forum_post_like' => 'nullable|boolean',
    'notify_on_forum_followed_thread_reply' => 'nullable|boolean',
    'notify_on_forum_post_reply' => 'nullable|boolean',
    'notify_on_lesson_comment_like' => 'nullable|boolean',
    'notifications_summary_frequency_minutes' => 'nullable|integer',
    
    'drums_playing_since_year' => 'nullable|integer|between:1900,' . date('Y'),
    'drums_gear_photo' => 'nullable|url',
    'drums_gear_cymbal_brands' => 'nullable|string',
    'drums_gear_set_brands' => 'nullable|string',
    'drums_gear_hardware_brands' => 'nullable|string',
    'drums_gear_stick_brands' => 'nullable|string',
    
    'guitar_playing_since_year' => 'nullable|integer|between:1900,' . date('Y'),
    'guitar_gear_photo' => 'nullable|url',
    'guitar_gear_guitar_brands' => 'nullable|string',
    'guitar_gear_amp_brands' => 'nullable|string',
    'guitar_gear_pedal_brands' => 'nullable|string',
    'guitar_gear_string_brands' => 'nullable|string',
    
    'piano_playing_since_year' => 'nullable|integer|between:1900,' . date('Y'),
    'piano_gear_photo' => 'nullable|url',
    'piano_gear_piano_brands' => 'nullable|string',
    'piano_gear_keyboard_brands' => 'nullable|string',

    'singing_since_year' => 'nullable|integer|between:1900,' . date('Y'),
    'singing_gear_mic_brands' => 'nullable|string',
    'singing_gear_photo' => 'nullable|url'
];
```

Will return a redirect to URL passed in with 'redirect' parameter, or will return to previous URL. Always redirects with
```php
['success' => true]
```
flashed to the session.

### Email Change Form API

**`POST /user-management-system/email-change/request`**

Parameters and validation for POST:

```php
[
    'email' => 'required|email|unique:usora_users,email',
];
```

Will return a redirect to URL passed in with 'redirect' parameter, or will return to previous URL. Always redirects with
```php
[
    'successes' => new MessageBag(
        ['password' => 'An email confirmation link has been sent to your new email address.']
    ),
]
```
flashed to the session.



**`GET /user-management-system/email-change/confirm`**

```php
[
    'token' => 'bail|required|string|exists:usora_email_changes,token',
]
```

Will return a redirect to URL passed in with 'redirect' parameter, or will return to previous URL. Always redirects with
```php
[
    'successes' => new MessageBag(
        ['password' => 'Your email has been updated successfully.']
    ),
];
```
flashed to the session.





## Pull users


### HTTP Request
    `GET usora/json-api/user/index`


### Permissions
    - Must be logged in
    - Only users with index-users ability

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|search_term|    ||
|body|per_page|    |Default:25|
|body|page|    |Default:1|
|body|sort|    |Default:createdAt|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/user-management-system/user/index',
{
    "search_term": "nisi",
    "per_page": 2,
    "page": 1,
    "sort": "createdAt"
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```



## Upload and update picture URLs 


### HTTP Request
    `PUT user-management-system/picture/upload`

## Request parameters:
- depending on the attributes sent, the request will update one of the following User attributes:
- only one of the parameters should be added to the request

```php
[
    'profile_picture_url' => 'url',
    'drums_gear_photo' => 'url',
    'piano_gear_photo' => 'url',
    'guitar_gear_photo' => 'url',
    'singing_gear_photo' => 'url',
]
```


### Permissions
    - Must be logged in

### Request Parameters


|Type|Key|Required| Notes         |
|----|---|--------|---------------|
|body|file|    | Max 5MB size. |


### Request Example:

See: [https://github.com/railroadmedia/musora-web-platform/blob/master/resources/platform/assets/js/vue/vuesora/components/ImageCropper/ImageCropper.vue#L337](https://github.com/railroadmedia/musora-web-platform/blob/master/resources/platform/assets/js/vue/vuesora/components/ImageCropper/ImageCropper.vue#L337)

### Return:
Returns entire user JSON object. Can get new profile pic URL with: response.profile_picture_url.


## Check if display name is unique


### HTTP Request
    `PUT user-management-system/is-display-name-unique`

#### Request parameter:
```php
['display_name' => 'required']
```
The request checks if another user exists with the same display name.


#### Success response:
```php
{"unique":true}
```
#### Unsuccess response:
```php
{"unique":false}
```
#### Missing parameter response:
```php
{"errors":{"display_name":"The display name field is required."}}
```


## Check if email is unique


### HTTP Request
    `PUT user-management-system/is-email-unique`

#### Request parameter:
```php
['email' => 'required|email']
```
The request checks if another user exists with the same email. Authentication is not needed.


#### Success response:
```php
{"unique":true}
```
#### Unsuccess response:
```php
{"unique":false}
```
#### Missing/invalid parameter response:
```php
{"errors":{"email":"The email field is required."}}
```
```php
{"errors":{"email":"The email must be a valid email address."}}
```
