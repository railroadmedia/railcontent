<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class ContentDatumCreateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'contentData'. Example: contentData
 * @bodyParam data.attributes.key string required  The data key. Example: description
 * @bodyParam data.attributes.value string  required Data value.  Example: indsf fdgg  gfg
 * @bodyParam data.attributes.position integer The position of this datum relative to other datum with the same key under the same content id.
 * @bodyParam data.relationships.content.data.type string required  Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer required  Must exists in contents. Example: 1
 */
class ContentDatumCreateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->validateContent($this);

        //set the general validation rules
        $this->setGeneralRules(
            [
                'data.type' => 'in:contentData',
                'data.attributes.key' => 'required|max:255',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.relationships.content.data.id' => 'required|numeric|exists:' .
                    config('railcontent.table_prefix') .
                    'content' .
                    ',id',
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

        //get all the rules for the request
        return parent::rules();
    }
}