<?php

namespace Railroad\Railcontent\Requests;

use App\Http\Requests\Scalecenter\ContentCreate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        ConfigService::$cacheTime = -1;
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
        $contentValidationRequired = null;
        $rulesForBrand = null;
        $content = null;
        $messages = [];

        try {
            $this->getContentForValidation($request, $contentValidationRequired, $rulesForBrand, $content);
        } catch (\Exception $exception) {
            throw new HttpResponseException(
                new JsonResponse($exception, 500)
            );
        }

        if (!$contentValidationRequired) {
            return true;
        }

        $counts = [];
        $cannotHaveMultiple = [];

        foreach ($rulesForBrand[$content['type']] as $setOfContentTypes => $rulesForContentType) {

            $setOfContentTypes = explode('|', $setOfContentTypes);

            if (!in_array($content['status'], $setOfContentTypes)) {
                continue;
            }

            if (isset($rulesForContentType['number_of_children'])) {

                $numberOfChildren = $this->contentHierarchyService->countParentsChildren(
                    [$content['id']]
                )[$content['id']] ?? 0;

                $rule = $rulesForContentType['number_of_children'];

                if(is_array($rule) && key_exists('rules', $rule)){
                    $rule = $rule['rules'];
                }

                $messages = array_merge(
                    $messages,
                    $this->validateRuleAndGetErrors($numberOfChildren, $rule, 'number_of_children', 1)
                );
            }
        }

        /*
         * Determine "required" elements, and validate that they're present in the content.
         * The main validation section below fails to do this, thus its handled here by itself.
         * Maybe one day refactor it so it's all tidy and together, for now this works.
         */

        $required = [];

        foreach ($rulesForBrand[$content['type']] as $setOfContentTypes => $rulesForContentType) {

            $setOfContentTypes = explode('|', $setOfContentTypes);

            if (!in_array($content['status'], $setOfContentTypes)) {
                continue;
            }

            foreach ($rulesForContentType as $rulesPropertyKey => $rules) {

                if (!is_array($rules)) {
                    continue;
                }

                if($rulesPropertyKey === 'number_of_children'){
                    continue;
                }

                foreach ($rules as $criteriaKey => &$criteria) {

                    if (!isset($criteria['rules'])) {
                        error_log(
                            $content['type'] . '.' . $criteriaKey . ' for one of the brands is missing the ' .
                            '"rules" key in the validation config'
                        );
                    }

                    if (is_array($criteria['rules'])) {
                        if (in_array('required', $criteria['rules'])) {
                            $required[$rulesPropertyKey][] = $criteriaKey;
                        }
                    } elseif (strpos($criteria['rules'], 'required') !== false) {
                        $required[$rulesPropertyKey][] = $criteriaKey;
                    }
                }
            }
        }

        foreach ($required as $propertyKey => $list) {

            if (!is_string($propertyKey)) {
                $message = 'You are likely missing a key in the config validation rules for this content-type: "' .
                    print_r(json_encode($required), true) . '"';
                if (!array_key_exists('fields', $required)) {
                    $message = $message . ' Perhaps the "' . $propertyKey . '" key should instead be "fields"?';
                } elseif (!array_key_exists('data', $required)) {
                    $message = $message . ' Perhaps the "' . $propertyKey . '" key should instead be "data"?';
                }
                throw new HttpResponseException(new JsonResponse(['messages' => $message], 500));
            }

            foreach ($list as $requiredElement) {
                $pass = false;
                foreach ($content[$propertyKey] as $contentPropertySet) {
                    if ($contentPropertySet['key'] === $requiredElement) {
                        $pass = true;
                    }
                }
                if (!$pass) {
                    $messages = array_merge(
                        $messages,
                        $this->validateRuleAndGetErrors(null, 'required', $requiredElement)
                    );
                }
            }
        }

        /*
         * Loop through the components of the content which we're modifying (or modifying a component of) and on
         * each of those loops, then loop through validation rules for that content's type
         */
        foreach ($content as $propertyName => $contentPropertySet) {

            foreach ($rulesForBrand[$content['type']] as $setOfContentTypes => $rulesForContentType) {

                $setOfContentTypes = explode('|', $setOfContentTypes);

                if (!in_array($content['status'], $setOfContentTypes)) {
                    continue;
                }

                foreach ($rulesForContentType as $rulesPropertyKey => $rules) {

                    /*
                     * "number_of_children" rules are handled elsewhere.
                     */
                    if ($rulesPropertyKey === 'number_of_children') {
                        continue;
                    }

                    // $rulesPropertyKey will be "data" or "fields"

                    /*
                     * If there's rule for the content-component we're currently at in our looping, then validate
                     * that component.
                     */
                    foreach ($rules as $criteriaKey => $criteria) {

                        if (!($propertyName === $rulesPropertyKey && !empty($criteria))) {
                            continue; // if does not match field & datum segments
                        }

                        /*
                         * Loop through the components to validate where needed
                         */
                        foreach ($contentPropertySet as $contentProperty) {

                            $key = $contentProperty['key'];
                            $fieldOrDatumValue = $contentProperty['value'];

                            /*
                             * If the field|datum item is itself a piece of content, get the id so that can be
                             * passed to the closure that evaluates the presence of that content in the database
                             */
                            if (($contentProperty['type'] ?? null) === 'content' && isset($fieldOrDatumValue['id'])) {
                                $fieldOrDatumValue = $fieldOrDatumValue['id'];
                            }

                            if ($key !== $criteriaKey) {
                                continue;
                            }

                            // Validate the component

                            $position = $contentProperty['position'] ?? null;

                            $messages = array_merge(
                                $messages,
                                $this->validateRuleAndGetErrors(
                                    $fieldOrDatumValue,
                                    $criteria['rules'],
                                    $key,
                                    $position
                                )
                            );

                            $thisOneCanHaveMultiple = false;

                            if (array_key_exists('can_have_multiple', $criteria)) {
                                $thisOneCanHaveMultiple = $criteria['can_have_multiple'];
                            }

                            if (!$thisOneCanHaveMultiple) {
                                $cannotHaveMultiple[] = $key;
                                $counts[$key] = isset($counts[$key]) ? $counts[$key] + 1 : 1;
                            }
                        }
                    }
                }
            }
        }

        foreach ($cannotHaveMultiple as $key) {
            $messages = array_merge(
                $messages,
                $this->validateRuleAndGetErrors((int)$counts[$key], 'numeric|max:1', $key . '_count', 1)
            );
        }

        if (!empty($messages)) {
            throw new HttpResponseException(
                new JsonResponse(['messages' => $messages], 422)
            );
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
    ) {
        $minimumRequiredChildren = null;
        $contentValidationRequired = false;
        $input = $request->request->all();

        $brand = null;
        $content = $this->getContentFromRequest($request);

        if(empty($content)){
            $contentValidationRequired = false;
            return;
        }

        $allValidationRules = ConfigService::$validationRules;

        if(empty($allValidationRules)){
            $contentValidationRequired = false;
            return;
        }

        if(empty($content['brand'])){
            $contentValidationRequired = false;
            return;
        }

        $rulesForBrand = $allValidationRules[$content['brand']] ?? [];

        if(empty($rulesForBrand[$content['type']])){
            $contentValidationRequired = false;
            return;
        }

        $restrictions = $this->getStatusRestrictionsForType($content['type'], $rulesForBrand);



        /*
         * ================== TEMPORARILY DISABLED SO JANADO CAN DO HIS THING. WAITING ON FRONT-END ==================
         *
         * The containing if ($timeIsUp || $appEnvIsDev) statement can be removed after Curtis fixes the thing where
         * course-parts (and probably other similar content) is created with requested "status" set to "published".
         * This is happening regardless of what the parent is set.
         *
         * Jonathan, 27th April 2018
         */

        // =============================================================================================================
        // =============================================================================================================
        $appEnv = env('APP_ENV'); $appEnvIsDev = $appEnv === 'development'; // delete this after F.E. fixed
        $timeIsUp = \Carbon\Carbon::now()->gt(\Carbon\Carbon::createFromDate(2018, 5, 8)); // delete this after F.E. fixed
        if($timeIsUp || $appEnvIsDev){ // delete this after F.E. fixed
        // =============================================================================================================
        // =============================================================================================================


            /* leave **this** if-statement after the F.E. is fixed */
            
            if ($request instanceof ContentCreateRequest) {
                if (isset($input['status'])) {
                    if (in_array($input['status'], $restrictions)) {
                        throw new \Exception('Status cannot be set to: "' . $input['status'] . '" on content-create.');
                    }
                }
            }

        // =============================================================================================================
        // =============================================================================================================
        } // delete this after F.E. fixed
        // =============================================================================================================
        // =============================================================================================================


        /*
         * part 1 - Validation required?
         *
         * part 2 - If request to create, update, or delete **A FIELD OR DATUM**, need content prepared for validation
         * to reflect the "requested whole" of the content - fields, data and all. The many cases below accomplish that
         * by preparing the content
         */

        if ($request instanceof ContentUpdateRequest) {

            // part 1
            $requestedStatusRequiresValidation = false;
            if (isset($input['status'])) {
                if (in_array($input['status'], $restrictions)) {
                    $requestedStatusRequiresValidation = true;
                }
            }
            $contentValidationRequired = $requestedStatusRequiresValidation || in_array(
                    $content['status'],
                    $restrictions
                );

            // part 2
            foreach ($input as $key => $value) {
                $content[$key] = $value;
            }
        }

        if ($request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest) {

            // part 1
            $contentValidationRequired = in_array($content['status'], $restrictions);

            // part 2
            $content[$request instanceof ContentFieldCreateRequest ? 'fields' : 'data'][] = [
                'key' => $input['key'],
                'value' => $input['value']
            ];
        }

        if ($request instanceof ContentDatumUpdateRequest || $request instanceof ContentFieldUpdateRequest) {

            // part 1
            $contentValidationRequired = in_array($content['status'], $restrictions);

            // part 2
            $fieldsOrData = $request instanceof ContentFieldUpdateRequest ? 'fields' : 'data';
            foreach ($content[$fieldsOrData] as &$item) {
                if ($item['id'] == $input['id']) {
                    $item['value'] = $input['value'];
                }
            }
        }

        if ($request instanceof ContentDatumDeleteRequest || $request instanceof ContentFieldDeleteRequest) {

            // part 1
            $contentValidationRequired = in_array($content['status'], $restrictions);

            // part 2
            if ($contentValidationRequired) {

                $idInParam = array_values($request->route()->parameters())[0];

                $fieldsOrData = $request instanceof ContentFieldDeleteRequest ? 'fields' : 'data';

                foreach ($content[$fieldsOrData] as $index => $fieldOrData) {

                    if ($fieldOrData['id'] == $idInParam) {
                        unset($content[$fieldsOrData][$index]);
                    }

                }
            }
        }

        $contentValidationRequired = $contentValidationRequired && isset($rulesForBrand[$content['type']]);
    }

    private function getContentFromRequest(Request $request)
    {
        if ($request instanceof ContentCreateRequest) {
            return $request->all();
        }

        if ($request instanceof ContentUpdateRequest) {
            $urlPath = explode('/', parse_url($request->fullUrl())['path']);
            return $this->contentService->getById((integer)array_values(array_slice($urlPath, -1))[0]);
        }

        if ($request instanceof ContentDatumCreateRequest || $request instanceof ContentFieldCreateRequest) {

            $contentId = $request->request->get('content_id');

            if (empty($contentId)) {
                error_log(
                    'Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                    'content_id passed. This is at odds with what we\'re expecting and might be cause for concern'
                );
            }

            return $this->contentService->getById($contentId);
        }

        if ($request instanceof ContentFieldDeleteRequest || $request instanceof ContentFieldUpdateRequest) {
            $idInParam = array_values($request->route()->parameters())[0];
            $contentDatumOrField = $this->contentFieldService->get($idInParam);
        }

        if(!empty($contentDatumOrField)){
            return $this->contentService->getById($contentDatumOrField['content_id']);
        }

        return [];
    }

    private function getStatusRestrictionsForType($contentType, $rulesForBrand)
    {
        $restrictions = [];
        foreach ($rulesForBrand[$contentType] as $setOfRestrictedStatuses => $rulesForContentType) {
            $setOfRestrictedStatuses = explode('|', $setOfRestrictedStatuses);
            $restrictions = array_merge($restrictions, $setOfRestrictedStatuses);
        }
        return $restrictions;
    }

    public function validateRule($fieldOrDatumValue, $rule, $key, $position = 0)
    {
        try {
            $this->validationFactory->make(
                [$key => $fieldOrDatumValue],
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

    public function validateRuleAndGetErrors($fieldOrDatumValue, $rule, $key, $position = 0)
    {
        try {
            $this->validateRule($fieldOrDatumValue, $rule, $key, $position);
        } catch (HttpResponseException $exception) {
            return $exception->getResponse()->getData(true)['messages'];
        }

        return [];
    }
}