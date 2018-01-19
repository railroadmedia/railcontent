<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

/** Custom Form Request that contain the validation logic for the CMS.
 * There are:
 *      general rules - are the same for all the brands and content types
 *      custom rules - are defined by the developers in the configuration file and are defined per brand and content type
 *
 * Class FormRequest
 *
 * @package Railroad\Railcontent\Requests
 */
class CustomFormRequest extends FormRequest
{
    /**
     * @var array $generalRules
     */
    protected $generalRules = [];

    /**
     * @var array $customRules
     */
    protected $customRules = [];

    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * ValidationService constructor.
     *
     * @param $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /** Get the general validation rules and the custom validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = array_merge($this->generalRules, $this->customRules);

        return $rules;
    }

    /** Set general rules
     *
     * @param array $rules
     */
    public function setGeneralRules(array $rules)
    {
        $this->generalRules = $rules;
    }

    /** Set the validation custom rules defined in the configuration file per brand and content type
     *
     * @param CustomFormRequest $request - the requests
     * @param null|string $entity - can be null, 'fields' or 'datum'
     *
     * @return array $customRules
     */
    public function setCustomRules($request, $entity = null)
    {
        $customRules = [];
        $contentType = $this->getContentTypeVal($request, $entity);

        // Differentiate between `Create` and `Update` Requests. Each requires it's own rule-set
        // or just determine which fields are present|submitted in the request and evaluation only for those.

        switch(get_class($request)){

            // ------ Content --------------------------
            case ContentCreateRequest::class:

                break;
            case ContentUpdateRequest::class:

                break;

            // ------ ContentHierarchy -----------------
            case ContentHierarchyCreateRequest::class:

                break;
            case ContentHierarchyUpdateRequest::class:

                break;

            // ------ ContentDatum ---------------------
            case ContentDatumCreateRequest::class:

                break;
            case ContentDatumUpdateRequest::class:

                break;

            // ------ ContentField ---------------------
            case ContentFieldCreateRequest::class:

                break;
            case ContentFieldUpdateRequest::class:

                break;

        };

        if (isset(ConfigService::$validationRules[ConfigService::$brand]) &&
            array_key_exists($contentType, ConfigService::$validationRules[ConfigService::$brand])) {
            if (!$entity) {
                $customRules = ConfigService::$validationRules[ConfigService::$brand][$contentType];
            } else {
                $customRules = $this->prepareCustomRules($request, $contentType, $entity);
            }
        }

        $this->customRules = $customRules;
    }

    /** Get the content's type based on content id for DatumRequest and FieldRequest instances
     *
     * @param CustomFormRequest $request
     * @param $entity null|string
     * @return string
     */
    private function getContentTypeVal($request, $entity)
    {
        if(!is_null($entity)){
            $type = '';
            if (($request instanceof ContentDatumCreateRequest) || ($request instanceof ContentFieldCreateRequest)) {
                $contentId = $request->request->get('content_id');
                $content = $this->contentService->getById($contentId);

                return $content['type'];
            }
            return $type;
        }

        return $this->getContentTypeVal($request, $entity);
    }

    /** Prepare the custom validation rules.
     *
     * @param $entity
     * @param $contentType
     * @param $rules
     * @param $generalRules
     * @return mixed
     */
    private function prepareCustomRules($request, $contentType, $entity)
    {
        $rules = [];

        if (array_key_exists($entity, ConfigService::$validationRules[ConfigService::$brand][$contentType])) {
            $customRules = ConfigService::$validationRules[ConfigService::$brand][$contentType][$entity];

            $entity_key = $request->request->get('key');
            $entity_type = $request->request->get('type');

            foreach ($customRules as $key => $value) {
                if (
                    (($request instanceof ContentFieldCreateRequest) &&
                        ($key == implode('|', $entity_key, $entity_type))) ||
                    (($request instanceof ContentDatumCreateRequest) && ($key == $entity_key))
                ) {
                    $rules = array_merge(
                        $rules,
                        [
                            'value' => $value
                        ]
                    );
                }
            }
        }
        return $rules;
    }
}