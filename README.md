# Development Environment

This repository is designed to run on PHP 8.0, MySQL 8.0, and Apache/PHP-FPM.  
Pull the latest railenvironment master branch changes and update with docker compose. This will install new 
containers for PHP 8 and MySQL 8. This will not affect legacy repos and websites.

We have multiple versions of PHP running in our dev environments so you must specify a port to connect to
this unified platform repository's website instead of the legacy brand repositories.

**URL: [https://devplatform.musora.com:8443/](https://devplatform.musora.com:8443/)**

Composer and artisan commands will automatically run inside the php 8 container if you specify musora-web-platform as
the application. For example:  
- **r musora-web-platform composer u**
- **r musora-web-platform artisan migrate**

### Connecting To MySQL 8 With phpMyAdmin

Go to the phpMyAdmin url for our local development: [http://localhost:4805/index.php](http://localhost:4805/index.php).  

Log in with these details (you may need to log out if you are already logged in to another mysql version):

- Server: **mysql8**
- Username: **root**
- Password: **root**  

Please note, mysql 8.0 databases are totally separate from the legacy mysql 5.6 databases. They exist on different 
mysql containers.

# Multi Domain Support

All brand domains/websites such as drumeo.com, pianote.com, etc use this same repository and laravel install
to run. To load these brands using the new musora-web-platform repo you must specify the port and URLs like this:  

[https://devplatform.drumeo.com:8443/](https://devplatform.drumeo.com:8443/)  
[https://devplatform.pianote.com:8443/](https://devplatform.pianote.com:8443/)  
[https://devplatform.guitareo.com:8443/](https://devplatform.guitareo.com:8443/)  
[https://devplatform.singeo.com:8443/](https://devplatform.singeo.com:8443/)  

This will load based on the routes defined in the relevant route files for that brand. There are folders for each brand
inside the routes file of this repo. A route can be locked to a given domain like this:

```php
Route::domain('{subdomain}.drumeo.com')->group(function () {
    Route::get('/', function () {
        return 'Drumeo only route!';
    });
});
```  

Prototyping is totally domain independent meaning the urls will work with any domain. You instead must separate
your blade files by brand. Currently, in the 'views' folder each brand has its own folder.

**Existing legacy dev URLs are not affected by this. They still work as normal, for example 'https://dev.drumeo.com/'.**

# Front End Web Prototyping

### Loading Blade Files With A Prototype URL

There is a simple prototyping system set up in this repository which allows for development of blade/view/vue 
pages without any need for back end routing or data. It works by loading blade files based on the URL.

URL: https://devplatform.musora.com:8443/prototype/{viewPath1}/{viewPath2?}/{viewPath3?}/{viewPath4?}/{viewPath5?}

This path to the view file is relative to the 'resources/views' directory. For example
if you have a blade file here:  
**resources/views/my_brand/my_category/my_blade.blade.php**  
you load that blade file in a browser with this URL:  
https://devplatform.musora.com:8443/prototype/my_brand/my_category/my_blade

You can also link to any blade file using this same URL structure:
```html
<a href="/prototype/my_brand/my_other_category/my_other_blade"
```

This URL should work as an example if the example files still exist in this repo:
[https://devplatform.musora.com:8443/prototype/musora/prototype_testing_example/testing_welcome](https://devplatform.musora.com:8443/prototype/musora/prototype_testing_example/testing_welcome)

### Loading Test Data In To A Blade

You can load testing data in the form of PHP variables in to any blade file by including the php
file inside the blade view file. All test data must be inside .php files and inside the 'resources/prototyping_data' 
directory. The PHP files should start with '<?php' and include raw variable definitions. For example:  

File location: resources/prototyping_data/test_data.php    
```php
<?php

$myString = 'Hello!';
$myArray = ['data 1', 'data 2'];
$myJsonObject = json_decode('{"name":"John", "age":30, "car":null}');
```

In your blade file you can load in these variables like this:

```php
@php
    require_once(resource_path('prototyping_data/test_data.php'))
@endphp

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body class="antialiased">
        <h1>Hello!</h1>
        <h2>{{ $myString }}</h2>

        @foreach($myArray as $myArrayValue)
            <h2>{{ $myArrayValue }}</h2>
        @endforeach

        @foreach($myJsonObject as $myJsonValue)
            <h2>{{ $myJsonValue }}</h2>
        @endforeach
    </body>
</html>

```
