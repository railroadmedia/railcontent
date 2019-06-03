# Content Data API

# JSON Endpoints


<!-- START_2897a4200e3365f16bdc09c4a556e35c -->
## Call the method from service that create new data and link the content with the data.


### HTTP Request
    `PUT railcontent/content/datum`


### Permissions
    - create.content.data required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentData'.|
|body|data.attributes.key|  yes  |The data key.|
|body|data.attributes.value|  yes  |Data value. |
|body|data.attributes.position|    |The position of this datum relative to other datum with the same key under the same content id.|
|body|data.relationships.content.data.type|  yes  |Must be 'content'.|
|body|data.relationships.content.data.id|  yes  |Must exists in contents.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        \/\/set the general validation rules",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:contentData',",
    "                'data.attributes.key' => 'required|max:255',",
    "                'data.attributes.position' => 'nullable|numeric|min:0',",
    "                'data.relationships.content.data.type' => 'required|in:content',",
    "                'data.relationships.content.data.id' => 'required|numeric|exists:' .",
    "                    config('railcontent.table_prefix') .",
    "                    'content' .",
    "                    ',id',",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules",
    "        $this->setCustomRules($this, 'datum');",
    "",
    "        \/\/get all the rules for the request",
    "        return parent::rules();"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum',
{
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 10
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
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
        "type": "contentData",
        "id": "1",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 0
        }
    }
}
```




<!-- END_2897a4200e3365f16bdc09c4a556e35c -->

<!-- START_fb363b9c870922ffa55b96a23cd5a425 -->
## Call the method from service to update a content datum


### HTTP Request
    `PATCH railcontent/content/datum/{datumId}`


### Permissions
    - update.content.data required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|data.type|  yes  |Must be 'contentData'.|
|body|data.attributes.key|    |The data key.|
|body|data.attributes.value|    |Data value. |
|body|data.attributes.position|    |The position of this datum relative to other datum with the same key under the same content id.|
|body|data.relationships.content.data.type|    |Must be 'content'.|
|body|data.relationships.content.data.id|    |Must exists in contents.|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        \/\/set the general validation rules",
    "        $this->setGeneralRules(",
    "            [",
    "                'data.type' => 'required|in:contentData',",
    "                'data.attributes.key' => 'max:255',",
    "                'data.attributes.position' => 'nullable|numeric|min:0'",
    "            ]",
    "        );",
    "",
    "        \/\/set the custom validation rules",
    "        $this->setCustomRules($this, 'datum');",
    "",
    "        \/\/get all the rules for the request",
    "        return parent::rules();"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum/1',
{
    "data": {
        "type": "contentData",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 10
        },
        "relationships": {
            "content": {
                "data": {
                    "type": "content",
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

### Response Example (201):

```json
{
    "data": {
        "type": "contentData",
        "id": "1",
        "attributes": {
            "key": "description",
            "value": "indsf fdgg  gfg",
            "position": 0
        }
    }
}
```




<!-- END_fb363b9c870922ffa55b96a23cd5a425 -->

<!-- START_a4137a74763de18a36fc0ff882de62d3 -->
## Call the method from service to delete the content data


### HTTP Request
    `DELETE railcontent/content/datum/{datumId}`


### Permissions
    - delete.content.data required
    
### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|

### Validation Rules
```php
[
    "        $this->validateContent($this);",
    "",
    "        \/\/get all the validation rules that apply to the request",
    "        return parent::rules();"
]
```

### Request Example:

```js
$.ajax({
    url: 'https://www.domain.com' +
             '/railcontent/content/datum/1',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (204):

```json
null
```




<!-- END_a4137a74763de18a36fc0ff882de62d3 -->

