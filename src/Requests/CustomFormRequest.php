<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentHierarchyService;
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
     * @var ValidationFactory
     */
    private $validationFactory;
    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * ValidationService constructor.
     *
     * @param $contentService
     */
    public function __construct(
        ContentService $contentService,
        ContentDatumService $contentDatumService,
        ContentFieldService $contentFieldService,
        ValidationFactory $validationFactory,
        ContentHierarchyService $contentHierarchyService
    ) {
        $this->contentService = $contentService;
        $this->contentDatumService = $contentDatumService;
        $this->contentFieldService = $contentFieldService;
        $this->validationFactory = $validationFactory;
        $this->contentHierarchyService = $contentHierarchyService;
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
        if (($request instanceof ContentDatumCreateRequest) ||
            ($request instanceof ContentFieldCreateRequest)) {
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

                $keyForField = $key == implode('|', [$entity_key, $entity_type]);
                $keyForDatum = $key == $entity_key;

                $getRulesForField = $keyForField && ($request instanceof ContentFieldCreateRequest);
                $getRulesForDatum = $keyForDatum && ($request instanceof ContentDatumCreateRequest);

                if ($getRulesForField || $getRulesForDatum) {
                    $rules = array_merge($rules, ['value' => $value]);
                }
            }
        }
        return $rules;
    }

    /**
     * @param CustomFormRequest $request
     * @return bool
     */
    public function validateContent($request)
    {
        //  - get the status "states to guard"
        //      - if we *are* writing|updating status, to what value are we wanting to set it to?
        //      - if the value we want to set is in "the states to guard", validate content (return 422 if fails)
        //  - if we *not* are writing|updating status, get the current status
        //      - if the current status is in "the states to guard", validate content (return 422 if fails)

        /*
         * Note that laravel 5.6 has a change to the `ValidatesWhenResolved` and `ValidatesWhenResolvedTrait`.
         * This may or may not affect this functionality of this method and related functionality. Thus, be aware of
         * this change in laravel and address if needed.
         *
         * Jonathan, March 2018
         */

        $contentValidationRequired = null;
        $rulesForBrand = null;
        $content = null;

        try{
            $this->getContentForValidation($request, $contentValidationRequired, $rulesForBrand, $content);
        }catch(\Exception $exception){
            throw new HttpResponseException(
                new JsonResponse(['messages' => $exception->getMessage()], 500)
            );
        }

        if ($contentValidationRequired) {

            $counts = [];
            $cannotHaveMultiple = [];

            if (isset($rulesForBrand[$content['type']]['number_of_children'])) {
                $inputToValidate = $this->contentHierarchyService->countParentsChildren([$content['id']])[$content['id']] ?? 0;
                $rule = $rulesForBrand[$content['type']]['number_of_children'];
                $this->validateRule($inputToValidate, $rule, 'number_of_children', 1);
            }


            /*
             * Loop through the components of the content which we're modifying (or modifying a component of) and on
             * each loop through validation rules for that content's type
             */
            foreach ($content as $propertyName => $contentPropertySet) {
                foreach ($rulesForBrand[$content['type']] as $rulesPropertyKey => $rules) {

                    /*
                     * Ignore this section of the rules at this point - it's used elsewhere.
                     */
                    if ($rulesPropertyKey !== 'number_of_children') {

                        /*
                         * If there's rule for the content-component we're currently at in our looping, then validate
                         * that component.
                         */
                        foreach ($rules as $criteriaKey => $criteria) {
                            if ($propertyName === $rulesPropertyKey && !empty($criteria)) { // matches field & datum segments

                                /*
                                 * Loop through the components to validate where needed
                                 */
                                foreach ($contentPropertySet as $contentProperty) {

                                    $key = $contentProperty['key'];
                                    $inputToValidate = $contentProperty['value'];

                                    /*
                                     * Will be empty for field & datum creates - thus indicates when the current
                                     * operation is one a ContentFieldCreateRequest or ContentDataCreateRequest.
                                     * Thus, the value requested to set can be accessed directly from the request.
                                     */
                                    if(!empty($contentProperty['id'])){
                                        if ($request->get('id') == $contentProperty['id']) {
                                            $inputToValidate = $request->get('value');
                                        }
                                    }

                                    /*
                                     * If the field|datum item is itself a piece of content, get the id so that can be
                                     * passed to the closure that evaluates the presence of that content in the database
                                     */
                                    if (($contentProperty['type'] ?? null) === 'content' && isset($inputToValidate['id'])) {
                                        $inputToValidate = $inputToValidate['id'];
                                    }

                                    /*
                                     * Validate the component
                                     */
                                    if ($key === $criteriaKey) {
                                        $position = $contentProperty['position'] ?? null;

                                        $this->validateRule($inputToValidate, $criteria['rules'], $key, $position );

                                        $thisOneCanHaveMultiple = false;
                                        if(array_key_exists('can_have_multiple', $criteria)) {
                                            $thisOneCanHaveMultiple = $criteria['can_have_multiple'];
                                        }
                                        if(!$thisOneCanHaveMultiple){
                                            $cannotHaveMultiple[] = $key;
                                            $counts[$key] = isset($counts[$key]) ? $counts[$key] + 1 : 1;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            foreach ($cannotHaveMultiple as $key) {
                $this->validateRule((int)$counts[$key], 'numeric|max:1', $key . '_count', 1);
            }
        }
        return true;
    }

    /**
     * @param CustomFormRequest $request
     * @param $contentValidationRequired
     * @param $rulesForBrand
     * @param $content
     * @throws \Exception
     */
    private function getContentForValidation(
        CustomFormRequest $request,
        &$contentValidationRequired,
        &$rulesForBrand,
        &$content
    ){
        $content = null;
        $minimumRequiredChildren = null;

        $rulesForBrand = [];

        $contentValidationRequired = false;

        $input = $request->request->all();

        $rulesExistForBrand = isset(ConfigService::$validationRules[ConfigService::$brand]);

        if ($rulesExistForBrand) {
            $rulesForBrand = ConfigService::$validationRules[ConfigService::$brand];
        }

        if (!is_array($rulesForBrand)) {
            throw_unless(
                is_string($rulesForBrand),
                new \Exception(
                    '"$rulesForBrand" is neither string nor array. wtf.'
                )
            );
            $rulesForBrand = [$rulesForBrand];
        }

        $restrictions = $rulesForBrand['restrictions'];

        if ($request instanceof ContentCreateRequest) {
            if (isset($input['status'])) {
                if (in_array($input['status'], $restrictions)) {
                    throw new \Exception('Status cannot be set to: "' . $input['status'] . '" on content-create.');
                }
            }
        }

        if ($request instanceof ContentUpdateRequest) {
            if (isset($input['status'])) {
                if (in_array($input['status'], $restrictions)) {
                    $contentValidationRequired = true;
                }
            }

            // get content

            $urlPath = parse_url($_SERVER['HTTP_REFERER'])['path'];
            $urlPath = explode('/', $urlPath);

            // if this is equal to content-type continue, else error
            $urlPathThirdLastElement = array_values(array_slice($urlPath, -3))[0];

            // if this is edit continue, else error
            $urlPathSecondLastElement = array_values(array_slice($urlPath, -2))[0];

            if ($urlPathSecondLastElement !== 'edit') {
                error_log(
                    'Attempting to validate content-update, but url path\'s second-last element does not ' .
                    'match expectations. (expected "edit", got "' . $urlPathSecondLastElement . '")'
                );
            }

            // content_id
            $urlPathLastElement = array_values(array_slice($urlPath, -1))[0];

            $contentId = (integer)$urlPathLastElement;
            $content = $this->contentService->getById($contentId);

            if ($urlPathThirdLastElement !== $content['type']) {
                error_log(
                    'Attempting to validate content-update, but url path\'s third-last element does not ' .
                    'match expectations. (expected "' .
                    $content['type'] .
                    '", got "' .
                    $urlPathSecondLastElement .
                    '")'
                );
            }
        }

        // get content status, if content status is restricted, then validation is required

        if ($request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest) {
            $contentId = $request->request->get('content_id');
            if (empty($contentId)) {
                error_log(
                    'Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                    'content_id passed. This is at odds with what we\'re expecting and might be cause for concern'
                );
            }
            $content = $this->contentService->getById($contentId);
            $contentValidationRequired = in_array($content['status'], $restrictions);


            if ($request instanceof ContentFieldCreateRequest) {
                $content['fields'][] = ['key' => $input['key'], 'value' => $input['value']];
            }

            if ($request instanceof ContentDatumCreateRequest) {
                $content['data'][] = ['key' => $input['key'], 'value' => $input['value']];
            }
        }

        if ($request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest) {
            $contentDatumOrField = [];

            if ($request instanceof ContentFieldUpdateRequest) {
                $contentDatumOrField = $this->contentFieldService->get(
                    array_values($request->route()->parameters())[0]
                );
            }

            if ($request instanceof ContentDatumUpdateRequest) {
                $contentDatumOrField = $this->contentDatumService->get(
                    array_values($request->route()->parameters())[0]
                );
            }

            throw_if(
                empty($contentDatumOrField),
                new \Exception(
                    '$contentDatumOrField not filled in ' .
                    '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
                )
            );
            $contentId = $contentDatumOrField['content_id'];
            $content = $this->contentService->getById($contentId);
            $contentValidationRequired = in_array($content['status'], $restrictions);


            if ($request instanceof ContentFieldUpdateRequest) {
                foreach($content['fields'] as $propertyKey => &$field){
                    if($propertyKey === 'key'){
                        $field['value'] = $input['value'];
                    }
                }
            }

            if ($request instanceof ContentDatumUpdateRequest) {
                foreach($content['data'] as $propertyKey => &$datum){
                    if($propertyKey === 'key'){
                        $datum['value'] = $input['value'];
                    }
                }
            }
        }
    }

    public function validateRule($inputToValidate, $rule, $key, $position = 0)
    {
        try {
            $this->validationFactory->make(
                [$key => $inputToValidate],
                [$key => $rule]
            )->validate();
        } catch (ValidationException $exception) {
            $messages = $exception->validator->messages()->messages();
            $formattedValidationMessages = [];

            foreach ($messages as $messageKey => $errors) {
                $formattedValidationMessages[] = [
                    'key' => $messageKey,
                    'position' => $position,
                    'errors' => $errors,
                ];
            }

            throw new HttpResponseException(
                new JsonResponse(['messages' => $formattedValidationMessages], 422)
            );
        }
    }
}