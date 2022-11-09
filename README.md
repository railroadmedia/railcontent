# Development Environment

This repository is designed to run on PHP 8.0, MySQL 8.0, and Apache/PHP-FPM.  

### Setup:
- pull the latest railenvironment master branch changes
- in the `railenvironment_docker` directory, run `sudo docker-compose build`
    - _This will install new containers for PHP 8 and MySQL 8. This will not affect legacy repos and websites._ 
- in the railenvironmet directory, restart the container with the `./rrr.sh` command
- run `r setup musora-web-platform` then `cd /app/musora-web-platform` 
- make a new file in the repository root named `.env`
- copy content from 1pass note `.env, local, Musora Web Platform` to the .env file 
- run `r musora-web-platform composer install` -- NOTE: if asked for nova package credentials, 
  input 'caleb@drumeo.com' for the username and for the password use our Nova license key which is inside the 1pass note: 
  "Laravel Nova v4.0 License Key". When it asks if you want to store a composer auth file, enter Y
- run these two sets of commands, each conveniently available as a one liner
    - set up databases
        ```
        r musora db8 local fromprod && r drumeo db8 local fromprod && r pianote db8 local fromprod && r guitareo db8 local fromprod && r singeo db8 local fromprod && r musora-web-platform artisan migrate
        ```
    - compile frontend assets
        ```
        cd /app/musora-web-platform && nvm use 16 && yarn && yarn platform-production && yarn marketing-production
        ```
