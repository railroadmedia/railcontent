# Brand Functionality & Logic

## Storage

There are 3 layers that store the users current and last used brand:  
- In the devices cookie
- In our redis cache
- In our database in that users' database row under column 'last_used_brand'

## Logic

When a user logs in for the first time we send them through onboarding where they choose an instrument. This set 
the correct brand value in all 3 layers.  

After that step, the last used brand is set anytime the user accesses a brand relevant page. For example all of our 
main routing uses 'musora.com/{BRAND}/page'. As soon as a user lands on any url with a brand as the first path 
section, the last used brand is set on all 3 layers to that brand.  

For example, if a user loads 'musora.com/drumeo/courses', then they log out, once they log back in, they will 
automatically be sent to 'musora.com/drumeo'.  

If that same user were to log in on a new device, they would also automatically be sent to 'musora.com/drumeo'.

A user can be sent to 'musora.com/members' and the system will automatically redirect them to the correct brands 
home page.  

Please review URL structure here: [web-url-structure.md](/docs/web-url-structure.md)

## Functions & Code
You can access the current brand for any given web request using this PHP function:

```php
$currentBrand = brand();
```

Generally this value will equal the first section of the URL path.
