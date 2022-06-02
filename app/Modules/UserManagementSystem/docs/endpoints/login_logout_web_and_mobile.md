




## User login cookie - Web application


### HTTP Request]()
    `POST user_management_system/login/cookie`


### Permissions
    - Without restrictions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|email|  yes  ||
|body|password|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/user_management_system/login/cookie',
{
    "email": "email@email.ro",
    "password": "password"
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response:
Brand homepage or redirect


## User login token - Mbile application


### HTTP Request]()
    `POST user_management_system/login/token`


### Permissions
    - Without restrictions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|email|  yes  ||
|body|password|  yes  ||


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/user_management_system/login/token',
{
    "email": "my_email@email.com",
    "password": "password"
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
  "success": true,
  "token": "eyJ0eX0YyJ9.ayJrvjNMrfDg78Aedglp6sEEoz6jzMLbHl7Gcy6Cygg",
  "user": {
    id: 1,
    email: "my_email@email.com",
    display_name: "test name"
    ....
  }
}
```

### Response Example (401):
When the server-side reports an error, it returns a JSON object in the following format:
```json
{
  "success": false,
  "message": "Invalid Email or Password"
}
```


## Logout web application

### HTTP Request
    `GET /user_management_system/logout/cookie`


### Permissions


### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/user_management_system/logout/cookie',
    success: function(response) {},
    error: function(response) {}
});
```



## Logout the authenticated user - Mobile application


### HTTP Request
    `GET /user_management_system/logout/token`


### Permissions
    - Only authenticated user

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/user_management_system/logout/token,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "success": true,
    "message": "Successfully logged out"
}
```

