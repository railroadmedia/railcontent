<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentHierarchyService;
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
    )
    {
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

                $keyForField = $key == implode('|', [$entity_key, $entity_type]);
                $keyForDatum = $key == $entity_key;

                $getRulesForField = $keyForField && ($request instanceof ContentFieldCreateRequest);
                $getRulesForDatum = $keyForDatum && ($request instanceof ContentDatumCreateRequest);

                if ($getRulesForField || $getRulesForDatum) {
                    $rules = array_merge( $rules, ['value' => $value]);
                }
            }
        }
        return $rules;
    }

    public function validateContent($request)
    {
        /*
         *      - get "the states to guard", are we writing|updating status?
         *      - if yes, to what value are we wanting to set it to?
         *          - if the value we want to set is in "the states to guard"
         *              - validate content (return 422 if fails)
         *              - exit
         *      - if no, get the current status means
         *          - if the current status is in "the states to guard"
         *              - validate content (return 422 if fails)
         *              - exit
         */

        $content = null;
        $requestedDatumOrFieldToSet = null;

        $rulesForBrand = [];

        $contentValidationRequired = false;

        $input = $request->request->all();

        $rulesExistForBrand = isset(ConfigService::$validationRules[ConfigService::$brand]);

        if ($rulesExistForBrand){
            $rulesForBrand = ConfigService::$validationRules[ConfigService::$brand];
        }

        if(!is_array($rulesForBrand)){
            throw_unless(is_string($rulesForBrand), new \Exception(
                '"$rulesForBrand" is neither string nor array. wtf.'
            ));
            $rulesForBrand = [$rulesForBrand];
        }

        $restrictions = $rulesForBrand['restrictions'];

        if($request instanceof ContentCreateRequest) {
            if(isset($input['status'])){
                if(in_array($input['status'], $restrictions)){
                    throw new \Exception(
                        'Status cannot be set to: "' . $input['status'] . '" on content-create.'
                    );
                }
            }
            $contentValidationRequired = false;
        }

        if($request instanceof ContentUpdateRequest) {
            if(isset($input['status'])){
                if(in_array($input['status'], $restrictions)){
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

            if($urlPathSecondLastElement !== 'edit'){
                error_log(
                    'Attempting to validate content-update, but url path\'s second-last element does not ' .
                    'match expectations. (expected "edit", got "' . $urlPathSecondLastElement . '")'
                );
            }

            // content_id
            $urlPathLastElement = array_values(array_slice($urlPath, -1))[0];

            $contentId = (integer) $urlPathLastElement;
            $content = $this->contentService->getById($contentId);

            if($urlPathThirdLastElement !== $content['type']){error_log(
                'Attempting to validate content-update, but url path\'s third-last element does not ' .
                'match expectations. (expected "' . $content['type'] . '", got "' . $urlPathSecondLastElement . '")'
            );}
        }

        // get content status, if content status is restricted, then validation is required

        if($request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest){
            $contentId = $request->request->get('content_id');
            if(empty($contentId)){
                error_log('Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                    'content_id passed. This is at odds with what we\'re expecting and might be cause for concern');
            }
            $content = $this->contentService->getById($contentId);
            $contentValidationRequired = in_array($content['status'], $restrictions);

            $requestedDatumOrFieldToSet = [$input['key'] => $input['value']];
        }

        if($request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest){
            $contentDatumOrField = $this->contentFieldService->get($request->request->get('id'));
            throw_if(empty($contentDatumOrField), // code-smell!
                new \Exception('$contentDatumOrField not filled in ' . '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent')
            );
            $contentId = $contentDatumOrField['content_id'];
            $content = $this->contentService->getById($contentId);
            $contentValidationRequired = in_array($content['status'], $restrictions);

            $requestedDatumOrFieldToSet = [$contentDatumOrField['key'] => $input['value']];
        }

        if($contentValidationRequired) {

            $contentType = $content['type'];
            $brand = ConfigService::$brand;
            $allRules = ConfigService::$validationRules;

            if(!array_key_exists($brand, $allRules)){
                return true;
            }

            $rulesForBrand = $allRules[$brand];

            foreach($rulesForBrand as $rulesForTypes){
                if(array_key_exists($contentType, $rulesForTypes)){
                    $rulesForContentType = $rulesForBrand[$contentType];
                }
            }


            // =========================================================================================================
            // =========================================================================================================
            // =========================================================================================================


//            $contentPropertiesForValidation = $this->contentService->getContentPropertiesForValidation(
//                $content, $rulesForContentType
//            );
//
//            $rulesForContentTypeReorganized = [];
//
//            // flatten content-details to easily-validated set
//            foreach($rulesForContentType as $primaryKey => $rulesOrArrayOfRules){
//                if(($primaryKey === 'datum') || ($primaryKey === 'fields')){
//                    foreach($rulesOrArrayOfRules as $keyForRule => $rule){
//                        $rulesForContentTypeReorganized[$keyForRule] = $rule;
//                    }
//                }else{
//                    $rulesForContentTypeReorganized[$primaryKey] = $rulesOrArrayOfRules;
//                }
//            }
//
//            // flatten rules so can be parsed by validator
//            $rulesForContentTypeModified = [];
//            foreach($rulesForContentTypeReorganized as $ruleKey => $ruleValue){
//                // we want to get rid of the "can_have_multiple" item and "de-nest" the rules in $rules['rules']
//                if(isset($ruleValue['rules'])){
//                    $rulesForContentTypeModified[$ruleKey] = $ruleValue['rules'];
//
//                    $rulesForContentTypeModified[$ruleKey . '_count'] = 'max:1';
//                    if(in_array('can_have_multiple', array_keys($ruleValue))){
//                        if($ruleValue['can_have_multiple']){
//                            $rulesForContentTypeModified[$ruleKey . '_count'] = '';
//                        }
//                    }
//                }
//            }
//            $rulesForContentTypeReorganized = $rulesForContentTypeModified;
//
//            // add rules for "can_have_multiple" then a count for each so all the validation happens in 1 call
//            $contentPropertiesForValidationWithCounts = [];
//            foreach($contentPropertiesForValidation as $propertyName =>$property){
//                $contentPropertiesForValidationWithCounts[$propertyName . '_count'] = count($property);
//            }
//            $contentPropertiesForValidation = array_merge(
//                $contentPropertiesForValidation, $contentPropertiesForValidationWithCounts
//            );
//
//            // get number of children from content-hierarchy and get minimum number from config for content-type
//            if(isset($rulesForContentType['minimum_required_children'])){
//
//                $rulesForContentTypeReorganized['number_of_children'] =
//                    $rulesForContentType['minimum_required_children'];
//
//                $contentPropertiesForValidation['number_of_children'] =
//                    (int)$this->contentHierarchyService->countParentsChildren([$content['id']])[$content['id']];
//
//                $aa_typeOf_rulesForContentTypeReorganized = gettype($rulesForContentTypeReorganized['number_of_children']);
//                $aa_typeOf_contentPropertiesForValidation = gettype($contentPropertiesForValidation['number_of_children']);
//
//
//            }
//
//            // the `!is_null($requestedDatumOrFieldToSet)` is basically for Datum|Field Requests (abstract it out
//            // ... with those if you refactor this)
//            if(!empty($rulesForContentTypeReorganized) && !is_null($requestedDatumOrFieldToSet)){
//                /*
//                 * We want to validate the content with the **yet-unsaved** requested (field|datum) change (*not* the
//                 * current state, but rather the state that would exist *after* we apply the requested change, if with
//                 * that change the content would be valid and we would therefore make that change).
//                 *
//                 * Jonathan, January 2018
//                 */
//                $nameOfDatumOrFieldToSet = array_keys($requestedDatumOrFieldToSet)[0];
//                if(isset($contentPropertiesForValidation[$nameOfDatumOrFieldToSet])){
//                    $contentPropertiesForValidation[$nameOfDatumOrFieldToSet] =
//                        $requestedDatumOrFieldToSet[$nameOfDatumOrFieldToSet];
//                }
//            }
//
//            try{
//                $this->validationFactory->make($contentPropertiesForValidation, $rulesForContentTypeReorganized)->validate();
//            }catch(ValidationException $exception){
//                /*
//                 * Validation failure will interrupt writing field|datum - thus preventing the publication or
//                 * scheduling of a ill-formed lesson.
//                 *
//                 * Jonathan, January 2018
//                 */
//                $messages = $exception->validator->messages()->messages();
//                return new JsonResponse(['messages' => $messages], 422);
//            }

            // =========================================================================================================
            // =========================================================================================================
            // =========================================================================================================

            $content['number_of_children'] = $this->contentHierarchyService->
            countParentsChildren([$content['id']])[$content['id']];

            $minimumRequiredChildren = null;

            $validate = function ($value, $rule){
                $rule = is_array($rule) ? $rule : [$rule];
                $value = is_array($value) ? $value : [$value];

                $bbb_validateRanWith[] = [
                    'rule' => $rule,
                    'value' => $value
                ];

                try {
                    $this->validationFactory->make($value, $rule)->validate();
                } catch (ValidationException $exception) {
                    $messages = $exception->validator->messages()->messages();
                    throw new HttpResponseException(
                        new JsonResponse(['messages' => $messages], 422)
                    );
                }
            };

            foreach($content as $aaa_c_1_contentPropertyKey => $aaa_c_1_contentPropertyValue){

                foreach(
                    $rulesForBrand[$contentType] as
                    $aaa_r_1_contentPropertyName => $aaa_r_1_contentPropertyValidationCriteria
                ){
                    if($aaa_r_1_contentPropertyName === 'number_of_children'){
                        // todo
                    }else{
                         if(!is_array($aaa_r_1_contentPropertyValidationCriteria)){
                             break;
                         }
                        foreach(
                            $aaa_r_1_contentPropertyValidationCriteria as
                            $aaa_r_2_contentPropertyValidationCriteria_key => $aaa_r_2_contentPropertyValidationCriteria_value
                        ){
                            foreach($aaa_r_2_contentPropertyValidationCriteria_value as $aaa_r_3_criteria_key => $aaa_r_3_criteria_value){

                                if($aaa_r_3_criteria_key === $aaa_c_1_contentPropertyKey){

                                    if($aaa_r_3_criteria_key === 'rules'){
                                        $rule = $aaa_r_3_criteria_value;
                                        $value = $aaa_c_1_contentPropertyValue;
                                        $validate($value, $rule);
                                    }

                                    // todo
                                    // todo
                                    // todo
                                    // if($aaa_r_3_criteria_key === 'can_have_multiple'){
                                    //     $can_have_multiple[$aaa_r_3_criteria_value][] = $aaa_r_2_contentPropertyValidationCriteria_value;
                                    // }

                                }
                            }
                        }
                    }
                }

//                if($a_1_contentPropertyKey === 'field' || $a_1_contentPropertyKey === 'datum'){
//                    if($a_1_contentPropertyKey === $aaa_r_3_criteria_key){
//                        $value = $a_1_propertyValue;
//                    }
//                }

            }
        }

        return true;
    }
}