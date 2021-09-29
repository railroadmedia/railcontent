<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Validation\Rule;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentUpdateRequest extends CustomFormRequest
{
    protected $generalRules;

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
                'status' => 'max:64|in:' .
                    implode(
                        ',',
                        [
                            ContentService::STATUS_DRAFT,
                            ContentService::STATUS_PUBLISHED,
                            ContentService::STATUS_ARCHIVED,
                            ContentService::STATUS_SCHEDULED,
                            ContentService::STATUS_DELETED,
                        ]
                    ),
                'type' => 'required_with:slug|max:64',
                'brand' => 'required_with:slug',
                'slug' => [
                    'nullable',
                    Rule::unique(ConfigService::$databaseConnectionName . '.' . ConfigService::$tableContent)
                        ->where('brand',$this->get('brand','drumeo'))
                        ->where('type',$this->get('type','live'))
                        ->ignore($this->id)
                ],
                'sort' => 'nullable|numeric',
                'position' => 'nullable|numeric|min:0',
                'parent_id' => 'nullable|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'published_on' => 'nullable|date'
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        //get the validation rules
        return parent::rules();
    }
}
