# Content API

# JSON Endpoints


<!-- START_61bfda18a7d18e87c48fe08c708c8abe -->
## railcontent/content

### HTTP Request
    `OPTIONS railcontent/content`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (500):

```json
{
    "message": "Server Error"
}
```




<!-- END_61bfda18a7d18e87c48fe08c708c8abe -->

<!-- START_d33050309856c95cc17d90bb91fbca9c -->
## railcontent/content

### HTTP Request
    `GET railcontent/content`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [],
    "meta": {
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0
        }
    },
    "links": {
        "self": "http:\/\/localhost\/railcontent\/content?page=1",
        "first": "http:\/\/localhost\/railcontent\/content?page=1",
        "last": "http:\/\/localhost\/railcontent\/content?page=0"
    }
}
```




<!-- END_d33050309856c95cc17d90bb91fbca9c -->

<!-- START_5749008282f838b8688849041825f55a -->
## Pull the children contents for the parent id


### HTTP Request
    `GET railcontent/content/parent/{parentId}`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/parent/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "slug": null,
            "type": null,
            "sort": 0,
            "status": null,
            "brand": null,
            "language": null,
            "user": "",
            "publishedOn": null,
            "archivedOn": null,
            "createdOn": null,
            "difficulty": null,
            "homeStaffPickRating": null,
            "legacyId": null,
            "legacyWordpressPostId": null,
            "qnaVideo": null,
            "style": null,
            "title": null,
            "xp": null,
            "album": null,
            "artist": null,
            "bpm": null,
            "cdTracks": null,
            "chordOrScale": null,
            "difficultyRange": null,
            "episodeNumber": null,
            "exerciseBookPages": null,
            "fastBpm": null,
            "includesSong": false,
            "instructors": null,
            "liveEventStartTime": null,
            "liveEventEndTime": null,
            "liveEventYoutubeId": null,
            "liveStreamFeedType": null,
            "name": null,
            "released": null,
            "slowBpm": null,
            "totalXp": null,
            "transcriberName": null,
            "week": null,
            "avatarUrl": null,
            "lengthInSeconds": null,
            "soundsliceSlug": null,
            "staffPickRating": null,
            "studentId": null,
            "vimeoVideoId": null,
            "youtubeVideoId": null
        }
    }
}
```




<!-- END_5749008282f838b8688849041825f55a -->

<!-- START_e55b02d4c8dd5d9849bcb5ea9764baa7 -->
## Pull the contents based on ids


### HTTP Request
    `GET railcontent/content/get-by-ids`


### Permissions
    - pull.contents required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/get-by-ids',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": [
        {
            "type": null,
            "id": "",
            "attributes": {
                "slug": null,
                "type": null,
                "sort": 0,
                "status": null,
                "brand": null,
                "language": null,
                "user": "",
                "publishedOn": null,
                "archivedOn": null,
                "createdOn": null,
                "difficulty": null,
                "homeStaffPickRating": null,
                "legacyId": null,
                "legacyWordpressPostId": null,
                "qnaVideo": null,
                "style": null,
                "title": null,
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        },
        {
            "type": null,
            "id": "",
            "attributes": {
                "slug": null,
                "type": null,
                "sort": 0,
                "status": null,
                "brand": null,
                "language": null,
                "user": "",
                "publishedOn": null,
                "archivedOn": null,
                "createdOn": null,
                "difficulty": null,
                "homeStaffPickRating": null,
                "legacyId": null,
                "legacyWordpressPostId": null,
                "qnaVideo": null,
                "style": null,
                "title": null,
                "xp": null,
                "album": null,
                "artist": null,
                "bpm": null,
                "cdTracks": null,
                "chordOrScale": null,
                "difficultyRange": null,
                "episodeNumber": null,
                "exerciseBookPages": null,
                "fastBpm": null,
                "includesSong": false,
                "instructors": null,
                "liveEventStartTime": null,
                "liveEventEndTime": null,
                "liveEventYoutubeId": null,
                "liveStreamFeedType": null,
                "name": null,
                "released": null,
                "slowBpm": null,
                "totalXp": null,
                "transcriberName": null,
                "week": null,
                "avatarUrl": null,
                "lengthInSeconds": null,
                "soundsliceSlug": null,
                "staffPickRating": null,
                "studentId": null,
                "vimeoVideoId": null,
                "youtubeVideoId": null
            }
        }
    ]
}
```




<!-- END_e55b02d4c8dd5d9849bcb5ea9764baa7 -->

<!-- START_590f05a5a1b2df09a96398373df36802 -->
## railcontent/content/{id}

### HTTP Request
    `GET railcontent/content/{id}`


### Permissions

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "slug": null,
            "type": null,
            "sort": 0,
            "status": null,
            "brand": null,
            "language": null,
            "user": "",
            "publishedOn": null,
            "archivedOn": null,
            "createdOn": null,
            "difficulty": null,
            "homeStaffPickRating": null,
            "legacyId": null,
            "legacyWordpressPostId": null,
            "qnaVideo": null,
            "style": null,
            "title": null,
            "xp": null,
            "album": null,
            "artist": null,
            "bpm": null,
            "cdTracks": null,
            "chordOrScale": null,
            "difficultyRange": null,
            "episodeNumber": null,
            "exerciseBookPages": null,
            "fastBpm": null,
            "includesSong": false,
            "instructors": null,
            "liveEventStartTime": null,
            "liveEventEndTime": null,
            "liveEventYoutubeId": null,
            "liveStreamFeedType": null,
            "name": null,
            "released": null,
            "slowBpm": null,
            "totalXp": null,
            "transcriberName": null,
            "week": null,
            "avatarUrl": null,
            "lengthInSeconds": null,
            "soundsliceSlug": null,
            "staffPickRating": null,
            "studentId": null,
            "vimeoVideoId": null,
            "youtubeVideoId": null
        }
    }
}
```




