<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class ContentDatumUpdateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'contentData'. Example: contentData
 * @bodyParam data.attributes.key string   The data key. Example: description
 * @bodyParam data.attributes.value string   Data value.  Example: indsf fdgg  gfg
 * @bodyParam data.attributes.position integer The position of this datum relative to other datum with the same key under the same content id.
 * @bodyParam data.relationships.content.data.type string   Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer   Must exists in contents. Example: 1
 */
class ContentDatumUpdateRequest extends CustomFormRequest
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
                'data.attributes.key' => 'max:255',
                'data.attributes.position' => 'nullable|numeric|min:0'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

        //get all the rules for the request
        return parent::rules();
    }

    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'data.attributes.key',
                    'data.attributes.value',
                    'data.attributes.position'
                ]
            );
    }
}