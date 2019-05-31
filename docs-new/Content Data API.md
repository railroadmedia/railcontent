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

```bash
curl -X PUT "http://localhost/railcontent/content/datum" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentData","attributes":{"key":"description","value":"indsf fdgg  gfg","position":4},"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```

### Response Example (500):

```json
{
    "message": "Server Error"
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

```bash
curl -X PATCH "http://localhost/railcontent/content/datum/1" \
    -H "Content-Type: application/json" \
    -d '{"data":{"type":"contentData","attributes":{"key":"description","value":"indsf fdgg  gfg","position":2},"relationships":{"content":{"data":{"type":"content","id":1}}}}}'

```

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Update failed, datum not found with id: 1"
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

```bash
curl -X DELETE "http://localhost/railcontent/content/datum/1" 
```

### Response Example (404):

```json
{
    "errors": {
        "title": "Not found.",
        "detail": "Delete failed, datum not found with id: 1"
    }
}
```




<!-- END_a4137a74763de18a36fc0ff882de62d3 -->

