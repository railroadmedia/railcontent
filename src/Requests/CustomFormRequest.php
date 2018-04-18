<?php

namespace Railroad\Railcontent\Requests;

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
        $messages = [];

        try {
            $this->getContentForValidation($request, $contentValidationRequired, $rulesForBrand, $content);
        } catch (\Exception $exception) {
            throw new HttpResponseException(
                new JsonResponse(['messages' => $exception->getMessage()], 500)
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
                break;
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
                break;
            }

            foreach ($rulesForContentType as $rulesPropertyKey => $rules) {

                if (!is_array($rules)) {
                    break;
                }

                if ($rulesPropertyKey === 'number_of_children') {
                    break;
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
                    break;
                }

                foreach ($rulesForContentType as $rulesPropertyKey => $rules) {

                    /*
                     * "number_of_children" rules are handled elsewhere.
                     */
                    if ($rulesPropertyKey === 'number_of_children') {
                        break;
                    }

                    // $rulesPropertyKey will be "data" or "fields"

                    /*
                     * If there's rule for the content-component we're currently at in our looping, then validate
                     * that component.
                     */
                    foreach ($rules as $criteriaKey => $criteria) {

                        if (!($propertyName === $rulesPropertyKey && !empty($criteria))) {
                            break; // if does not match field & datum segments
                        }

                        /*
                         * Loop through the components to validate where needed
                         */
                        foreach ($contentPropertySet as $contentProperty) {

                            $key = $contentProperty['key'];
                            $inputToValidate = $contentProperty['value'];

                            /*
                             * If the field|datum item is itself a piece of content, get the id so that can be
                             * passed to the closure that evaluates the presence of that content in the database
                             */
                            if (($contentProperty['type'] ?? null) === 'content' && isset($inputToValidate['id'])) {
                                $inputToValidate = $inputToValidate['id'];
                            }

                            if ($key !== $criteriaKey) {
                                break;
                            }

                            // Validate the component

                            $position = $contentProperty['position'] ?? null;

                            $messages = array_merge(
                                $messages,
                                $this->validateRuleAndGetErrors(
                                    $inputToValidate,
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

        $rulesForBrand = ConfigService::$validationRules[$content['brand']] ?? [];

        $restrictions = $this->getStatusRestrictionsForType($content['type'], $rulesForBrand);

        if ($request instanceof ContentCreateRequest) {
            if (isset($input['status'])) {
                if (in_array($input['status'], $restrictions)) {
                    throw new \Exception('Status cannot be set to: "' . $input['status'] . '" on content-create.');
                }
            }
        }

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
                $unset = null;
                $idInParam = array_values($request->route()->parameters())[0];
                $fieldsOrData = $request instanceof ContentFieldDeleteRequest ? 'fields' : 'data';
                foreach ($content[$fieldsOrData] as $propertyKey => $field) {
                    if ($field['id'] === (integer)$idInParam) {
                        $unset = $propertyKey;
                    }
                }
                if (notNullValue($unset)) {
                    unset($content['fields'][$unset]);
                }
            }
        }

        $contentValidationRequired = $contentValidationRequired || isset($rulesForBrand[$content['type']]);
    }

    private function getContentFromRequest(Request $request)
    {
        if ($request instanceof ContentUpdateRequest) {

            $urlPath = explode('/', parse_url($_SERVER['HTTP_REFERER'])['path']);

            //$brand = array_values(array_slice($urlPath, -4))[0];

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

        $idInParam = array_values($request->route()->parameters())[0];

        if ($request instanceof ContentFieldDeleteRequest || $request instanceof ContentFieldUpdateRequest) {
            $contentDatumOrField = $this->contentFieldService->get($idInParam);
        } else {
            $contentDatumOrField = $this->contentDatumService->get($idInParam);
        }

        throw_if(
            empty($contentDatumOrField),
            new \Exception(
                '$contentDatumOrField not filled in ' .
                '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent'
            )
        );

        return $this->contentService->getById($contentDatumOrField['content_id']);
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

    public function validateRuleAndGetErrors($inputToValidate, $rule, $key, $position = 0)
    {
        try {
            $this->validateRule($inputToValidate, $rule, $key, $position);
        } catch (HttpResponseException $exception) {
            return $exception->getResponse()->getData(true)['messages'];
        }

        return [];
    }
}