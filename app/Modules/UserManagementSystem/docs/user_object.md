# Accessing The Authenticated User

You can access the currently authenticated user anywhere in our laravel PHP code or blade templates using the 'user()' 
helper function. This function returns an instance of our User module class here 
'app/Modules/UserManagementSystem/Models/User.php'. PHPStorm should have hinting for the attributes, but you can 
always view the available attributes and functions in that User.php module file.  

Much of the past user data that required complex queries and system to get like 'total xp' and 'access level' are now 
stored directly on the user object!  

```php
$authenticatedUser = user();

user()->display_name;
user()->email;
user()->profile_picture_url;
user()->first_name;
user()->last_name;
user()->access_level;
user()->total_xp;
user()->brand_method_levels;
// etc...
```

You can also get an array or json version of the user object for use on the front end or in JS like this:

```php
$userAttributesAsAnArray = user()->toArray();
$userAttributesAsAJsonString = json_encode(user()->toArray());
```
