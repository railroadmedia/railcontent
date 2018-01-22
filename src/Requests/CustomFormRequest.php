<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Illuminate\Validation\Factory as ValidationFactory;

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
     * @var ValidationFactory
     */
    private $validationFactory;

    /**
     * ValidationService constructor.
     *
     * @param $contentService
     */
    public function __construct(
        ContentService $contentService,
        ContentDatumService $contentDatumService,
        ContentFieldService $contentFieldService,
        ValidationFactory $validationFactory
    )
    {
        $this->contentService = $contentService;
        $this->contentDatumService = $contentDatumService;
        $this->contentFieldService = $contentFieldService;
        $this->validationFactory = $validationFactory;
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
        $content = null;                // code-smell!
        $contentId = null;              // code-smell!
        $contentType = null;            // code-smell!
        $contentDatumOrFieldKey = null; // code-smell!
        $lynchPin = null;           // code-smell!

        if(!empty($request->request->get('content_id'))){

            /*
             * ContentDatumCreateRequest and ContentFieldCreateRequest both pass in a content_id for the new field or
             * datum to describe. However, if the field|datum already exists, then we just need *its* id, not the
             * content_id. Thus here we're using the content_id to determine if the request is a create or an update.
             *
             * note the code smell below with the "elseif"
             * $request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest
             *
             * Jonathan Jan 2018
             */

            // create request
            $contentId = $request->request->get('content_id');
            $content = $this->contentService->getById($contentId);
            $contentType = $content['type'];
            $contentDatumOrFieldKey = $request->request->get('key');

        }elseif($request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest){

            // update request

            $id = $request->request->get('id');

            $contentDatumOrField = null; // code-smell!

            if ($request instanceof ContentDatumUpdateRequest){
                $contentDatumOrField = $this->contentDatumService->get($id);
            }elseif($request instanceof ContentFieldUpdateRequest) {
                $contentDatumOrField = $this->contentFieldService->get($id);
            }

            throw_if(empty($contentDatumOrField), // code-smell!
                new \Exception('$contentDatumOrField not filled in ' . '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent')
            );

            $contentId = $contentDatumOrField['content_id'];
            $content = $this->contentService->getById($contentId);
            $contentType = $content['type'];
            $contentDatumOrFieldKey = $contentDatumOrField['key'];
        }else{
            throw new \Exception(
                'Both "!empty($request->request->get(\'content_id\'))"  and ' .
                '"$request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest"... ' .
                'are false. Should not be possible.'
            );
        }

        throw_if(empty($contentType), // code-smell!
            new \Exception('$contentType not filled in (Railroad) CustomFormRequest::validateContent')
        );
        throw_if(empty($contentDatumOrFieldKey), // code-smell!
            new \Exception('$contentDatumOrFieldKey not filled in (Railroad) CustomFormRequest::validateContent')
        );

        throw_unless(isset(ConfigService::$validationRules[ConfigService::$brand]),
            new \Exception('lynchPin not set for brand: "' . ConfigService::$brand . '"')
        );

        $rulesExistForBrand = isset(ConfigService::$validationRules[ConfigService::$brand]);

        $lynchPinExistsForBrand = array_key_exists(
            'lynchPin',
            ConfigService::$validationRules[ConfigService::$brand]
        );

        if ($rulesExistForBrand && $lynchPinExistsForBrand){
            $lynchPin = ConfigService::$validationRules[ConfigService::$brand]['lynchPin'];
        }

        throw_if(empty($lynchPin), // code-smell!
            new \Exception('$lynchPin not filled in (Railroad) CustomFormRequest::validateContent')
        );

        if(in_array($contentType, array_keys($lynchPin['special_cases']))){
            $lynchPin = $lynchPin['special_cases'][$contentType];
        }
        $lynchPinFieldKey = $lynchPin['field'];

        if($contentDatumOrFieldKey === $lynchPinFieldKey){

            throw_unless($content, new NotFoundException('No content with id ' . $contentId . ' exists.')); // code-smell

            $rules = $this->contentService->getValidationRules($content);

            if($rules === false){
                return new JsonResponse('Application misconfiguration. Validation rules missing perhaps.', 503);
            }

            $contentPropertiesForValidation = $this->contentService->getContentPropertiesForValidation($content, $rules);

            try{
                $this->validationFactory->make($contentPropertiesForValidation, $rules)->validate();
            }catch(ValidationException $exception){
                $messages = $exception->validator->messages()->messages();
                return new JsonResponse(['messages' => $messages], 422);
            }
        }

        return true;
    }
}