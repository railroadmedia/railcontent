# Onboarding apis for each step:

For gears, topics, genres and experience, data can be found by calling the following attributes on the user object:

```php
    user()->onboardingGears;
    user()->onboardingTopics;
    user()->onboardingGenres;
    user()->onboardingExperience;
```

## 1 ABOUT

- check if {{ user()->display_name }} exists; 

if exists: go to next page

else: show the page

when pressing 'next button':
**`POST /user_management_system/user/update/{user_id}`**

```php
['display_name' => 'required']
```

## 2 INSTRUMENT
- if user comes from step one, let the user choose the instrument
- if user comes from web app and the brand is already selected, jump this step
- no api call needed

## 3 GEARS

- check if {{ user()->onboardingGears }} returns at least a gear from the selected brand

if it returns: go to next step

if it does not return: show the gears step

when pressing 'next button':

**`POST /user_management_system/onboarding-gears`**

```php
[
    'data[0]' => 'required',
    'data[1]' => '',
    'data[2]' => '',
...
];
```
('data' parameter is an array with all the gears values selected)


## 4 EXPERIENCE

- check if {{ user()->onboardingExperience }} returns the experience object for the selected brand

if it returns: go to next step

if it does not return: show the experience step

when pressing 'next button':

**`POST /user_management_system/onboarding-experience`**

```php
['experience_level' => 'required|[0-3]'];
```
('experience_level' parameter must take one of the following values: [0,1,2,3])



## 5 GENRES

- check if {{ user()->onboardingGenres }} returns at least a genre from the selected brand

if it returns: go to next step

if it does not return: show the genres step

when pressing 'next button':

**`POST /user_management_system/onboarding-genres`**

```php
[
    'data[0]' => 'required',
    'data[1]' => '',
    'data[2]' => '',
...
];
```
('data' parameter is an array with all the genres values selected)

## 6 TOPICS 

- check if {{ user()->onboardingTopics }} returns at least a topic from the selected brand

if it returns: go to next step

if it does not return: show the topics step

when pressing 'next button':

**`POST /user_management_system/onboarding-topics`**

```php
[
    'data[0]' => 'required',
    'data[1]' => '',
    'data[2]' => '',
...
];
```
('data' parameter is an array with all the topics values selected)


## 7 COACHES

Search for coaches based on brand and show the results:

**`GET railcontent/content?brand=${brand}&limit=18&statuses[]=published&sort=-published_on&required_fields[]=is_coach,1&page=1${term ? '&term='+term : ''}`)`**


When bell is clicked, follow new coach:
**`POST railcontent/content/follow`**

```php
['content_id' => 'required'];
```
