<?php

namespace Railroad\Railcontent\Requests;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;
use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

/** Custom Form Request that contain the validation logic for the CMS.
 * There are:
 *      general rules - are the same for all the brands and content types
 *      custom rules - are defined by the developers in the configuration file and are defined per brand and content
 * type
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
     * @var ValidationFactory
     */
    private $validationFactory;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var JsonApiHydrator
     */
    private $jsonApiHydrator;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CustomFormRequest constructor.
     *
     * @param ContentService $contentService
     * @param ContentDatumService $contentDatumService
     * @param ContentHierarchyService $contentHierarchyService
     * @param JsonApiHydrator $jsonApiHydrator
     * @param EntityManager $entityManager
     * @param ValidationFactory $validationFactory
     */
    public function __construct(
        ContentService $contentService,
        ContentDatumService $contentDatumService,
        ContentHierarchyService $contentHierarchyService,
        JsonApiHydrator $jsonApiHydrator,
        EntityManager $entityManager,
        ValidationFactory $validationFactory
    ) {
        $this->contentService = $contentService;
        $this->contentDatumService = $contentDatumService;
        $this->jsonApiHydrator = $jsonApiHydrator;
        $this->entityManager = $entityManager;
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
     * @param null|string $entity - can be null or 'datum'
     *
     * @return array $customRules
     */
    public function setCustomRules($request, $entity = null)
    {
        $customRules = [];

        $noEntity = is_null($entity);
        $thereIsEntity = (!$noEntity);

        $contentType =
            $thereIsEntity ? $this->getContentTypeVal($request) : $request->input('data.attributes.type')  ?? '';

        if (isset(config('railcontent.validation')[config('railcontent.brand')]) &&
            array_key_exists($contentType, config('railcontent.validation')[config('railcontent.brand')])) {
            if (!$entity) {
                $customRules['data.attributes.fields'] =
                    config('railcontent.validation')[config('railcontent.brand')][$contentType];
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
        if (($request instanceof ContentDatumCreateRequest) || ($request instanceof ContentFieldCreateRequest)) {
            $contentId = $request->input('data.relationships.content.data.id');
            $content = $this->contentService->getById($contentId);

            return ($content) ? $content->getType() : '';
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

        if (array_key_exists($entity, config('railcontent.validation')[config('railcontent.brand')][$contentType])) {
            $customRules = config('railcontent.validation')[config('railcontent.brand')][$contentType][$entity];

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
                response()->json(
                    [
                        'code' => 500,
                        'errors' => $exception,
                    ]
                )
            );
        }

        if (!$contentValidationRequired) {
            return true;
        }

        $counts = [];
        $cannotHaveMultiple = [];

        foreach ($rulesForBrand[$content->getType()] as $setOfContentTypes => $rulesForContentType) {

            $setOfContentTypes = explode('|', $setOfContentTypes);

            if (!in_array($content->getStatus(), $setOfContentTypes)) {
                continue;
            }

            if (isset($rulesForContentType['number_of_children'])) {

                $numberOfChildren = $this->contentHierarchyService->countParentsChildren(
                        [$content->getId()]
                    )[$content->getId()] ?? 0;

                $rule = $rulesForContentType['number_of_children'];

                if (is_array($rule) && key_exists('rules', $rule)) {
                    $rule = $rule['rules'];
                }

                $messages = array_merge(
                    $messages,
                    $this->validateRuleAndGetErrors($numberOfChildren, $rule, 'number_of_children', 1)
                );
            }

            $fieldRules = $rulesForContentType['fields'] ?? [];
            $dataRules = $rulesForContentType['data'] ?? [];

            foreach ($fieldRules as $field => $rule) {

                $requestData = null;

                //get field from request if exist; otherwise from entity
                if ($request instanceof ContentCreateRequest || $request instanceof ContentUpdateRequest) {
                    $requestData = array_search(
                        $field,
                        array_column(
                            $request->get('data')['attributes']['fields'],
                            'key'
                        )
                    );
                }

                if ($requestData >= 0) {
                    $val = $request->get('data')['attributes']['fields'][$requestData]['value'];
                } else {
                    $get = 'get' . ucfirst($field);
                    $val = $content->$get();
                }

                $messages = array_merge(
                    $messages,
                    $this->validateRuleAndGetErrors($val, $rule['rules'] ?? $rule, $field)
                );
                $this->multipleFields($rule, $field, $cannotHaveMultiple, $counts);
            }

            foreach ($dataRules as $field => $rule) {
                if (($request instanceof ContentDatumCreateRequest || $request instanceof ContentDatumUpdateRequest) &&
                    ($request->get('data')['attributes']['key'] == $field)) {
                    $data = $request->get('data')['attributes']['value'];
                } else {
                    $predictate = function ($element) use ($field) {
                        return $element->getKey() === $field;
                    };

                    $data =
                        $content->getData()
                            ->filter($predictate);
                }

                $messages = array_merge(
                    $messages,
                    $this->validateRuleAndGetErrors($data, $rule['rules'] ?? $rule, $field)
                );

                $this->multipleFields($rule, $field, $cannotHaveMultiple, $counts);
            }
        }

        foreach ($cannotHaveMultiple as $key) {
            $messages = array_merge(
                $messages,
                $this->validateRuleAndGetErrors((int)$counts[$key], 'numeric|max:1', $key . '_count', 1)
            );
        }

        // -------------------------------------------------------------------------------------------------------------

        /*
         * Make a request exempt from validation if the content was created before the validation was implemented
         * (defined by the "validation_exemption_date" in config"), AND the content property edited (when applicable)
         * does not fail validation.
         *
         * Otherwise users can't edit old content that was created before the validation was implemented and may not pass
         * validation. This means that while it's state is a protected one, nothing could be edited because the content
         * would always fail validation.
         */

        if ($request instanceof ContentDatumDeleteRequest) {
            $idInParam = array_values(
                $request->route()
                    ->parameters()
            )[0];

            $keyToCheckForExemption =
                $this->contentDatumService->get($idInParam)
                    ->getKey();
        }

        if ($request instanceof ContentDatumUpdateRequest) {
            $idInParam = array_values(
                $request->route()
                    ->parameters()
            )[0];

            $keyToCheckForExemption =
                $this->contentDatumService->get($idInParam)
                    ->getKey();
        }

        $contentCreatedOn = Carbon::parse(
            $content->getCreatedOn()
                ->format('Y-m-d H:i:s')
        );
        $exemptionDate = new Carbon('1970-01-01 00:00');
        if (!empty(config('railcontent.validation_exemption_date'))) {
            $exemptionDate = new Carbon(config('railcontent.validation_exemption_date'));
        }
        $exempt = $exemptionDate->gt($contentCreatedOn);

        foreach ($messages as $message) {
            if (empty($keyToCheckForExemption)) {
                $keyToCheckForExemption = null;
                if (!empty($request->request->all()['key'])) {
                    $keyToCheckForExemption = $request->request->all()['key'];
                }
            }
            if ($keyToCheckForExemption === $message['key']) {
                $exempt = false;
                $alternativeMessages = [$message];
            }
        }

        if (isset($alternativeMessages)) {
            $messages = $alternativeMessages;
        }

        // -------------------------------------------------------------------------------------------------------------

        /*
         * Passes Validation
         */
        if (empty($messages) || $exempt) {
            return true;
        }

        /*
         * Fails Validation
         */
        throw new HttpResponseException(
            response()->json(
                ['messages' => $messages],
                422
            )
        );
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

        if (empty($content)) {
            $contentValidationRequired = false;
            return;
        }

        $allValidationRules = config('railcontent.validation');

        if (empty($allValidationRules)) {
            $contentValidationRequired = false;
            return;
        }

        if (empty($content->getBrand())) {
            $contentValidationRequired = false;
            return;
        }

        $rulesForBrand = $allValidationRules[$content->getBrand()] ?? [];

        if (empty($rulesForBrand[$content->getType()])) {
            $contentValidationRequired = false;
            return;
        }

        $restrictions = $this->getStatusRestrictionsForType($content->getType(), $rulesForBrand);

        if ($request instanceof ContentCreateRequest) {
            if (isset($input['data']['attributes']['status'])) {
                if (in_array($input['data']['attributes']['status'], $restrictions)) {
                    throw new \Exception(
                        'Status cannot be set to: "' . $input['data']['attributes']['status'] . '" on content-create.'
                    );
                }
            }
        }

        $contentValidationRequired = in_array($content->getStatus(), $restrictions);

        if ($request instanceof ContentUpdateRequest) {
            $requestedStatusRequiresValidation = false;
            if (isset($input['data']['attributes']['status'])) {
                if (in_array($input['data']['attributes']['status'], $restrictions)) {
                    $requestedStatusRequiresValidation = true;
                }
            }

            $contentValidationRequired = $requestedStatusRequiresValidation || in_array(
                    $content->getStatus(),
                    $restrictions
                );
        }

        $contentValidationRequired = $contentValidationRequired && isset($rulesForBrand[$content->getType()]);
    }

    private function getContentFromRequest(Request $request)
    {
        if ($request instanceof ContentCreateRequest) {
            $content = new Content();

            $this->jsonApiHydrator->hydrate($content, $request->onlyAllowed());

            return $content;
        }

        if ($request instanceof ContentUpdateRequest) {

            $urlPath = explode('/', parse_url($request->fullUrl())['path']);
            $id = (integer)array_values(array_slice($urlPath, -1))[0];

            return $this->contentService->getById($id);
        }

        if ($request instanceof ContentDatumCreateRequest) {
            $contentId = $request->input('data.relationships.content.data.id');

            if (empty($contentId)) {
                error_log(
                    'Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                    'content_id passed. This is at odds with what we\'re expecting and might be cause for concern'
                );
            }

            return $this->contentService->getById($contentId);
        }

        if ($request instanceof ContentDatumUpdateRequest) {
            $idInParam = array_values(
                $request->route()
                    ->parameters()
            )[0];

            $contentDatumOrField = $this->contentDatumService->get($idInParam);

        }

        if ($request instanceof ContentDatumDeleteRequest) {
            $idInParam = array_values(
                $request->route()
                    ->parameters()
            )[0];
            $contentDatumOrField = $this->contentDatumService->get($idInParam);

        }

        if (!empty($contentDatumOrField)) {
            return $this->contentService->getById(
                $contentDatumOrField->getContent()
                    ->getId()
            );
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
            )
                ->validate();
        } catch (ValidationException $exception) {

            $messages =
                $exception->validator->messages()
                    ->messages();

            $formattedValidationMessages = [];

            foreach ($messages as $messageKey => $errors) {
                $formattedValidationMessages[] = [
                    'key' => $messageKey,
                    'position' => $position,
                    'errors' => $errors,
                ];
            }

            throw new HttpResponseException(
                response()->json(
                    [
                        'messages' => $formattedValidationMessages,
                    ],
                    422
                )
            );
        }
    }

    public function validateRuleAndGetErrors($fieldOrDatumValue, $rule, $key, $position = 0)
    {
        try {
            $this->validateRule($fieldOrDatumValue, $rule, $key, $position);
        } catch (HttpResponseException $exception) {
            return $exception->getResponse()
                ->getData(true)['messages'];
        }

        return [];
    }

    /**
     * @param $rule
     * @param $field
     * @param array $cannotHaveMultiple
     * @param array $counts
     * @return array
     */
    private function multipleFields($rule, $field, array &$cannotHaveMultiple, array &$counts)
    : array {
        $thisOneCanHaveMultiple = false;

        if (is_array($rule) && array_key_exists('can_have_multiple', $rule)) {
            $thisOneCanHaveMultiple = $rule['can_have_multiple'];
        }

        if (!$thisOneCanHaveMultiple) {
            $cannotHaveMultiple[] = $field;
            $counts[$field] = isset($counts[$field]) ? $counts[$field] + 1 : 1;
        }
        return [$cannotHaveMultiple, $counts];
    }
}