# Onboarding apis for each step:

For gear, topics, genres and experience, data can be found by calling the following attributes on the user object:

```php
    user()->onboardingGear;
    user()->onboardingTopics;
    user()->onboardingGenres;
    user()->onboardingExperience;
```

## 1 ABOUT

- check if {{ user()->display_name }} exists; 

if exists: go to next page

else: show the page

when pressing 'next button':
**`POST /user-management-system/user/update/{user_id}`**

```php
['display_name' => 'required']
```

## 2 INSTRUMENT
- if user comes from step one, let the user choose the instrument
- if user comes from web app and the brand is already selected, jump this step
- no api call needed

## 3 GEAR

- check if {{ user()->onboardingGear }} returns at least a gear from the selected brand

if it returns: go to next step

if it does not return: show the gear step

when pressing 'next button':

**`POST /user-management-system/onboarding-gears`**

```php
[
    'brand'   => 'required',
    'data[0]' => 'required',
    'data[1]' => '',
    'data[2]' => '',
...
];
```
('data' parameter is an array with all the gear values selected)

<a href="https://red-shadow-611407.postman.co/workspace/Team-Workspace~38bb093f-0978-4a83-8423-944a3c78fd51/request/9725390-a64d3e6f-cc0f-489a-b021-11cacf3c7846"  target="_blank" style="float:right;">
<img width="120px" src="https://images.ctfassets.net/1wryd5vd9xez/1sHuHRROdF7ifCjy4QKVXk/a44e85c6138dbe13126c4ede8650cf29/https___cdn-images-1.medium.com_max_2000_1_O0OZO4m6nbwwnYAtkSQO0g.png"/>
</a>

## 4 EXPERIENCE

- check if {{ user()->onboardingExperience }} returns the experience object for the selected brand

if it returns: go to next step

if it does not return: show the experience step

when pressing 'next button':

**`POST /user-management-system/onboarding-experience`**

```php
[
    'brand' => 'required',
    'experience_level' => 'required|[0-3]'
];
```
('experience_level' parameter must take one of the following values: [0,1,2,3])

<a href="https://red-shadow-611407.postman.co/workspace/Team-Workspace~38bb093f-0978-4a83-8423-944a3c78fd51/request/9725390-f6bda40a-171d-4389-aa2e-d63390713ee6"  target="_blank" style="float:right;">
<img width="120px" src="https://images.ctfassets.net/1wryd5vd9xez/1sHuHRROdF7ifCjy4QKVXk/a44e85c6138dbe13126c4ede8650cf29/https___cdn-images-1.medium.com_max_2000_1_O0OZO4m6nbwwnYAtkSQO0g.png"/>
</a>


## 5 GENRES

- check if {{ user()->onboardingGenres }} returns at least a genre from the selected brand

if it returns: go to next step

if it does not return: show the genres step

when pressing 'next button':

**`POST /user-management-system/onboarding-genres`**

```php
[
    'brand'   => 'required',
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

**`POST /user-management-system/onboarding-topics`**

```php
[
    'brand'   => 'required',
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


## 8 SKIP ACCOUNT SETUP

During onboarding process, once the brand is selected, the user can press 'SKIP ACCOUNT SETUP' button:
This will set the user attribute [brand]_onboarding_skip_setup to 'true'

**`POST /user-management-system/onboarding-skip-account-setup`**

```php
[
    'brand' => 'string|required',
    'skip' => 'boolean|required'
];
```

The response will return the user json, together with the updated value. So if user()->pianote_onboarding_skip_setup == true, then 'Complete your account' div must be hidden on pianote.


## 9 ONBOARDING ANSWER HISTORY INSTRUMENT

When the instrument is selected during the onboarding process, the onboarding answer history instrument request is also called.
We are using it to story historical data about the options chosen by the user during the onboarding process.

**`GET /user-management-system/onboarding-answer-history-instrument?instrument=${instrument}`**

```php
[
    'instrument' => 'string|required|possible-values:[drums, guitar, singing, piano]',
];
```

The response will return a json with a 200 code in case of success.

## 10 ONBOARDING ANSWER HISTORY COACH

When the user subscribes to a coach during the onboarding process, the onboarding answer history coach request is also called.
We are using it to store historical data about the options chosen by the user during the onboarding process.


**`GET /user-management-system/onboarding-answer-history-coach?coachName=${coachName}&coachId=${coachId}`**

```php
[
    'coachName' => 'string|required',
    'coachId' => 'int|required
];
```

The response will return a json with a 200 code in case of success.
