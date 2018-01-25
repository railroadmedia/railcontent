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
    ){
        $this->contentService = $contentService;
        $this->contentDatumService = $contentDatumService;
        $this->contentFieldService = $contentFieldService;
        $this->validationFactory = $validationFactory;

        parent::__construct();
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
        // 1--------------------------------------------------------

        $content = null;                // code-smell!
        $contentId = null;              // code-smell!
        $contentType = null;            // code-smell!
        $keysOfValuesRequestedToSet = []; // code-smell!
        $restricted = null;             // code-smell!

        $input = $request->request->all();

        // 2--------------------------------------------------------

        $this->setContentToValidate();

        // 3--------------------------------------------------------

        $rulesExistForBrand = isset(ConfigService::$validationRules[ConfigService::$brand]);

        $restrictedExistsForBrand = array_key_exists(
            'restricted_for_invalid_content',
            ConfigService::$validationRules[ConfigService::$brand]
        );

        if ($rulesExistForBrand && $restrictedExistsForBrand){
            $restricted = ConfigService::$validationRules[ConfigService::$brand]['restricted_for_invalid_content'];
        }

        if(in_array($contentType, array_keys($restricted['custom']))){
            $restricted = $restricted['custom'][$contentType];
        }else{
            $restricted = $restricted['default'];
        }

        throw_if(empty($restricted), // code-smell! Why are we doing this? Is it not obvious that it should just be set?
            new \Exception('$restricted not filled in (Railroad) CustomFormRequest::validateContent')
        );


        // 4--------------------------------------------------------

        $this->prepareForContentValidation();

        throw_if(empty($contentType), // code-smell!
            new \Exception('$contentType not filled in (Railroad) CustomFormRequest::validateContent')
        );
        throw_if(empty($keysOfValuesRequestedToSet), // code-smell!
            new \Exception('$keysOfValuesRequestedToSet not filled in (Railroad) CustomFormRequest::validateContent')
        );

        throw_unless(isset(ConfigService::$validationRules[ConfigService::$brand]),
            new \Exception('lynchPin not set for brand: "' . ConfigService::$brand . '"')
        );


        // 5--------------------------------------------------------

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


        // 6--------------------------------------------------------

        return true;
    }

    protected function setContentToValidate(){

    }

    protected function prepareForContentValidation(){

    }
}