<!-- END_590f05a5a1b2df09a96398373df36802 -->

<!-- START_041a3bcbff15a33078ad0fc39db6ceda -->
## Create a new content


### HTTP Request
    `PUT railcontent/content`


### Permissions
    - Must be logged in
    - Must have the create.content permission to create
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'content'.|
|body|data.attributes.slug|    ||
|body|data.attributes.type|  yes  ||
|body|data.attributes.status|  yes  ||
|body|data.attributes.language|    |default:'en-US'.|
|body|data.attributes.sort|    ||
|body|data.attributes.published_on|    ||
|body|data.attributes.created_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.parent.data.type|    |Must be 'content'.|
|body|data.relationships.parent.data.id|    |Must exists in contents.|
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:content',",
    "                'data.attributes.status' => 'max:64|required|in:' . implode(",
    "                        ',',",
    "                        [",
    "                            ContentService::STATUS_DRAFT,",
    "                            ContentService::STATUS_PUBLISHED,",
    "                            ContentService::STATUS_ARCHIVED,",
    "                            ContentService::STATUS_SCHEDULED,",
    "                            ContentService::STATUS_DELETED,",
    "                        ]",
    "                    ),",
    "                'data.attributes.type' => 'required|max:64',",
    "                'data.attributes.slug' => 'max:255',",
    "                'data.attributes.sort' => 'nullable|numeric',",
    "                'data.attributes.position' => 'nullable|numeric|min:0',",
    "                'data.attributes.published_on' => 'nullable|date',",
    "                'data.relationships.parent.data.type' => 'nullable|in:content',",
    "                'data.relationships.user.data.type' => 'nullable|in:user',",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules based on content type and brand",
    "        $this->setCustomRules($this);",
    "",
    "        return parent::rules();"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content',
{
    "data": {
        "type": "content",
        "attributes": {
            "slug": "01-getting-started",
            "type": "course",
            "status": "draft",
            "language": "en-US",
            "sort": 0,
            "published_on": "null",
            "created_on": "eaque",
            "archived_on": "neque",
            "fields": [],
            "brand": "brand"
        },
        "relationships": {
            "parent": {
                "data": {
                    "type": "content",
                    "id": 1
                }
            },
            "user": {
                "data": {
                    "type": "user",
                    "id": 1
                }
            }
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
    "data": {
        "type": null,
        "id": "",
        "attributes": {
            "slug": null,
            "type": null,
            "sort": 0,
            "status": null,
            "brand": null,
            "language": null,
            "user": "",
            "publishedOn": null,
            "archivedOn": null,
            "createdOn": null,
            "difficulty": null,
            "homeStaffPickRating": null,
            "legacyId": null,
            "legacyWordpressPostId": null,
            "qnaVideo": null,
            "style": null,
            "title": null,
            "xp": null,
            "album": null,
            "artist": null,
            "bpm": null,
            "cdTracks": null,
            "chordOrScale": null,
            "difficultyRange": null,
            "episodeNumber": null,
            "exerciseBookPages": null,
            "fastBpm": null,
            "includesSong": false,
            "instructors": null,
            "liveEventStartTime": null,
            "liveEventEndTime": null,
            "liveEventYoutubeId": null,
            "liveStreamFeedType": null,
            "name": null,
            "released": null,
            "slowBpm": null,
            "totalXp": null,
            "transcriberName": null,
            "week": null,
            "avatarUrl": null,
            "lengthInSeconds": null,
            "soundsliceSlug": null,
            "staffPickRating": null,
            "studentId": null,
            "vimeoVideoId": null,
            "youtubeVideoId": null
        }
    }
}
```




<!-- END_041a3bcbff15a33078ad0fc39db6ceda -->

<!-- START_5828f7048c0cc2858373a9cf44c55e02 -->
## Update a content based on content id and return it in JSON format


### HTTP Request
    `PATCH railcontent/content/{contentId}`


### Permissions
    - Must be logged in
    - Must have the update.content permission to update
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|query|content_id|  yes  ||
|body|data.type|  yes  |Must be 'content'.|
|body|data.attributes.slug|    ||
|body|data.attributes.type|    ||
|body|data.attributes.status|    ||
|body|data.attributes.language|    |en-US|
|body|data.attributes.sort|    ||
|body|data.attributes.published_on|    ||
|body|data.attributes.archived_on|    ||
|body|data.attributes.fields|    ||
|body|data.attributes.brand|    ||
|body|data.relationships.user.data.type|    |Must be 'user'.|
|body|data.relationships.user.data.id|    |Must exists in user.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        \/\/set the general validation rules",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:content',",
    "                'data.attributes.status' => 'max:64|in:' .",
    "                    implode(",
    "                        ',',",
    "                        [",
    "                            ContentService::STATUS_DRAFT,",
    "                            ContentService::STATUS_PUBLISHED,",
    "                            ContentService::STATUS_ARCHIVED,",
    "                            ContentService::STATUS_SCHEDULED,",
    "                            ContentService::STATUS_DELETED,",
    "                        ]",
    "                    ),",
    "                'data.attributes.type' => 'max:64',",
    "                'data.attributes.sort' => 'nullable|numeric',",
    "                'data.attributes.position' => 'nullable|numeric|min:0',",
    "                'data.attributes.published_on' => 'nullable|date'",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules based on content type and brand",
    "        $this->setCustomRules($this);",
    "",
    "        \/\/get the validation rules",
    "        return parent::rules();"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
{
    "data": {
        "type": "content",
        "attributes": {
            "slug": "01-getting-started",
            "type": "course",
            "status": "draft",
            "language": "harum",
            "sort": 0,
            "published_on": "null",
            "archived_on": "impedit",
            "fields": "",
            "brand": "brand"
        },
        "relationships": {
            "user": {
                "data": {
                    "type": "user",
                    "id": 1
                }
            }
        }
    }
}
   ,
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.type",
            "detail": "The type field is required."
        }
    ]
}
```




<!-- END_5828f7048c0cc2858373a9cf44c55e02 -->

<!-- START_6db1e06526b714b35026eddcf5e1efb9 -->
## Call the delete method if the content exist


### HTTP Request
    `DELETE railcontent/content/{id}`


### Permissions
    - delete.content required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (404):

```json
{}
```




<!-- END_6db1e06526b714b35026eddcf5e1efb9 -->

<!-- START_cd36dc2623a54c340f0bc0db37986ba8 -->
## Call the soft delete method if the content exist


### HTTP Request
    `DELETE railcontent/soft/content/{id}`


### Permissions
    - delete.content required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|


### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/soft/content/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, content not found with id: 1"
    }
}
```




<!-- END_cd36dc2623a54c340f0bc0db37986ba8 -->

