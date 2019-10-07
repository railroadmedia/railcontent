<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Railroad\Railcontent\Services\ResponseService;

/**  Form Request - extend the Laravel Form Request class and handle the validation errors messages
 *
 * Class FormRequest
 *
 * @package Railroad\Railcontent\Requests
 */
class FormRequest extends LaravelFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (ResponseService::$oldResponseStructure) {
            $request = $this->all();
            $oldStyle = [];

            foreach (config('oldResponseMapping.request_attributes', []) as $attribute) {
                if ($this->has($attribute)) {
                    $oldStyle['data']['attributes'][$attribute] = $this->get($attribute);
                }
            }

            foreach (config('oldResponseMapping.request_relationships', []) as $old => $type) {

                if ($this->has($old)) {
                    $oldStyle['data']['relationships'][$type] = [
                        'data' => [
                            'type' => $type,
                            'id' => $this->get($old),
                        ],
                    ];
                }
            }

            $newParams = array_merge_recursive($request, $oldStyle);

            $this->replace($newParams);
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $attributePrettyNames = [];

        foreach ($this->rules() as $attribute => $rules) {
            $attributePrettyNames[$attribute] = str_replace('_', ' ', last(explode('.', $attribute)));
        }
        return $attributePrettyNames;
    }

    /** Get the failed validation response in json format
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        foreach (
            $validator->errors()
                ->getMessages() as $key => $value
        ) {
            $errors[] = [
                "title" => 'Validation failed.',
                "source" => $key,
                "detail" => $value[0],
            ];
        }
        throw new HttpResponseException(
            response()->json(['errors' => $errors], 422)
        );
    }
}