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

For example, if a user loads 'musora.com/drumeo/courses', then they close their browser
