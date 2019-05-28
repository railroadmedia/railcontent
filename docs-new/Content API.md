---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/../../../docs-new/collection.json)

<!-- END_INFO -->

<!-- START_61bfda18a7d18e87c48fe08c708c8abe -->
## railcontent/content
> Example request:

```bash
curl -X OPTIONS "http://localhost/railcontent/content" 
```
```javascript
const url = new URL("http://localhost/railcontent/content");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "OPTIONS",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`OPTIONS railcontent/content`


<!-- END_61bfda18a7d18e87c48fe08c708c8abe -->

<!-- START_d33050309856c95cc17d90bb91fbca9c -->
## railcontent/content
> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/content" 
```
```javascript
const url = new URL("http://localhost/railcontent/content");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

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

### HTTP Request
`GET railcontent/content`


<!-- END_d33050309856c95cc17d90bb91fbca9c -->

<!-- START_5749008282f838b8688849041825f55a -->
## Pull the children contents for the parent id

> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/content/parent/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/parent/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

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

### HTTP Request
`GET railcontent/content/parent/{parentId}`


<!-- END_5749008282f838b8688849041825f55a -->

<!-- START_e55b02d4c8dd5d9849bcb5ea9764baa7 -->
## Pull the contents based on ids

> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/content/get-by-ids" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/get-by-ids");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

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

### HTTP Request
`GET railcontent/content/get-by-ids`


<!-- END_e55b02d4c8dd5d9849bcb5ea9764baa7 -->

<!-- START_590f05a5a1b2df09a96398373df36802 -->
## railcontent/content/{id}
> Example request:

```bash
curl -X GET -G "http://localhost/railcontent/content/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

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

### HTTP Request
`GET railcontent/content/{id}`


<!-- END_590f05a5a1b2df09a96398373df36802 -->

<!-- START_041a3bcbff15a33078ad0fc39db6ceda -->
## Create a new content and return it in JSON format

> Example request:

```bash
curl -X PUT "http://localhost/railcontent/content" 
```
```javascript
const url = new URL("http://localhost/railcontent/content");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (422):

```json
{
    "errors": [
        {
            "title": "Validation failed.",
            "source": "data.attributes.status",
            "detail": "The status field is required."
        },
        {
            "title": "Validation failed.",
            "source": "data.attributes.type",
            "detail": "The type field is required."
        }
    ]
}
```

### HTTP Request
`PUT railcontent/content`


<!-- END_041a3bcbff15a33078ad0fc39db6ceda -->

<!-- START_5828f7048c0cc2858373a9cf44c55e02 -->
## Update a content based on content id and return it in JSON format

> Example request:

```bash
curl -X PATCH "http://localhost/railcontent/content/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Update failed, content not found with id: 1"
    }
}
```

### HTTP Request
`PATCH railcontent/content/{contentId}`


<!-- END_5828f7048c0cc2858373a9cf44c55e02 -->

<!-- START_6db1e06526b714b35026eddcf5e1efb9 -->
## Call the delete method if the content exist

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/content/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/content/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (404):

```json
{}
```

### HTTP Request
`DELETE railcontent/content/{id}`


<!-- END_6db1e06526b714b35026eddcf5e1efb9 -->

<!-- START_cd36dc2623a54c340f0bc0db37986ba8 -->
## Call the soft delete method if the content exist

> Example request:

```bash
curl -X DELETE "http://localhost/railcontent/soft/content/1" 
```
```javascript
const url = new URL("http://localhost/railcontent/soft/content/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, content not found with id: 1"
    }
}
```

### HTTP Request
`DELETE railcontent/soft/content/{id}`


<!-- END_cd36dc2623a54c340f0bc0db37986ba8 -->

