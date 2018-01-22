<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
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
     * @var ContentDatumService
     */
    private $contentDatumService;
    /**
     * @var ContentFieldService
     */
    private $contentFieldService;

    /**
     * ValidationService constructor.
     *
     * @param $contentService
     */
    public function __construct(
        ContentService $contentService,
        ContentDatumService $contentDatumService,
        ContentFieldService $contentFieldService
    )
    {
        $this->contentService = $contentService;
        $this->contentDatumService = $contentDatumService;
        $this->contentFieldService = $contentFieldService;
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

        $noEntity = is_null($entity);
        $thereIsEntity = (!$noEntity);

        $contentType =
            $thereIsEntity ? $this->getContentTypeVal($request) : $request->request->get('type');

        if (isset(ConfigService::$validationRules[ConfigService::$brand]) &&
            array_key_exists($contentType, ConfigService::$validationRules[ConfigService::$brand])) {
            if (!$entity) {
                $customRules = ConfigService::$validationRules[ConfigService::$brand][$contentType];
            } else {
                $customRules = $this->prepareCustomRules($request, $contentType, $entity);
            }
        }

        $this->customRules = $customRules;
        return $customRules;
    }

    /** Get the content's type based on content id for DatumRequest and FieldRequest instances
     *
     * @param ContentDatumCreateRequest|ContentFieldCreateRequest $request
     * @return string
     */
    private function getContentTypeVal($request)
    {
        $type = '';
        if ( ($request instanceof ContentDatumCreateRequest) || ($request instanceof ContentFieldCreateRequest) ) {
            $contentId = $request->request->get('content_id');
            $content = $this->contentService->getById($contentId);

            return $content['type'];
        }

        return $type;
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

    public function validateContent($request)
    {
        $contentType = null;
        $contentDatumOrFieldKey = null;

        if(!empty($request->request->get('content_id'))){
            // create request
            $contentType = $this->contentService->getById($request->request->get('content_id'))['type'];

            $contentType = $this->contentService->getById($request->request->get('key'))['type'];
            $contentDatumOrFieldKey = $request->request->get('key');
        }elseif($request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest){
            // update request
            $id = $request->request->get('id');

            $contentDatumOrField = null;
            if ($request instanceof ContentDatumUpdateRequest){
                $contentDatumOrField = $this->contentDatumService->get($id);
            }elseif($request instanceof ContentFieldUpdateRequest) {
                $contentDatumOrField = $this->contentFieldService->get($id);
            }
            if(empty($contentDatumOrField)){
                throw new \Exception(
                    '$contentDatumOrField not filled in 
                    \Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
                );
            }

            $content = $this->contentService->getById($contentDatumOrField['content_id']);
            $contentType = $content['type'];
            $contentDatumOrFieldKey = $contentDatumOrField['key'];
        }

        if(empty($contentType)){
            throw new \Exception(
                '$contentType not filled in 
                \Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
            );
        }

        if(empty($contentDatumOrFieldKey)){
            throw new \Exception(
                '$contentDatumOrFieldKey not filled in 
                \Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
            );
        }

        if (
            isset(ConfigService::$validationRules[ConfigService::$brand])
            &&
            array_key_exists('lynchPinInfo', ConfigService::$validationRules[ConfigService::$brand])
        ){
            $lynchPinInfo = ConfigService::$validationRules[ConfigService::$brand][$contentType]['lynchPinInfo'];
        }


        if(empty($lynchPinInfo)){
            throw new \Exception(
                '$lynchPinInfo not filled in 
                \Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
            );
        }

        if($contentDatumOrFieldKey === $lynchPinInfo){
            // todo: validate content
            // todo: validate content
            // todo: validate content



        }

        return true;
    }
}