- [https://devplatform.musora.com:8443](https://devplatform.musora.com:8443) should now load and the app and automated testing should work

### Running Commands:
Composer and artisan commands will automatically run inside the php 8 container if you specify musora-web-platform as
the application. For example:  
- **r musora-web-platform composer u**
- **r musora-web-platform artisan key:generate**
- **r musora-web-platform artisan migrate**

### Connecting to Dev Platform:
We have multiple versions of PHP running in our dev environments so you must specify a port to connect to
this unified platform repository's website instead of the legacy brand repositories.

**URL: [https://devplatform.musora.com:8443/](https://devplatform.musora.com:8443/)**

### Connecting To MySQL 8 With phpMyAdmin

Go to the phpMyAdmin url for our local development: [http://localhost:4805/index.php](http://localhost:4805/index.php).  

Log in with these details (you may need to log out if you are already logged in to another mysql version):

- Server: **mysql8**
- Username: **root**
- Password: **root**  

Please note, mysql 8.0 databases are totally separate from the legacy mysql 5.6 databases. They exist on different 
mysql containers.

<br>

# Multi Domain Support

All brand domains/websites such as drumeo.com, pianote.com, etc use this same repository and laravel install
to run. To load these brands using the new musora-web-platform repo you must specify the port and URLs like this:  

[https://devplatform.musora.com:8443/](https://devplatform.musora.com:8443/)  
[https://devplatform.drumeo.com:8443/](https://devplatform.drumeo.com:8443/)  
[https://devplatform.pianote.com:8443/](https://devplatform.pianote.com:8443/)  
[https://devplatform.guitareo.com:8443/](https://devplatform.guitareo.com:8443/)  
[https://devplatform.singeo.com:8443/](https://devplatform.singeo.com:8443/)  

This will load based on the routes defined in the relevant route files for that brand. There are folders for each brand
inside the routes file of this repo. A route can be locked to a given domain like this:

```php
Route::domain('{drumeoDomain}')->group(function () {
    Route::get('/', function () {
        return 'Drumeo only route!';
    });
});
```  

Prototyping is totally domain independent meaning the urls will work with any domain. You instead must separate
your blade files by brand. Currently, in the 'views' folder each brand has its own folder.

**Existing legacy dev URLs are not affected by this. They still work as normal, for example 'https://dev.drumeo.com/'.**

<br>

# Module Design Pattern For Back End
Now that we have a single repository we no longer need to separate our main php system in to separate composer
packages. Instead, we use a 'module' design system.  

[https://techsemicolon.github.io/blog/2019/01/06/laravel-module-pattern/](https://techsemicolon.github.io/blog/2019/01/06/laravel-module-pattern/)  

This pattern achieves a similar level of seperation of logic and solid principals but without need seperate composer 
packages and repositories. Please review the app/Modules folder. We will slowly migrate all of our core php packages
to module in this repository over time.  

Before the launch we are only planning to move over our 'usora' package in to a module called 'UserManagementSystem'.

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


# PHPStorm Automated Testing Settings

### Test Framework
![](https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/f532fe6d-7f49-489e-aa55-2dabeaee5900/public)

### CLI Interpreter
![](https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/e0eb64b1-b163-4626-e217-5ce9d80d7900/public)


# Useful Testing & Seeder Commands

## Seed a users content data with: SeedUserContentData
`artisan SeedUserContentData "{userEmail}"`  
Generates content progress, list additions, coach follows, etc, for the user for testing.  
Example:  
`r mwp artisan SeedUserContentData "caleb@drumeo.com"`


## Seed Live And Schduled Content
`artisan SeedLiveAndScheduledContent --live-now`  
This command adds a bunch content to the 
schedule for all brands. When `--live-now` is added it also sets a currently live event
so you can preview the live stream page.

  
# Creating Test Users
When the correct middleware is enabled (during dev, qa, and for alpha testing) 
you can spin up test users using the login page. Any email and password combination will work. It's recommended to use
the email as the password for testing convenience.
If an account with the 
email you input does not exist, one will automatically be created with the email and password you entered. 
You will be logged in under this new user.
If you enter an email that already exists you must enter the correct password for that user.  


You can use key words in the email to control which use case you would like the user to represent.  
- If the word 'member' is in the email, the new user will be given a valid membership status.
  - For example, you could use: caleb+member1@drumeo.com
- If the word 'expired' is in the email, the new user will be given an expired membership.
  - For example, you could use: caleb+expired1@drumeo.com
- If the word 'pack' is in the email, the new user will be given 2 valid packs and no membership.
  - For example, you could use: caleb+pack1@drumeo.com
   

# Cloud Environments

We have 11 total environments:
- **production** - our primary environment that is live to students
- **pre-production** - for testing large project deployment processes
- **beta-testing** - for beta testing projects to internal staff or students
- **web-staging-one** - for general purpose website testing, review, etc
- **web-staging-two** - for general purpose website testing, review, etc
- **web-staging-three** - for general purpose website testing, review, etc
- **web-staging-four** - for general purpose website testing, review, etc
- **web-staging-five** - for general purpose website testing, review, etc
- **app-staging-one** - for general purpose mobile app API testing, review, etc
- **app-staging-two** - for general purpose mobile app API testing, review, etc
- **app-staging-three** - for general purpose mobile app API testing, review, etc

Each environment deploys a specific branch in the musora-web-platform repository under the same name as the environment
**except for 'production' which deploys the 'master' branch**.

## Web URLs

- [https://www.musora.com/](https://www.musora.com/)
- [https://pre-production.musora.com/](https://pre-production.musora.com/)
- [https://beta-testing.musora.com/](https://beta-testing.musora.com/)
- [https://web-staging-one.musora.com/](https://web-staging-one.musora.com/)
- [https://web-staging-two.musora.com/](https://web-staging-two.musora.com/)
- [https://web-staging-three.musora.com/](https://web-staging-three.musora.com/)
- [https://web-staging-four.musora.com/](https://web-staging-four.musora.com/)
- [https://web-staging-five.musora.com/](https://web-staging-five.musora.com/)
- [https://app-staging-one.musora.com/](https://app-staging-one.musora.com/)
- [https://app-staging-two.musora.com/](https://app-staging-two.musora.com/)
- [https://app-staging-three.musora.com/](https://app-staging-three.musora.com/)

# How To Deploy

## Any Staging/Testing/Beta/Pre Environment
To deploy any environment except production, push to the branch. GitHub actions automatically deploys the branch
anytime new changes are pushed. This usually takes around 5 minutes.

## Production
Merge in to the production branch, same as above.

# How To Run Artisan Commands On Cloud Environments
You can run commands on our staging and other vapor based cloud environments using
the vapor CLI tool. We have already built integration with our 'r' CLI tool.  

First, ensure you have a valid Laravel Vapor API token. Log in to your vapor account and create one here:
[https://vapor.laravel.com/app/account/api-tokens](https://vapor.laravel.com/app/account/api-tokens)  

Then, add your login email and API token (as the password) in your railenvironment credentials/credentials file.  
```bash
laravelVaporEmail="your-login-email@email.com"
laravelVaporPassword="your-api-token"
```  

You should now be able to run any vapor command using the `r` tool from our manager container:
`r vapor` to see a list of all possible commands.  

You can run `r vapor env:list` to check if you are connected to our vapor project properly. You should see a list 
of all our environments.  

To run artisan commands including migrate on any vapor environment use the following command substituting 
'web-staging-one' with whatever environment you wish to run it on:  
`r vapor command web-staging-one --command="php artisan migrate"`

# How To Update Environment Variables On Vapor Cloud Environments

## Overview & Reasoning
Laravel vapor uses AWS Lambda. Lambda has a limitation on how many environment variables can be set for a given 
function/image. You can read about that here: 
[Vapor Env Docs](https://docs.vapor.build/1.0/projects/environments.html#environment-variables)  

Since 4kb of data is too small to house all our environment variables we also use secrets to serve environment variables
to our application. [Vapor Secret Docs](https://docs.vapor.build/1.0/projects/environments.html#secrets)  

Secrets are generally meant for key-value pairs but it costs us money per secret stored in AWS. We use special 
code which allows us to store many env values in a single secret and parse them in our application. Secrets 
also have a length limitation so we also often need to split our environment variables across multiple secrets. These 
secrets look exactly like the .env files we use on in our local development environments and follow the same rules.  

Instead of managing all of these environment variables in lambda/vapor and across multiple secrets manually, we built 
an artisan command line tool to handle it all for us.

If you are curious how we inject the vapor secrets in to our app for usage as environment variables, we use the code 
from here: [Laravel Vapor Extended Secrets](https://atymic.dev/blog/laravel-vapor-extended-secrets/)  

Instead of forking the original repo, we overwrite the vendor file using composer since its was less overhead. See:  

```php
"Laravel\\Vapor\\Runtime\\": "app/VaporCoreClassOverrides"
```

line the root composer.json file. The file we overwrite is: `app/VaporCoreClassOverrides/Secrets.php`  

## How To Use The CLI/Artisan Tool

### Requirements
You must have the laravelVaporEmail and laravelVaporPassword variables set in your railenvironment 
credentials/credentials file.

### Command
```
VaporEnvManager {environment} {pushOrPull}
```

### Pulling The Environment Variables
To edit the environment variables for a given environment, you must pull them to your machine in to a file for easy 
editing. Example: (all examples use our r tool, you would need to use `php artisan` otherwise):

```
r mwp artisan VaporEnvManager production pull
```

This will create a file on your machine under this repository root folder named `.env.full.production`  
You can then edit this file to change the environment variables. Please always pull the latest environment variables 
using the pull command before updating and pushing changes.

Once you are done editing and have saved the file, update the environment variables on the cloud server using the 
push parameter. Example:

```
r mwp artisan VaporEnvManager production push
```

Once the command completes, everything is updated in the cloud and you must deploy the environment for the new 
environments variables to take effect.  

Other examples:
```
r mwp artisan VaporEnvManager beta-testing pull
# edit the .env.full.beta-testing file
r mwp artisan VaporEnvManager beta-testing push
```
```
r mwp artisan VaporEnvManager web-staging-one pull
# edit the .env.full.web-staging-one file
r mwp artisan VaporEnvManager web-staging-one push
```

**Important Note**  
Environment variables are highly sensitive and need to stay secure. Please do not ever commit these .env files or share
them. They should be deleted from your machine after updates are pushed.

# How To Update Staging/Vapor Environments Databases From Production Data

Use the r command 'update-databases'. Example:  
```
r mwp update-databases
```
Then enter the corresponding environment number you want to be updated with production data.

# Emails and Testing Emails
All non-production environment emails sent by our system go to our mailtrap account and email address be default:
[https://mailtrap.io/inboxes/1620451/messages](https://mailtrap.io/inboxes/1620451/messages)
This mailtrap receiving email address is the only verified email that we can send to from our SES account for 
non-production environments. This prevents accidentally sending emails to students from staging/testing environments.

Emails for all environments including production are sent through AWS SES in the us-east-2 region.

# Logging

Production laravel logs are sent to our papertrail account: 
[https://my.papertrailapp.com/groups/36174881/events](https://my.papertrailapp.com/groups/36174881/events)  

PHP or lower level logs are in cloudwatch/vapor.

Other environments are being added to papertrial in the near future.

## Local

Run `r logs {container-id}` from within railenvmanager, specifing the php8 apache container.

Get the container id of the apache-php-fpm-8 container by running this (in railenvmanager container):

```
docker ps | grep 'apache-php-fpm-8'
```

That'll return something like this:

```
90b0bd123eb0   railenvironment_docker_apache-php-fpm-8      "/entrypoint /bin/ba…"   7 hours ago    Up 4 hours   9000/tcp, 9100/tcp, 0.0.0.0:8880->80/tcp, :::8880->80/tcp, 0.0.0.0:8222->222/tcp, :::8222->222/tcp, 0.0.0.0:8443->443/tcp, :::8443->443/tcp   railenvironmentdocker_apache-php-fpm-8
```

Then to view the logs for that that you can run (in railenvmanager container):

```
docker logs 90b0bd123eb0
```

Or because you don't need the entire id, just enough to differentiate it from other containers, this would probably do:

```
docker logs 90b0
```

# Image CDN Uploading, Serving, and Formatting 

We use the Cloudflare Images service to manage all our images.    

## Uploading New Images
New images can be uploaded from the cloudflare console at:   
[https://dash.cloudflare.com/13b43223393c313ed5db36bcc2138a95/images/images](https://dash.cloudflare.com/13b43223393c313ed5db36bcc2138a95/images/images)

Once you upload an image please use the musora.com domain instead of the cloudflare default domain for the source image.  

```
https://imagedelivery.net/*
```

Should be changed to:  
```
https://musora.com/cdn-cgi/imagedelivery/*
```

Example:  
```
https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/e275983d-455d-43af-6c8a-f1e62bda7500/public
to
https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/e275983d-455d-43af-6c8a-f1e62bda7500/public
```

## Serving & Formatting Images
All images **from any source** must be served through the cloudflare image CDN. You can put any image URL at the end 
of our CDN url to serve it from our cloudflare CDN.  

[Formatting Options Docs](https://developers.cloudflare.com/images/image-resizing/url-format/)

URL Structure:  
```
https://musora.com/cdn-cgi/image/FORMATTING_OPTIONS/FULL_SOURCE_IMAGE_URL
```

Examples:  
```
https://musora.com/cdn-cgi/image/width=100,height=100,quality=85/https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/e275983d-455d-43af-6c8a-f1e62bda7500/public
```  
```
https://musora.com/cdn-cgi/image/width=100,height=100,quality=85/https://s3.amazon.com/my-image.jpeg
```  


# Login As A User

Log in with an authorized account (in incog or another session), 
then use this URL and swap in the user of the account you wish to log in to:
```
https://www.musora.com/user-management-system/login-as-user/USER_ID
```
