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
         * get "the states to guard"
         *
         * are we writing|updating status?
         *
         * if yes
         *
         *      to what value are we wanting to set it to?
         *
         *      if the value we want to set is in "the states to guard"
         *
         *          validate content (return 422 if fails)
         *
         *          exit
         *
         * if no
         *
         *      get the current status means
         *
         *      if the current status is in "the states to guard"
         *
         *          validate content (return 422 if fails)
         *
         *          exit
         */

        // 1 -----------------------------------------------------------------------------------------------------------

        $rulesForBrand = [];
        $restrictedStatuses = [];

        $contentValidationRequired = false;

        $input = $request->request->all();

        if($request instanceof ContentCreateRequest) {
            $contentType = $input['type'];
        }

        // todo: $contentUpdate = $request instanceof ContentUpdateRequest;
        // todo: $fieldOrDatumCreate = $request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest;
        // todo: $fieldOrDatumUpdate = $request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest;


        // 2 -----------------------------------------------------------------------------------------------------------

        // todo: get "restricted"

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

        foreach($rulesForBrand as $restrictedStatusesComposite => $rulesForContentTypes){
            $restrictedStatusesComposite = explode('|', $restrictedStatusesComposite);
            foreach($restrictedStatusesComposite as $status){
                $restrictedStatuses[] = $status;
            }
        }

        // 3 -----------------------------------------------------------------------------------------------------------


        if($request instanceof ContentCreateRequest) {
            if(isset($input['status'])){
                if(in_array($input['status'], $restrictedStatuses)){
                    throw new \Exception(
                        'Status cannot be set to: "' . $input['status'] . '" on content-create.'
                    );
                }
            }

            $contentValidationRequired = false;
        }

        // todo: $contentUpdate = $request instanceof ContentUpdateRequest;
        // todo: $fieldOrDatumCreate = $request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest;
        // todo: $fieldOrDatumUpdate = $request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest;




        if($contentValidationRequired){

            // todo: do content validation

            $foo = 'bar';

        }

        return true;
    }



    public function validateContent_OLD_VERSION($request)
    {

        // 111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111

        $content = null;                // code-smell!
        $contentId = null;              // code-smell!
        $contentType = null;            // code-smell!
        $keysOfValuesRequestedToSet = []; // code-smell!
        $restricted = null;             // code-smell!

        $input = $request->request->all();

        // 222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222

//        $contentCreate = $request instanceof ContentCreateRequest;
//        $contentUpdate = $request instanceof ContentUpdateRequest;
//        $fieldOrDatumCreate = $request instanceof ContentDatumCreateRequest ||
//            $request instanceof ContentFieldCreateRequest;
//        $fieldOrDatumUpdate = $request instanceof ContentDatumUpdateRequest ||
//            $request instanceof ContentFieldUpdateRequest;
//        $hierarchyCreate = $request instanceof ContentHierarchyCreateRequest;
//        $hierarchyUpdate = $request instanceof ContentHierarchyUpdateRequest;


        // 333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333

        if($fieldOrDatumCreate){
            $contentId = $request->request->get('content_id');
            if(empty($contentId)){
                error_log('Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                    'content_id passed. This is at odds with what we\'re expecting and might be cause for concern');
            }
            $content = $this->contentService->getById($contentId);
            $contentType = $content['type'];
            $keysOfValuesRequestedToSet[] = $request->request->get('key');
        }elseif($fieldOrDatumUpdate){
            $contentDatumOrField = $this->contentFieldService->get($request->request->get('id'));
            throw_if(empty($contentDatumOrField), // code-smell!
                new \Exception('$contentDatumOrField not filled in ' . '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent')
            );
            $contentId = $contentDatumOrField['content_id'];
            $content = $this->contentService->getById($contentId);
            $contentType = $content['type'];
            $keysOfValuesRequestedToSet[] = $contentDatumOrField['key'];
        }elseif($contentCreate) {
            $contentType = $input['type'];
        }elseif($contentUpdate) {

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
            $contentType = $content['type'];

            if($urlPathThirdLastElement !== $contentType){
                error_log(
                    'Attempting to validate content-update, but url path\'s third-last element does not ' .
                    'match expectations. (expected "' . $contentType . '", got "' . $urlPathSecondLastElement . '")'
                );
            }
        }elseif($hierarchyCreate) {
            $contentType = null;
        }elseif($hierarchyUpdate) {
            $contentType = null;
        }else{
            throw new \Exception('Unexpected request type');
        }

        // 444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444

//        $rulesExistForBrand = isset(ConfigService::$validationRules[ConfigService::$brand]);
//
//        $restrictedExistsForBrand = array_key_exists(
//            'restricted_for_invalid_content',
//            ConfigService::$validationRules[ConfigService::$brand]
//        );

//        if ($rulesExistForBrand && $restrictedExistsForBrand){
//            $restricted = ConfigService::$validationRules[ConfigService::$brand]['restricted_for_invalid_content'];
//        }

        if(in_array($contentType, array_keys($restricted['custom']))){
            $restricted = $restricted['custom'][$contentType];
        }else{
            $restricted = $restricted['default'];
        }

        throw_if(empty($restricted), // code-smell! Why are we doing this? Is it not obvious that it should just be set?
            new \Exception('$restricted not filled in (Railroad) CustomFormRequest::validateContent')
        );


        // 555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555

        if($fieldOrDatumCreate){
            // moved
        }elseif($fieldOrDatumUpdate){
            // moved
        }elseif($contentCreate) {
//            foreach($input as $inputKey => $inputValue){
//                if(in_array($inputKey, $restricted)){
//                    throw new \Exception(
//                        'Trying to create new content and passing a value that is protected by the ' .
//                        'content validation system ("' . $inputKey . '" is restricted and thus cannot be set on ' .
//                        'create). This value should not be sent in create requests such as this. It happening is ' .
//                        'likely due to an incorrectly configured form.'
//                    );
//                }
//                $keysOfValuesRequestedToSet[] = $inputKey;
//            }
//            /*
//             * No need to validate - the user is just creating the content and thus of course it won't pass, and
//             * we know they're not setting a value that would set it live.
//             *
//             * Jonathan, January 2018
//             */
//            return true;
        }elseif($contentUpdate) {

            $restrictedAttemptedToSet = false;

            foreach($input as $inputKey => $inputValue){
                if(in_array($inputKey, $restricted)){
                    $restrictedAttemptedToSet = true;
                }
                $keysOfValuesRequestedToSet[] = $inputKey;
            }

            if(!$restrictedAttemptedToSet){
                /*
                 * No need to validate - the user is just updating or setting a content attribute that is not
                 * disallowed for invalid contents and thus must not be protected.
                 *
                 * Jonathan, January 2018
                 */

                return true;
            }
        }elseif($hierarchyCreate) {

            // todo...?
            // todo...?
            // todo...?

        }elseif($hierarchyUpdate) {

            // todo...?
            // todo...?
            // todo...?

        }else{
            throw new \Exception('Unexpected request type');
        }

        throw_if(empty($contentType), // code-smell!
            new \Exception('$contentType not filled in (Railroad) CustomFormRequest::validateContent')
        );
        throw_if(empty($keysOfValuesRequestedToSet), // code-smell!
            new \Exception('$keysOfValuesRequestedToSet not filled in (Railroad) CustomFormRequest::validateContent')
        );

        throw_unless(isset(ConfigService::$validationRules[ConfigService::$brand]),
            new \Exception('lynchPin not set for brand: "' . ConfigService::$brand . '"')
        );


        // 666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666666

        $attemptingToSetRestricted = false;

        foreach($keysOfValuesRequestedToSet as $keyRequestedToSet){
            if(in_array($keyRequestedToSet, $restricted)){
                $attemptingToSetRestricted = true;
            }
        }

        if($attemptingToSetRestricted){ // ... then we need to validate lest we set restricted on an invalid content

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

                /*
                 * Validation failure will interrupt writing field|datum - thus preventing the publication or
                 * scheduling of a ill-formed lesson.
                 *
                 * Jonathan, January 2018
                 */
            }
        }


        // 7777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777

        return true;
    }
}