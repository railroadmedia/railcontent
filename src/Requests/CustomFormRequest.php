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

    public function validateContent($request)
    {
        // todo: ↓ is this comment still valid|helpful?
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

        $aa______ = '================================================================================================';
        $aa_____1 = '================================================================================================';
        $aa_____2 = '================================================================================================';
        $aa_____3 = '================================================================================================';
        $aa_____4 = '================================================================================================';

        $cc______ = '================================================================================================';
        $cc_____1 = '================================================================================================';
        $cc_____2 = '================================================================================================';
        $cc_____3 = '================================================================================================';
        $cc_____4 = '================================================================================================';


        $contentValidationRequired = null;
        $rulesForBrand = null;
        $aa_content = null;

        $counts = [];
        $cannotHaveMultiple = [];

        $this->getContentForValidation($request, $contentValidationRequired, $rulesForBrand, $aa_content);

        if ($contentValidationRequired) {

            $rulesForContentType = $rulesForBrand[$aa_content['type']];

            if (isset($rulesForContentType['number_of_children'])) {
                $this->validateRule(
                    $this->contentHierarchyService->countParentsChildren([$aa_content['id']])[$aa_content['id']]
                    ??
                    0,
                    $rulesForContentType['number_of_children'],
                    'number_of_children',
                    1
                );
            }

            foreach ($aa_content as $aa_propertyName => $aa_contentPropertySet) {
                foreach ($rulesForContentType as $bb_rulesPropertyKey => $bb_rules) {

                    if ($bb_rulesPropertyKey !== 'number_of_children') {
                        foreach ($bb_rules as $bb_criteriaKey => $bb_criteria) {

                            if($bb_criteriaKey === 'sheet_music_image_url' && $aa_propertyName === 'data'){
                                $stop = 'here';
                            }

                            if ($aa_propertyName === $bb_rulesPropertyKey && !empty($bb_criteria)) { // matches field & datum segments
                                foreach ($aa_contentPropertySet as $contentProperty) {
                                    $aa_key = $contentProperty['key'];

                                    if(!empty($contentProperty['id'])){ // will be empty for field & datum creates
                                        if ($request->get('id') == $contentProperty['id']) {
                                            $contentProperty['value'] = $request->get('value');
                                        }
                                    }

                                    if (($contentProperty['type'] ?? null) == 'content' &&
                                        isset($contentProperty['value']['id'])) {
                                        $contentProperty['value'] = $contentProperty['value']['id'];
                                    }

                                    if ($aa_key === $bb_criteriaKey) {
                                        $this->validateRule(
                                            $contentProperty['value'],
                                            $bb_criteria['rules'],
                                            $aa_key,
                                            $contentProperty['position'] ?? null
                                        );
                                        if(!$bb_criteria['can_have_multiple']){
                                            $cannotHaveMultiple[] = $aa_key;
                                            $counts[$aa_key] = isset($counts[$aa_key]) ? $counts[$aa_key] + 1 : 1;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach ($cannotHaveMultiple as $key) {
                // todo: ensure that if this fails, you get a good message for the user
                $count = (int)$counts[$key];
                $this->validateRule($count, 'max:1', $key . '_count', 1);
            }
        }

        return true;
    }

    private function getContentForValidation($request, &$contentValidationRequired, &$rulesForBrand, &$content){
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

        // =============================================================================================================

        if ($request instanceof ContentCreateRequest) {
            if (isset($input['status'])) {
                if (in_array($input['status'], $restrictions)) {
                    throw new \Exception(
                        'Status cannot be set to: "' . $input['status'] . '" on content-create.'
                    );
                }
            }
            $contentValidationRequired = false;
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
                $content['fields'][] = ['key' => $input['key'], 'value' => $input['value']];
            }

            if ($request instanceof ContentDatumUpdateRequest) {
                $content['data'][] = ['key' => $input['key'], 'value' => $input['value']];
            }
        }
    }

    public function validateRule($value, $rule, $key, $position = 0)
    {
        try {
            $this->validationFactory->make(
                [$key => $value],
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